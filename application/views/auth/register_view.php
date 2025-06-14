<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($title) ? $title : 'Register'; ?></title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body { background-color: #f8f9fa; }
        .card { border-radius: 0.75rem; box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075); }
        .card-header { border-radius: 0.75rem 0.75rem 0 0 !important; }
        .invalid-feedback { display: block; } /* Make validation errors always visible if present */
    </style>
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h3 class="mb-0">Register for a New Account</h3>
                    </div>
                    <div class="card-body">
                        <?php if (isset($error_message) && $error_message): ?>
                            <div class="alert alert-danger" role="alert">
                                <?php echo $error_message; ?>
                            </div>
                        <?php endif; ?>

                        <?php echo validation_errors('<div class="alert alert-danger" role="alert">', '</div>'); ?>

                        <?php echo form_open('auth/register'); ?>
                            <div class="mb-3">
                                <label for="username" class="form-label">Username</label>
                                <input type="text" class="form-control" id="username" name="username" value="<?php echo set_value('username'); ?>" required autofocus>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email" value="<?php echo set_value('email'); ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>
                            <div class="mb-3">
                                <label for="passconf" class="form-label">Confirm Password</label>
                                <input type="password" class="form-control" id="passconf" name="passconf" required>
                            </div>
                            <button type="submit" class="btn btn-primary btn-block">Register</button>
                            <p class="mt-3 text-center">Already have an account? <a href="<?php echo base_url('login'); ?>">Login here</a></p>
                        <?php echo form_close(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>