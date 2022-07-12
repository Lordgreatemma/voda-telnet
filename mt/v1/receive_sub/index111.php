<?php 
header('Content-Type: application/json; charset=utf-8');

include_once 'includes/autoloader.inc.php';


$response = file_get_contents("php://input");
file_put_contents("logs/data.log", $response);
$result = json_decode($response, true);


// echo $result['serviceNotificationType'];
echo $response;

$dataObj = new DataAuths();
$trDataObj = new TrAuths();

// $re = $dataObj->checkSubscriptionState("233504648398");trailToPaid
// $re = $dataObj->insert($result['msisdn'], 'shortCode', 'clientCorelator', 'senderName', 'message');

$createdDate = date("Y-m-d");
$file        = fopen("logs/newSub-$createdDate.log",'a');
$values      = "[  $response ];\n";
fwrite($file, "$values");
fclose($file);



if (!empty($result) || $result != "") {
	if (trim($result['serviceNotificationType']) == "SUB" && trim($result['state']) == "ACTIVE" ) {
		$re = $dataObj->insertNewSubscription($result['msisdn'], $result['state'], $result['offerId'], $result['offerName'], $result['transactionId'], $result['subscriptionId'], $result['serviceNotificationType'], $result['isRenewal'], $result['serviceId'], $result['serviceName'], $result['failureReason'], $result['channelType'], $result['subscriptionCounter'], $result['chargedAmount'], $result['subscriptionStartDate'], $result['subscriptionEndDate'], $result['nextChargingDate'], $result['lastRenewalDate'], $result['chargingPeriod'], $result['requestDate'], $result['inTry'], "");
		echo $re;

		//PRO
		$re = $trDataObj->saveTrSubscription($result['msisdn'], $result['state'], $result['offerId'], $result['offerName'], $result['transactionId'], $result['subscriptionId'], $result['serviceNotificationType'], $result['isRenewal'], $result['serviceId'], $result['serviceName'], $result['failureReason'], $result['channelType'], $result['subscriptionCounter'], $result['chargedAmount'], $result['subscriptionStartDate'], $result['subscriptionEndDate'], $result['nextChargingDate'], $result['lastRenewalDate'], $result['chargingPeriod'], $result['requestDate'], $result['inTry'], "");
		echo $re;
	}
	elseif(trim($result['serviceNotificationType']) == "SUSPENDED" && trim($result['state']) == "SUSPENDED") {
		$re = $dataObj->insertNewSubscription($result['msisdn'], $result['state'], $result['offerId'], $result['offerName'], $result['transactionId'], $result['subscriptionId'], $result['serviceNotificationType'], $result['isRenewal'], $result['serviceId'], $result['serviceName'], $result['failureReason'], $result['channelType'], $result['subscriptionCounter'], $result['chargedAmount'], $result['subscriptionStartDate'], $result['subscriptionEndDate'], $result['nextChargingDate'], $result['lastRenewalDate'], $result['chargingPeriod'], $result['requestDate'], $result['inTry'], $result['inRenewal']);
		echo $re;

		// PRO
		$re = $trDataObj->saveTrSubscription($result['msisdn'], $result['state'], $result['offerId'], $result['offerName'], $result['transactionId'], $result['subscriptionId'], $result['serviceNotificationType'], $result['isRenewal'], $result['serviceId'], $result['serviceName'], $result['failureReason'], $result['channelType'], $result['subscriptionCounter'], $result['chargedAmount'], $result['subscriptionStartDate'], $result['subscriptionEndDate'], $result['nextChargingDate'], $result['lastRenewalDate'], $result['chargingPeriod'], $result['requestDate'], $result['inTry'], $result['inRenewal']);
		echo $re;
	} elseif(trim($result['serviceNotificationType']) == "UNSUB" && trim($result['state']) == "INACTIVE"){
		$dataObj->updateStateChange($result['msisdn'], $result['state'], $result['offerId'], $result['offerName'], $result['transactionId'], $result['serviceNotificationType'], $result['serviceId'], $result['serviceName'], $result['failureReason'], $result['subscriptionStartDate'], $result['subscriptionEndDate'], $result['nextChargingDate'], $result['lastRenewalDate'], $result['channelType'], $result['inRenewal'], $result['chargingPeriod'], $result['subscriptionCounter'], $result['requestDate'], $result['chargedAmount'], $result['inTry']);

		// PRO
		$trDataObj->updateTrStateChange($result['msisdn'], $result['state'], $result['offerId'], $result['offerName'], $result['transactionId'], $result['serviceNotificationType'], $result['serviceId'], $result['serviceName'], $result['failureReason'], $result['subscriptionStartDate'], $result['subscriptionEndDate'], $result['nextChargingDate'], $result['lastRenewalDate'], $result['channelType'], $result['inRenewal'], $result['chargingPeriod'], $result['subscriptionCounter'], $result['requestDate'], $result['chargedAmount'], $result['inTry']);
	}
	else {
		$dataObj->updateStateChange($result['msisdn'], $result['state'], $result['offerId'], $result['offerName'], $result['transactionId'], $result['serviceNotificationType'], $result['serviceId'], $result['serviceName'], $result['failureReason'], $result['subscriptionStartDate'], $result['subscriptionEndDate'], $result['nextChargingDate'], $result['lastRenewalDate'], $result['channelType'], $result['inRenewal'], $result['chargingPeriod'], $result['subscriptionCounter'], $result['requestDate'], $result['chargedAmount'], "", $result['trailToPaid']);

		// PRO
		$trDataObj->updateTrStateChange($result['msisdn'], $result['state'], $result['offerId'], $result['offerName'], $result['transactionId'], $result['serviceNotificationType'], $result['serviceId'], $result['serviceName'], $result['failureReason'], $result['subscriptionStartDate'], $result['subscriptionEndDate'], $result['nextChargingDate'], $result['lastRenewalDate'], $result['channelType'], $result['inRenewal'], $result['chargingPeriod'], $result['subscriptionCounter'], $result['requestDate'], $result['chargedAmount'], "", $result['trailToPaid']);
	}
	
} else {
	echo $result['serviceNotificationType']. ', '.$result['state'];
}




