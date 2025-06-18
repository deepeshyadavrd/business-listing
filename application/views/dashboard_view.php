<div class="jumbotron">
    <h1 class="display-4">Welcome to your Dashboard, <?php echo htmlspecialchars($logged_in_username); ?>!</h1>
    <p class="lead">You are logged in as a <strong><?php echo htmlspecialchars($logged_in_user_group_name); ?></strong>.</p>
    <hr class="my-4">
    <p>This is your personal hub where you can manage your business listings and more.</p>
    <p class="lead">
        <a class="btn btn-primary btn-lg" href="<?php echo base_url('businesses/manage'); ?>" role="button"><i class="fas fa-building"></i> Manage My Businesses</a>
        <a class="btn btn-success btn-lg ml-2" href="<?php echo base_url('businesses/add'); ?>" role="button"><i class="fas fa-plus-circle"></i> Add New Business</a>
    </p>
</div>

<div class="row">
    <div class="col-md-4">
        <div class="card text-center mb-3">
            <div class="card-body">
                <h5 class="card-title">My Listings</h5>
                <p class="card-text">View and edit your existing business listings.</p>
                <a href="<?php echo base_url('businesses/manage'); ?>" class="btn btn-info">Go to Listings</a>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card text-center mb-3">
            <div class="card-body">
                <h5 class="card-title">Add New Listing</h5>
                <p class="card-text">Submit a new business to the directory.</p>
                <a href="<?php echo base_url('businesses/add'); ?>" class="btn btn-success">Add Business</a>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card text-center mb-3">
            <div class="card-body">
                <h5 class="card-title">Profile Settings</h5>
                <p class="card-text">Update your account information.</p>
                <a href="<?php echo base_url('profile'); ?>" class="btn btn-secondary">Edit Profile</a>
            </div>
        </div>
    </div>
</div>