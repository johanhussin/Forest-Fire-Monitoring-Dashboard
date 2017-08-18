<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
   include("conec.php");
   //include("Lib.php");
   require_once 'firebaseInterface.php';
   require_once 'firebaseStub.php';
   require_once 'firebaseLib.php';
   	

   	$url = 'https://arduinosensor-d9f15.firebaseio.com';
	// --- Use your token from Firebase here
	$token = 'bWL7lHlL9bMWd2uPDia1i6QJZSLRRF7uUNVn8guB';
	// --- Here is your parameter from the http GET
	$temperature = $_GET['temp1'];
	$humidity = $_GET['moi1'];
	$date = date("d-m-y h:i:sa");
	$rain = $_GET['rain'];
	// --- Set up your Firebase url structure here
	$firebasePath = 'Temp';
	$firebasePath2 = 'Hum';
	$firebasePath3 = 'Time';
	$firebasePath4 = 'Rain';

/// --- Making calls
	$fb = new \Firebase\FirebaseLib($url,$token);
	////$fb = new \Firebase($url, $token);
	$response = $fb->set($firebasePath, $temperature);
	$response = $fb->set($firebasePath2, $humidity);
	$response = $fb->set($firebasePath3, $date);
	$response = $fb->set($firebasePath4, $rain);

	$link=Conection();
   	$Sql="insert into tempmoi (Time,temp1,moi1,rain) values ('$date','".$_GET["temp1"]."', '".$_GET["moi1"]."','".$_GET["rain"]."')";      
   	mysqli_query($link,$Sql); 
   	header("Location: index.php"); 
?>
