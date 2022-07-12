<?php 
    include_once 'includes/autoloader.inc.php';
	$response = file_get_contents("php://input");
	file_put_contents("logs/sub/data.log", $response);
	$result = json_decode($response, true);
	echo $response;


	$dataObj = new MODataAuths();
	if(!empty($result) || $result != "") 
	{
		// echo $result['merchantId'];
		// echo $result['carrierId'];
		// echo $result['shortCode'];
		// echo $result['accountInfo']['accountIdType'];
		// echo $result['accountInfo']['accountId'];
		// echo $result['smsText'];
		// echo $result['carrierTransactionId'];


		$dataObj->saveMOSubscription($result['merchantId'], $result['carrierId'], $result['shortCode'], $result['accountInfo']['accountIdType'], $result['accountInfo']['accountId'], $result['smsText'], $result['carrierTransactionId']);
	}


	$createdDate = date("Y-m-d");
	$file        = fopen("logs/sub/newSub-$createdDate.log",'a');
	$values      = "[  $response ];\n";
	fwrite($file, "$values");
	fclose($file);
?>