<?php 
    include_once 'includes/autoloader.inc.php';
    include_once 'includes/client.inc.php';

    /**
     * 
     */
    class keywordsController// extends AnotherClass
    {
    	
    	private $dataObj = null;

    	public function __construct()
    	{
    		$this->dataObj = new DataAuths();
    	}

    	// generate corelator id
    	public function generateCorelationId()
        {
            $token_prefix = 'MCC';
            $token_suffix = substr(md5(time()), 0, 20);
            $full_token   = $token_prefix . $token_suffix;

            $opt_code = rand(100000,999999);

            $uniqueVal    = date("dHis");

            $subRef       = rand(1000000000,100);
            $rand_        = rand(25, 9999999);
            $token        = "mcc-".$subRef;

            return "mcc-".$uniqueVal.$token_suffix.$opt_code;//$token.
        }




        // generate client access_token
        public function generateAuthToken($client_id, $client_secret, $access_link)
        {
        	try 
        	{
        		$keys = array(
		            'client_id' => $client_id,
		            'client_secret' => $client_secret
		        );
	
		        //basic auth key generation
		        $basic_auth_key = 'Basic '.base64_encode($client_id.':'.$client_secret);
		        // $request_url = "https://vfgh-test.telenity.com/oauth/token?grant_type=client_credentials";
		        // $data_to_post = urlencode($keys);

		        $ch =  curl_init($access_link);  
						curl_setopt( $ch, CURLOPT_POST, true );  
						// curl_setopt( $ch, CURLOPT_POSTFIELDS, 'client_id:'.$client_id,'client_secret:'.$client_secret); //$data_to_post //
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

				$accessToken = json_decode($result, true);
				// var_dump($err);

				if (!$err) {
					// var_dump($result);
					return $accessToken['access_token'];
				} else{
					return $err;
				}
        		
        	} catch (Exception $e) {
             	return $e->getMessage();
            }
        }




        // send Content for the various services
        public function sendKeywordSMS($serviceName, $shortCode, $address, $message, $clientId, $clientSecret)
        {
        	try 
            {  
            	 
            	$access_link      = "https://sdp.vodafone.com.gh/oauth/token?grant_type=client_credentials";//OAUTH_TOKEN_LINK
            	$serviceUrl       = "https://sdp.vodafone.com.gh/vfgh/gw/messaging/v1/outbound";//MESSAGING_LINK

            	$senderName    	  = "Mobile Content";
            	$clientCorrelator = $this->generateCorelationId();
            	$accessToken      = $this->generateAuthToken($clientId, $clientSecret, $access_link);
            	// save current content transmission data
	            // $this->dataObj->logContentData($address, $shortCode, $clientCorrelator, $senderName, $message, $serviceName);


	            
            	$rawData = [
						"address"=>[
					    	$address
						],
						"senderAddress"=>$shortCode,
						"outboundSMSTextMessage"=>[
					    	"message"=>$message
						],
						"clientCorrelator"=> $clientCorrelator,//
						"receiptRequest"=>[
					    	"notifyURL"=>"https://mysmsinbox.com/telnet_sdp/mt/v1/notify/",
					    	"callbackData"=> $serviceName  //"some-data-useful-to-the-mcc"
						],
						"senderName"=>$senderName
					];

            	$data = json_encode($rawData);

	            $ch = curl_init($serviceUrl); 
	            // curl_setopt($ch, CURLOPT_URL, 'https://vfgh-test.telenity.com/vfgh/gw/messaging/v1/outbound'); 
	            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
	            	"Accept: */*",
	            	"client_id: ".$clientId, 
	            	"client_secret: ".$clientSecret,         
	                "Authorization: Bearer ".$accessToken,//.$this->accessToken,
	                "Content-Type: application/json"
	               ));
	            curl_setopt($ch, CURLOPT_POST, true);   
	                                            
	            // curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
	            curl_setopt( $ch, CURLOPT_POSTFIELDS, $data); 
	            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
				curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
	            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
	            $result = curl_exec($ch);
	                
	            curl_getinfo($ch, CURLINFO_HTTP_CODE);
	            $err = curl_error($ch);
	            curl_close($ch);
	                
	            $jsonData = json_decode($result, 1); 

	            file_put_contents('logs/Resp_Rawsms.log', print_r($result, true));
	            file_put_contents('logs/con_JsmsResp.log', print_r($jsonData, true));	
	            file_put_contents('logs/playloadsms.log', print_r($rawData, true));
	            file_put_contents('logs/Jsonplayloadsms.log', print_r($data, true));


	            // // save current content transmission data
	            // $this->dataObj->logContentData($address, $shortCode, $clientCorrelator, $senderName, $message, $serviceName);

	            foreach($jsonData['outboundSMSMessageRequest']['deliveryInfoList']['deliveryInfo'] as $data) {
	            	//save delivery response for the current transmission
					$this->dataObj->logContentDeliveryResponse($address, $shortCode, $clientCorrelator, $senderName, $data['deliveryStatus'], $data['requestId'], $serviceName);
					file_put_contents('logs/delivery/Rawsms.log', print_r($data, true));
				}

				// // save current content transmission data
	            $this->dataObj->logContentData($address, $shortCode, $clientCorrelator, $senderName, $message, $serviceName);

				$createdDate = date("Y-m-d");
				$file        = fopen("logs/delivery/DailyDelivery-".$createdDate.".log",'a');
				$values      = "[  $result ];\n";
				fwrite($file, "$values");
				fclose($file);



				// $this->dataObj->logContentDeliveryResponse($address, $shortCode, $clientCorrelator, $senderName, $deliveryStatus, $requestId);

	            if(!$err){
	                return $result;//$jsonData;
	            } else {
	                return $err;
	            }
            } catch (Exception $e) {
             	return $e->getMessage();
            }
        }






        // send content service by service after subscriber is charged successfully......
        public function pushContents($serviceName, $shortCode, $address, $message)
        {
        	try 
        	{
        		switch ($serviceName) {
        			case "GOSPEL":
        				$result = $this->clientChargeRequest('0.2', $address, $serviceName, $shortCode, "Charge amount for ".$serviceName, '1', "55924fa21576c734368c79c8357f2924ed48bd3c", "7ef6a97d0abe1e9ddf5c16ff549394da380c03ba" );
        				switch ($result) {
        					case 'Success':
        						return $this->sendKeywordSMS($serviceName, $shortCode, $address, "Motivation:\n".$message, "55924fa21576c734368c79c8357f2924ed48bd3c", "7ef6a97d0abe1e9ddf5c16ff549394da380c03ba" );
        						break;       					
        					default:
        						echo "Failed";
        						break;
        				}	
				    break;
				    case "WSDM":
				    	$result = $this->clientChargeRequest('0.2', $address, $serviceName, $shortCode, "Charge amount for ".$serviceName, '1', "2cebdc57b5b28591967f1a7070352dc7d2546a2e", "7cafe0f0f09be9cfeee2fee243e89e1bba9de047");//WISDOM_CLIENT_ID, WISDOM_CLIENT_SECRET
				    	switch ($result) {
        					case 'Success':
        						return $this->sendKeywordSMS($serviceName, $shortCode, $address, "WISDOM:\n".$message, "2cebdc57b5b28591967f1a7070352dc7d2546a2e", "7cafe0f0f09be9cfeee2fee243e89e1bba9de047");
        						break;       					
        					default:
        						echo "Failed";
        						break;
        				}
				    break;
				    case "FIN":
				    	$result = $this->clientChargeRequest('0.2', $address, $serviceName, $shortCode, "Charge amount for ".$serviceName, '1', "d7ecc934cdbeaf0517cfc99508e81256216f49e5", "1c0b2ca59a1f667e12bdd2518a01aa7aebf4f592");//FINANCE_CLIENT_ID, FINANCE_CLIENT_SECRET
				    	if (trim($result) == "Failed") {
				    		$result = $this->clientChargeRequest('0.2', $address, $serviceName, $shortCode, "Charge amount for ".$serviceName, '1', "d7ecc934cdbeaf0517cfc99508e81256216f49e5", "1c0b2ca59a1f667e12bdd2518a01aa7aebf4f592");
				    		if (trim($result) == "Failed") {
				    			$result = $this->clientChargeRequest('0.2', $address, $serviceName, $shortCode, "Charge amount for ".$serviceName, '1', "d7ecc934cdbeaf0517cfc99508e81256216f49e5", "1c0b2ca59a1f667e12bdd2518a01aa7aebf4f592");
				    		} elseif(trim($result) == "Success") {
				    			echo $this->sendKeywordSMS($serviceName, $shortCode, $address, "Finance:\n".$message, "d7ecc934cdbeaf0517cfc99508e81256216f49e5", "1c0b2ca59a1f667e12bdd2518a01aa7aebf4f592");
				    		}
				    	}elseif(trim($result) == "Success"){
				    		echo $this->sendKeywordSMS($serviceName, $shortCode, $address, "Finance:\n".$message, "d7ecc934cdbeaf0517cfc99508e81256216f49e5", "1c0b2ca59a1f667e12bdd2518a01aa7aebf4f592");	
				    	}				    	
				    break;
				     case "MOVIES":
				     	$result = $this->clientChargeRequest('0.2', $address, $serviceName, $shortCode, "Charge amount for ".$serviceName, '1', MOVIES_CLIENT_ID, MOVIES_CLIENT_SECRET);
				    	if (trim($result) == "Failed") {
				    		$result = $this->clientChargeRequest('0.2', $address, $serviceName, $shortCode, "Charge amount for ".$serviceName, '1', MOVIES_CLIENT_ID, MOVIES_CLIENT_SECRET);
				    		if (trim($result) == "Failed") {
				    			$result = $this->clientChargeRequest('0.2', $address, $serviceName, $shortCode, "Charge amount for ".$serviceName, '1', MOVIES_CLIENT_ID, MOVIES_CLIENT_SECRET);
				    		} elseif(trim($result) == "Success") {
				    			echo $this->sendKeywordSMS($serviceName, $shortCode, $address, "Movies:\n".$message, MOVIES_CLIENT_ID, MOVIES_CLIENT_SECRET);
				    		}
				    	}elseif(trim($result) == "Success"){
				    		echo $this->sendKeywordSMS($serviceName, $shortCode, $address, "Movies:\n".$message, MOVIES_CLIENT_ID, MOVIES_CLIENT_SECRET);	
				    	}				    	
				    break;
				     case "CHEL":
				     	$result = $this->clientChargeRequest('0.2', $address, $serviceName, $shortCode, "Charge amount for ".$serviceName, '1', CHELSEA_CLIENT_ID, CHELSEA_CLIENT_SECRET);
				    	if (trim($result) == "Failed") {
				    		$result = $this->clientChargeRequest('0.2', $address, $serviceName, $shortCode, "Charge amount for ".$serviceName, '1', CHELSEA_CLIENT_ID, CHELSEA_CLIENT_SECRET);
				    		if (trim($result) == "Failed") {
				    			$result = $this->clientChargeRequest('0.2', $address, $serviceName, $shortCode, "Charge amount for ".$serviceName, '1', CHELSEA_CLIENT_ID, CHELSEA_CLIENT_SECRET);
				    		} elseif(trim($result) == "Success") {
				    			echo $this->sendKeywordSMS($serviceName, $shortCode, $address, "Chelsea:\n".$message, CHELSEA_CLIENT_ID, CHELSEA_CLIENT_SECRET);
				    		}
				    	}elseif(trim($result) == "Success"){
				    		echo $this->sendKeywordSMS($serviceName, $shortCode, $address, "Chelsea:\n".$message, CHELSEA_CLIENT_ID, CHELSEA_CLIENT_SECRET);	
				    	}				    	
				    break;
				     case "REALM":
				     	$result = $this->clientChargeRequest('0.2', $address, $serviceName, $shortCode, "Charge amount for ".$serviceName, '1', REAL_CLIENT_ID, REAL_CLIENT_SECRET);
				    	if (trim($result) == "Failed") {
				    		$result = $this->clientChargeRequest('0.2', $address, $serviceName, $shortCode, "Charge amount for ".$serviceName, '1', REAL_CLIENT_ID, REAL_CLIENT_SECRET);
				    		if (trim($result) == "Failed") {
				    			$result = $this->clientChargeRequest('0.2', $address, $serviceName, $shortCode, "Charge amount for ".$serviceName, '1', REAL_CLIENT_ID, REAL_CLIENT_SECRET);
				    		} elseif(trim($result) == "Success") {
				    			echo $this->sendKeywordSMS($serviceName, $shortCode, $address, "Real Madrid:\n".$message, REAL_CLIENT_ID, REAL_CLIENT_SECRET);
				    		}
				    	}elseif(trim($result) == "Success"){
				    		echo $this->sendKeywordSMS($serviceName, $shortCode, $address, "Real Madrid:\n".$message, REAL_CLIENT_ID, REAL_CLIENT_SECRET);	
				    	}				    	
				    break;
				     case "MANU":
				     	$result = $this->clientChargeRequest('0.2', $address, $serviceName, $shortCode, "Charge amount for ".$serviceName, '1', MANU_CLIENT_ID, MANU_CLIENT_SECRET);
				    	if (trim($result) == "Failed") {
				    		$result = $this->clientChargeRequest('0.2', $address, $serviceName, $shortCode, "Charge amount for ".$serviceName, '1', MANU_CLIENT_ID, MANU_CLIENT_SECRET);
				    		if (trim($result) == "Failed") {
				    			$result = $this->clientChargeRequest('0.2', $address, $serviceName, $shortCode, "Charge amount for ".$serviceName, '1', MANU_CLIENT_ID, MANU_CLIENT_SECRET);
				    		} elseif(trim($result) == "Success") {
				    			echo $this->sendKeywordSMS($serviceName, $shortCode, $address, "Man U:\n".$message, MANU_CLIENT_ID, MANU_CLIENT_SECRET);
				    		}
				    	}elseif(trim($result) == "Success"){
				    		echo $this->sendKeywordSMS($serviceName, $shortCode, $address, "Man U:\n".$message, MANU_CLIENT_ID, MANU_CLIENT_SECRET);	
				    	}				    	
				    break;
				     case "BARCA":
				     	$result = $this->clientChargeRequest('0.2', $address, $serviceName, $shortCode, "Charge amount for ".$serviceName, '1', BARCA_CLIENT_ID, BARCA_CLIENT_SECRET);
				    	if (trim($result) == "Failed") {
				    		$result = $this->clientChargeRequest('0.2', $address, $serviceName, $shortCode, "Charge amount for ".$serviceName, '1', BARCA_CLIENT_ID, BARCA_CLIENT_SECRET);
				    		if (trim($result) == "Failed") {
				    			$result = $this->clientChargeRequest('0.2', $address, $serviceName, $shortCode, "Charge amount for ".$serviceName, '1', BARCA_CLIENT_ID, BARCA_CLIENT_SECRET);
				    		} elseif(trim($result) == "Success") {
				    			echo $this->sendKeywordSMS($serviceName, $shortCode, $address, "Barcelona:\n".$message, BARCA_CLIENT_ID, BARCA_CLIENT_SECRET);
				    		}
				    	}elseif(trim($result) == "Success"){
				    		echo $this->sendKeywordSMS($serviceName, $shortCode, $address, "Barcelona:\n".$message, BARCA_CLIENT_ID, BARCA_CLIENT_SECRET);
				    	}				    	
				    break;
				     case "ARSNL":
				     	$result = $this->clientChargeRequest('0.2', $address, $serviceName, $shortCode, "Charge amount for ".$serviceName, '1', ARSENAL_CLIENT_ID, ARSENAL_CLIENT_SECRET);
				    	if (trim($result) == "Failed") {
				    		$result = $this->clientChargeRequest('0.2', $address, $serviceName, $shortCode, "Charge amount for ".$serviceName, '1', ARSENAL_CLIENT_ID, ARSENAL_CLIENT_SECRET);
				    		if (trim($result) == "Failed") {
				    			$result = $this->clientChargeRequest('0.2', $address, $serviceName, $shortCode, "Charge amount for ".$serviceName, '1', ARSENAL_CLIENT_ID, ARSENAL_CLIENT_SECRET);
				    		} elseif(trim($result) == "Success") {
				    			echo $this->sendKeywordSMS($serviceName, $shortCode, $address, "Arsenal:\n".$message, ARSENAL_CLIENT_ID, ARSENAL_CLIENT_SECRET);
				    		}
				    	}elseif(trim($result) == "Success"){
				    		echo $this->sendKeywordSMS($serviceName, $shortCode, $address, "Arsenal:\n".$message, ARSENAL_CLIENT_ID, ARSENAL_CLIENT_SECRET);
				    	}				    	
				    break;
				     case "LPOOL":
				     	$result = $this->clientChargeRequest('0.2', $address, $serviceName, $shortCode, "Charge amount for ".$serviceName, '1', LIVERPOOL_CLIENT_ID, LIVERPOOL_CLIENT_SECRET);
				    	if (trim($result) == "Failed") {
				    		$result = $this->clientChargeRequest('0.2', $address, $serviceName, $shortCode, "Charge amount for ".$serviceName, '1', LIVERPOOL_CLIENT_ID, LIVERPOOL_CLIENT_SECRET);
				    		if (trim($result) == "Failed") {
				    			$result = $this->clientChargeRequest('0.2', $address, $serviceName, $shortCode, "Charge amount for ".$serviceName, '1', LIVERPOOL_CLIENT_ID, LIVERPOOL_CLIENT_SECRET);
				    		} elseif(trim($result) == "Success") {
				    			echo $this->sendKeywordSMS($serviceName, $shortCode, $address, "Liverpool:\n".$message, LIVERPOOL_CLIENT_ID, LIVERPOOL_CLIENT_SECRET);
				    		}
				    	}elseif(trim($result) == "Success"){
				    		echo $this->sendKeywordSMS($serviceName, $shortCode, $address, "Liverpool:\n".$message, LIVERPOOL_CLIENT_ID, LIVERPOOL_CLIENT_SECRET);
				    	}				    	
				    break;
				     case "MANCITY":
				     	$result = $this->clientChargeRequest('0.2', $address, $serviceName, $shortCode, "Charge amount for ".$serviceName, '1', MANCITY_CLIENT_ID, MANCITY_CLIENT_SECRET);
				    	if (trim($result) == "Failed") {
				    		$result = $this->clientChargeRequest('0.2', $address, $serviceName, $shortCode, "Charge amount for ".$serviceName, '1', MANCITY_CLIENT_ID, MANCITY_CLIENT_SECRET);
				    		if (trim($result) == "Failed") {
				    			$result = $this->clientChargeRequest('0.2', $address, $serviceName, $shortCode, "Charge amount for ".$serviceName, '1', MANCITY_CLIENT_ID, MANCITY_CLIENT_SECRET);
				    		} elseif(trim($result) == "Success") {
				    			echo $this->sendKeywordSMS($serviceName, $shortCode, $address, "Man City:\n".$message, MANCITY_CLIENT_ID, MANCITY_CLIENT_SECRET);
				    		}
				    	}elseif(trim($result) == "Success"){
				    		echo $this->sendKeywordSMS($serviceName, $shortCode, $address, "Man City:\n".$message, MANCITY_CLIENT_ID, MANCITY_CLIENT_SECRET);
				    	}				    	
				    break;
				    ###########################################################################################################################
				    case "CATHOLIC":
				    	$result = $this->clientChargeRequest('0.2', $address, $serviceName, $shortCode, "Charge amount for ".$serviceName, '1', CATHOLIC_CLIENT_ID, CATHOLIC_CLIENT_SECRET);
				    	if(trim($result) == "Failed") {
				    		$result = $this->clientChargeRequest('0.2', $address, $serviceName, $shortCode, "Charge amount for ".$serviceName, '1', CATHOLIC_CLIENT_ID, CATHOLIC_CLIENT_SECRET);
				    		if(trim($result) == "Failed") {
				    			$result = $this->clientChargeRequest('0.2', $address, $serviceName, $shortCode, "Charge amount for ".$serviceName, '1', CATHOLIC_CLIENT_ID, CATHOLIC_CLIENT_SECRET);
				    		} elseif(trim($result) == "Success") {
				    			echo $this->sendKeywordSMS($serviceName, $shortCode, $address, "Catholic:\n".$message, CATHOLIC_CLIENT_ID, CATHOLIC_CLIENT_SECRET);
				    		}
				    	}elseif(trim($result) == "Success"){
				    		echo $this->sendKeywordSMS($serviceName, $shortCode, $address, "Catholic:\n".$message, CATHOLIC_CLIENT_ID, CATHOLIC_CLIENT_SECRET);
				    	}
				    break;
				    case "PPP":
				    	$result = $this->clientChargeRequest('0.2', $address, $serviceName, $shortCode, "Charge amount for ".$serviceName, '1', PPP_CLIENT_ID, PPP_CLIENT_SECRET);
				    	if(trim($result) == "Failed") {
				    		$result = $this->clientChargeRequest('0.2', $address, $serviceName, $shortCode, "Charge amount for ".$serviceName, '1', PPP_CLIENT_ID, PPP_CLIENT_SECRET);
				    		if(trim($result) == "Failed") {
				    			$result = $this->clientChargeRequest('0.2', $address, $serviceName, $shortCode, "Charge amount for ".$serviceName, '1', PPP_CLIENT_ID, PPP_CLIENT_SECRET);
				    		} elseif(trim($result) == "Success") {
				    			echo $this->sendKeywordSMS($serviceName, $shortCode, $address, "PPP:\n".$message, PPP_CLIENT_ID, PPP_CLIENT_SECRET);
				    		}
				    	}elseif(trim($result) == "Success"){
				    		echo $this->sendKeywordSMS($serviceName, $shortCode, $address, "PPP:\n".$message, PPP_CLIENT_ID, PPP_CLIENT_SECRET);
				    	}
				    break;
				    case "PKN":
				    	$result = $this->clientChargeRequest('0.2', $address, $serviceName, $shortCode, "Charge amount for ".$serviceName, '1', PKN_CLIENT_ID, PKN_CLIENT_SECRET);
				    	if(trim($result) == "Failed") {
				    		$result = $this->clientChargeRequest('0.2', $address, $serviceName, $shortCode, "Charge amount for ".$serviceName, '1', PKN_CLIENT_ID, PKN_CLIENT_SECRET);
				    		if(trim($result) == "Failed") {
				    			$result = $this->clientChargeRequest('0.2', $address, $serviceName, $shortCode, "Charge amount for ".$serviceName, '1', PKN_CLIENT_ID, PKN_CLIENT_SECRET);
				    		} elseif(trim($result) == "Success") {
				    			echo $this->sendKeywordSMS($serviceName, $shortCode, $address, "PKN:\n".$message, PKN_CLIENT_ID, PKN_CLIENT_SECRET);
				    		}
				    	}elseif(trim($result) == "Success"){
				    		echo $this->sendKeywordSMS($serviceName, $shortCode, $address, "PKN:\n".$message, PKN_CLIENT_ID, PKN_CLIENT_SECRET);
				    	}				    	
				    break;
				    case "AG":
				    	$result = $this->clientChargeRequest('0.2', $address, $serviceName, $shortCode, "Charge amount for ".$serviceName, '1', AG_CLIENT_ID, AG_CLIENT_SECRET);
				    	if(trim($result) == "Failed") {
				    		$result = $this->clientChargeRequest('0.2', $address, $serviceName, $shortCode, "Charge amount for ".$serviceName, '1', AG_CLIENT_ID, AG_CLIENT_SECRET);
				    		if(trim($result) == "Failed") {
				    			$result = $this->clientChargeRequest('0.2', $address, $serviceName, $shortCode, "Charge amount for ".$serviceName, '1', AG_CLIENT_ID, AG_CLIENT_SECRET);
				    		} elseif(trim($result) == "Success") {
				    			echo $this->sendKeywordSMS($serviceName, $shortCode, $address, "AG:\n".$message, AG_CLIENT_ID, AG_CLIENT_SECRET);
				    		}
				    	}elseif(trim($result) == "Success"){
				    		echo $this->sendKeywordSMS($serviceName, $shortCode, $address, "AG:\n".$message, AG_CLIENT_ID, AG_CLIENT_SECRET);
				    	}			    	
				    break;
				    case "FABU":
				    	$result = $this->clientChargeRequest('0.2', $address, $serviceName, $shortCode, "Charge amount for ".$serviceName, '1', FABU_CLIENT_ID, FABU_CLIENT_SECRET);
				    	if(trim($result) == "Failed") {
				    		$result = $this->clientChargeRequest('0.2', $address, $serviceName, $shortCode, "Charge amount for ".$serviceName, '1', FABU_CLIENT_ID, FABU_CLIENT_SECRET);
				    		if(trim($result) == "Failed") {
				    			$result = $this->clientChargeRequest('0.2', $address, $serviceName, $shortCode, "Charge amount for ".$serviceName, '1', FABU_CLIENT_ID, FABU_CLIENT_SECRET);
				    		} elseif(trim($result) == "Success") {
				    			echo $this->sendKeywordSMS($serviceName, $shortCode, $address, "FABU:\n".$message, FABU_CLIENT_ID, FABU_CLIENT_SECRET);
				    		}
				    	}elseif(trim($result) == "Success"){
				    		echo $this->sendKeywordSMS($serviceName, $shortCode, $address, "FABU:\n".$message, FABU_CLIENT_ID, FABU_CLIENT_SECRET);
				    	}				    	
				    break;
				    case "GFA":
				    	$result = $this->clientChargeRequest('0.2', $address, $serviceName, $shortCode, "Charge amount for ".$serviceName, '1', GFA_CLIENT_ID, GFA_CLIENT_SECRET);
				    	if(trim($result) == "Failed") {
				    		$result = $this->clientChargeRequest('0.2', $address, $serviceName, $shortCode, "Charge amount for ".$serviceName, '1', GFA_CLIENT_ID, GFA_CLIENT_SECRET);
				    		if(trim($result) == "Failed") {
				    			$result = $this->clientChargeRequest('0.2', $address, $serviceName, $shortCode, "Charge amount for ".$serviceName, '1', GFA_CLIENT_ID, GFA_CLIENT_SECRET);
				    		} elseif(trim($result) == "Success") {
				    			echo $this->sendKeywordSMS($serviceName, $shortCode, $address, "GFA:\n".$message, GFA_CLIENT_ID, GFA_CLIENT_SECRET);
				    		}
				    	}elseif(trim($result) == "Success"){
				    		echo $this->sendKeywordSMS($serviceName, $shortCode, $address, "GFA:\n".$message, GFA_CLIENT_ID, GFA_CLIENT_SECRET);
				    	}				    	
				    break;
				    case "FAITHS":
				    	$result = $this->clientChargeRequest('0.2', $address, $serviceName, $shortCode, "Charge amount for ".$serviceName, '1', FAITHS_CLIENT_ID, FAITHS_CLIENT_SECRET);
				    	if(trim($result) == "Failed") {
				    		// $result = $this->clientChargeRequest('0.2', $address, $serviceName, $shortCode, "Charge amount for ".$serviceName, '1', FAITHS_CLIENT_ID, FAITHS_CLIENT_SECRET);
				    		// if(trim($result) == "Failed") {
				    		// 	$result = $this->clientChargeRequest('0.2', $address, $serviceName, $shortCode, "Charge amount for ".$serviceName, '1', FAITHS_CLIENT_ID, FAITHS_CLIENT_SECRET);
				    		// } elseif(trim($result) == "Success") {
				    		// 	echo $this->sendKeywordSMS($serviceName, $shortCode, $address, "Faith:\n".$message, FAITHS_CLIENT_ID, FAITHS_CLIENT_SECRET);
				    		// }
				    	}elseif(trim($result) == "Success"){
				    		echo $this->sendKeywordSMS($serviceName, $shortCode, $address, "Faith:\n".$message, FAITHS_CLIENT_ID, FAITHS_CLIENT_SECRET);
				    	}				    	
				    break;
				    case "MONEY":
				    	$result = $this->clientChargeRequest('0.2', $address, $serviceName, $shortCode, "Charge amount for ".$serviceName, '1', MONEY_CLIENT_ID, MONEY_CLIENT_SECRET);
				    	if(trim($result) == "Failed") {
				    		$result = $this->clientChargeRequest('0.2', $address, $serviceName, $shortCode, "Charge amount for ".$serviceName, '1', MONEY_CLIENT_ID, MONEY_CLIENT_SECRET);
				    		if(trim($result) == "Failed") {
				    			$result = $this->clientChargeRequest('0.2', $address, $serviceName, $shortCode, "Charge amount for ".$serviceName, '1', MONEY_CLIENT_ID, MONEY_CLIENT_SECRET);
				    		} elseif(trim($result) == "Success") {
				    			echo $this->sendKeywordSMS($serviceName, $shortCode, $address, "Money:\n".$message, MONEY_CLIENT_ID, MONEY_CLIENT_SECRET);
				    		}
				    	}elseif(trim($result) == "Success"){
				    		echo $this->sendKeywordSMS($serviceName, $shortCode, $address, "Money:\n".$message, MONEY_CLIENT_ID, MONEY_CLIENT_SECRET);
				    	}				    	
				    break;
				    case "CARE247":
				    	$result = $this->clientChargeRequest('0.2', $address, $serviceName, $shortCode, "Charge amount for ".$serviceName, '1', CARE247_CLIENT_ID, CARE247_CLIENT_SECRET);
				    	if(trim($result) == "Failed") {
				    		$result = $this->clientChargeRequest('0.2', $address, $serviceName, $shortCode, "Charge amount for ".$serviceName, '1', CARE247_CLIENT_ID, CARE247_CLIENT_SECRET);
				    		if(trim($result) == "Failed") {
				    			$result = $this->clientChargeRequest('0.2', $address, $serviceName, $shortCode, "Charge amount for ".$serviceName, '1', CARE247_CLIENT_ID, CARE247_CLIENT_SECRET);
				    		} elseif(trim($result) == "Success") {
				    			echo $this->sendKeywordSMS($serviceName, $shortCode, $address, "Care247:\n".$message, CARE247_CLIENT_ID, CARE247_CLIENT_SECRET);
				    		}
				    	}elseif(trim($result) == "Success"){
				    		echo $this->sendKeywordSMS($serviceName, $shortCode, $address, "Care247:\n".$message, CARE247_CLIENT_ID, CARE247_CLIENT_SECRET);
				    	}					    	
				    break;
				    case "MCC USSD":
				    	echo $this->sendKeywordSMS($serviceName, $shortCode, $address, $message, MCCUSSD_CLIENT_ID, MCCUSSD_CLIENT_SECRET);
				    break;
				    case "SCHOOL PLACEMENT":
				    	echo $this->sendKeywordSMS($serviceName, $shortCode, $address, $message, SCHOOLPLACEMENT_CLIENT_ID, SCHOOLPLACEMENT_CLIENT_SECRET);
				    break;
				    case "SILVERBIRD MOVIES":
				    	$result = $this->clientChargeRequest('0.2', $address, $serviceName, $shortCode, "Charge amount for ".$serviceName, '1', SILVERBIRD_CLIENT_ID, SILVERBIRD_CLIENT_SECRET);
				    	if(trim($result) == "Failed") {
				    		$result = $this->clientChargeRequest('0.2', $address, $serviceName, $shortCode, "Charge amount for ".$serviceName, '1', SILVERBIRD_CLIENT_ID, SILVERBIRD_CLIENT_SECRET);
				    		if(trim($result) == "Failed") {
				    			$result = $this->clientChargeRequest('0.2', $address, $serviceName, $shortCode, "Charge amount for ".$serviceName, '1', SILVERBIRD_CLIENT_ID, SILVERBIRD_CLIENT_SECRET);
				    		} elseif(trim($result) == "Success") {
				    			echo $this->sendKeywordSMS($serviceName, $shortCode, $address, $message, SILVERBIRD_CLIENT_ID, SILVERBIRD_CLIENT_SECRET);
				    		}
				    	}elseif(trim($result) == "Success"){
				    		echo $this->sendKeywordSMS($serviceName, $shortCode, $address, $message, SILVERBIRD_CLIENT_ID, SILVERBIRD_CLIENT_SECRET);
				    	}				    	
				    break;
				    default:
	    				$output['message'] = "Kindly provide a valid service name to be charged...!";
			    		$output['success'] = false;
			    		header('Content-type: application/json; charset=utf-8');
			    		echo json_encode($output);
        		}
        		
        	} catch (Exception $e) {
        		return $e->getMessage();
        	}
        }








        // Process client charge request..............
        public function clientChargeRequest($amount, $msisdn, $offerName, $shortCode, $description, $unit, $clientId, $clientSecret)
        {
        	try 
        	{
        		$access_link	 = "https://sdp.vodafone.com.gh/oauth/token?grant_type=client_credentials";

        		$clientChargeTransactionId = $this->generateCorelationId();    
        		$clientRequestId = date("YmdHis").rand(1000000000,100);
        		$accessToken = $this->generateAuthToken($clientId, $clientSecret, $access_link);
        		$errorCode = "";
        		$errorMsg ="";
        		$rootErrorCode = "";

            	$rawData = array(
	                'amount' 	=> (float)$amount, 
	                'clientChargeTransactionId' => $clientRequestId,
	                'clientRequestId' => $clientRequestId,
	                'channel' 	=> "SMS", //$channel,
	                'msisdn' 	=> $msisdn,
	                'offer' 	=> $offerName,
	                'description'=> $description,
	                'unit'		=>$unit,
	                'parameters' => array()
	            );

	            $data = json_encode($rawData);

	            $ch = curl_init("https://sdp.vodafone.com.gh/vfgh/gw/charging/v1/charge");//CHARGE_LINK https://sdp.vodafone.com.gh/vfgh/gw/charging/v2/charge
	            // curl_setopt($ch, CURLOPT_URL, "https://sdp.vodafone.com.gh");//CHARGE_LINK 
	            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
	            	"Accept: */*",
	            	"client_id: ".$clientId, 
	            	"client_secret: ".$clientSecret,         
	                "Authorization: Bearer ".$accessToken,//.$this->accessToken,
	                "Content-Type: application/json"
	               ));
	            // curl_setopt($ch, CURLOPT_POST, true);   
	                                            
	            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
	            curl_setopt( $ch, CURLOPT_POSTFIELDS, $data); 
	            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
				curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
	            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
	            $result = curl_exec($ch);
	                
	            curl_getinfo($ch, CURLINFO_HTTP_CODE);
	            $err = curl_error($ch);
	            curl_close($ch);
	                
	            $jsonData = json_decode($result, 1); 

	            file_put_contents('logs/chargeRespJ.log', print_r($jsonData, true));
	            file_put_contents('logs/ChargePlayload.log', print_r($rawData, true));
	            file_put_contents('logs/ChargeJsonplayload.log', print_r($data, true));
	            file_put_contents('logs/ChargeRawResponse.log', print_r($result, true));


	            $createdDate = date("Y-m-d");
				$file        = fopen("logs/DailyBill-".$createdDate.".log",'a');
				$values      = "[  $result ];\n";
				fwrite($file, "$values");
				fclose($file);

	            //do db stuff here
	            
	            if(trim($jsonData['rootErrorCode']) && trim($jsonData['errorMsg']) && trim($jsonData['errorCode']))
	            {	
	            	//save failed responses
	            	$this->dataObj->saveChargeCustomerResponse($amount, $msisdn, $shortCode, "SMS", $clientChargeTransactionId, $clientRequestId, "",  $offerName, $description, $unit, $jsonData['errorCode'], $jsonData['errorMsg'], $jsonData['rootErrorCode'] );
	            	return "Failed";
	            }else {
	            	// save successful charge response
	            	$this->dataObj->saveChargeCustomerResponse($amount, $msisdn, $shortCode, "SMS", $clientChargeTransactionId, $clientRequestId, $jsonData['transactionId'],  $offerName, $description, $unit, "", "", "" );
	            	return "Success";
	            }
        	} catch (Exception $e) {
        		return $e->getMessage();
        	}
        }












        public function initiateRequest($serviceName, $shortCode, $address, $message){
        	try 
        	{
        		$description =""; $unit = ""; $clientId =""; $clientSecret = "";$description = ""; $unit = 1; $formartMessage = "";
        		switch ($serviceName) {
        			case "GOSPEL":
        				$clientId = "55924fa21576c734368c79c8357f2924ed48bd3c"; $clientSecret = "7ef6a97d0abe1e9ddf5c16ff549394da380c03ba"; $description = "Charge amount for ".$serviceName; $amount = "0.2";
        				$formartMessage = "Motivation:\n".$message;
				    	// return $this->clientChargeRequest($amount, $msisdn, $serviceName, $shortCode, $description, $unit, GOSPEL_CLIENT_ID, GOSPEL_CLIENT_SECRET);
				    break;
				    case "WSDM":
				    	$clientId = "2cebdc57b5b28591967f1a7070352dc7d2546a2e"; $clientSecret = "7cafe0f0f09be9cfeee2fee243e89e1bba9de047"; $description = "Charge amount for ".$serviceName; $amount = "0.2";$formartMessage = "Wisdom:\n".$message;
				    break;
				    default:
	    				$output['message'] = "Kindly provide a valid service name to for the charge request...!";
			    		$output['success'] = false;
			    		header('Content-type: application/json; charset=utf-8');
			    		return json_encode($output);
        		}


        		$access_link	 = "https://sdp.vodafone.com.gh/oauth/token?grant_type=client_credentials";

        		$clientChargeTransactionId = $this->generateCorelationId();    
        		$clientRequestId = date("YmdHis").rand(1000000000,100);
        		$accessToken = $this->generateAuthToken($clientId, $clientSecret, $access_link);
        		$errorCode = "";
        		$errorMsg ="";
        		$rootErrorCode = "";

            	$rawData = array(
	                'amount' 	=> (float)$amount, 
	                'clientChargeTransactionId' => $clientRequestId,
	                'clientRequestId' => $clientRequestId,
	                'channel' 	=> "SMS", //$channel,
	                'msisdn' 	=> $address,
	                'offer' 	=> $serviceName,
	                'description'=> $description,
	                'unit'		=> $unit,
	                'parameters' => array()
	            );

	            $data = json_encode($rawData);

	            $ch = curl_init("https://sdp.vodafone.com.gh/vfgh/gw/charging/v1/charge");//CHARGE_LINK https://sdp.vodafone.com.gh/vfgh/gw/charging/v2/charge
	            // curl_setopt($ch, CURLOPT_URL, "https://sdp.vodafone.com.gh");//CHARGE_LINK 
	            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
	            	"Accept: */*",
	            	"client_id: ".$clientId, 
	            	"client_secret: ".$clientSecret,         
	                "Authorization: Bearer ".$accessToken,//.$this->accessToken,
	                "Content-Type: application/json"
	               ));
	            // curl_setopt($ch, CURLOPT_POST, true);   
	                                            
	            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
	            curl_setopt( $ch, CURLOPT_POSTFIELDS, $data); 
	            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
				curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
	            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
	            $result = curl_exec($ch);
	                
	            curl_getinfo($ch, CURLINFO_HTTP_CODE);
	            $err = curl_error($ch);
	            curl_close($ch);
	                
	            $jsonData = json_decode($result, 1); 

	            file_put_contents('logs/IchargeRespJ.log', print_r($jsonData, true));
	            file_put_contents('logs/IChargePlayload.log', print_r($rawData, true));
	            file_put_contents('logs/IChargeJsonplayload.log', print_r($data, true));
	            file_put_contents('logs/IChargeRawResponse.log', print_r($result, true));


	   //          $createdDate = date("Y-m-d");
				// $file        = fopen("logs/DailyBill-".$createdDate.".log",'a');
				// $values      = "[  $result ];\n";
				// fwrite($file, "$values");
				// fclose($file);

	            //do db stuff here
	            
	            if(trim($jsonData['rootErrorCode']) && trim($jsonData['errorMsg']) && trim($jsonData['errorCode']))
	            {	
	            	//save failed responses
	            	$this->dataObj->saveChargeCustomerResponse($amount, $address, $shortCode, "SMS", $clientRequestId, $clientRequestId, "",  $serviceName, $description, $unit, $jsonData['errorCode'], $jsonData['errorMsg'], $jsonData['rootErrorCode'] );
	            	return "Failed";
	            }else {
	            	// save successful charge response
	            	$this->dataObj->saveChargeCustomerResponse($amount, $address, $shortCode, "SMS", $clientRequestId, $clientRequestId, $jsonData['transactionId'],  $serviceName, $description, $unit, "", "", "" );
	            	
	            	$res = $this->sendKeywordSMS($serviceName, $shortCode, $address, $formartMessage, $clientId, $clientSecret );
	            	return $res;
	            }

        	} catch (Exception $e) {
        		return $e->getMessage();
        	}
        }




        // initiate a charge request for the various services.........
        public function chargeRequest($amount, $msisdn, $serviceName, $shortCode, $description, $unit)
        {
        	try 
        	{//clientChargeRequest($amount, $msisdn, $serviceName, $shortCode, $description, $unit, $clientId, $clientSecret)
        		switch ($serviceName) {
        			case "GOSPEL":
				    	return $this->clientChargeRequest($amount, $msisdn, $serviceName, $shortCode, $description, $unit, GOSPEL_CLIENT_ID, GOSPEL_CLIENT_SECRET);
				    break;
				    case "WSDM":
				    	return $this->clientChargeRequest($amount, $msisdn, $serviceName, $shortCode, $description, $unit, "2cebdc57b5b28591967f1a7070352dc7d2546a2e", "7cafe0f0f09be9cfeee2fee243e89e1bba9de047"); //WISDOM_CLIENT_ID, WISDOM_CLIENT_SECRET
				    break;
				    case "FIN":
				    	echo $this->clientChargeRequest($amount, $msisdn, $serviceName, $shortCode, $description, $unit, "d7ecc934cdbeaf0517cfc99508e81256216f49e5", "1c0b2ca59a1f667e12bdd2518a01aa7aebf4f592");//FINANCE_CLIENT_ID, FINANCE_CLIENT_SECRET
				    break;
				     case "MOVIES":
				    	echo $this->clientChargeRequest($amount, $msisdn, $serviceName, $shortCode, $description, $unit, MOVIES_CLIENT_ID, MOVIES_CLIENT_SECRET);
				    break;
				     case "CHEL":
				    	echo $this->clientChargeRequest($amount, $msisdn, $serviceName, $shortCode, $description, $unit, CHELSEA_CLIENT_ID, CHELSEA_CLIENT_SECRET);
				    break;
				     case "REALM":
				    	echo $this->clientChargeRequest($amount, $msisdn, $serviceName, $shortCode, $description, $unit, REAL_CLIENT_ID, REAL_CLIENT_SECRET);
				    break;
				     case "MANU":
				    	echo $this->clientChargeRequest($amount, $msisdn, $serviceName, $shortCode, $description, $unit, MANU_CLIENT_ID, MANU_CLIENT_SECRET);
				    break;
				     case "BARCA":
				    	echo $this->clientChargeRequest($amount, $msisdn, $serviceName, $shortCode, $description, $unit, BARCA_CLIENT_ID, BARCA_CLIENT_SECRET);
				    break;
				     case "ARSNL":
				    	echo $this->clientChargeRequest($amount, $msisdn, $serviceName, $shortCode, $description, $unit, ARSENAL_CLIENT_ID, ARSENAL_CLIENT_SECRET);
				    break;
				     case "LPOOL":
				    	echo $this->clientChargeRequest($amount, $msisdn, $serviceName, $shortCode, $description, $unit, LIVERPOOL_CLIENT_ID, LIVERPOOL_CLIENT_SECRET);
				    break;
				     case "MANCITY":
				    	echo $this->clientChargeRequest($amount, $msisdn, $serviceName, $shortCode, $description, $unit, MANCITY_CLIENT_ID, MANCITY_CLIENT_SECRET);
				    break;

				    ###########################################################################################################################
				    case "CATHOLIC":
				    	echo $this->clientChargeRequest($amount, $msisdn, $serviceName, $shortCode, $description, $unit, CATHOLIC_CLIENT_ID, CATHOLIC_CLIENT_SECRET);
				    break;
				    case "PPP":
				    	echo $this->clientChargeRequest($amount, $msisdn, $serviceName, $shortCode, $description, $unit, PPP_CLIENT_ID, PPP_CLIENT_SECRET);
				    break;
				    case "PKN":
				    	echo $this->clientChargeRequest($amount, $msisdn, $serviceName, $shortCode, $description, $unit, PKN_CLIENT_ID, PKN_CLIENT_SECRET);
				    break;
				    case "AG":
				    	echo $this->clientChargeRequest($amount, $msisdn, $serviceName, $shortCode, $description, $unit, AG_CLIENT_ID, AG_CLIENT_SECRET);
				    break;
				    case "FABU":
				    	echo $this->clientChargeRequest($amount, $msisdn, $serviceName, $shortCode, $description, $unit, FABU_CLIENT_ID, FABU_CLIENT_SECRET);
				    break;
				    case "GFA":
				    	echo $this->clientChargeRequest($amount, $msisdn, $serviceName, $shortCode, $description, $unit, GFA_CLIENT_ID, GFA_CLIENT_SECRET);
				    break;
				    case "FAITHS":
				    	echo $this->clientChargeRequest($amount, $msisdn, $serviceName, $shortCode, $description, $unit, FAITHS_CLIENT_ID, FAITHS_CLIENT_SECRET);
				    break;
				    case "MONEY":
				    	echo $this->clientChargeRequest($amount, $msisdn, $serviceName, $shortCode, $description, $unit, MONEY_CLIENT_ID, MONEY_CLIENT_SECRET);
				    break;
				    case "CARE247":
				    	echo $this->clientChargeRequest($amount, $msisdn, $serviceName, $shortCode, $description, $unit, CARE247_CLIENT_ID, CARE247_CLIENT_SECRET);
				    break;
				    case "MCC USSD":
				    	echo $this->clientChargeRequest($amount, $msisdn, $serviceName, $shortCode, $description, $unit, MCCUSSD_CLIENT_ID, MCCUSSD_CLIENT_SECRET);
				    break;
				    case "SCHOOL PLACEMENT":
				    	echo $this->clientChargeRequest($amount, $msisdn, $serviceName, $shortCode, $description, $unit, SCHOOLPLACEMENT_CLIENT_ID, SCHOOLPLACEMENT_CLIENT_SECRET);
				    break;
				    case "SILVERBIRD MOVIES":
				    	echo $this->clientChargeRequest($amount, $msisdn, $serviceName, $shortCode, $description, $unit, SILVERBIRD_CLIENT_ID, SILVERBIRD_CLIENT_SECRET);
				    break;
				    default:
	    				$output['message'] = "Kindly provide a valid service name to for the charge request...!";
			    		$output['success'] = false;
			    		header('Content-type: application/json; charset=utf-8');
			    		echo json_encode($output);
        		}
        	} catch (Exception $e) {
        		return $e->getMessage();
        	}
        }



















        // send content service by service after subscriber is charged successfully......
        public function pushContentsBilledKewords($serviceName, $shortCode, $address, $message)
        {
        	try 
        	{
        		switch ($serviceName) {
        			case "GOSPEL":
        				return $this->sendKeywordSMS($serviceName, $shortCode, $address, "Gospel:\n".$message, "55924fa21576c734368c79c8357f2924ed48bd3c", "7ef6a97d0abe1e9ddf5c16ff549394da380c03ba" );//GOSPEL_CLIENT_ID, GOSPEL_CLIENT_SECRET
				    break;
				    case "WSDM":
				    		$this->sendKeywordSMS($serviceName, $shortCode, $address, "Wisdom:\n".$message, "2cebdc57b5b28591967f1a7070352dc7d2546a2e", "7cafe0f0f09be9cfeee2fee243e89e1bba9de047");	
				    break;
				    case "FIN":
				    			echo $this->sendKeywordSMS($serviceName, $shortCode, $address, "Finance:\n".$message, "d7ecc934cdbeaf0517cfc99508e81256216f49e5", "1c0b2ca59a1f667e12bdd2518a01aa7aebf4f592");
				    break;
				    case "MOVIES":
				    		echo $this->sendKeywordSMS($serviceName, $shortCode, $address, "Movies:\n".$message, MOVIES_CLIENT_ID, MOVIES_CLIENT_SECRET);    	
				    break;
				     case "CHEL":
				    		echo $this->sendKeywordSMS($serviceName, $shortCode, $address, "Chelsea:\n".$message, CHELSEA_CLIENT_ID, CHELSEA_CLIENT_SECRET);   	
				    break;
				     case "REALM":
				    			echo $this->sendKeywordSMS($serviceName, $shortCode, $address, "Real Madrid:\n".$message, REAL_CLIENT_ID, REAL_CLIENT_SECRET); 	
				    break;
				     case "MANU":
				    		echo $this->sendKeywordSMS($serviceName, $shortCode, $address, "Man U:\n".$message, MANU_CLIENT_ID, MANU_CLIENT_SECRET);	    	
				    break;
				     case "BARCA":
				    		echo $this->sendKeywordSMS($serviceName, $shortCode, $address, "Barcelona:\n".$message, BARCA_CLIENT_ID, BARCA_CLIENT_SECRET);   	
				    break;
				     case "ARSNL":
				    		echo $this->sendKeywordSMS($serviceName, $shortCode, $address, "Arsenal:\n".$message, ARSENAL_CLIENT_ID, ARSENAL_CLIENT_SECRET);   	
				    break;
				     case "LPOOL":
				    		echo $this->sendKeywordSMS($serviceName, $shortCode, $address, "Liverpool:\n".$message, LIVERPOOL_CLIENT_ID, LIVERPOOL_CLIENT_SECRET);
				    break;
				     case "MANCITY":
				    		echo $this->sendKeywordSMS($serviceName, $shortCode, $address, "Man City:\n".$message, MANCITY_CLIENT_ID, MANCITY_CLIENT_SECRET);  	
				    break;
				    ###########################################################################################################################
				    case "CATHOLIC":
				    		echo $this->sendKeywordSMS($serviceName, $shortCode, $address, "Catholic:\n".$message, CATHOLIC_CLIENT_ID, CATHOLIC_CLIENT_SECRET);
				    break;
				    case "PPP":
				    		echo $this->sendKeywordSMS($serviceName, $shortCode, $address, "PPP:\n".$message, PPP_CLIENT_ID, PPP_CLIENT_SECRET);
				    break;
				    case "PKN":
				    		echo $this->sendKeywordSMS($serviceName, $shortCode, $address, "PKN:\n".$message, PKN_CLIENT_ID, PKN_CLIENT_SECRET);		    	
				    break;
				    case "AG":
				    		echo $this->sendKeywordSMS($serviceName, $shortCode, $address, "AG:\n".$message, AG_CLIENT_ID, AG_CLIENT_SECRET);		    	
				    break;
				    case "FABU":
				    		echo $this->sendKeywordSMS($serviceName, $shortCode, $address, "FABU:\n".$message, FABU_CLIENT_ID, FABU_CLIENT_SECRET);		    	
				    break;
				    case "GFA":
				    		echo $this->sendKeywordSMS($serviceName, $shortCode, $address, "GFA:\n".$message, GFA_CLIENT_ID, GFA_CLIENT_SECRET);		    	
				    break;
				    case "FAITHS":
				    		echo $this->sendKeywordSMS($serviceName, $shortCode, $address, "Faith:\n".$message, FAITHS_CLIENT_ID, FAITHS_CLIENT_SECRET);    	
				    break;
				    case "MONEY":
				    		echo $this->sendKeywordSMS($serviceName, $shortCode, $address, "Money:\n".$message, MONEY_CLIENT_ID, MONEY_CLIENT_SECRET);	    	
				    break;
				    case "CARE247":
				    		echo $this->sendKeywordSMS($serviceName, $shortCode, $address, "Care247:\n".$message, CARE247_CLIENT_ID, CARE247_CLIENT_SECRET);   	
				    break;
				    case "MCC USSD":
				    	echo $this->sendKeywordSMS($serviceName, $shortCode, $address, $message, MCCUSSD_CLIENT_ID, MCCUSSD_CLIENT_SECRET);
				    break;
				    case "SCHOOL PLACEMENT":
				    	echo $this->sendKeywordSMS($serviceName, $shortCode, $address, $message, SCHOOLPLACEMENT_CLIENT_ID, SCHOOLPLACEMENT_CLIENT_SECRET);
				    break;
				    case "SILVERBIRD MOVIES":
				    		echo $this->sendKeywordSMS($serviceName, $shortCode, $address, $message, SILVERBIRD_CLIENT_ID, SILVERBIRD_CLIENT_SECRET);	    	
				    break;
				    default:
	    				$output['message'] = "Kindly provide a valid service name to be sent...!";
			    		$output['success'] = false;
			    		header('Content-type: application/json; charset=utf-8');
			    		echo json_encode($output);
        		}
        		
        	} catch (Exception $e) {
        		return $e->getMessage();
        	}
        }














        // Delete a user's subscription from a service
        public function deleteCustomerAccount($carrierId, $accountIdType, $shortCode, $accountId, $clientId, $clientSecret)
        {
        	try 
        	{
        		$access_link	 = "https://sdp.vodafone.com.gh/oauth/token?grant_type=client_credentials";
        		$deletionUri	 = "https://sdp.vodafone.com.gh/api/notification/user-account/CustomerAccount?carrierId=".$carrierId."&accountIdType=".$accountIdType."&accountId=".$accountId;

        		$clientCorrelator = $this->generateCorelationId();
            	$accessToken      = $this->generateAuthToken($clientId, $clientSecret, $access_link);

        		// $carrierId = "";
        		// $deletionUri =//."&shortCode=".{shortCode}

        		$ch = curl_init($deletionUri); 
	            // curl_setopt($ch, CURLOPT_URL, $deletionUri); 
	            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
	            	"Accept: */*",
	            	"client_id: ".$clientId, 
	            	"client_secret: ".$clientSecret,         
	                "Authorization: Bearer ".$accessToken,
	                "Content-Type: application/json"
	               ));
	            // curl_setopt($ch, CURLOPT_POST, true);   
	                                            
	            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
	            // curl_setopt( $ch, CURLOPT_POSTFIELDS, $data); 
	            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
				curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
	            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
	            $result = curl_exec($ch);
	                
	            curl_getinfo($ch, CURLINFO_HTTP_CODE);
	            $err = curl_error($ch);
	            curl_close($ch);	

	            return $result;
        	}catch(Exception $e){
        		return $e->getMessage();
        	}
        }





        public function createCustomerAccount($shortCode, $accountIdType, $accountId, $smsText, $clientId, $clientSecret)
        {
        	try 
        	{
        		$access_link	 = "https://sdp.vodafone.com.gh/oauth/token?grant_type=client_credentials";
        		$sub_link = "";

        		$clientCorrelator = $this->generateCorelationId();
            	$accessToken      = $this->generateAuthToken($clientId, $clientSecret, $access_link);
        		$rawData = array(
	                'merchantId' => $merchantId,
	                'carrierId'  => "VDF_Ghana",
	                'shortCode'  => $shortCode,
	                'accountInfo'=> array(
	                    "accountIdType" => $accountIdType,
	                    'accountId'     => $accountId
	                ),
	                'smsText' => $smsText,
	                'carrierTransactionId' => $clientCorrelator
	            );

            	$data = json_encode($rawData);

            	$ch = curl_init($sub_link); 
	            // curl_setopt($ch, CURLOPT_URL, CREATE_ACCOUNT_LINK); 
	            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
	            	"Accept: */*",
	            	"client_id: ".$clientId, 
	            	"client_secret: ".$clientSecret,         
	                "Authorization: Bearer ".$accessToken,
	                "Content-Type: application/json"
	               ));
	            curl_setopt($ch, CURLOPT_POST, true);   
	                                            
	            // curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
	            curl_setopt( $ch, CURLOPT_POSTFIELDS, $data); 
	            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
				curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
	            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
	            $result = curl_exec($ch);
	                
	            curl_getinfo($ch, CURLINFO_HTTP_CODE);
	            $err = curl_error($ch);
	            curl_close($ch);
	                
	            // $jsonData = json_decode($result, 1); 
	            // file_put_contents('logs/MOResp_Jsms.log', print_r($jsonData, true));
	            file_put_contents('logs/MOResp_RawCreate.log', print_r($result, true));
	            file_put_contents('logs/Createplayload.log', print_r($rawData, true));
	            file_put_contents('logs/CreateJsonplayload.log', print_r($data, true));

	            if(!$err) {
	                return $result;
	            } else {
	                return $err;
	            }
        	}catch(Exception $e){
        		return $e->getMessage();
        	}
        }











        // unsubscribe user from a service......
        public function unsubscritptionMTChannel($offerName, $shortCode, $msisdn, $inactivationReason, $clientId, $clientSecret)
        {	
        	$access_link   = "https://sdp.vodafone.com.gh/oauth/token?grant_type=client_credentials";
            $transactionID = $this->generateCorelationId();
            $accessToken   = $this->generateAuthToken($clientId, $clientSecret, $access_link);
            $serviceUrl    = "https://sdp.vodafone.com.gh/vfgh/gw/subscription/v1/unsubscribe";
            

            try 
            {
	             $playload = array(
	                 "TransactionId" => $transactionID,
	                 "Channel" => "SMS", //$channel, //SMS
	                 "msisdn" => $msisdn,
	                 "offer"=> $offerName,  //motivation, wisdom
	                 "inactivationReason" => $inactivationReason //on customer's demand
	             );

	             $data = json_encode($playload);

	             $ch = curl_init($serviceUrl); 
	             // curl_setopt($ch, CURLOPT_URL, 'https://vfgh-test.telenity.com/vfgh/gw/subscription/v1/unsubscribe'); 
	             curl_setopt($ch, CURLOPT_HTTPHEADER, array(
	             	"Accept: */*",
	                "Authorization: Bearer ".$accessToken,
	                "Content-Type: application/json"
	               ));
	             curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
	             curl_setopt( $ch, CURLOPT_POSTFIELDS, $data); 
	             curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
				curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
	             curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
	             $result = curl_exec($ch);
	                
	             curl_getinfo($ch, CURLINFO_HTTP_CODE);
	             $err = curl_error($ch);
	             curl_close($ch);
	                
	             $jsonData = json_decode($result, 1);


	            file_put_contents('logs/UnsubjsResp.log', print_r($jsonData, true));
	            file_put_contents('logs/unsubplayload.log', print_r($playload, true));
	            file_put_contents('logs/unsubJsonplayload.log', print_r($data, true)); 

	             if (!$err) {
	                 return $result;
	             } else {
	                 return $err;
	             }
            } catch (Exception $e) {
                return $e->getMessage();
            }
        }





        //unsubscribe a user from a given service
        public function unsubscribeServiceName($serviceName, $shortCode, $address, $inactivationReason)
        {
        	try 
        	{
        		switch ($serviceName) {//unsubscritptionMTChannel($offerName, $shortCode, $msisdn, $inactivationReason, $clientId, $clientSecret)
        			case "GOSPEL":
				    	echo $this->unsubscritptionMTChannel($serviceName, $shortCode, $address, $inactivationReason, GOSPEL_CLIENT_ID, GOSPEL_CLIENT_SECRET);
				    break;
				    case "WSDM":
				    	echo $this->unsubscritptionMTChannel($serviceName, $shortCode, $address, $inactivationReason, WISDOM_CLIENT_ID, WISDOM_CLIENT_SECRET);
				    break;
				    case "FIN":
				    	echo $this->unsubscritptionMTChannel($serviceName, $shortCode, $address, $inactivationReason, FINANCE_CLIENT_ID, FINANCE_CLIENT_SECRET);
				    break;
				     case "MOVIES":
				    	echo $this->unsubscritptionMTChannel($serviceName, $shortCode, $address, $inactivationReason, MOVIES_CLIENT_ID, MOVIES_CLIENT_SECRET);
				    break;
				     case "CHEL":
				    	echo $this->unsubscritptionMTChannel($serviceName, $shortCode, $address, $inactivationReason, CHELSEA_CLIENT_ID, CHELSEA_CLIENT_SECRET);
				    break;
				     case "REALM":
				    	echo $this->unsubscritptionMTChannel($serviceName, $shortCode, $address, $inactivationReason, REAL_CLIENT_ID, REAL_CLIENT_SECRET);
				    break;
				     case "MANU":
				    	echo $this->unsubscritptionMTChannel($serviceName, $shortCode, $address, $inactivationReason, MANU_CLIENT_ID, MANU_CLIENT_SECRET);
				    break;
				     case "BARCA":
				    	echo $this->unsubscritptionMTChannel($serviceName, $shortCode, $address, $inactivationReason, BARCA_CLIENT_ID, BARCA_CLIENT_SECRET);
				    break;
				     case "ARSNL":
				    	echo $this->unsubscritptionMTChannel($serviceName, $shortCode, $address, $inactivationReason, ARSENAL_CLIENT_ID, ARSENAL_CLIENT_SECRET);
				    break;
				     case "LPOOL":
				    	echo $this->unsubscritptionMTChannel($serviceName, $shortCode, $address, $inactivationReason, LIVERPOOL_CLIENT_ID, LIVERPOOL_CLIENT_SECRET);
				    break;
				     case "MANCITY":
				    	echo $this->unsubscritptionMTChannel($serviceName, $shortCode, $address, $inactivationReason, MANCITY_CLIENT_ID, MANCITY_CLIENT_SECRET);
				    break;

				    ###########################################################################################################################
				    case "CATHOLIC":
				    	echo $this->unsubscritptionMTChannel($serviceName, $shortCode, $address, $inactivationReason, CATHOLIC_CLIENT_ID, CATHOLIC_CLIENT_SECRET);
				    break;
				    case "PPP":
				    	echo $this->unsubscritptionMTChannel($serviceName, $shortCode, $address, $inactivationReason, PPP_CLIENT_ID, PPP_CLIENT_SECRET);
				    break;
				    case "PKN":
				    	echo $this->unsubscritptionMTChannel($serviceName, $shortCode, $address, $inactivationReason, PKN_CLIENT_ID, PKN_CLIENT_SECRET);
				    break;
				    case "AG":
				    	echo $this->unsubscritptionMTChannel($serviceName, $shortCode, $address, $inactivationReason, AG_CLIENT_ID, AG_CLIENT_SECRET);
				    break;
				    case "FABU":
				    	echo $this->unsubscritptionMTChannel($serviceName, $shortCode, $address, $inactivationReason, FABU_CLIENT_ID, FABU_CLIENT_SECRET);
				    break;
				    case "GFA":
				    	echo $this->unsubscritptionMTChannel($serviceName, $shortCode, $address, $inactivationReason, GFA_CLIENT_ID, GFA_CLIENT_SECRET);
				    break;
				    case "FAITHS":
				    	echo $this->unsubscritptionMTChannel($serviceName, $shortCode, $address, $inactivationReason, FAITHS_CLIENT_ID, FAITHS_CLIENT_SECRET);
				    break;
				    case "MONEY":
				    	echo $this->unsubscritptionMTChannel($serviceName, $shortCode, $address, $inactivationReason, MONEY_CLIENT_ID, MONEY_CLIENT_SECRET);
				    break;
				    case "CARE247":
				    	echo $this->unsubscritptionMTChannel($serviceName, $shortCode, $address, $inactivationReason, CARE247_CLIENT_ID, CARE247_CLIENT_SECRET);
				    break;
				    case "MCC USSD":
				    	echo $this->unsubscritptionMTChannel($serviceName, $shortCode, $address, $inactivationReason, MCCUSSD_CLIENT_ID, MCCUSSD_CLIENT_SECRET);
				    break;
				    case "SCHOOL PLACEMENT":
				    	echo $this->unsubscritptionMTChannel($serviceName, $shortCode, $address, $inactivationReason, SCHOOLPLACEMENT_CLIENT_ID, SCHOOLPLACEMENT_CLIENT_SECRET);
				    break;
				    case "SILVERBIRD MOVIES":
				    	echo $this->unsubscritptionMTChannel($serviceName, $shortCode, $address, $inactivationReason, SILVERBIRD_CLIENT_ID, SILVERBIRD_CLIENT_SECRET);
				    break;
				    default:
	    				$output['message'] = "Kindly provide a valid service name to be unsubscribe...!";
			    		$output['success'] = false;
			    		header('Content-type: application/json; charset=utf-8');
			    		echo json_encode($output);
        		}
        	} catch (Exception $e) {
        		return $e->getMessage();
        	}
        }








    }

