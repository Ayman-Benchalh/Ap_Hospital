<?php
include('../config/database.php'); 
if (isset($_GET['id'])) {
   

   echo $_GET['id'];
   $id_App=$_GET['id'];

    $stmt = $conn->prepare("DELETE FROM appointment WHERE app_id=?");
    $stmt->bind_param("i",$id_App);
    $stmt->execute();

    $stmt->close();
    $conn->close();

    header('Location: appointment.php');
    exit();
}
