<?php 
	include_once 'includes/autoloader.inc.php';
	$dataObj = new SDPProductionModel();
	$dataContObj = new SDPController();
	$clientCorrelator = $dataContObj->generateCorelationId();
	$offerName = "WSDM";
	$message = "";
	$offerId = "";
	$transmission_date = date("Y-m-d H:i:s");


	//WISDOM=>47488


	$data = $dataObj->getScheduledContents($offerName, '2022-05-20 07:15:52');
	if ($data) {
		foreach ($data as $value) {
			// var_dump($value);
			$message = $value["message"];
			$offerId = $value["shortCode"];
		}




		$subData = $dataObj->getWisdomSubscribers($offerName, $offerId);
		if($subData){
			// foreach ($subData as $key) {
			// // var_dump($key);
			// 	$dataContObj->sendContent($key['msisdn'], $offerId, $message, $offerName, $clientCorrelator);
			// }
			foreach ($subData as $key => $value) {
				$dataContObj->sendContent($value['msisdn'], $offerId, $message, $offerName, $clientCorrelator);
			}
		} 
	}

// echo $dataContObj->sendContent('233206846412', '1402', 'text message', $offerName, $clientCorrelator);
echo "Done Running ...".$offerName;
?>