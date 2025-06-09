<?php
require_once 'config.php'; // Include your database connection and session_start()

$identifier_err = $password_err = $general_err = '';
$identifier = ''; // To pre-fill form in case of error

// Check if the user is already logged in, if yes then redirect him to dashboard
if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
    header("location: dashboard.php"); // Change to your preferred logged-in landing page
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Input validation
    if (empty(trim($_POST["identifier"]))) {
        $identifier_err = "Please enter username or email.";
    } else {
        $identifier = trim($_POST["identifier"]);
    }

    if (empty(trim($_POST["password"]))) {
        $password_err = "Please enter your password.";
    }
    $password = trim($_POST["password"]);

    // Validate credentials
    if (empty($identifier_err) && empty($password_err)) {
        // Prepare a select statement
        $sql = "SELECT id, username, email, password, group_id, status FROM users WHERE username = :identifier OR email = :identifier";

        if ($stmt = $pdo->prepare($sql)) {
            // Bind parameters
            $stmt->bindParam(":identifier", $param_identifier, PDO::PARAM_STR);
            $param_identifier = $identifier;

            // Attempt to execute the prepared statement
            if ($stmt->execute()) {
                // Check if username/email exists, if yes then verify password
                if ($stmt->rowCount() == 1) {
                    $user = $stmt->fetch();
                    if ($user->status == 1) { // Check if user account is active
                        if (password_verify($password, $user->password)) {
                            // Password is correct, start a new session
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $user->id;
                            $_SESSION["username"] = $user->username;
                            $_SESSION["email"] = $user->email;
                            $_SESSION["group_id"] = $user->group_id; // Store group_id
                            
                            // Optional: Fetch group name from user_groups table and store in session
                            $sql_group = "SELECT name FROM user_groups WHERE id = :group_id";
                            if ($stmt_group = $pdo->prepare($sql_group)) {
                                $stmt_group->bindParam(":group_id", $user->group_id, PDO::PARAM_INT);
                                if ($stmt_group->execute()) {
                                    $group_info = $stmt_group->fetch();
                                    if ($group_info) {
                                        $_SESSION["group_name"] = $group_info->name;
                                    }
                                }
                                unset($stmt_group);
                            }

                            // Set success message
                            $_SESSION['success_message'] = "Welcome back, " . htmlspecialchars($user->username) . "!";

                            // Redirect user to dashboard page
                            header("location: dashboard.php"); // Change to your preferred logged-in landing page
                            exit;
                        } else {
                            // Password is not valid
                            $password_err = "The password you entered was not valid.";
                        }
                    } else {
                        $general_err = "Your account is inactive. Please contact support.";
                    }
                } else {
                    // Username or email doesn't exist
                    $identifier_err = "No account found with that username or email.";
                }
            } else {
                $general_err = "Oops! Something went wrong. Please try again later.";
            }
            unset($stmt);
        }
    }
    unset($pdo); // Close connection
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Business Directory</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body { font-family: Arial, sans-serif; background-color: #f4f7f6; display: flex; justify-content: center; align-items: center; min-height: 100vh; margin: 0; }
        .wrapper { width: 400px; padding: 30px; background-color: #fff; border-radius: 8px; box-shadow: 0 4px 10px rgba(0,0,0,0.1); }
        .form-group { margin-bottom: 15px; }
        .form-group label { display: block; margin-bottom: 5px; font-weight: bold; }
        .form-control { width: 100%; padding: 10px; border: 1px solid #ced4da; border-radius: 4px; box-sizing: border-box; }
        .invalid-feedback { color: #dc3545; font-size: 0.875em; margin-top: 5px; }
        .btn { background-color: #28a745; color: white; padding: 10px 20px; border: none; border-radius: 4px; cursor: pointer; width: 100%; font-size: 1em; }
        .btn:hover { background-color: #218838; }
        .text-center { text-align: center; }
        h2 { text-align: center; margin-bottom: 25px; color: #333; }
        .alert-danger { background-color: #f8d7da; border-color: #f5c6cb; color: #721c24; padding: 10px; border-radius: 5px; margin-bottom: 15px; }
        .alert-success { background-color: #d4edda; border-color: #c3e6cb; color: #155724; padding: 10px; border-radius: 5px; margin-bottom: 15px; }
    </style>
</head>
<body>
    <div class="wrapper">
        <h2>Login Account</h2>
        <?php
        if (isset($_SESSION['success_message'])) {
            echo '<div class="alert alert-success">' . $_SESSION['success_message'] . '</div>';
            unset($_SESSION['success_message']); // Clear the message after displaying
        }
        if (isset($_SESSION['error_message'])) {
            echo '<div class="alert alert-danger">' . $_SESSION['error_message'] . '</div>';
            unset($_SESSION['error_message']); // Clear the message after displaying
        }
        ?>

        <?php if (!empty($general_err)): ?>
            <div class="alert alert-danger"><?php echo $general_err; ?></div>
        <?php endif; ?>

        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group">
                <label>Username or Email</label>
                <input type="text" name="identifier" class="form-control <?php echo (!empty($identifier_err)) ? 'is-invalid' : ''; ?>" value="<?php echo htmlspecialchars($identifier); ?>">
                <span class="invalid-feedback"><?php echo $identifier_err; ?></span>
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>">
                <span class="invalid-feedback"><?php echo $password_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn" value="Login">
            </div>
            <p class="text-center">Don't have an account? <a href="register.php">Register here</a>.</p>
        </form>
    </div>
</body>
</html>