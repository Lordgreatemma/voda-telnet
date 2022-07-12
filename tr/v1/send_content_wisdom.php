<?php 
set_time_limit(13600);
	include_once 'includes/autoloader.inc.php';
	$dataObj = new SDPProductionModel();
	$dataContObj = new SDPController();
	$clientCorrelator = $dataContObj->generateCorelationId();
	$offerName = "WSDM";
	$message = "";
	$offerId = "";
	$transmission_date = date("Y-m-d H:i");


	//WISDOM=>47488


	// $cron = "Today transmission started at: ".$transmission_date;
	// $createdDate = date("Y-m-d");
	// $file        = fopen("logs/cron/WSDMDailyRun.log",'a');
	// $values      = "[  $cron ];\n";
	// fwrite($file, "$values");
	// fclose($file);







	$data = $dataObj->getScheduledContents($offerName, $transmission_date);
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
		echo "Done running......";
		// $Batch_2Data = $dataObj->getWisdomSubscribersBatch_2($offerName, $offerId);
		// if($Batch_2Data){
		// 	foreach ($Batch_2Data as $key => $value_2s) {
		// 		$dataContObj->sendContent($value_2s['msisdn'], $offerId, $message, $offerName, $clientCorrelator);
		// 	}
		// } 

		// $Batch_3Data = $dataObj->getWisdomSubscribersBatch_3($offerName, $offerId);
		// if($Batch_3Data){
		// 	foreach ($Batch_3Data as $key => $value_3s) {
		// 		$dataContObj->sendContent($value_3s['msisdn'], $offerId, $message, $offerName, $clientCorrelator);
		// 	}
		// } 
	}else{
		echo "No content at this time...";
	}













// echo $dataContObj->sendContent('233206846412', '1402', 'text message', $offerName, $clientCorrelator);

	// $transmission_date = date("Y-m-d H:i:s");
	// $ends = "Today transmission ended at: ".$transmission_date;
	// $createdDate = date("Y-m-d");
	// $file        = fopen("logs/cron/WSDMDailyRun.log",'a');
	// $values      = "[  $ends ];\n";
	// fwrite($file, "$values");
	// fclose($file);
?>