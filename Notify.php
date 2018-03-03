<?php
// API access key from Google API's Console
define( 'API_ACCESS_KEY', '*******************' );

class Notification{

// prep the bundle

public function sendNotification($ids, $body, $title , $identifier, $target){

$headers = array(
	'Authorization: key=' . API_ACCESS_KEY,
	'Content-Type: application/json'
);

$registrationIds = array( $ids );
$notification = array
(
	'body' 	=> $body,
	'title'		=> $title,
	'vibrate'	=> 1,
	'sound'		=> 1,
	"icon" => "fcm_push_icon"
);
$data = array
(
	'identifier' => $identifier,
	'target'	=> $target
);

$fields = array(

	'registration_ids' 	=> $registrationIds,
	'notification'			=> $notification,
	'data'			=> $data,
	"priority" => "high"
);


echo json_encode( $fields ) ;


$ch = curl_init();
curl_setopt( $ch,CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send' );
curl_setopt( $ch,CURLOPT_POST, true );
curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fields ) );
$result = curl_exec($ch );
curl_close( $ch );
echo $result;

}
 
}

?>
