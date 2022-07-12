<?php 
	include_once 'includes/autoloader.inc.php';

	$sendSMSObj = new TelnetSendSMSModel();


// echo "string";
// die();


	if($_SERVER['REQUEST_METHOD'] == 'POST'){
		if(empty($_POST['address'])){
			$unsubResponse['message'] = "The address cannot be null. Provide subscriber number.";
			header('Content-type: application/json; charset=utf-8');
			echo json_encode($unsubResponse);
			die();
		}elseif(!is_numeric($_POST['address']) || trim(strlen($_POST['address'])) != 12) {
			$unsubResponse['message'] = "Provide valid subscriber number in 233503456789 format.";
			header('Content-type: application/json; charset=utf-8');
			echo json_encode($unsubResponse);
			die();
		}
		elseif(empty($_POST['shortCode'])) 
		{
			$unsubResponse['message'] = "Provide shortCode for this channel.";
			header('Content-type: application/json; charset=utf-8');
			echo json_encode($unsubResponse);
			die();
		}elseif (empty($_POST['message'])) {
			$unsubResponse['message'] = "Provide message to be transmitted.";
			header('Content-type: application/json; charset=utf-8');
			echo json_encode($unsubResponse);
			die();
		} elseif (empty($_POST['offerName'])) {
			$unsubResponse['message'] = "Provide offerName for this transmission.";
			header('Content-type: application/json; charset=utf-8');
			echo json_encode($unsubResponse);
			die();
		} 
		else 
		{			
			$resp = $sendSMSObj->sendSMSNotification($_POST['address'], $_POST['shortCode'], $_POST['message'], $_POST['offerName']);
			echo $resp;
		}		
	}else{
		$unsubResponse['message'] = "Invalid http method. Send notification required 'POST' request.";
		header('Content-type: application/json; charset=utf-8');
		echo json_encode($unsubResponse);
		die();
	}






	// {
	// 	"Authorization":" Bearer d3f3bbb30b54883339a8d1028b35f251",
	// 	"address":"233206846412",
	// 	"senderAddress":"1234",
	// 	"outboundSMSTextMessage":
	// 		{
	// 			"message":"Hello there, test message."
	// 		},
	// 	"clientCorrelator":"mcc-27933087720220415200529ecc19f6a3c76301c4b58",
	// 	"receiptRequest":
	// 		{
	// 			"notifyURL":"https://mysmsinbox.com/telnet_sdp/mt/v1/notify/"
	// 		},
	// 	"callbackData":"any-useful-data",
	// 	"senderName":"Mobile Content"
	// }



// 	Array
// (
//     [code] => 8001022
//     [message] => Subsystem failed to process the request and responded with service exception. Details : code [SVC4001], text [MSG_EXCEPTION] variables []
// )