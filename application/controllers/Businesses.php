<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// All actions in this controller require a logged-in business owner
class Businesses extends MY_Controller {

    public function __construct() {
        parent::__construct();
        // MY_Controller handles the base authentication check
        // Now, ensure only 'business_owner' group can access these specific actions
        if ($this->session->userdata('group_id') != 3) { // Assuming group_id 3 is for 'business_owner'
            $this->session->set_flashdata('error_message', 'You do not have permission to access this section.');
            redirect(base_url('dashboard')); // Redirect to a page where they have permission
            exit;
        }
        // Business_model is autoloaded in config/autoload.php
        // $this->load->model('business_model');]
        
        // >>> THE FIX: Explicitly load the Upload Library here <<<
        $this->load->library('upload'); // <-- ADD THIS LINE
    }

    /**
     * Display a list of the current user's businesses.
     */
    public function manage() {
        $user_id = $this->session->userdata('id'); // Get user ID from session
        $data['businesses'] = $this->business_model->get_user_businesses($user_id);
        $data['title'] = 'Manage Your Business Listings';

        $this->render_page('businesses/manage_businesses_view', $data);
    }

    /**
     * Display the form to add a new business and handle submission.
     */
    public function add() {
        $data['title'] = 'Add New Business Listing';

        // Set validation rules for the business form fields
        $this->form_validation->set_rules('business_name', 'Business Name', 'required|min_length[3]|max_length[255]');
        $this->form_validation->set_rules('description', 'Description', 'max_length[1000]');
        $this->form_validation->set_rules('address', 'Address', 'required|max_length[255]');
        $this->form_validation->set_rules('city', 'City', 'required|max_length[100]');
        $this->form_validation->set_rules('state', 'State', 'required|max_length[100]');
        $this->form_validation->set_rules('zip_code', 'Zip Code', 'max_length[20]');
        $this->form_validation->set_rules('phone', 'Phone Number', 'max_length[50]');
        $this->form_validation->set_rules('email', 'Email', 'valid_email|max_length[100]');
        $this->form_validation->set_rules('website', 'Website', 'valid_url|max_length[255]');
        $this->form_validation->set_rules('category', 'Category', 'required|max_length[100]');

        if ($this->form_validation->run() == FALSE) {
            // Validation failed or form is being displayed for the first time
            $this->render_page('businesses/add_business_view', $data);
        } else {
            // Validation passed, prepare data for insertion
            $user_id = $this->session->userdata('id'); // Get current logged-in user's ID

            $insert_data = array(
                'user_id'       => $user_id,
                'business_name' => $this->input->post('business_name', TRUE),
                'description'   => $this->input->post('description', TRUE),
                'address'       => $this->input->post('address', TRUE),
                'city'          => $this->input->post('city', TRUE),
                'state'         => $this->input->post('state', TRUE),
                'zip_code'      => $this->input->post('zip_code', TRUE),
                'phone'         => $this->input->post('phone', TRUE),
                'email'         => $this->input->post('email', TRUE),
                'website'       => $this->input->post('website', TRUE),
                'category'      => $this->input->post('category', TRUE),
                'status'        => 0 // Default to pending approval (0)
            );

            // --- Handle Image Upload ---
            // The 'upload' library is autoloaded, but you need to set config specifically here
            $config['upload_path']   = './uploads/business_logos/'; // Target folder: Create this folder!
            $config['allowed_types'] = 'gif|jpg|png|jpeg'; // Allowed file types
            $config['max_size']      = 2048; // Max size in KB (2MB)
            $config['max_width']     = 1024; // Max image width
            $config['max_height']    = 768; // Max image height
            $config['encrypt_name']  = TRUE; // Encrypt file name for security and uniqueness

            $this->upload->initialize($config); // Initialize the upload library with our config

            if (!empty($_FILES['business_image']['name'])) { // Check if a file was selected
                if ($this->upload->do_upload('business_image')) { // 'business_image' is the name of the file input field
                    $upload_data = $this->upload->data();
                    $insert_data['image'] = 'uploads/business_logos/' . $upload_data['file_name'];
                } else {
                    // Image upload failed
                    $data['error'] = $this->upload->display_errors();
                    $this->session->set_flashdata('error_message', $data['error']);
                    $this->render_page('businesses/add_business_view', $data);
                    return; // Stop execution if upload fails
                }
            } else {
                $insert_data['image'] = NULL; // No image uploaded
            }

            if ($this->business_model->create_business($insert_data)) {
                $this->session->set_flashdata('success_message', 'Business listing added successfully! It is pending for admin approval.');
                redirect(base_url('businesses/manage'));
            } else {
                $this->session->set_flashdata('error_message', 'Failed to add business listing. Please try again.');
                redirect(base_url('businesses/add'));
            }
        }
    }

