<div class="row justify-content-center">
    <div class="col-md-10">
        <div class="card">
            <div class="card-header bg-dark text-white">
                <h2 class="mb-0"><?php echo htmlspecialchars($business->business_name); ?></h2>
                <span class="badge badge-secondary"><?php echo htmlspecialchars($business->category); ?></span>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <?php if ($business->image): ?>
                            <img src="<?php echo base_url($business->image); ?>" class="img-fluid rounded mb-3" alt="<?php echo htmlspecialchars($business->business_name); ?>">
                        <?php else: ?>
                            <img src="[https://placehold.co/400x300/e0e0e0/333333?text=No+Image](https://placehold.co/400x300/e0e0e0/333333?text=No+Image)" class="img-fluid rounded mb-3" alt="No Image">
                        <?php endif; ?>
                    </div>
                    <div class="col-md-8">
                        <p class="card-text"><strong>Description:</strong> <?php echo nl2br(htmlspecialchars($business->description)); ?></p>
                        <hr>
                        <p><strong>Address:</strong> <?php echo htmlspecialchars($business->address); ?>, <?php echo htmlspecialchars($business->city); ?>, <?php echo htmlspecialchars($business->state); ?> - <?php echo htmlspecialchars($business->zip_code); ?></p>
                        <?php if ($business->phone): ?>
                            <p><strong>Phone:</strong> <a href="tel:<?php echo htmlspecialchars($business->phone); ?>"><?php echo htmlspecialchars($business->phone); ?></a></p>
                        <?php endif; ?>
                        <?php if ($business->email): ?>
                            <p><strong>Email:</strong> <a href="mailto:<?php echo htmlspecialchars($business->email); ?>"><?php echo htmlspecialchars($business->email); ?></a></p>
                        <?php endif; ?>
                        <?php if ($business->website): ?>
                            <p><strong>Website:</strong> <a href="<?php echo htmlspecialchars($business->website); ?>" target="_blank"><?php echo htmlspecialchars($business->website); ?></a></p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <div class="card-footer text-muted">
                Listed on: <?php echo date('F j, Y', strtotime($business->created_at)); ?>
            </div>
        </div>
        <div class="mt-3">
            <a href="<?php echo base_url(); ?>" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Back to Listings</a>
        </div>
    </div>
</div>