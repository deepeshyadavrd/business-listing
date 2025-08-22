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
    <div id="city-manual-selector" style="display:none;">
    <p>Please select your city to get local listings:</p>
    <form id="city-form-manual">
        <select id="manual-city-dropdown" name="city">
            </select>
        <button type="submit">Set City</button>
    </form>
</div>
</header>
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script> -->
 <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        // Function to handle the fallback to manual city selection
        function showManualCitySelector() {
            // Fetch cities data from CodeIgniter and populate the dropdown
            $.ajax({
                url: '<?php echo site_url("listings/get_cities_json"); ?>',
                type: 'GET',
                dataType: 'json',
                success: function(cities) {
                    let dropdown = $('#manual-city-dropdown');
                    dropdown.empty(); // Clear existing options
                    dropdown.append('<option value="">Select a City</option>');
                    $.each(cities, function(key, city) {
                        dropdown.append($('<option></option>').attr('value', city.city_name).text(city.city_name));
                    });
                    $('#city-manual-selector').show();
                },
                error: function() {
                    console.error('Failed to load city list from server.');
                    // Display a static message if AJAX fails
                    $('#city-manual-selector').show();
                }
            });
        }

        // 1. Check if the Geolocation API is supported
        if ("geolocation" in navigator) {
            // 2. Request user's location
            navigator.geolocation.getCurrentPosition(function(position) {
                // Success: Get lat/long and send to server for reverse geocoding
                const latitude = position.coords.latitude;
                const longitude = position.coords.longitude;
                
                $.ajax({
                    url: '<?php echo site_url("listings/set_location_from_coords"); ?>',
                    type: 'POST',
                    data: { lat: latitude, long: longitude },
                    dataType: 'json',
                    success: function(response) {
                        if (response.success) {
                            console.log('Location set to: ' + response.city);
                            // Optional: Reload the page to show listings from the new city
                            location.reload(); 
                        } else {
                            console.error('Failed to set city from coordinates: ' + response.message);
                            showManualCitySelector();
                        }
                    },
                    error: function() {
                        console.error('AJAX failed to communicate with server.');
                        showManualCitySelector();
                    }
                });

            }, function(error) {
                // Failure: User denied access or an error occurred
                console.error('Geolocation access denied or failed:', error.message);
                showManualCitySelector();
            });
        } else {
            // Geolocation is not supported by the browser
            console.warn('Geolocation is not supported by this browser.');
            showManualCitySelector();
        }

        // Handle manual city form submission
        $('#city-form-manual').on('submit', function(e) {
            e.preventDefault();
            const selectedCity = $('#manual-city-dropdown').val();
            if (selectedCity) {
                $.ajax({
                    url: '<?php echo site_url("listings/change_location"); ?>',
                    type: 'POST',
                    data: { city: selectedCity },
                    success: function() {
                        location.reload(); 
                    },
                    error: function() {
                        alert('Error: Could not save city. Please try again.');
                    }
                });
            } else {
                alert('Please select a city.');
            }
        });
    });
</script>