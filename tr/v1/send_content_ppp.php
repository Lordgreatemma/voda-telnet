<?php 
	include_once 'includes/autoloader.inc.php';
	$dataObj = new SDPProductionModel();
	$dataContObj = new SDPController();
	$clientCorrelator = $dataContObj->generateCorelationId();
	$offerName = "PPP";//
	$message = "";
	$offerId = "";
	$transmission_date = date("Y-m-d H:i");


	//WISDOM=>47488



	// $cron = "Today transmission started at: ".$transmission_date;
	// $createdDate = date("Y-m-d");
	// $file        = fopen("logs/cron/PPPDailyRun.log",'a');
	// $values      = "[  $cron ];\n";
	// fwrite($file, "$values");
	// fclose($file);





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
	// 	$dataContObj->sendContent($key['address'], $offerId, $message, $offerName, $clientCorrelator);//
	// }










	// $transmission_date = date("Y-m-d H:i:s");
	// $ends = "Today transmission ended at: ".$transmission_date;
	// $createdDate = date("Y-m-d");
	// $file        = fopen("logs/cron/PPPDailyRun.log",'a');
	// $values      = "[  $ends ];\n";
	// fwrite($file, "$values");
	// fclose($file);
?>