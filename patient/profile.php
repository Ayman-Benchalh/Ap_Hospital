<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include("../config/database.php");

$contentdata = file_get_contents("php://input");
if ($contentdata === false) {
    echo json_encode(array("error" => "Failed to read input"));
    exit();
}

$getdata = json_decode($contentdata);
if (json_last_error() !== JSON_ERROR_NONE) {
    echo json_encode(array("error" => "Invalid JSON input"));
    exit();
}

if (is_object($getdata) && isset($getdata->patientID)) {
    $id = $getdata->patientID;
    $query = "SELECT * FROM patients WHERE patient_id = '$id'";
    $result = mysqli_query($conn, $query);

    if (!$result) {
        echo json_encode(array("error" => "Database query failed: " . mysqli_error($conn)));
        exit();
    }

    $numrow = mysqli_num_rows($result);
    if ($numrow == 1) {
        $arr = array();
        while ($row = mysqli_fetch_assoc($result)) {
            $arr[] = $row;
        }
        echo json_encode($arr);
    } else {
        echo json_encode(null);
    }
    
    mysqli_close($conn);
} else {
    echo json_encode(array("error" => "Invalid data format or missing patientID"));
    exit();
}
