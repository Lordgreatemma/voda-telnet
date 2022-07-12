<?php 
	header('Content-Type: application/json; charset=utf-8');
    include_once 'includes/autoloader.inc.php';
    include_once 'includes/client.inc.php';
    // $dataObj = new DataAuths();

    $smsObj = new keywordsController();

    $response = file_get_contents("php://input");
	file_put_contents("logs/ServiceData.log", $response);
	$result = json_decode($response, true);


    // echo PROMO6_CLIENT_SECRET;

    if (!empty($result) || $result != "") {
    	if($result['network'] && !empty($result['network']) && trim($result['network']) == "VODAFONE") {
    		if ($result['action']  && trim($result['action']) == "sendContent") 
    		{
    			$res = $smsObj->pushContents($result['serviceName'], $result['shortCode'], $result['address'], $result['message']);//pushContents initiateRequest
    			echo $res;
    		} elseif($result['action']  && trim($result['action']) == "unsubscribeCustomer") 
    		{
    			$res = $smsObj->unsubscribeServiceName($result['serviceName'], $result['shortCode'], $result['address'], $result['inactivationReason']);
    			echo $res;
    		}
    		 elseif($result['action']  && trim($result['action']) == "chargeCustomer") 
    		{
    			$res = $smsObj->chargeRequest($result['amount'], $result['address'], $result['serviceName'], $result['shortCode'], $result['description'], $result['unit']);
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
    






// {
//     "network":"VODAFONE",
//     "action": "sendContent",
//     "address": "233206846412",
//     "shortCode": "1212",
//     "clientCorrelator":"232kb43jk43j54b5h",
//     "message"  : "A short message testing...",
//     "offerName": "Gospel Daily"
// }


// {
//     "network":"VODAFONE MO",
//     "action": "chargeCustomer",
//     "address": "233206846412",
//     "shortCode": "1212",
//     "channel": "SMS",
//     "amount":"1.0",
//     "description"  : "Charge for ABC",
//     "offerName": "Gospel Daily",
//     "unit":"1"      //(e.g 1, 2, 3, 4) 1: Money 2: Piece 3: Byte 4: Second
// }