<?php 


// Get OAuth Token:
// curl --location --request POST 'https://vfgh-test.telenity.com/oauth/token?grant_type=client_credentials' \
// --header 'Content-Type: application/x-www-form-urlencoded' \
// --data-urlencode 'client_id=ab2e22a2df3aac8d8424675ddce7ce4598f6f785' \
// --data-urlencode 'client_secret=4d2212843f2s9b7554255ee88c8775a11866ac8'


// try 
// {
// 	$ch = curl_init(); 
// 	curl_setopt($ch, CURLOPT_URL, "https://vfgh-test.telenity.com/oauth/token?grant_type=client_credentials"); 
// 	curl_setopt($ch, CURLOPT_HTTPHEADER, array(
// 	    // "Accept: */*",
// 	    "Content-Type: application/x-www-form-urlencoded"
// 	  )); 
  
// 	curl_setopt($ch, CURLOPT_POST, true);
// 	curl_setopt( $ch, CURLOPT_POSTFIELDS, array(
// 		'client_id' => urlencode("124f697b927b38dfad1f8d8e28d56e266f66741f"),
// 		'client_secret' => urlencode("49784e5140683e7381db182ed26bc003c88a57e4")
// 	));	
// 	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
// 	$result = curl_exec($ch); 
// 	$status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
// 	$err = curl_error($ch);
// 	curl_close($ch);

// 	// echo $result;

// 	// // echo $err;
// 	// var_dump($err);

// 	if ($result) {
// 		echo $result;
// 	} else {
// 		var_dump($err);
// 	}
// 	var_dump($status);

// } catch (Exception $e) {
// 	return $e->getMessage();
// }


// http://54.163.32.178:2788/Receiver?User=mycloudhttp&Pass=M1C2T3&From=1413&To=233543654688&Text=message
// 		var_dump("Your AcloePay code is 3456 
// Don't share this code with anyone.");

// 		die();



include_once 'includes/client.php';

$keyC = '55924fa21576c734368c79c8357f2924ed48bd3c';
$secC = '7ef6a97d0abe1e9ddf5c16ff549394da380c03ba';
$keys = array(
            'client_id' => '55924fa21576c734368c79c8357f2924ed48bd3c',
            'client_secret' => '7ef6a97d0abe1e9ddf5c16ff549394da380c03ba'
        );



	
        //basic auth key generation
        $basic_auth_key = 'Basic '.base64_encode('55924fa21576c734368c79c8357f2924ed48bd3c:7ef6a97d0abe1e9ddf5c16ff549394da380c03ba');
        $request_url = "https://sdp.vodafone.com.gh/oauth/token?grant_type=client_credentials";
        $data_to_post = urlencode('client_id:55924fa21576c734368c79c8357f2924ed48bd3c','client_secret:7ef6a97d0abe1e9ddf5c16ff549394da380c03ba');

        $ch =  curl_init($request_url);  
				curl_setopt( $ch, CURLOPT_POST, true ); 
				curl_setopt( $ch, CURLOPT_POSTFIELDS, $data_to_post);  //'client_id:'.$keyC,'client_secret:'.$secC
				curl_setopt( $ch, CURLOPT_VERBOSE, true );
				curl_setopt( $ch, CURLOPT_STDERR => fopen('logs/curl.log', 'w+')); 
				// CURLOPT_STDERR => fopen('./curl.log', 'w+'); 
				curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
				curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
				curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0); 
				curl_setopt( $ch, CURLOPT_HTTPHEADER, array(
				    'Authorization: '.$basic_auth_key,
				    'grant_type: client_credentials',
				    'Content-Type: application/x-www-form-urlencoded',
				  ));

		$result = curl_exec($ch); 
		$err = curl_error($ch);
		curl_close($ch);

		var_dump($err);


// urlencode()

		if (!curl_error($ch)) {
			var_dump($result);
		} 
