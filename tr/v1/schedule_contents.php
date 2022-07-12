<?php 
include_once 'includes/autoloader.inc.php';


	if(empty($_POST['serviceName'])){
		$unsubResponse['message'] = "The serviceName cannot be null. Provide offer name.";
		header('Content-type: application/json; charset=utf-8');
		echo json_encode($unsubResponse);
		die();
	}elseif(trim($_POST['shortCode']) == "") {
		$unsubResponse['message'] = "Provide short code.";
		header('Content-type: application/json; charset=utf-8');
		echo json_encode($unsubResponse);
		die();
	}
	elseif(empty($_POST['message'])) 
	{
		$unsubResponse['message'] = "Provide the message to be scheduled.";
		header('Content-type: application/json; charset=utf-8');
		echo json_encode($unsubResponse);
		die();
	}elseif (empty($_POST['transmission_date'])) {
		$unsubResponse['message'] = "Provide schedule date time message to be transmitted.";
		header('Content-type: application/json; charset=utf-8');
		echo json_encode($unsubResponse);
		die();
	}
	else 
	{	
		$sendSMSObj = new SDPProductionModel();		
		$resp = $sendSMSObj->scheduleNewSampelContents($_POST['serviceName'], $_POST['shortCode'], $_POST['message'], $_POST['transmission_date']);
		if (trim($resp) == 1) {
			$unsubResponse['message'] = "Message scheduled to ".$_POST['transmission_date'];
			header('Content-type: application/json; charset=utf-8');
			echo json_encode($unsubResponse);
		} else {
			header('Content-type: application/json; charset=utf-8');
			echo json_encode("scheduling failed...");
		}
		
		// echo $resp;
	}

?>