<?php 
	include_once 'includes/autoloader.inc.php';
	$dataObj = new SDPProductionModel();
	$dataContObj = new SDPController();
	$clientCorrelator = $dataContObj->generateCorelationId();
	$offerName = "PPP";
	$message = "";
	$offerId = "";
	$transmission_date = date("Y-m-d H:i:s");

	//GOSPEL, =>19316;

	$cron = "Today transmission started at: ".$transmission_date;
	$createdDate = date("Y-m-d");
	$file        = fopen("logs/cron/TestDailyRun.log",'a');
	$values      = "[  $cron ];\n";
	fwrite($file, "$values");
	fclose($file);


	#let's say you have your cript logic here..........
	$subData = $dataObj->getTest($offerName);
		if($subData){
			foreach ($subData as $key => $value) {
				var_dump($value['msisdn']);//['msisdn']
				// echo $value['msisdn'];
			}
		}

	$ends = "Today transmission ended at: ".$transmission_date;
	$createdDate = date("Y-m-d");
	$file        = fopen("logs/cron/TestDailyRun.log",'a');
	$values      = "[  $ends ];\n";
	fwrite($file, "$values");
	fclose($file);
