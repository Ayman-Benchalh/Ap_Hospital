<?php 
include('../config/autoload.php');
include('./includes/path.inc.php');
include('./includes/session.inc.php');

if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    echo "<script>alert('Error: No data to save.'); location.replace('./')</script>";
    $conn->close();
    exit;
}

if (!isset($doctor_row['clinic_id']) || !isset($conn)) {
    die('Required data not set.');
}

$clinic_id = $doctor_row['clinic_id'];
$doctor_id = $doctor_row['doctor_id'];
extract($_POST);

$allday = isset($allday);

// Check if the record already exists
$sql_check = "SELECT id FROM `schedule_list` WHERE `doctor_id` = '{$doctor_id}' AND `clinic_id` = '{$clinic_id}' AND `id` = '{$id}'";
$result_check = $conn->query($sql_check);

if ($result_check->num_rows > 0) {
    // If a record exists, perform an update
    $sql = "UPDATE `schedule_list` 
            SET `title` = '{$title}', `description` = '{$description}', `start_datetime` = '{$start_datetime}', `end_datetime` = '{$end_datetime}' 
            WHERE `id` = '{$id}'";
} else {
    // If no record exists, perform an insert
    $sql = "INSERT INTO `schedule_list` (`title`, `description`, `doctor_id`, `clinic_id`, `start_datetime`, `end_datetime`) 
            VALUES ('$title', '$description', '$doctor_id', '$clinic_id', '$start_datetime', '$end_datetime')";
}

$save = $conn->query($sql);

if ($save) {
    echo "<script>alert('Schedule Successfully Saved.'); location.replace('./sch-list.php')</script>";
} else {
    echo "<pre>";
    echo "An Error occurred.<br>";
    echo "Error: " . $conn->error . "<br>";
    echo "SQL: " . $sql . "<br>";
    echo "</pre>";
}

$conn->close();
?>
