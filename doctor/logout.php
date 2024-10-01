<?php
// Start the session before manipulating session variables
session_start();

// Unset individual session variables using unset()
unset($_SESSION['DoctorRoleID']);
unset($_SESSION['DoctorRoleEmail']);
unset($_SESSION['DoctorRoleLoggedIn']);

// Optionally, clear all session variables if needed
// session_unset();

// Optionally, destroy the session completely
// session_destroy();

// Redirect to the login page
header("Location: login.php");
exit(); // It's a good practice to include exit after redirection
?>
