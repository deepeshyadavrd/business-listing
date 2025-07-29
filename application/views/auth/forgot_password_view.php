<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($title) ? $title : 'Forgot Password'; ?></title>
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
                    <div class="card-header bg-warning text-white">
                        <h3 class="mb-0">Forgot Your Password?</h3>
                    </div>
                    <div class="card-body">
                        <p class="text-muted">Enter your email address below and we'll send you a link to reset your password.</p>

                        <?php if (isset($error_message) && $error_message): ?>
                            <div class="alert alert-danger" role="alert">
                                <?php echo $error_message; ?>
                            </div>
                        <?php endif; ?>

                        <?php echo validation_errors('<div class="alert alert-danger" role="alert">', '</div>'); ?>

                        <?php echo form_open('auth/forgot_password'); ?>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email Address</label>
                                <input type="email" class="form-control" id="email" name="email" value="<?php echo set_value('email'); ?>" required autofocus>
                            </div>
                            <button type="submit" class="btn btn-warning btn-block">Send Reset Link</button>
                            <p class="mt-3 text-center"><a href="<?php echo base_url('login'); ?>">Back to Login</a></p>
                        <?php echo form_close(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>