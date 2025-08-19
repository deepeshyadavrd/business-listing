<header class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="<?php echo base_url(); ?>">Urbanwood Directory</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo base_url(); ?>">Home <span class="sr-only">(current)</span></a>
                </li>
                <?php if (isset($logged_in_username) && $logged_in_username): ?>
                    <!-- Logged-in user links -->
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo base_url('dashboard'); ?>"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
                    </li>
                    <?php if (isset($logged_in_user_group_id) && $logged_in_user_group_id == 3): // Business Owner specific link ?>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo base_url('businesses/manage'); ?>"><i class="fas fa-building"></i> My Businesses</a>
                        </li>
                    <?php endif; ?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo base_url('logout'); ?>"><i class="fas fa-sign-out-alt"></i> Logout (<?php echo htmlspecialchars($logged_in_username); ?>)</a>
                    </li>
                <?php else: ?>
                    <!-- Not logged-in user links -->
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo base_url('login'); ?>"><i class="fas fa-sign-in-alt"></i> Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo base_url('register'); ?>"><i class="fas fa-user-plus"></i> Register</a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
    <div class="location-selector">
    <form action="<?php echo site_url('listings/change_location'); ?>" method="post">
        <label for="city_selector">Select Your City:</label>
        <select id="city_selector" name="city">
            <option value="">All Locations</option>
            <?php foreach ($cities as $city): ?>
                <option value="<?php echo htmlspecialchars($city['city_name']); ?>"
                    <?php echo (isset($selected_city) && $selected_city == $city['city_name']) ? 'selected' : ''; ?>>
                    <?php echo htmlspecialchars($city['city_name']); ?>
                </option>
            <?php endforeach; ?>
        </select>
        <button type="submit">Go</button>
    </form>
</div>
</header>