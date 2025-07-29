<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($title) ? $title : 'Login'; ?></title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body { background-color: #f8f9fa; }
        .card { border-radius: 0.75rem; box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075); }
        .card-header { border-radius: 0.75rem 0.75rem 0 0 !important; }
        .invalid-feedback { display: block; }
    </style>
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-success text-white">
                        <h3 class="mb-0">Login to Your Account</h3>
                    </div>
                    <div class="card-body">
                        <?php // Flash messages (success/error) handled by MY_Controller ?>
                        <?php echo validation_errors('<div class="alert alert-danger" role="alert">', '</div>'); ?>

                        <?php echo form_open('auth/login'); ?>
                            <div class="mb-3">
                                <label for="identifier" class="form-label">Username or Email</label>
                                <input type="text" class="form-control" id="identifier" name="identifier" value="<?php echo set_value('identifier'); ?>" required autofocus>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>
                            <div class="mb-3 text-right">
                                <a href="<?php echo base_url('auth/forgot_password'); ?>" class="text-muted">Forgot Password?</a>
                            </div>
                            <button type="submit" class="btn btn-success btn-block">Login</button>
                            <p class="mt-3 text-center">Don't have an account? <a href="<?php echo base_url('register'); ?>">Register here</a></p>
                        <?php echo form_close(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>