<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        // Database library is autoloaded in config/autoload.php
    }

    /**
     * Registers a new user account.
     * The password will be hashed before insertion.
     * Frontend registrations default to 'business_owner' group.
     *
     * @param array $data Contains username, email, and plain password.
     * @return int Inserted user ID on success, or FALSE on failure.
     */
    public function register_user($data) {
        // Securely hash the password using PASSWORD_BCRYPT (recommended)
        $data['password'] = password_hash($data['password'], PASSWORD_BCRYPT);

        // Assign default group_id for frontend registrations (Business Owner: 3)
        if (!isset($data['group_id'])) {
            $data['group_id'] = 3; // Hardcoded default for frontend new users
        }
        // Set default status (e.g., active = 1)
        if (!isset($data['status'])) {
            $data['status'] = 1;
        }

        if ($this->db->insert('users', $data)) {
            return $this->db->insert_id(); // Return the ID of the newly registered user
        }
        return FALSE;
    }

    /**
     * Authenticates a user by username/email and password.
     *
     * @param string $identifier User's username or email.
     * @param string $password User's plain text password.
     * @return object|FALSE User data object on successful authentication, FALSE otherwise.
     */
    public function authenticate_user($identifier, $password) {
        // Query database to find user by username OR email
        $this->db->where('email', $identifier)
                 ->or_where('username', $identifier);
        $query = $this->db->get('users');

        if ($query->num_rows() == 1) {
            $user = $query->row(); // Get the user row as an object

            // Verify the provided password against the stored hashed password
            if (password_verify($password, $user->password)) {
                // Check if the user account is active
                if ($user->status == 1) {
                    return $user; // Authentication successful, return user object
                }
            }
        }
        return FALSE; // Authentication failed (e.g., wrong credentials, inactive account)
    }

    /**
     * Checks if a username already exists in the 'users' table.
     * Used for real-time validation during registration.
     * @param string $username The username to check.
     * @return bool TRUE if username exists, FALSE otherwise.
     */
    public function username_exists($username) {
        $this->db->where('username', $username);
        $query = $this->db->get('users');
        return $query->num_rows() > 0;
    }

    /**
     * Checks if an email address already exists in the 'users' table.
     * Used for real-time validation during registration.
     * @param string $email The email to check.
     * @return bool TRUE if email exists, FALSE otherwise.
     */
    public function email_exists($email) {
        $this->db->where('email', $email);
        $query = $this->db->get('users');
        return $query->num_rows() > 0;
    }

    /**
     * Get user details by their ID.
     * @param int $user_id The user ID.
     * @return object|null User data object, or NULL if not found.
     */
    public function get_user_by_id($user_id) {
        $query = $this->db->get_where('users', array('id' => $user_id));
        return $query->row();
    }

    /**
     * Get user group details by group ID.
     * @param int $group_id The group ID.
     * @return object|null Group data object, or NULL if not found.
     */
    public function get_group_by_id($group_id) {
        $query = $this->db->get_where('user_groups', array('id' => $group_id));
        return $query->row();
    }
}