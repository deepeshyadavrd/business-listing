<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * MY_Controller
 *
 * This is the base controller for your application.
 * All other controllers should extend this class to inherit common functionality
 * like authentication checks, shared data for views, etc.
 */
class MY_Controller extends CI_Controller {

    protected $data = array(); // A property to hold data to be passed to views

    public function __construct() {
        parent::__construct();

        // Ensure session and URL helper are loaded (also autoloaded in config/autoload.php)
        $this->load->library('session');
        $this->load->helper('url');

        // --- Global Authentication Check ---
        // This check applies to all controllers that extend MY_Controller.
        // It redirects non-logged-in users to the login page.
        // We explicitly allow 'Auth' controller to bypass this to prevent redirect loops.
        $current_class = $this->router->fetch_class(); // Gets the current controller class name

        if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
            // If not logged in, and not trying to access the Auth controller, redirect to login.
            if ($current_class !== 'Auth') {
                // Store the current URL in session, so the user can be redirected back after login
                $_SESSION['redirect_after_login'] = current_url();
                redirect(base_url('login')); // Use base_url('login') for the CI login route
                exit;
            }
        }

        // --- Common Data for All Views ---
        // This data will be available in all views loaded by controllers extending MY_Controller
        $this->data['site_name'] = 'Urbanwood Business Directory';
        $this->data['logged_in_user_id'] = $this->session->userdata('id');
        $this->data['logged_in_username'] = $this->session->userdata('username');
        $this->data['logged_in_user_group_id'] = $this->session->userdata('group_id');
        $this->data['logged_in_user_group_name'] = $this->session->userdata('group_name');

        // Flash messages (success/error) will be handled by MY_Controller for consistency
        $this->data['success_message'] = $this->session->flashdata('success_message');
        $this->data['error_message'] = $this->session->flashdata('error_message');
    }

    /**
     * A common method to render pages with the main layout.
     * Use this in your controllers instead of loading header, view, footer separately.
     *
     * @param string $view_path The path to the specific content view (e.g., 'dashboard_view', 'businesses/add_business_view').
     * @param array $additional_data Any data specific to the current page.
     */
    protected function render_page($view_path, $additional_data = array()) {
        // Merge common data from MY_Controller with any additional data specific to this page
        $final_data = array_merge($this->data, $additional_data);

        // Set the 'main_content' variable that your 'main_layout.php' expects
        $final_data['main_content'] = $view_path;

        // Load the main layout view. The main layout will then load the specific content.
        $this->load->view('layouts/main_layout', $final_data);
    }
}