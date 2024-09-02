<?php
include('../config/database.php'); 
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
   

    if ($conn->connect_error) {
        die("Connection failed: " . $mysqli->connect_error);
    }

    $stmt = $mysqli->prepare("UPDATE appointment SET app_date=?, app_time=?, treatment_type=?, patient_id=?, doctor_id=?, clinic_id=?, doctor_ext=?, status=?, consult_status=?, arrive_status=? WHERE app_id=?");
    $stmt->bind_param("ssssiiiiiii", $_POST['app_date'], $_POST['app_time'], $_POST['treatment_type'], $_POST['patient_id'], $_POST['doctor_id'], $_POST['clinic_id'], $_POST['doctor_ext'], $_POST['status'], $_POST['consult_status'], $_POST['arrive_status'], $_POST['app_id']);
    $stmt->execute();

    $stmt->close();
    $mysqli->close();

    header('Location: index.php');
    exit();
}
?>