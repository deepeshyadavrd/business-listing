<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// The Admin controller requires admin authentication, so it extends MY_Controller
class Admin extends MY_Controller {

    public function __construct() {
        parent::__construct();
        // MY_Controller handles basic authentication (logged in)
        // Now, ensure ONLY ADMINS can access this controller
        if (!$this->is_admin()) { // Using the helper method from MY_Controller
            $this->session->set_flashdata('error_message', 'Access Denied. You must be an administrator to view this page.');
            redirect(base_url('dashboard')); // Redirect non-admins to their dashboard
            exit;
        }
        // Business_model is autoloaded in config/autoload.php
        // $this->load->model('business_model');
    }

    /**
     * Displays the main admin dashboard.
     */
    public function index() {
        $data['title'] = 'Admin Dashboard';
        // You can add summary stats here later (e.g., total businesses, pending approvals)
        $this->render_page('admin/admin_dashboard_view', $data);
    }

    /**
     * Displays a list of all business listings (active, pending, rejected).
     * Admins can view and manage all listings.
     */
    public function manage_businesses() {
        $data['title'] = 'Manage All Business Listings';
        $data['businesses'] = $this->business_model->get_all_businesses(); // Get all businesses

        $this->render_page('admin/manage_all_businesses_view', $data);
    }

    /**
     * Approves a business listing.
     * @param int $id The ID of the business to approve.
     */
    public function approve_business($id) {
        if ($this->business_model->update_business_status($id, 1)) { // Set status to 1 (Active)
            $this->session->set_flashdata('success_message', 'Business listing approved successfully.');
        } else {
            $this->session->set_flashdata('error_message', 'Failed to approve business listing.');
        }
        redirect(base_url('admin/manage_businesses')); // Redirect back to admin management page
    }

    /**
     * Rejects a business listing.
     * @param int $id The ID of the business to reject.
     */
    public function reject_business($id) {
        if ($this->business_model->update_business_status($id, 2)) { // Set status to 2 (Rejected)
            $this->session->set_flashdata('success_message', 'Business listing rejected successfully.');
        } else {
            $this->session->set_flashdata('error_message', 'Failed to reject business listing.');
        }
        redirect(base_url('admin/manage_businesses'));
    }

    /**
     * Deletes a business listing.
     * This is a permanent delete action for admins.
     * @param int $id The ID of the business to delete.
     */
    public function delete_business($id) {
        $business = $this->business_model->get_business($id); // Get business details to delete image

        if (!$business) {
            $this->session->set_flashdata('error_message', 'Business not found.');
            redirect(base_url('admin/manage_businesses'));
            return;
        }

        // Delete associated image file if it exists
        if ($business->image && file_exists('./' . $business->image)) {
            unlink('./' . $business->image);
        }

        if ($this->business_model->delete_business($id)) {
            $this->session->set_flashdata('success_message', 'Business listing permanently deleted.');
        } else {
            $this->session->set_flashdata('error_message', 'Failed to delete business listing.');
        }
        redirect(base_url('admin/manage_businesses'));
    }
}
