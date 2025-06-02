<?php require 'includes/header.php'; ?>

<div class="row justify-content-center">
    <div class="col-lg-8">
        <h2 class="mb-4">Add New Business</h2>
        
        <?php if(isset($_GET['error'])): ?>
            <div class="alert alert-danger">Error submitting business. Please try again.</div>
        <?php endif; ?>
        
        <form action="process.php" method="POST">
            <div class="mb-3">
                <label for="name" class="form-label">Business Name *</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            
            <div class="mb-3">
                <label for="description" class="form-label">Description *</label>
                <textarea class="form-control" id="description" name="description" rows="4" required></textarea>
            </div>
            
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="category" class="form-label">Category *</label>
                    <select class="form-select" id="category" name="category" required>
                        <option value="">Select Category</option>
                        <option value="Restaurant">Restaurant</option>
                        <option value="Retail">Retail</option>
                        <option value="Service">Service</option>
                        <option value="Healthcare">Healthcare</option>
                        <option value="Education">Education</option>
                        <option value="Automotive">Automotive</option>
                    </select>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="phone" class="form-label">Phone *</label>
                    <input type="tel" class="form-control" id="phone" name="phone" required>
                </div>
            </div>
            
            <div class="mb-3">
                <label for="address" class="form-label">Address *</label>
                <textarea class="form-control" id="address" name="address" rows="2" required></textarea>
            </div>
            
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="website" class="form-label">Website</label>
                    <input type="url" class="form-control" id="website" name="website">
                </div>
                <div class="col-md-6 mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email">
                </div>
            </div>
            
            <button type="submit" class="btn btn-primary btn-lg">Add Business</button>
        </form>
    </div>
</div>

<?php require 'includes/footer.php'; ?>