<?php
include_once("./config/database.php");
header('Content-Type: application/json');
if(isset($_POST['date'])){
    $date = $_POST['date'];

    $nameclinc = "CabinetChaibi";
    $sql = $conn->prepare("SELECT * FROM clinics WHERE clinic_name = ?");
    $sql->bind_param("s", $nameclinc);
    $sql->execute();
    $result2 = $sql->get_result();
    $row2 = $result2->fetch_assoc();

    $clinic_id= $row2['clinic_id'];

    $sql2 = $conn->prepare("SELECT * FROM doctors WHERE clinic_id = ?");
    $sql2->bind_param("s", $clinic_id);
    $sql2->execute();
    $result3 = $sql2->get_result();
    $row3 = $result3->fetch_assoc();
    $docter_idF= $row3 ['doctor_id'];


    $stmt = $conn->prepare("SELECT * FROM appointment WHERE app_date = ? AND doctor_id = ? AND clinic_id = ?");
    $stmt->bind_param("sii", $date,$docter_idF,$clinic_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $rows = $result->fetch_all(MYSQLI_ASSOC);

    if ($rows) {
   
        echo json_encode(

           [
            'status' => 202,
            'data' => $rows
           ]);
    } else {
     
        echo json_encode([
            'status' => 'no_data',
            'message' => 'No appointments found for the selected date.'
        ]);
    }

   


    $conn->close();
}
?>