<?php
class Listing_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    // New function to get businesses based on a specific city
    public function get_businesses_by_location($city) {
        $this->db->where('city', $city);
        $this->db->where('status', 'approved');
        $query = $this->db->get('businesses');
        return $query->result_array();
    }

    // You'll also need a function to get all businesses for the default view
    public function get_all_businesses() {
        $this->db->where('status', 'approved');
        $query = $this->db->get('businesses');
        return $query->result_array();
    }

    // Function to get a list of all unique cities for the dropdown
    public function get_all_cities() {
        $this->db->select('city');
        $this->db->distinct();
        $this->db->where('status', 'approved');
        $query = $this->db->get('businesses');
        return $query->result_array();
    }
    public function get_nearest_city($user_lat, $user_long) {
        // This is a simple Haversine formula to find the closest point
        // It's a computationally intensive query, so use it sparingly.
        $sql = "
            SELECT 
                city_name,
                (
                    6371 * acos(
                        cos(radians(?)) * cos(radians(latitude)) * cos(radians(longitude) - radians(?))
                        + sin(radians(?)) * sin(radians(latitude))
                    )
                ) AS distance
            FROM
                cities
            ORDER BY distance
            LIMIT 1;
        ";

        $query = $this->db->query($sql, array($user_lat, $user_long, $user_lat));
        
        if ($query->num_rows() > 0) {
            return $query->row_array();
        }
        return false;
    }
}