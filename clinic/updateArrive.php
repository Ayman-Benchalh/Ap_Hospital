<?php
include('../config/autoload.php');

if(isset($_POST['id']) && !empty($_POST['id']))
{
    $id = $_POST['id'];
    $patient_Seance = $_POST['patient_Seance'];
    include('../config/database.php');

    $update = "UPDATE appointment SET arrive_status = 1 WHERE app_id = '".$id."'";
    $update2 = "UPDATE patients SET patient_Seance = patient_Seance+ 1 WHERE patient_id = '".$patient_Seance."'";

    // if (mysqli_query($conn, $update2 )  )
    // {
    //     // echo $update2 ;
    //    echo $patient_Seance;
    //     echo "Record updated successfully";
    // } 
    if (mysqli_query($conn, $update) && mysqli_query($conn, $update2))
    {
        // echo $update2 ;
        echo "Record updated successfully";
    } 
    else 
    {
        echo "Error updating record: " . mysqli_error($conn);
    }
    die;
}