// $createdTime = date("Y-m-d H:i:s");
// $file = fopen("logs/newSub.log", 'a');
// $current = "REQUEST $response\n";
// fwrite($file, "$current");
// fclose($file);


// $createdDate = date("Y-m-d");
// $file        = fopen("logs/newSub-$createdDate.log",'a');
// $values      = "[  $response ];\n";
// fwrite($file, "$values");
// fclose($file);

// SUB
// {
// 	"subscriptionId":"null",
// 	"msisdn":"905007654321",
// 	"state":"ACTIVE",
// 	"offerId":"1",
// 	"offerName":"Test Daily",
// 	"transactionId":"5200460034143900060",
// 	"serviceNotificationType":"SUB",
// 	"isRenewal":"false",
// 	"serviceId":"1",
// 	"serviceName":"TestService",
// 	"failureReason":"null",
// 	"subscriptionStartDate":"null",
// 	"subscriptionEndDate":"2021-12-08T12:19:32",
// 	"nextChargingDate":"null",
// 	"lastRenewalDate":"null",
// 	"channelType":"WEB",
// 	"chargingPeriod":"P000Y000M001DT00H00M00S",
// 	"subscriptionCounter":"2",
// 	"requestDate":"null",
// 	"chargedAmount":null
// 	"inTry":"false"
// }


// REACTIVATE
// {
// "subscriptionId": "null",
// "msisdn": "905007654322",
// "state": "ACTIVE",
// "offerId": "4",
// "offerName": "TestDaily",
// "transactionId": "5200460034143900060",
// "serviceNotificationType": "REACTIVATE",
// "serviceId": "103",
// "serviceName": "TestService",
// "failureReason": "null",
// "subscriptionStartDate": "2021-12-08T12:19:32",
// "subscriptionEndDate": "2022-01-18T13:46:04",
// "isRenewal":"false",
// "nextChargingDate": "null",
// "lastRenewalDate": "2022-01-19T05:16:27",
// "channelType": "WEB",
// "chargingPeriod": "P000Y000M001DT00H00M00S",
// "subscriptionCounter":"1",
// "requestDate": "null",
// "chargedAmount": null,
// "trailToPaid": "true"
// }

// REACTIVATE
// {
// "subscriptionId": "19226",
// "msisdn": "905007654321",
// "state": "ACTIVE",
// "offerId": "13",
// "offerName": "GamesPortal Daily",
// "transactionId": "5001444095341321569",
// "serviceNotificationType": "REACTIVATE",
// "channelType": "CC",
// "isRenewal": "false",
// "subscriptionEndDate": "2022-02-10T12:20:20",
// "trailToPaid": "true",
// "subscriptionCounter": "2",
// "requestDate": "2022-02-09T12:23:25",
// "serviceId": "5",
// "serviceName": "GamesPortal",
// "chargedAmount": "0.35",
// "subscriptionStartDate": "2022-02-09T12:20:20",
// "lastRenewalDate": "2022-02-09T12:20:20",
// "chargingPeriod": "P000Y000M000DT00H02M00S",
// "inTry": "false"
// }


// SUSPENDED
// {
// "subscriptionId":"null",
// "msisdn":"905007654321",
// "state":"SUSPENDED",
// "offerId":"4",
// "offerName":"Test Daily",
// "transactionId":"5200460034143900060",
// "serviceNotificationType":"SUSPENDED",
// "serviceId":"103",
// "serviceName":"TestService",
// "failureReason":"null",
// "subscriptionStartDate":"2021-12-08T12:19:32",
// "subscriptionEndDate":"2022-01-18T13:46:04",
// "nextChargingDate":"null",
// "lastRenewalDate":"null",
// "channelType":"WEB",
// "inRenewal": false,
// "chargingPeriod":"P000Y000M001DT00H00M00S",
// "subscriptionCounter":"1",
// "requestDate":"null",
// "chargedAmount":null,
// "inTry":"false"
// }


// UNSUB
// {
// "subscriptionId":"2230",
// "msisdn":"905007654321",
// "state":"INACTIVE",
// "offerId":"1",
// "offerName":"Test Daily",
// "transactionId":"5200460034143900060",
// "serviceNotificationType":"UNSUB",
// "serviceId":"1",
// "serviceName":"TestService",
// "failureReason":"on customer's will",
// "subscriptionStartDate":"2021-12-08T12:19:32",
// "subscriptionEndDate":"2022-01-18T13:46:04",
// "nextChargingDate":"2022-01-18T13:46:04",
// "lastRenewalDate":"2022-01-17T13:46:04",
// "channelType":"WEB",
// "inRenewal": false,
// "chargingPeriod":"P000Y000M001DT00H00M00S",
// "subscriptionCounter":"16",
// "requestDate":"2022-01-17T13:46:04",
// "chargedAmount":null,
// "inTry":"false"
// }