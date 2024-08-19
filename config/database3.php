<?php

if (session_status() == PHP_SESSION_NONE) {
    // echo "good";
	
session_start();

}

$database = "client007_clinic_appointment";
$hostname = "85.187.142.78";
$username = "client007_cabinetchaibi";
$password = "CabinetChaibi@2024";

// mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);


try {
	$conn = new mysqli($hostname, $username, $password, $database);
	$conn->set_charset("utf8mb4");
	// echo 'connet god';
} catch (Exception $e) {
	error_log($e->getMessage());
	exit('Error connecting to database');
}

// try {
// 	$conn = new PDO("mysql:host=$hostname;dbname=clinic_appointment", $username, $password);
// 	// set the PDO error mode to exception
// 	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	
// 	// echo "Connected successfully";
//   } catch(PDOException $e) {
// 	// echo "Connection failed: " . $e->getMessage();
// 	error_log($e->getMessage());
// 	exit('Error connecting to database');
//   }