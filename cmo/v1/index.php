<?php
// include_once 'includes/autoloader.inc.php';
// $dataObj = new SDPController();
// $resp = $dataObj->sendContent('233206846412', '1212', 'message', 'Gospel Daily');

// var_dump($resp);

header('Content-Type: application/json; charset=utf-8');
include_once 'includes/autoloader.inc.php';

// $modelObj = new SDPModel();
         // foreach ($modelObj->getScheduledContents("Gospel Daily", '2022-05-02 08:11:12') as $key) {
         // 	var_dump($key);
         // }

$data1 = file_get_contents("php://input");

$data = json_decode($data1, 1);

// file_put_contents('logs/request.log', print_r($data, true));
$createdTime = date("Y-m-d");
$file = fopen("logs/dailysend/request-$createdTime.log", 'a');
$current = "[  \n$data1\n  ];\n";
fwrite($file, "$current");
fclose($file);

die();

if($data['network'] && trim($data['network']) === "VODAFONE MO"){
	$dataObj = new SDPController();
	if(trim($data['action']) == "sendContent") {
		$resp = $dataObj->sendContent($data['address'], $data['shortCode'], $data['message'], $data['offerName'], $data['clientCorrelator']);
		echo $resp;
		// $actionResponse['message'] = "Sending daily content out.";
		// header('Content-type: application/json; charset=utf-8');
		// echo json_encode($actionResponse);
	}elseif(trim($data['action']) == "subscribeCustomer") {
		// $dataObj->subscribeCustomer();
		$actionResponse['message'] = "Requesting new subscription.";
		header('Content-type: application/json; charset=utf-8');
		echo json_encode($actionResponse);
	}
	elseif(trim($data['action']) == "unsubscribeCustomer") {
		$resp = $dataObj->unsubscribeCustomer($data['address'], $data['channel'], $data['offerName'], $data['reseason']);
		// $actionResponse['message'] = "Requesting unsubscription. from service";
		// header('Content-type: application/json; charset=utf-8');
		// echo json_encode($actionResponse);
		echo $resp;
	}
	elseif(trim($data['action']) == "chargeCustomer") {
		$resp = $dataObj->chargeCustomer($data['amount'], $data['channel'], $data['address'], $data['offerName'], $data['description'], $data['unit']);
		// $actionResponse['message'] = "Requesting to charge customer.";
		// header('Content-type: application/json; charset=utf-8');
		// echo json_encode($actionResponse);
		echo $resp;
	}
	else {
		$actionResponse['message'] = "Provide valid action to be processed.";
		header('Content-type: application/json; charset=utf-8');
		echo json_encode($actionResponse);
	}
} else {
	$actionResponse['message'] = "Unknown network.";
	header('Content-type: application/json; charset=utf-8');
	echo json_encode($actionResponse);
}


