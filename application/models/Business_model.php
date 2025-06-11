<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Business_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        // Database library is autoloaded in config/autoload.php
    }

    /**
     * Get a single business listing by its ID.
     * @param int $id The business ID.
     * @return object|null Business data object or null if not found.
     */
    public function get_business($id) {
        $query = $this->db->get_where('businesses', array('id' => $id));
        return $query->row();
    }

    /**
     * Get all business listings for a specific user.
     * @param int $user_id The ID of the user.
     * @return array An array of business data objects.
     */
    public function get_user_businesses($user_id) {
        $this->db->where('user_id', $user_id);
        $this->db->order_by('created_at', 'DESC');
        $query = $this->db->get('businesses');
        return $query->result(); // Returns an array of objects
    }

    /**
     * Get all active business listings (for public display on homepage/listings page).
     * @return array An array of business data objects.
     */
    public function get_all_active_businesses() {
        $this->db->where('status', 1); // Only active businesses are publicly visible
        $this->db->order_by('created_at', 'DESC');
        $query = $this->db->get('businesses');
        return $query->result();
    }

    /**
     * Get a single active business listing by its ID for public view.
     * @param int $id The business ID.
     * @return object|null Business data object or null if not found or not active.
     */
    public function get_active_business($id) {
        $this->db->where('id', $id);
        $this->db->where('status', 1);
        $query = $this->db->get('businesses');
        return $query->row();
    }


    /**
     * Insert a new business listing into the database.
     * @param array $data Data for the new business.
     * @return int Inserted business ID on success, or FALSE on failure.
     */
    public function create_business($data) {
        if ($this->db->insert('businesses', $data)) {
            return $this->db->insert_id();
        }
        return FALSE;
    }

    /**
     * Update an existing business listing.
     * @param int $id The business ID to update.
     * @param array $data New data for the business.
     * @return bool TRUE on success, FALSE on failure.
     */
    public function update_business($id, $data) {
        $this->db->where('id', $id);
        return $this->db->update('businesses', $data);
    }

    /**
     * Delete a business listing.
     * @param int $id The business ID to delete.
     * @return bool TRUE on success, FALSE on failure.
     */
    public function delete_business($id) {
        $this->db->where('id', $id);
        return $this->db->delete('businesses');
    }

    /**
     * Get business by ID and user ID for security check (ensures user owns the business).
     * @param int $id The business ID.
     * @param int $user_id The user ID.
     * @return object|null Business data object or null if not found or not owned by user.
     */
    public function get_business_by_id_and_user($id, $user_id) {
        $this->db->where('id', $id);
        $this->db->where('user_id', $user_id);
        $query = $this->db->get('businesses');
        return $query->row();
    }
}