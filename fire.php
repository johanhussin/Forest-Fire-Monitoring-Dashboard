<?php
#SCIRPT TO SEND CLOUD MESSAGING WITH DATA PAYLOAD TO ANDROID APP

#API access key from Firebase console -> project setting -> cloud messaging and use the legacy server key , 
    define( 'API_ACCESS_KEY', 'XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX' );
    $registrationIds = $_GET['id'];
    $temperature = $_GET['temp1'];
    $humidity = $_GET['moi1'];
#prep the bundle
     $msg = array
          (
		'body' 	=> "Temp = $temperature\n Humidity = $humidity\n Potential risk of fire!" ,
		'title'	=> 'Warning!!!',
        'icon'	=> 'myicon',/*Default Icon*/
        'sound' => 'mySound'/*Default sound*/
          );
	$fields = array
			(
				'to'		=> $registrationIds,
				'notification'	=> $msg
			);
	
	
	$headers = array
			(
				'Authorization: key=' . API_ACCESS_KEY,
				'Content-Type: application/json'
			);
#Send Reponse To FireBase Server	
		$ch = curl_init();
		curl_setopt( $ch,CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send' );
		curl_setopt( $ch,CURLOPT_POST, true );
		curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
		curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
		curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
		curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fields ) );
		$result = curl_exec($ch );
		curl_close( $ch );
#Echo Result Of FireBase Server
echo $result;