<?php
// Initialize the session
session_start();

// Unset all of the session variables
$_SESSION = array();

// Destroy the session.
session_destroy();

// Set a flash message
$_SESSION['success_message'] = "You have been successfully logged out.";

// Redirect to login page
header("location: login.php");
exit;
?>