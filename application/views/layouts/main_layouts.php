<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($title) ? $title : 'Urbanwood Business Directory'; ?></title>
    <!-- Common CSS files -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        body { font-family: Arial, sans-serif; background-color: #f4f7f6; }
        .wrapper { min-height: 100vh; display: flex; flex-direction: column; }
        .content-area { flex: 1; padding: 20px 0; }
        .navbar-brand { font-weight: bold; }
        .footer { background-color: #343a40; color: #fff; padding: 20px 0; text-align: center; }
        .alert-container { margin-top: 20px; }
    </style>
    <!-- You can add page-specific CSS here if passed in $head_includes -->
    <?php echo isset($head_includes) ? $head_includes : ''; ?>
</head>
<body>
    <div class="wrapper">
        <!-- Common Header/Navigation -->
        <?php $this->load->view('common/header'); ?>

        <main class="content-area container">
            <!-- Flash Messages (Success/Error) -->
            <div class="alert-container">
                <?php if (isset($success_message) && $success_message): ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <?php echo $success_message; ?>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                <?php endif; ?>
                <?php if (isset($error_message) && $error_message): ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <?php echo $error_message; ?>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                <?php endif; ?>
            </div>

            <?php
            // THIS IS WHERE THE SPECIFIC PAGE CONTENT IS LOADED
            if (isset($main_content)) {
                $this->load->view($main_content);
            } else {
                echo '<div class="alert alert-warning">No content loaded for this page.</div>';
            }
            ?>
        </main>

        <!-- Common Footer -->
        <?php $this->load->view('common/footer'); ?>
    </div>

    <!-- Common JavaScript files -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
    <!-- You can add page-specific JS here if passed in $footer_includes -->
    <?php echo isset($footer_includes) ? $footer_includes : ''; ?>
</body>
</html>