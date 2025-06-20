<div class="row justify-content-center">
    <div class="col-md-8">
        <h2 class="mb-4"><?php echo $title; ?></h2>

        <?php echo validation_errors('<div class="alert alert-danger" role="alert">', '</div>'); ?>

        <?php echo form_open_multipart('businesses/edit/' . $business->id); // form_open_multipart for file uploads ?>
            <div class="card mb-4">
                <div class="card-header bg-primary text-white">Business Details</div>
                <div class="card-body">
                    <div class="mb-3">
                        <label for="business_name" class="form-label">Business Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="business_name" name="business_name" value="<?php echo set_value('business_name', $business->business_name); ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="category" class="form-label">Category <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="category" name="category" value="<?php echo set_value('category', $business->category); ?>" placeholder="e.g., Furniture Store, Cafe, Salon" required>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" id="description" name="description" rows="4"><?php echo set_value('description', $business->description); ?></textarea>
                    </div>
                </div>
            </div>

            <div class="card mb-4">
                <div class="card-header bg-info text-white">Contact Information</div>
                <div class="card-body">
                    <div class="mb-3">
                        <label for="address" class="form-label">Address <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="address" name="address" value="<?php echo set_value('address', $business->address); ?>" required>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="city" class="form-label">City <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="city" name="city" value="<?php echo set_value('city', $business->city); ?>" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="state" class="form-label">State <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="state" name="state" value="<?php echo set_value('state', $business->state); ?>" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="zip_code" class="form-label">Zip Code</label>
                        <input type="text" class="form-control" id="zip_code" name="zip_code" value="<?php echo set_value('zip_code', $business->zip_code); ?>">
                    </div>
                    <div class="mb-3">
                        <label for="phone" class="form-label">Phone</label>
                        <input type="tel" class="form-control" id="phone" name="phone" value="<?php echo set_value('phone', $business->phone); ?>">
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" value="<?php echo set_value('email', $business->email); ?>">
                    </div>
                    <div class="mb-3">
                        <label for="website" class="form-label">Website URL</label>
                        <input type="url" class="form-control" id="website" name="website" value="<?php echo set_value('website', $business->website); ?>" placeholder="https://www.example.com">
                    </div>
                </div>
            </div>

            <div class="card mb-4">
                <div class="card-header bg-warning text-white">Business Image/Logo</div>
                <div class="card-body">
                    <?php if ($business->image): ?>
                        <div class="mb-3">
                            <label class="form-label">Current Image:</label><br>
                            <img src="<?php echo base_url($business->image); ?>" alt="Current Business Image" class="img-thumbnail mb-2" style="max-width: 200px;">
                            <input type="hidden" name="existing_image" value="<?php echo htmlspecialchars($business->image); ?>">
                        </div>
                    <?php endif; ?>
                    <div class="mb-3">
                        <label for="business_image" class="form-label">Upload New Image/Logo (Max 2MB, JPG/PNG)</label>
                        <input type="file" class="form-control-file" id="business_image" name="business_image" accept="image/*">
                        <small class="form-text text-muted">Leave blank to keep current image. Recommended size: 1024x768 pixels.</small>
                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-primary btn-lg mt-3">Update Listing</button>
            <a href="<?php echo base_url('businesses/manage'); ?>" class="btn btn-secondary btn-lg mt-3 ml-2">Cancel</a>
        <?php echo form_close(); ?>
    </div>
</div>