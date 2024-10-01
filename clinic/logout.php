<?php
// Start the session before manipulating session variables
session_start();

// Unset individual session variables
unset($_SESSION['sess_clinicadminid']);
unset($_SESSION['sess_clinicadminemail']);

// Optionally, clear all session variables
// session_unset();

// Optionally, destroy the session completely
// session_destroy();

// Redirect to the login page
header("Location: login.php");
exit(); // It is a good practice to include exit after redirection
?>
