<?php
set_time_limit(13000);
    include_once 'includes/autoloader.inc.php';
    $smsObj  = new keywordsController();
    $dataObj = new DataAuths();
    $TrAuths = new TrAuths();



    $created_at   = date("Y-m-d");
    $serviceName  = "WSDM";
    $message = "";
    $address = "";
    $shortCode = "";

    // var_dump($created_at);

   //Gospel ->6m.3sec/1441; (133->1m 1.26s)
    //wisdom ->   /1236 (309->2m 22.20s)

	$transmission_date = date("Y-m-d H:i:s");
    $scheduledDate = date('Y-d-m H:i',strtotime($transmission_date));


    $content = $TrAuths->getScheduledContents($serviceName, "2022-05-28 10:06");
    // var_dump($content);
    // var_dump($scheduledDate);
    // die();

    if ($content) {
    	foreach ($content as $key) {
    		$message   = $key['message'];
    		$shortCode = $key['shortCode'];
    	}
    	// var_dump($message);

    	$Data = $dataObj->getBilledSubscribers($serviceName);
    	// var_dump($Data);die();

    	if($Data) {
    		foreach ($Data as $value) {
    			// var_dump($value);die();
    			$smsObj->pushContentsBilledKewords($serviceName, $shortCode, $value['msisdn'], $message);
    		}
    	} else {
    		echo "No billed sub for this keyword...";
    	}
    	
    } else {
    	echo "No message for this keyword...";
    }
    
    echo "Done Sending Contents..........";

	




