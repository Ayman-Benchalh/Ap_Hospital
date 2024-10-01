<?php

include('../config/autoload.php');
include('../config/database.php'); // Assuming this file contains $mysqli connection
include('./includes/path.inc.php');
include('./includes/session.inc.php');

// Sanitize and validate $doctor_id


if (!isset($clinic_row['clinic_id'])) {
    die("Doctor ID is not set in the session.");
}

$doctor_id = intval($clinic_row['clinic_id']);

// Check for connection errors
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Prepare the SQL query
$query = "SELECT * FROM appointment WHERE doctor_id = $doctor_id";
$result = $conn->query($query);

if (!$result) {
    die("Query failed: " . $conn->error);
}

$events = [];

while ($row = $result->fetch_assoc()) {
    $events[] = [
        'id' => $row['app_id'],
        'title' => $row['patient_id'],
        'start' => $row['app_date'] . 'T' . $row['app_time'],
        'description' =>" Doctor ID: " . $row['doctor_id']
    ];
}

$conn->close();

// Set headers for JSON response
header('Content-Type: application/json');
echo json_encode($events);
?>
