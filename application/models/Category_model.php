<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Category_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    /**
     * Get all categories from the database.
     * @return array An array of category objects.
     */
    public function get_all_categories() {
        $query = $this->db->get('categories');
        return $query->result();
    }

    /**
     * Add a new category to the database.
     * @param array $data An array containing the 'name' and 'icon' of the new category.
     * @return bool TRUE on success, FALSE on failure.
     */
    public function add_category($data) {
        return $this->db->insert('categories', $data);
    }

    /**
     * Delete a category by its ID.
     * @param int $id The ID of the category to delete.
     * @return bool TRUE on success, FALSE on failure.
     */
    public function delete_category($id) {
        $this->db->where('id', $id);
        return $this->db->delete('categories');
    }
}
