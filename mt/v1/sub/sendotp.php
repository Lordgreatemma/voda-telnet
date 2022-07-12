<?php 

	$result   = rand(100000,999999);//999999
	$otpCOde  = substr($result, 0, 4); 
	$auth_key = $_POST['token'];
	$address  = $_POST['phone_number'];
	$message  = "Dear customer,\nYour One Time Code for the subscription is : ".$otpCOde;
	$message  = urlencode($message);//200.2.168.175:2199 54.163.215.114
    // $url      = "http://34.230.90.80:2788/Receiver?User=mycloudhttp&Pass=M1C2T3&From=1413&To=$msisdn&Text=$message";
    // $curl     = curl_init();
    // curl_setopt_array($curl, array(
    //     CURLOPT_RETURNTRANSFER => 1,
    //     CURLOPT_URL => $url
    // ));
   	
    $params = array(
    	'address'   => $address,
    	'shortCode' => '1212',
    	'offerName' => 'Gospel Daily',
    	'message'   => $message
    );
    $params = json_encode($params);
   	$ch =  curl_init("https://mysmsinbox.com/telnet_sdp/mt/v1/send-sms-notification-to-sdp.php");  
		curl_setopt( $ch, CURLOPT_POST, true );  
		curl_setopt( $ch, CURLOPT_POSTFIELDS, $params);  
		curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );  
		curl_setopt( $ch, CURLOPT_HTTPHEADER, array(
		    // 'Authorization: '.$auth_key,
		    // 'Cache-Control: no-cache',
		    'Content-Type: application/json',
		  ));



    // $result = curl_exec($curl);
	curl_exec($curl);
    $error = curl_error($curl);
    curl_close($curl);

    if ($error) {
        $response['success'] = false;
	    $response["message"] = 'Failed to send code';
	    $response["code"] = 'new opt=> '.$otpCOde;
	    header('Content-Type: application/json');
		echo json_encode($response);
    } else{
        $response['success'] = true;
	    $response["message"] = 'Code sent successfuly';
	    $response["code"] = 'new opt=> '.$otpCOde;
	    header('Content-Type: application/json');
		echo json_encode($response);
    }
   



	
