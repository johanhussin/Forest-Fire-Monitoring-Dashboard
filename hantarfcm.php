<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$token = $_GET['token'];

$con = new mysqli('localhost','johan','avenged123','sensor_data');

$stmt = $con->prepare("INSERT INTO fcmtoken (token) VALUES ($token)");
$stmt->bind_param("ss",$token);
$response = array();

if($stmt->execute()){
	$response['error'] = false;
	$response['message'] = 'token stored succesfully';
}else{
	$response['error'] = true;
	$response['message'] = $stmt->error;
}

echo json_encode($response);
?>
