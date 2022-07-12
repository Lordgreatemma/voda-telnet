<?php 
/**------------------------------------------------------------------------------------------------------------------------------------------------
* @@Name:              unsub

* @@Author:            Lordgreat -  Adri Emmanuel <'rexmerlo@gmail.com'>
* @@Tell:              +233543645688/+233273593525

* @Date:               2022-04-13 07:40:30
* @Last Modified by:   Lordgreat - Adri Emmanuel
* @Last Modified time: 2022-04-13 12:08:17

* @Copyright:          MobileContent.Com Ltd <'owner'>

* @Website:            https://mobilecontent.com.gh
*-------------------------------------------------------------------------------------------------------------------------------------------------
*/
//https://mysmsinbox.com/telnet_sdp/mt/v1/unsub-mt-service.php
	include_once 'includes/autoloader.inc.php';

	$modelObj = new TelnetSendSMSModel();


	if($_SERVER['REQUEST_METHOD'] == 'POST'){
		if(empty($_POST['msisdn'])){
			$unsubResponse['message'] = "The msisdn cannot be null. Provide subscriber number.";
			header('Content-type: application/json; charset=utf-8');
			echo json_encode($unsubResponse);
			die();
		}elseif(!is_numeric($_POST['msisdn']) || trim(strlen($_POST['msisdn'])) != 12) {
			$unsubResponse['message'] = "Provide subscriber valid number in 233503456789 format.";
			header('Content-type: application/json; charset=utf-8');
			echo json_encode($unsubResponse);
			die();
		}
		elseif(empty($_POST['reseason'])) 
		{
			$unsubResponse['message'] = "Provide reason for the unsubscription.";
			header('Content-type: application/json; charset=utf-8');
			echo json_encode($unsubResponse);
			die();
		}elseif(empty($_POST['offer'])) {
			$unsubResponse['message'] = "Provide offer to be unsubscribed.";
			header('Content-type: application/json; charset=utf-8');
			echo json_encode($unsubResponse);
			die();
		}
		elseif(empty($_POST['channel'])) {
			$unsubResponse['message'] = "Provide the service channel.";
			header('Content-type: application/json; charset=utf-8');
			echo json_encode($unsubResponse);
			die();
		} 
		else 
		{
			$resp = $modelObj->unsubscritptionMTChannel($_POST['msisdn'], $_POST['channel'], $_POST['offer'], $_POST['reseason']);
			echo $resp;
		}
		
		
	}else{
		$unsubResponse['message'] = "Invalid http request. unsubscription require 'POST' request.";
		header('Content-type: application/json; charset=utf-8');
		echo json_encode($unsubResponse);
		die();
	}


	//DATA
	// Array
	// (
	//     [TransactionId] => mcc-335937683202204152330496525df08151d68b3fa0b
	//     [Channel] => SMS
	//     [msisdn] => 233206846412
	//     [offer] => Gospel Daily
	//     [inactivationReason] => Will of the customer
	// )


	// ERROR
	// Array
	// (
	//     [code] => 8001022
	//     [errorCode] => 5201010
	//     [message] => Offer not found with name [no more fund].
	// )