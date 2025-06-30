<div class="jumbotron text-center">
    <h1 class="display-4">Welcome to Urbanwood Business Directory!</h1>
    <p class="lead">Discover local businesses and services in Gurugram.</p>
    <hr class="my-4">
    <p>Are you a business owner? <a href="<?php echo base_url('register'); ?>">Register your business</a> today!</p>
</div>

<h2 class="mb-4">Featured Businesses</h2>

<?php if (empty($businesses)): ?>
    <div class="alert alert-info" role="alert">
        No active business listings found yet. Please check back later!
    </div>
<?php else: ?>
    <div class="row">
        <?php foreach ($businesses as $business): ?>
            <div class="col-md-4 mb-4">
                <div class="card h-100">
                    <?php if ($business->image): ?>
                        <img src="<?php echo base_url($business->image); ?>" class="card-img-top" alt="<?php echo htmlspecialchars($business->business_name); ?>" style="height: 200px; object-fit: cover;">
                    <?php else: ?>
                        <img src="https://placehold.co/400x200/e0e0e0/333333?text=Business+Image" class="card-img-top" alt="Placeholder" style="height: 200px; object-fit: cover;">
                    <?php endif; ?>
                    <div class="card-body">
                        <h5 class="card-title"><?php echo htmlspecialchars($business->business_name); ?></h5>
                        <h6 class="card-subtitle mb-2 text-muted"><?php echo htmlspecialchars($business->category); ?></h6>
                        <p class="card-text">
                            <?php echo htmlspecialchars($business->address . ', ' . $business->city . ', ' . $business->state); ?><br>
                            <?php if ($business->phone): ?><i class="fas fa-phone-alt mr-1"></i> <?php echo htmlspecialchars($business->phone); ?><br><?php endif; ?>
                            <?php if ($business->email): ?><i class="fas fa-envelope mr-1"></i> <?php echo htmlspecialchars($business->email); ?><br><?php endif; ?>
                        </p>
                        <a href="<?php echo base_url('listings/' . $business->id); ?>" class="btn btn-primary btn-sm mt-2">View Details</a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
<?php endif; ?>