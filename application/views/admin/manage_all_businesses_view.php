<h2 class="mb-4"><?php echo $title; ?></h2>

<?php if (empty($businesses)): ?>
    <div class="alert alert-info" role="alert">
        No business listings found in the system.
    </div>
<?php else: ?>
    <div class="table-responsive">
        <table class="table table-hover table-striped">
            <thead class="thead-dark">
                <tr>
                    <th>ID</th>
                    <th>Image</th>
                    <th>Business Name</th>
                    <th>Owner (ID)</th>
                    <th>Category</th>
                    <th>City, State</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($businesses as $business): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($business->id); ?></td>
                        <td>
                            <?php if ($business->image): ?>
                                <img src="<?php echo base_url($business->image); ?>" alt="<?php echo htmlspecialchars($business->business_name); ?>" class="img-thumbnail" style="width: 80px; height: 60px; object-fit: cover;">
                            <?php else: ?>
                                <img src="[https://placehold.co/80x60/cccccc/333333?text=No+Img](https://placehold.co/80x60/cccccc/333333?text=No+Img)" alt="No Image" class="img-thumbnail" style="width: 80px; height: 60px; object-fit: cover;">
                            <?php endif; ?>
                        </td>
                        <td><?php echo htmlspecialchars($business->business_name); ?></td>
                        <td><?php echo htmlspecialchars($business->user_id); ?></td> <!-- Display owner ID -->
                        <td><?php echo htmlspecialchars($business->category); ?></td>
                        <td><?php echo htmlspecialchars($business->address . ', ' . $business->city . ', ' . $business->state); ?></td>
                        <td>
                            <?php if ($business->status == 1): ?>
                                <span class="badge badge-success">Active</span>
                            <?php elseif ($business->status == 0): ?>
                                <span class="badge badge-warning">Pending</span>
                            <?php else: ?>
                                <span class="badge badge-danger">Rejected</span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <?php if ($business->status == 0): // Only show approve/reject for pending ?>
                                <a href="<?php echo base_url('admin/approve_business/' . $business->id); ?>" class="btn btn-sm btn-success" title="Approve" onclick="return confirm('Are you sure you want to approve this business?');"><i class="fas fa-check-circle"></i></a>
                                <a href="<?php echo base_url('admin/reject_business/' . $business->id); ?>" class="btn btn-sm btn-warning" title="Reject" onclick="return confirm('Are you sure you want to reject this business?');"><i class="fas fa-times-circle"></i></a>
                            <?php endif; ?>
                            <a href="<?php echo base_url('businesses/edit/' . $business->id); ?>" class="btn btn-sm btn-primary" title="Edit (Owner View)"><i class="fas fa-edit"></i></a>
                            <a href="<?php echo base_url('listings/' . $business->id); ?>" class="btn btn-sm btn-info" target="_blank" title="View Public Listing"><i class="fas fa-eye"></i></a>
                            <a href="<?php echo base_url('admin/delete_business/' . $business->id); ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to PERMANENTLY DELETE this business listing? This action cannot be undone.');" title="Delete"><i class="fas fa-trash-alt"></i></a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
<?php endif; ?>