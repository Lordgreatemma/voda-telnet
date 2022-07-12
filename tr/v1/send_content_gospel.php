<?php 
	set_time_limit(13000);
	include_once 'includes/autoloader.inc.php';
	$dataObj = new SDPProductionModel();
	$dataContObj = new SDPController();
	$clientCorrelator = $dataContObj->generateCorelationId();
	$offerName = "GOSPEL";
	$message = "";
	$offerId = "";
	$transmission_date = date("Y-m-d H:i");

	//GOSPEL, =>19316;

	// $cron = "Today transmission started at: ".$transmission_date;
	// $createdDate = date("Y-m-d");
	// $file        = fopen("logs/cron/GOSPELDailyRun.log",'a');
	// $values      = "[  $cron ];\n";
	// fwrite($file, "$values");
	// fclose($file);



/*


	$data = $dataObj->getScheduledContents($offerName, $transmission_date);

	if($data) {
		foreach ($data as $value) {
			// var_dump($value);
			$message = $value["message"];
			$offerId = $value["shortCode"];
		}


		// batch 1
		$subData = $dataObj->getGospelSubscribers($offerName, $offerId);
		if($subData){
			foreach ($subData as $key) {
				$dataContObj->sendContent($key['msisdn'], $offerId, $message, $offerName, $clientCorrelator);
			}
		}
		echo "Done running......";
		//// batch 2
		// $Batch_2Data = $dataObj->getGospelSubscribersBatch_2($offerName, $offerId);
		// if($Batch_2Data){
		// 	foreach ($Batch_2Data as $key => $value_2s) {
		// 		$dataContObj->sendContent($value_2s['msisdn'], $offerId, $message, $offerName, $clientCorrelator);
		// 	}
		// } 
	}else{
		echo "No content at this time...";
	}



*/

// echo "string";



	// foreach ($dataObj->getScheduledContents($offerName, $transmission_date) as $value) {
	// 	$message = $value["message"];
	// 	$offerId = $value["shortCode"];
	// }

	// foreach ($dataObj->getGospelSubscribers($offerName, $offerId) as $key) {
	// 	$dataContObj->sendContent( $key['address'], $offerId, $message, $offerName, $clientCorrelator);//'VODAFONE', 'sendContent',
	// }

	

	// // echo $dataContObj->sendContent(, $offerId, strtoupper($offerName).":\n".$message, $offerName, $clientCorrelator);
	// echo $dataContObj->sendContent('VODAFONEs', 'sendContent', "233503456787", '1212', 'message', 'serviceName', 'clientCorrelator');


	// $transmission_date = date("Y-m-d H:i:s");
	// $ends = "Today transmission ended at: ".$transmission_date;
	// $createdDate = date("Y-m-d");
	// $file        = fopen("logs/cron/GOSPELDailyRun.log",'a');
	// $values      = "[  $ends ];\n";
	// fwrite($file, "$values");
	// fclose($file);
?>