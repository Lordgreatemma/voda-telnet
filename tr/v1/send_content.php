<?php 
	include_once 'includes/autoloader.inc.php';
	$dataObj = new SDPModel();
	$dataContObj = new SDPController();
	$clientCorrelator = $dataContObj->generateCorelationId();
	$offerName = "";
	$message = "";
	$offerId = "";
	$transmission_date = date("Y-m-d H:i:s");

// var_dump($clientCorrelator);
	//GOSPEL, =>19316; WISDOM=>47488
	$mt_offerNames = array("AG", "CATHOLIC", "FABU", "FAITH", "GFA", "INFO", "MONEY", "NDC", "PKN", "PPP");

	//AG keyword
	foreach ($dataObj->getScheduledContents("Gospel Daily", "2022-05-02 08:11:12") as $value) {
		// var_dump($value);
		$message = $value["message"];
		$offerId = $value["shortCode"];
	}
	var_dump($offerId);
	foreach ($dataObj->getSubscribers("Gospel Daily", $offerId) as $key) {
		//$dataContObj->sendContent($key['address'], $offerId, "Gospel Daily:\n".$message, "Gospel Daily", $clientCorrelator);
		var_dump($key);
	}
	################################################################################################################################


// die();die();
// die();

	//CATHOLIC keyword
	$transmission_date = date("Y-m-d H:i:s");
	foreach ($dataObj->getScheduledContents("CATHOLIC", $transmission_date) as $value) {
		$message = $value["message"];
		$offerId = $value["shortCode"];
	}
	foreach ($dataObj->getSubscribers("CATHOLIC", $offerId) as $key) {
		$dataContObj->sendContent($key['address'], $offerId, "CATHOLIC:\n".$message, "CATHOLIC", $clientCorrelator);
	}
	##############################################################################################################################




	//FABU keyword
	$transmission_date = date("Y-m-d H:i:s");
	foreach ($dataObj->getScheduledContents("FABU", $transmission_date) as $value) {
		$message = $value["message"];
		$offerId = $value["shortCode"];
	}
	foreach ($dataObj->getSubscribers("FABU", $offerId) as $key) {
		$dataContObj->sendContent($key['address'], $offerId, "FABU:\n".$message, "FABU", $clientCorrelator);
	}
	###############################################################################################################################





	//FAITH keyword
	$transmission_date = date("Y-m-d H:i:s");
	foreach ($dataObj->getScheduledContents("FAITH", $transmission_date) as $value) {
		$message = $value["message"];
		$offerId = $value["shortCode"];
	}
	foreach ($dataObj->getSubscribers("FAITH", $offerId) as $key) {
		$dataContObj->sendContent($key['address'], $offerId, "FAITH:\n".$message, "FAITH", $clientCorrelator);
	}
	###############################################################################################################################



	//GFA keyword
	$transmission_date = date("Y-m-d H:i:s");
	foreach ($dataObj->getScheduledContents("GFA", $transmission_date) as $value) {
		$message = $value["message"];
		$offerId = $value["shortCode"];
	}

	foreach ($dataObj->getSubscribers("GFA", $offerId) as $key) {
		$dataContObj->sendContent($key['address'], $offerId, "GFA:\n".$message, "GFA", $clientCorrelator);
	}
	##############################################################################################################################





	//INFO keyword
	$transmission_date = date("Y-m-d H:i:s");
	foreach ($dataObj->getScheduledContents("INFO", $transmission_date) as $value) {
		$message = $value["message"];
		$offerId = $value["shortCode"];
	}

	foreach ($dataObj->getSubscribers("INFO", $offerId) as $key) {
		$dataContObj->sendContent($key['address'], $offerId, "INFO:\n".$message, "INFO", $clientCorrelator);
	}
	##############################################################################################################################





	//PKN keyword
	$transmission_date = date("Y-m-d H:i:s");
	foreach ($dataObj->getScheduledContents("PKN", $transmission_date) as $value) {
		$message = $value["message"];
		$offerId = $value["shortCode"];
	}

	foreach ($dataObj->getSubscribers("PKN", $offerId) as $key) {
		$dataContObj->sendContent($key['address'], $offerId, "PKN:\n".$message, "PKN", $clientCorrelator);
	}
	##############################################################################################################################




	//PPP keyword
	$transmission_date = date("Y-m-d H:i:s");
	foreach ($dataObj->getScheduledContents("PPP", $transmission_date) as $value) {
		$message = $value["message"];
		$offerId = $value["shortCode"];
	}

	foreach ($dataObj->getSubscribers("PPP", $offerId) as $key) {
		$dataContObj->sendContent($key['address'], $offerId, "PPP:\n".$message, "PPP", $clientCorrelator);
	}
	##############################################################################################################################
?>