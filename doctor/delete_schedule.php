<?php 
include('../config/autoload.php');
include('./includes/path.inc.php');
include('./includes/session.inc.php');

if(!isset($_GET['id'])){
    echo "<script> alert('Undefined Schedule ID.'); location.replace('./sch-list.php') </script>";
    $conn->close();
    exit;
}

$delete = $conn->query("DELETE FROM `schedule_list` WHERE id = '{$_GET['id']}'");

if($delete){
    echo "<script> alert('Event has been deleted successfully.'); location.replace('./sch-list.php') </script>";
} else {
    echo "<pre>";
    echo "An Error occurred.<br>";
    echo "Error: ".$conn->error."<br>";
    echo "SQL: DELETE FROM `schedule_list` WHERE id_schedule = '{$_GET['id']}'<br>";
    echo "</pre>";
}

$conn->close();
?>
