<?php 
/**------------------------------------------------------------------------------------------------------------------------------------------------
* @@Name:              send sms

* @@Author:            Lordgreat -  Adri Emmanuel <'rexmerlo@gmail.com'>
* @@Tell:              +233543645688/+233273593525

* @Date:               2022-04-02 11:40:30
* @Last Modified by:   Lordgreat - Adri Emmanuel
* @Last Modified time: 2022-04-02 12:08:17

* @Copyright:          MobileContent.Com Ltd <'owner'>

* @Website:            https://mobilecontent.com.gh
*-------------------------------------------------------------------------------------------------------------------------------------------------
*/

    include_once 'includes/autoloader.inc.php';


    $modelObj = new MOModels();

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
		if(empty($_POST['msisdn'])){
			$unsubResponse['message'] = "The msisdn cannot be null. Provide subscriber number.";
			header('Content-type: application/json; charset=utf-8');
			echo json_encode($unsubResponse);
			die();
		}elseif(!is_numeric($_POST['msisdn']) || trim(strlen($_POST['msisdn'])) != 12) {
			$unsubResponse['message'] = "Provide valid subscriber number in 233503456789 format.";
			header('Content-type: application/json; charset=utf-8');
			echo json_encode($unsubResponse);
			die();
		}
		elseif(empty($_POST['amount'])) 
		{
			$unsubResponse['message'] = "Provide amount to be charged.";
			header('Content-type: application/json; charset=utf-8');
			echo json_encode($unsubResponse);
			die();
		}elseif(empty($_POST['offer'])){
			$unsubResponse['message'] = "Provide offer the charge is meant for!";
			header('Content-type: application/json; charset=utf-8');
			echo json_encode($unsubResponse);
			die();
		}
		elseif(empty($_POST['description'])){
			$unsubResponse['message'] = "Provide the description of the charge amount!";
			header('Content-type: application/json; charset=utf-8');
			echo json_encode($unsubResponse);
			die();
		}
		elseif(empty($_POST['channel'])){
			$unsubResponse['message'] = "Provide the channel for the service subscription!";
			header('Content-type: application/json; charset=utf-8');
			echo json_encode($unsubResponse);
			die();
		}
		elseif(empty($_POST['unit'])){
			$unsubResponse['message'] = "Provide the Unit of amount (e.g 1, 2, 3, 4) of the request!";
			header('Content-type: application/json; charset=utf-8');
			echo json_encode($unsubResponse);
			die();
		}
		else{
			$res = $modelObj->clientChargeRequest($_POST["amount"], $_POST["channel"], $_POST["msisdn"], $_POST["offer"], $_POST["description"], $_POST["unit"]);

			echo $res;
		}
	}else{
		$unsubResponse['message'] = "Invalid http request. Allowed method is 'POST' for charge request.";
		header('Content-type: application/json; charset=utf-8');
		echo json_encode($unsubResponse);
		die();
	}