<div class="jumbotron">
    <h1 class="display-4">Admin Panel Dashboard</h1>
    <p class="lead">Welcome, <?php echo htmlspecialchars($logged_in_username); ?>! You have full control over the directory.</p>
    <hr class="my-4">
    <p>From here, you can manage all business listings, user accounts, and site settings.</p>
    <p class="lead">
        <a class="btn btn-primary btn-lg" href="<?php echo base_url('admin/manage_businesses'); ?>" role="button"><i class="fas fa-list-alt"></i> Manage All Businesses</a>
        <!-- Add more admin links here later -->
        <a class="btn btn-info btn-lg ml-2" href="#" role="button"><i class="fas fa-users-cog"></i> Manage Users (Coming Soon)</a>
    </p>
</div>

<div class="row">
    <div class="col-md-4">
        <div class="card text-center mb-3">
            <div class="card-body">
                <h5 class="card-title">All Listings</h5>
                <p class="card-text">Review, approve, or reject business submissions.</p>
                <a href="<?php echo base_url('admin/manage_businesses'); ?>" class="btn btn-dark">Go to Listings</a>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card text-center mb-3">
            <div class="card-body">
                <h5 class="card-title">User Accounts</h5>
                <p class="card-text">Manage all user registrations and roles.</p>
                <a href="#" class="btn btn-secondary disabled">Coming Soon</a>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card text-center mb-3">
            <div class="card-body">
                <h5 class="card-title">Site Settings</h5>
                <p class="card-text">Configure global settings for the directory.</p>
                <a href="#" class="btn btn-secondary disabled">Coming Soon</a>
            </div>
        </div>
    </div>
</div>