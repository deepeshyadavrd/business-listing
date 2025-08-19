<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Listings extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->model('listing_model');
        $this->load->helper('url');
    }

    public function change_location() {
        $city = $this->input->post('city');
        $this->session->set_userdata('selected_city', $city);
        redirect('listings'); // Redirect back to the main listings page
    }

    public function index() {
        $data['cities'] = $this->listing_model->get_all_cities();
        $selected_city = $this->session->userdata('selected_city');
        $data['selected_city'] = $selected_city;

        if ($selected_city) {
            $data['businesses'] = $this->listing_model->get_businesses_by_location($selected_city);
        } else {
            $data['businesses'] = $this->listing_model->get_all_businesses();
        }

        $this->load->view('listings_page', $data);
    }
}