    /**
     * Display the form to edit an existing business and handle submission.
     * Only allows editing businesses owned by the current user.
     * @param int $id The ID of the business to edit.
     */
    public function edit($id) {
        $user_id = $this->session->userdata('id'); // Get current logged-in user's ID
        $business = $this->business_model->get_business_by_id_and_user($id, $user_id);

        if (!$business) {
            $this->session->set_flashdata('error_message', 'Business not found or you do not have permission to edit it.');
            redirect(base_url('businesses/manage'));
            return;
        }

        $data['business'] = $business; // Pass existing business data to the form
        $data['title'] = 'Edit Business Listing';

        // Set validation rules (similar to add, but for existing data)
        $this->form_validation->set_rules('business_name', 'Business Name', 'required|min_length[3]|max_length[255]');
        $this->form_validation->set_rules('description', 'Description', 'max_length[1000]');
        $this->form_validation->set_rules('address', 'Address', 'required|max_length[255]');
        $this->form_validation->set_rules('city', 'City', 'required|max_length[100]');
        $this->form_validation->set_rules('state', 'State', 'required|max_length[100]');
        $this->form_validation->set_rules('zip_code', 'Zip Code', 'max_length[20]');
        $this->form_validation->set_rules('phone', 'Phone Number', 'max_length[50]');
        $this->form_validation->set_rules('email', 'Email', 'valid_email|max_length[100]');
        $this->form_validation->set_rules('website', 'Website', 'valid_url|max_length[255]');
        $this->form_validation->set_rules('category', 'Category', 'required|max_length[100]');

        if ($this->form_validation->run() == FALSE) {
            // Validation failed or form is first loaded (pre-filled with existing data)
            $this->render_page('businesses/edit_business_view', $data);
        } else {
            // Validation passed, process updated data
            $update_data = array(
                'business_name' => $this->input->post('business_name', TRUE),
                'description'   => $this->input->post('description', TRUE),
                'address'       => $this->input->post('address', TRUE),
                'city'          => $this->input->post('city', TRUE),
                'state'         => $this->input->post('state', TRUE),
                'zip_code'      => $this->input->post('zip_code', TRUE),
                'phone'         => $this->input->post('phone', TRUE),
                'email'         => $this->input->post('email', TRUE),
                'website'       => $this->input->post('website', TRUE),
                'category'      => $this->input->post('category', TRUE)
                // Status is NOT updated by user here (only by admin)
            );

            // Handle image upload for update (if a new image is provided)
            $config['upload_path']   = './uploads/business_logos/';
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $config['max_size']      = 2048; // 2MB
            $config['max_width']     = 1024;
            $config['max_height']    = 768;
            $config['encrypt_name']  = TRUE;

            $this->upload->initialize($config);

            if (!empty($_FILES['business_image']['name'])) {
                if ($this->upload->do_upload('business_image')) {
                    // Delete old image if it exists
                    if ($business->image && file_exists('./' . $business->image)) {
                        unlink('./' . $business->image);
                    }
                    $upload_data = $this->upload->data();
                    $update_data['image'] = 'uploads/business_logos/' . $upload_data['file_name'];
                } else {
                    $data['error'] = $this->upload->display_errors();
                    $this->session->set_flashdata('error_message', $data['error']);
                    // Reload form with validation errors and old data
                    $this->render_page('businesses/edit_business_view', $data);
                    return;
                }
            }

            if ($this->business_model->update_business($id, $update_data)) {
                $this->session->set_flashdata('success_message', 'Business listing updated successfully! It may require re-approval.');
                redirect(base_url('businesses/manage'));
            } else {
                $this->session->set_flashdata('error_message', 'Failed to update business listing. Please try again.');
                redirect(base_url('businesses/edit/' . $id));
            }
        }
    }

    /**
     * Delete a business listing.
     * Only allows deleting businesses owned by the current user.
     * @param int $id The ID of the business to delete.
     */
    public function delete($id) {
        $user_id = $this->session->userdata('id'); // Get current logged-in user's ID
        $business = $this->business_model->get_business_by_id_and_user($id, $user_id);

        if (!$business) {
            $this->session->set_flashdata('error_message', 'Business not found or you do not have permission to delete it.');
            redirect(base_url('businesses/manage'));
            return;
        }

        // Delete associated image file if it exists
        if ($business->image && file_exists('./' . $business->image)) {
            unlink('./' . $business->image);
        }

        if ($this->business_model->delete_business($id)) {
            $this->session->set_flashdata('success_message', 'Business listing deleted successfully.');
        } else {
            $this->session->set_flashdata('error_message', 'Failed to delete business listing. Please try again.');
        }
        redirect(base_url('businesses/manage'));
    }
}