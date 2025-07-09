<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

    public function __construct() {
        parent::__construct();
        // Models and libraries are autoloaded in config/autoload.php,
        // so no need to load them here again.
        $this->load->model('user_model');
        // $this->load->library('form_validation');
        // $this->load->library('session');
        // $this->load->helper('url');
        // $this->load->helper('form');
    }

    /**
     * Displays the registration form and handles user registration.
     */
    public function register() {
        // If user is already logged in, redirect them away from registration
        if ($this->session->userdata('loggedin')) {
            redirect(base_url('dashboard'));
        }

        // Set validation rules for registration form fields
        // 'is_unique' rule checks if the value already exists in the specified table.column
        $this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[4]|max_length[50]|is_unique[users.username]',
            array('is_unique' => 'This %s is already taken. Please choose another.')
        );
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|is_unique[users.email]',
            array('is_unique' => 'This %s is already registered. Please login or use a different email.')
        );
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[6]');
        $this->form_validation->set_rules('passconf', 'Password Confirmation', 'required|matches[password]');

        if ($this->form_validation->run() == FALSE) {
            // Validation failed or form is being displayed for the first time
            $data['title'] = 'Register for Account';
            $this->load->view('auth/register_view', $data); // Load the registration form view
        } else {
            // Validation passed, proceed with user registration
            $userData = array(
                'username' => $this->input->post('username', TRUE), // TRUE for XSS cleaning
                'email'    => $this->input->post('email', TRUE),
                'password' => $this->input->post('password', TRUE) // Password will be hashed in the model
                // 'group_id' is set to 3 (business_owner) by default in User_model::register_user
            );

            $user_id = $this->user_model->register_user($userData);

            if ($user_id) {
                // Registration successful, log the user in automatically
                $user = $this->user_model->get_user_by_id($user_id);
                $user_group = $this->user_model->get_group_by_id($user->group_id);

                // Set session data for the newly registered and logged-in user
                $_SESSION["loggedin"] = TRUE;
                $_SESSION["id"] = $user->id;
                $_SESSION["username"] = $user->username;
                $_SESSION["email"] = $user->email;
                $_SESSION["group_id"] = $user->group_id;
                $_SESSION["group_name"] = $user_group->name;

                // Set a success flash message for the next page
                $this->session->set_flashdata('success_message', 'Registration successful! You are now logged in.');
                redirect(base_url('dashboard')); // Redirect to the user's dashboard
            } else {
                // Registration failed due to a database issue (e.g., couldn't insert)
                $this->session->set_flashdata('error_message', 'Registration failed. Please try again.');
                redirect(base_url('register')); // Redirect back to registration form
            }
        }
    }

    /**
     * Displays the login form and handles user authentication.
     */
    public function login() {
        // If user is already logged in, redirect them away from login
        if ($this->session->userdata('loggedin')) {
            redirect(base_url('dashboard'));
        }

        // Set validation rules for login form fields
        $this->form_validation->set_rules('identifier', 'Username or Email', 'trim|required');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run() == FALSE) {
            // Validation failed or form is being displayed for the first time
            $data['title'] = 'Login to Your Account';
            $this->load->view('auth/login_view', $data); // Load the login form view
        } else {
            // Validation passed, attempt authentication
            $identifier = $this->input->post('identifier', TRUE); // User's username or email
            $password   = $this->input->post('password', TRUE);  // User's plain text password

            $user = $this->user_model->authenticate_user($identifier, $password);

            if ($user) {
                // Authentication successful, set session data
                $user_group = $this->user_model->get_group_by_id($user->group_id);

                $_SESSION["loggedin"] = TRUE;
                $_SESSION["id"] = $user->id;
                $_SESSION["username"] = $user->username;
                $_SESSION["email"] = $user->email;
                $_SESSION["group_id"] = $user->group_id;
                $_SESSION["group_name"] = $user_group->name;

                // Set a success flash message for the next page
                $this->session->set_flashdata('success_message', 'Login successful! Welcome back, ' . htmlspecialchars($user->username) . '.');

                // Redirect to the page they were trying to access before login (if set)
                if ($this->session->userdata('redirect_after_login')) {
                    $redirect_url = $this->session->userdata('redirect_after_login');
                    $this->session->unset_userdata('redirect_after_login'); // Clear it
                    redirect($redirect_url);
                } elseif ($this->session->userdata('group_id') == 1) { // Assuming group_id 1 is for 'admin'
                    // Priority 2: If no specific redirect URL, and user is admin, go to admin dashboard
                    redirect(base_url('admin'));
                } else {
                    redirect(base_url('dashboard')); // Default dashboard
                }
            } else {
                // Authentication failed (e.g., invalid credentials or inactive account)
                $this->session->set_flashdata('error_message', 'Invalid username/email or password. Please try again.');
                redirect(base_url('login')); // Redirect back to login form
            }
        }
    }
    /**
     * Logs out the current user by destroying the session.
     */
    public function logout() {
        // Unset all of the session variables
        $_SESSION = array();

        // Destroy the session.
        session_destroy();

        // Set a flash message for the next page (login page)
        $this->session->set_flashdata('success_message', 'You have been successfully logged out.');
        redirect(base_url('login')); // Redirects to the login page
    }
}