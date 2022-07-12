<?php 


		include_once 'includes/autoloader.inc.php';

	$sendSMSObj = new keywordsController();


// echo "string";
// die();


	if($_SERVER['REQUEST_METHOD'] == 'POST'){
		if(empty($_POST['amount'])){
			$unsubResponse['message'] = "The amount cannot be null. Provide charge amount.";
			header('Content-type: application/json; charset=utf-8');
			echo json_encode($unsubResponse);
			die();
		}
		// elseif(!is_numeric($_POST['msisdn']) || trim(strlen($_POST['msisdn'])) != 12) {
		// 	$unsubResponse['message'] = "Provide valid subscriber number in 233503456789 format.";
		// 	header('Content-type: application/json; charset=utf-8');
		// 	echo json_encode($unsubResponse);
		// 	die();
		// }
		elseif(empty($_POST['shortCode'])) 
		{
			$unsubResponse['message'] = "Provide shortCode for this channel.";
			header('Content-type: application/json; charset=utf-8');
			echo json_encode($unsubResponse);
			die();
		}elseif (empty($_POST['description'])) {
			$unsubResponse['message'] = "Provide description for the charge.";
			header('Content-type: application/json; charset=utf-8');
			echo json_encode($unsubResponse);
			die();
		} elseif (empty($_POST['offerName'])) {
			$unsubResponse['message'] = "Provide offerName for this charge.";
			header('Content-type: application/json; charset=utf-8');
			echo json_encode($unsubResponse);
			die();
		} 
		else 
		{		
			//Mobile Content service payment request

		//	$amount, $msisdn, $offerName, $shortCode, $description, $unit, $clientId, $clientSecret
			// $resp = $sendSMSObj->clientChargeRequest($_POST['amount'], $_POST['msisdn'], $_POST['offerName'], $_POST['shortCode'], $_POST['description'], $_POST['unit'], "8eac50fd3e720c3aeb0518d9f59f9d4ae78283e0", "2b9098d1dc35795b967472b2d8fa5ff534cb9e5c");

			//$amount, $msisdn, $serviceName, $shortCode, $description, $unit
			$resp = $sendSMSObj->chargeRequest($_POST['amount'], $_POST['msisdn'], $_POST['offerName'], $_POST['shortCode'], $_POST['description'], $_POST['unit']);
			echo $resp;
		}		
	}else{
		$unsubResponse['message'] = "Invalid http method. Send notification required 'POST' request.";
		header('Content-type: application/json; charset=utf-8');
		echo json_encode($unsubResponse);
		die();
	}

	// $actionResponse['message'] = "Sorry, generic charging is for only MO services.";
	// header('Content-type: application/json; charset=utf-8');
	// echo json_encode($actionResponse);
?>