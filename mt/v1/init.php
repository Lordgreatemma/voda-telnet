<?php 
	header('Content-Type: application/json; charset=utf-8');
    include_once 'includes/autoloader.inc.php';
    include_once 'includes/client.inc.php';
    // $dataObj = new DataAuths();

    $smsObj = new keywordsController();

    $response = file_get_contents("php://input");
	file_put_contents("logs/ServiceData.log", $response);
	$result = json_decode($response, true);


    $res = $smsObj->initiateRequest("WSDM", "1402", '233206846412', 'testing text message.');
    echo $res;

    // echo PROMO6_CLIENT_SECRET;
die();


    if (!empty($result) || $result != "") {
    	if($result['network'] && !empty($result['network']) && trim($result['network']) == "VODAFONE") {
    		if ($result['action']  && trim($result['action']) == "sendContent") 
    		{
    			// $res = $smsObj->pushContents($result['serviceName'], $result['shortCode'], $result['address'], $result['message']);//pushContents initiateRequest
                $res = $smsObj->initiateRequest("WSDM", "1402", '233206846412', 'testing text message.');
    			echo $res;
    		}
    		else {
    			echo "unknow action...";
    		}
    		
    	} else {
    		$output['message'] = "Only content for vodafone network is allowed...!";
    		$output['success'] = false;
    		header('Content-type: application/json; charset=utf-8');
    		echo json_encode($output);
    	}
    	
    	//$smsObj->pushContents();
    } else {
    	echo "No data";
    }
    
