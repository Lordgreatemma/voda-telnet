<?php 
	include_once 'includes/autoloader.inc.php';
	$dataObj = new SDPModel();
	$dataContObj = new SDPController();
	$clientCorrelator = $dataContObj->generateCorelationId();
	$offerName = "FIN";//Fin
	$message = "";
	$offerId = "";
	$transmission_date = date("Y-m-d H:i:s");


	//WISDOM=>47488
	
	$data = $dataObj->getScheduledContents($offerName, $transmission_date);
	if ($data) {
		foreach ($data as $value) {
			$message = $value["message"];
			$offerId = $value["shortCode"];
		}




		$subData = $dataObj->getSubscribers($offerName, $offerId);
		if($subData){
			foreach ($subData as $key) {
				$dataContObj->sendContent($key['msisdn'], $offerId, $message, $offerName, $clientCorrelator);
			}
		} 
	}
	
	// foreach ($dataObj->getScheduledContents($offerName, $transmission_date) as $value) {
	// 	$message = $value["message"];
	// 	$offerId = $value["shortCode"];
	// }

	// foreach ($dataObj->getSubscribers($offerName, $offerId) as $key) {
	// 	// $dataContObj->sendContent($key['address'], $offerId, strtoupper($offerName).":\n".$message, $offerName, $clientCorrelator);
	// 	$dataContObj->sendContent($key['msisdn'], $offerId, $message, $offerName, $clientCorrelator);//'VODAFONE', 'sendContent', 
	// }
?>