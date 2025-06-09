<?php
require_once 'config.php'; // Include your database connection and session_start()

$username_err = $email_err = $password_err = $confirm_password_err = $general_err = '';
$username = $email = ''; // To pre-fill form in case of error

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Input validation
    // Username
    if (empty(trim($_POST["username"]))) {
        $username_err = "Please enter a username.";
    } else {
        $username = trim($_POST["username"]);
        // Check if username already exists
        $sql = "SELECT id FROM users WHERE username = :username";
        if ($stmt = $pdo->prepare($sql)) {
            $stmt->bindParam(":username", $param_username, PDO::PARAM_STR);
            $param_username = $username;
            if ($stmt->execute()) {
                if ($stmt->rowCount() == 1) {
                    $username_err = "This username is already taken.";
                }
            } else {
                $general_err = "Oops! Something went wrong. Please try again later.";
            }
            unset($stmt);
        }
    }

    // Email
    if (empty(trim($_POST["email"]))) {
        $email_err = "Please enter an email.";
    } elseif (!filter_var(trim($_POST["email"]), FILTER_VALIDATE_EMAIL)) {
        $email_err = "Please enter a valid email address.";
    } else {
        $email = trim($_POST["email"]);
        // Check if email already exists
        $sql = "SELECT id FROM users WHERE email = :email";
        if ($stmt = $pdo->prepare($sql)) {
            $stmt->bindParam(":email", $param_email, PDO::PARAM_STR);
            $param_email = $email;
            if ($stmt->execute()) {
                if ($stmt->rowCount() == 1) {
                    $email_err = "This email is already registered.";
                }
            } else {
                $general_err = "Oops! Something went wrong. Please try again later.";
            }
            unset($stmt);
        }
    }

    // Password
    if (empty(trim($_POST["password"]))) {
        $password_err = "Please enter a password.";
    } elseif (strlen(trim($_POST["password"])) < 6) {
        $password_err = "Password must have at least 6 characters.";
    }
    $password = trim($_POST["password"]);

    // Confirm password
    if (empty(trim($_POST["confirm_password"]))) {
        $confirm_password_err = "Please confirm password.";
    } else {
        $confirm_password = trim($_POST["confirm_password"]);
        if (empty($password_err) && ($password != $confirm_password)) {
            $confirm_password_err = "Password did not match.";
        }
    }

    // If no errors, insert into database
    if (empty($username_err) && empty($email_err) && empty($password_err) && empty($confirm_password_err) && empty($general_err)) {
        $sql = "INSERT INTO users (username, email, password, group_id, status) VALUES (:username, :email, :password, :group_id, :status)";

        if ($stmt = $pdo->prepare($sql)) {
            $stmt->bindParam(":username", $param_username, PDO::PARAM_STR);
            $stmt->bindParam(":email", $param_email, PDO::PARAM_STR);
            $stmt->bindParam(":password", $param_password, PDO::PARAM_STR);
            $stmt->bindParam(":group_id", $param_group_id, PDO::PARAM_INT);
            $stmt->bindParam(":status", $param_status, PDO::PARAM_INT);

            $param_username = $username;
            $param_email = $email;
            $param_password = password_hash($password, PASSWORD_BCRYPT); // Hash the password
            $param_group_id = 3; // Default to 'business_owner'
            $param_status = 1;   // Default to active

            if ($stmt->execute()) {
                // Registration successful, set a success message and redirect
                $_SESSION['success_message'] = "Registration successful! You can now log in.";
                header("location: login.php");
                exit();
            } else {
                $general_err = "Something went wrong with registration. Please try again later.";
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
    <title>Register - Business Directory</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body { font-family: Arial, sans-serif; background-color: #f4f7f6; display: flex; justify-content: center; align-items: center; min-height: 100vh; margin: 0; }
        .wrapper { width: 400px; padding: 30px; background-color: #fff; border-radius: 8px; box-shadow: 0 4px 10px rgba(0,0,0,0.1); }
        .form-group { margin-bottom: 15px; }
        .form-group label { display: block; margin-bottom: 5px; font-weight: bold; }
        .form-control { width: 100%; padding: 10px; border: 1px solid #ced4da; border-radius: 4px; box-sizing: border-box; }
        .invalid-feedback { color: #dc3545; font-size: 0.875em; margin-top: 5px; }
        .btn { background-color: #007bff; color: white; padding: 10px 20px; border: none; border-radius: 4px; cursor: pointer; width: 100%; font-size: 1em; }
        .btn:hover { background-color: #0056b3; }
        .text-center { text-align: center; }
        h2 { text-align: center; margin-bottom: 25px; color: #333; }
        .alert-danger { background-color: #f8d7da; border-color: #f5c6cb; color: #721c24; padding: 10px; border-radius: 5px; margin-bottom: 15px; }
    </style>
</head>
<body>
    <div class="wrapper">
        <h2>Register Account</h2>
        <?php if (!empty($general_err)): ?>
            <div class="alert alert-danger"><?php echo $general_err; ?></div>
        <?php endif; ?>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group">
                <label>Username</label>
                <input type="text" name="username" class="form-control <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" value="<?php echo htmlspecialchars($username); ?>">
                <span class="invalid-feedback"><?php echo $username_err; ?></span>
            </div>
            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" class="form-control <?php echo (!empty($email_err)) ? 'is-invalid' : ''; ?>" value="<?php echo htmlspecialchars($email); ?>">
                <span class="invalid-feedback"><?php echo $email_err; ?></span>
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>">
                <span class="invalid-feedback"><?php echo $password_err; ?></span>
            </div>
            <div class="form-group">
                <label>Confirm Password</label>
                <input type="password" name="confirm_password" class="form-control <?php echo (!empty($confirm_password_err)) ? 'is-invalid' : ''; ?>">
                <span class="invalid-feedback"><?php echo $confirm_password_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn" value="Register">
            </div>
            <p class="text-center">Already have an account? <a href="login.php">Login here</a>.</p>
        </form>
    </div>
</body>
</html>