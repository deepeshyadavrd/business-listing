<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// The Home controller handles public-facing pages, so it does NOT extend MY_Controller directly
// as it should be accessible without login.
class Home extends CI_Controller {

    public function __construct() {
        parent::__construct();
        // Database model for businesses is autoloaded.
        // $this->load->model('business_model');
        $this->load->model('business_model');
        $this->load->helper('url'); // For base_url()
        $this->load->library('session'); // For flash messages
    }
    /**
     * Displays the public homepage with a list of active business listings.
     * This acts as your main directory page.
     */
    public function index() {
        $data['title'] = 'Urbanwood Business Directory - Find Local Businesses';
        $data['businesses'] = $this->business_model->get_all_active_businesses();

        // Common data for the layout (manually pass or load a dedicated public base controller)
        // For simplicity, we'll mimic MY_Controller data for now if you don't have a public base controller
        $data['site_name'] = 'Urbanwood Business Directory';
        $data['logged_in_username'] = $this->session->userdata('username'); // Check if logged in
        $data['logged_in_user_group_name'] = $this->session->userdata('group_name');

        // Render the page using the main layout
        $data['main_content'] = 'home_public_view'; // Specify the content view
        $this->load->view('layouts/main_layouts', $data);
        
    }

    /**
     * Displays details of a single public business listing.
     * @param int $id The ID of the business to view.
     */
    public function view_listing($id) {
        $business = $this->business_model->get_active_business($id); // Only active businesses

        if (!$business) {
            // Business not found or not active, show 404 or redirect
            show_404(); // CodeIgniter's default 404 handler
            return;
        }

        $data['business'] = $business;
        $data['title'] = $business->business_name . ' - Business Details';
// --- NEW: Categories for the homepage section ---
        // In a real application, you would fetch these from a 'categories' table
        $data['categories'] = [
            ['name' => 'Furniture', 'icon' => 'fas fa-chair'],
            ['name' => 'Home Decor', 'icon' => 'fas fa-lightbulb'],
            ['name' => 'Interior Design', 'icon' => 'fas fa-paint-roller'],
            ['name' => 'Renovation', 'icon' => 'fas fa-hammer'],
            ['name' => 'Appliances', 'icon' => 'fas fa-blender'],
            ['name' => 'Electronics', 'icon' => 'fas fa-tv'],
            ['name' => 'Real Estate', 'icon' => 'fas fa-home'],
            ['name' => 'Services', 'icon' => 'fas fa-tools'],
            ['name' => 'Retail', 'icon' => 'fas fa-shopping-bag'],
            ['name' => 'Food & Beverage', 'icon' => 'fas fa-utensils'],
            ['name' => 'Health & Beauty', 'icon' => 'fas fa-spa'],
            ['name' => 'Automotive', 'icon' => 'fas fa-car']
        ];
        // --- END NEW ---
        // Common data for layout
        $data['site_name'] = 'Urbanwood Business Directory';
        $data['logged_in_username'] = $this->session->userdata('username');
        $data['logged_in_user_group_name'] = $this->session->userdata('group_name');

        // Render the page
        $data['main_content'] = 'businesses/view_single_business_view'; // Create this view
        $this->load->view('layouts/main_layouts', $data);
    }
    /**
     * Handles business search queries and displays results.
     */
    public function search() {
        $search_query = $this->input->get('query', TRUE);    // Get search term from GET, XSS cleaned
        $search_location = $this->input->get('location', TRUE); // Get location term from GET, XSS cleaned

        $data['title'] = 'Search Results for "' . htmlspecialchars($search_query) . '"';
        $data['search_query'] = $search_query;
        $data['search_location'] = $search_location;

        // Fetch businesses based on search terms
        $data['businesses'] = $this->business_model->search_businesses($search_query, $search_location);

        // Common data for layout
        $data['site_name'] = 'Urbanwood Business Directory';
        $data['logged_in_username'] = $this->session->userdata('username');
        $data['logged_in_user_group_name'] = $this->session->userdata('group_name');

        // Render the search results page
        $data['main_content'] = 'search_results_view'; // Specify the content view
        $this->load->view('layouts/main_layouts', $data);
    }
}