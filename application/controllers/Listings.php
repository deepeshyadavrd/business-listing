<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Listings extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->model('listing_model');
        $this->load->helper('url');
    }
    // Method to handle automatic location detection from coordinates
    public function set_location_from_coords() {
        $this->output->set_content_type('application/json');

        $lat = $this->input->post('lat');
        $long = $this->input->post('long');

        if (!$lat || !$long) {
            echo json_encode(['success' => false, 'message' => 'Coordinates are missing.']);
            return;
        }

        // Find the nearest city in your database using coordinates
        $nearest_city = $this->listing_model->get_nearest_city($lat, $long);

        if ($nearest_city) {
            $this->session->set_userdata('selected_city', $nearest_city['city_name']);
            echo json_encode(['success' => true, 'city' => $nearest_city['city_name']]);
        } else {
            echo json_encode(['success' => false, 'message' => 'No nearby city found in the database.']);
        }
    }

    // Method to get all cities for the manual dropdown
    public function get_cities_json() {
        $this->output->set_content_type('application/json');
        $cities = $this->listing_model->get_all_cities();
        echo json_encode($cities);
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