<h2 class="mb-4"><?php echo $title; ?></h2>

<p>
    <a href="<?php echo base_url('businesses/add'); ?>" class="btn btn-success"><i class="fas fa-plus-circle"></i> Add New Business Listing</a>
</p>

<?php if (empty($businesses)): ?>
    <div class="alert alert-info" role="alert">
        You have no business listings yet. Click "Add New Business Listing" to get started!
    </div>
<?php else: ?>
    <div class="table-responsive">
        <table class="table table-hover table-striped">
            <thead class="thead-dark">
                <tr>
                    <th>Image</th>
                    <th>Business Name</th>
                    <th>Category</th>
                    <th>City, State</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($businesses as $business): ?>
                    <tr>
                        <td>
                            <?php if ($business->image): ?>
                                <img src="<?php echo base_url($business->image); ?>" alt="<?php echo htmlspecialchars($business->business_name); ?>" class="img-thumbnail" style="width: 80px; height: 60px; object-fit: cover;">
                            <?php else: ?>
                                <img src="[https://placehold.co/80x60/cccccc/333333?text=No+Img](https://placehold.co/80x60/cccccc/333333?text=No+Img)" alt="No Image" class="img-thumbnail" style="width: 80px; height: 60px; object-fit: cover;">
                            <?php endif; ?>
                        </td>
                        <td><?php echo htmlspecialchars($business->business_name); ?></td>
                        <td><?php echo htmlspecialchars($business->category); ?></td>
                        <td><?php echo htmlspecialchars($business->city . ', ' . $business->state); ?></td>
                        <td>
                            <?php if ($business->status == 1): ?>
                                <span class="badge badge-success">Active</span>
                            <?php elseif ($business->status == 0): ?>
                                <span class="badge badge-warning">Pending Approval</span>
                            <?php else: ?>
                                <span class="badge badge-danger">Rejected</span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <a href="<?php echo base_url('businesses/edit/' . $business->id); ?>" class="btn btn-sm btn-primary" title="Edit"><i class="fas fa-edit"></i></a>
                            <a href="<?php echo base_url('businesses/delete/' . $business->id); ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this business listing? This action cannot be undone.');" title="Delete"><i class="fas fa-trash-alt"></i></a>
                            <?php if ($business->status == 1): ?>
                                <a href="<?php echo base_url('listings/' . $business->id); ?>" class="btn btn-sm btn-info" target="_blank" title="View Public Listing"><i class="fas fa-eye"></i></a>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
<?php endif; ?>