<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// Dashboard requires authentication, so it extends MY_Controller
class Dashboard extends MY_Controller {

    public function __construct() {
        parent::__construct();
        // Parent constructor handles basic authentication redirection
        // Other dashboard-specific models/libraries can be loaded here
    }

    /**
     * Displays the main user dashboard.
     * This page is only accessible to logged-in users.
     */
    public function index() {
        // Data for the dashboard view
        $data['title'] = 'My Dashboard';

        // Example: Fetch data relevant to the logged-in user
        // Using $this->data for common items from MY_Controller
        // $data['username'] = $this->data['logged_in_username'];
        // $data['user_id'] = $this->data['logged_in_user_id'];
        // $data['user_group'] = $this->data['logged_in_user_group_name'];

        // Render the page using the common layout function from MY_Controller
        $this->render_page('dashboard_view', $data);
    }
}