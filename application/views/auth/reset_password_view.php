<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($title) ? $title : 'Reset Password'; ?></title>
    <link rel="stylesheet" href="[https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css](https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css)">
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
                        <h3 class="mb-0">Reset Your Password</h3>
                    </div>
                    <div class="card-body">
                        <?php if (isset($error_message) && $error_message): ?>
                            <div class="alert alert-danger" role="alert">
                                <?php echo $error_message; ?>
                            </div>
                        <?php endif; ?>

                        <?php echo validation_errors('<div class="alert alert-danger" role="alert">', '</div>'); ?>

                        <?php echo form_open('auth/reset_password/' . htmlspecialchars($token)); ?>
                            <input type="hidden" name="token" value="<?php echo htmlspecialchars($token); ?>">
                            <div class="mb-3">
                                <label for="password" class="form-label">New Password</label>
                                <input type="password" class="form-control" id="password" name="password" required autofocus>
                            </div>
                            <div class="mb-3">
                                <label for="passconf" class="form-label">Confirm New Password</label>
                                <input type="password" class="form-control" id="passconf" name="passconf" required>
                            </div>
                            <button type="submit" class="btn btn-success btn-block">Reset Password</button>
                        <?php echo form_close(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>