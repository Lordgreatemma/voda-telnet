<?php 
	include_once 'includes/autoloader.inc.php';
	$dataObj = new SDPProductionModel();
	$dataContObj = new SDPController();
	$clientCorrelator = $dataContObj->generateCorelationId();
	$offerName = "GOSPEL";
	$message = "";
	$offerId = "";
	$transmission_date = date("Y-m-d H:i:s");

	//GOSPEL, =>19316;

	$data = $dataObj->getScheduledContents($offerName, '2022-05-19 05:25:52');
	if ($data) {
		foreach ($data as $value) {
			// var_dump($value);
			$message = $value["message"];
			$offerId = $value["shortCode"];
		}



		$subData = $dataObj->getGospelSubscribers($offerName, $offerId);
		if($subData){
			foreach ($subData as $key) {
				$dataContObj->sendContent($key['msisdn'], $offerId, $message, $offerName, $clientCorrelator);
			}
		}
	}
	echo "Done running...".$offerName;
