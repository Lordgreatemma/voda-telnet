
<?php 
/**------------------------------------------------------------------------------------------------------------------------------------------------
* @@Name:              send sms

* @@Author:            Lordgreat -  Adri Emmanuel <'rexmerlo@gmail.com'>
* @@Tell:              +233543645688/+233273593525

* @Date:               2022-04-02 11:40:30
* @Last Modified by:   Lordgreat - Adri Emmanuel
* @Last Modified time: 2022-04-02 12:08:17

* @Copyright:          MobileContent.Com Ltd <'owner'>

* @Website:            https://mobilecontent.com.gh
*-------------------------------------------------------------------------------------------------------------------------------------------------
*/

    include_once 'includes/autoloader.inc.php';
    include_once 'includes/objects.php';

    /**
     * https://docs.google.com/document/d/e/2PACX-1vSpHOzvL5rndhDO2cW66Hfe1n8cQJAQ2bV4-P_O3WzHFqvPP-60zyrByeqGvGhvNH0bKtKy9FNGkI9Y/pub
     *https://docs.google.com/document/d/e/2PACX-1vSbQJ_UjtZgE7X4x_TeNL_rDpuWcpu094U9bRKkhko61GFZl1-blvbAa9PUfDubutLRz2xzkrtT2Xp3/pub
     *https://github.com/aaronpk/quick-php-authentication/commit/ff0be3461c3f6a82fb6cc0e2f279c29f38bffc5d
     */
     /**
     * 
     */
    class MOModels //extends MODataAuths
    {
    	private $dataObj = null;

    	public function __construct()
    	{
    		$this->dataObj = new MODataAuths();
    	}


    	public function generateCorelationId()
        {
            $token_prefix = 'MCC';
            $token_suffix = substr(md5(time()), 0, 20);
            $full_token   = $token_prefix . $token_suffix;

            $opt_code = rand(100000,999999);

            $uniqueVal    = date("YmdHis");

            $subRef       = rand(1000000000,100);
            $rand_        = rand(25, 9999999);
            $token        = "mcc-".$subRef;

            return "mcc-".$uniqueVal.$token_suffix;
        }



        public function generateAuthToken()
        {
        	try 
        	{
        		$keys = array(
		            'client_id' => CLIENT_ID,
		            'client_secret' => CLIENT_SECRET
		        );
	
		        //basic auth key generation
		        $basic_auth_key = 'Basic '.base64_encode(CLIENT_ID.':'.CLIENT_SECRET);
		        // $request_url = "https://vfgh-test.telenity.com/oauth/token?grant_type=client_credentials";
		        $data_to_post = urlencode($keys);

		        $ch =  curl_init(ACCESS_TOKEN_LINK);  
						curl_setopt($ch, CURLOPT_POST, true );  
						curl_setopt($ch, CURLOPT_POSTFIELDS, $data_to_post);  
						curl_setopt($ch, CURLOPT_RETURNTRANSFER, true );  
						curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
						curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0); 
						curl_setopt($ch, CURLOPT_HTTPHEADER, array(
						    'Authorization: '.$basic_auth_key,
						    'grant_type: client_credentials',
						    'Content-Type: application/x-www-form-urlencoded',
						  ));

				$result = curl_exec($ch); 
				$err = curl_error($ch);
				curl_close($ch);

				$accessToken = json_decode($result, true);
				// var_dump($err);

				if (!curl_error($ch)) {
					// var_dump($result);
					return $accessToken['access_token'];
				} else{
					return $err;
				}
        		
        	} catch (Exception $e) {
             	return $e->getMessage();
            }
        }





        public function clientChargeRequest($amount, $channel, $msisdn, $offerName, $description, $unit)
        {
        	try 
        	{
        		$clientChargeTransactionId = $this->generateCorelationId();    
        		$clientRequestId = date("YmdHis").rand(1000000000,100);
        		$accessToken = $this->generateAuthToken();
        		$errorCode = "";
        		$errorMsg ="";
        		$rootErrorCode = "";

            	$rawData = array(
	                'amount' 	=> $amount,
	                'clientChargeTransactionId' => $clientChargeTransactionId,
	                'clientRequestId' => $clientRequestId,
	                'channel' 	=> $channel,
	                'msisdn' 	=> $msisdn,
	                'offer' 	=> $offerName,
	                'description'=> $description,
	                'unit'		=>$unit,
	                'parameters' => array()
	            );

	            $data = json_encode($rawData);

	            $ch = curl_init("https://sdp.vodafone.com.gh");//CHARGE_LINK 
	            // curl_setopt($ch, CURLOPT_URL, "https://sdp.vodafone.com.gh");//CHARGE_LINK 
	            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
	            	"Accept: */*",
	            	"client_id: d14756d3ac3275e70edc6327dac6b9db40617068", 
	            	"client_secret: 33693ecb44e951e2bb40f6b206ec67e4243fc953",         
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

	            file_put_contents('logs/con_jchargeResp.log', print_r($jsonData, true));
	            file_put_contents('logs/playload.log', print_r($rawData, true));
	            file_put_contents('logs/Jsonplayload.log', print_r($data, true));


	            //do db stuff here
	            
	            if(trim($jsonData['rootErrorCode']) && trim($jsonData['errorMsg']) && trim($jsonData['errorCode']))
	            {
	            	$this->dataObj->saveChargeCustomerResponse($amount, $msisdn, $shortCode, $channel, $clientChargeTransactionId, $clientRequestId, "",  $offerName, $description, $unit, $jsonData['errorCode'], $jsonData['errorMsg'], $jsonData['rootErrorCode'] );
	            }else {
	            	$this->dataObj->saveChargeCustomerResponse($amount, $msisdn, $shortCode, $channel, $clientChargeTransactionId, $clientRequestId, $transactionId,  $offerName, $description, $unit, "", "", "" );
	            }
	            
	           	

	            if (!$err) {
	                return $jsonData;
	            } else {
	                return $err;
	            }
        	} catch (Exception $e) {
        		return $e->getMessage();
        	}
        }






        public function sendMONotification($address, $shortCode, $message, $offerName)
        {           
            $clientCorrelator = $this->generateCorelationId();
            $accessToken      = $this->generateAuthToken();
            $deliveryUrl      = SEND_MO_NOTIFY;
            $serviceUrl       = SEND_MO_SMS;

            try 
            {         
	            $rawData = [
						"address"=>[
					    	$address
						],
						"senderAddress"=>$shortCode,
						"outboundSMSTextMessage"=>[
					    	"message"=>$message
						],
						"clientCorrelator"=> $clientCorrelator,
						"receiptRequest"=>[
					    	"notifyURL"=>"https://mysmsinbox.com/telnet_sdp/mo/v1/mo_notify/",
					    	"callbackData"=>"some-data-useful-to-the-mcc"
						],
						"senderName"=>"Mobile Content"
					];
					

            	$data = json_encode($rawData);

	            $ch = curl_init(SEND_MO_SMS); 
	            curl_setopt($ch, CURLOPT_URL, SEND_MO_SMS); 
	            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
	            	"Accept: */*",
	            	"client_id: 124f697b927b38dfad1f8d8e28d56e266f66741f", 
	            	"client_secret: 49784e5140683e7381db182ed26bc003c88a57e4",         
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
	                
	            $jsonData = json_decode($result, 1); 

	            file_put_contents('logs/MOResp_Jsms.log', print_r($jsonData, true));
	            file_put_contents('logs/MOResp_Rawsms.log', print_r($result, true));
	            file_put_contents('logs/playload.log', print_r($rawData, true));
	            file_put_contents('logs/Jsonplayload.log', print_r($data, true));


	            $this->dataObj->logContentData($address, $shortCode, $clientCorrelator, $senderName, $message, $offerName);

	            foreach($jsonData['outboundSMSMessageRequest']['deliveryInfoList']['deliveryInfo'] as $data) {
					// $deliveryStatus = $data['deliveryStatus'];
					// $requestId      = $data['requestId'];

					$this->dataObj->logContentDeliveryResponse($address, $shortCode, $clientCorrelator, $senderName, $data['deliveryStatus'], $data['requestId'], $offerName);
					file_put_contents('logs/delivery/Rawsms.log', print_r($data, true));
				}

	            if (!curl_error($ch)) {
	                return $jsonData;
	            } else {
	                return $err;
	            }
            } catch (Exception $e) {
             	return $e->getMessage();
            }

        }




        public function createCustomerAccount($shortCode, $accountIdType, $accountId, $smsText)
        {
        	try 
        	{
        		$clientCorrelator = $this->generateCorelationId();
            	$accessToken      = $this->generateAuthToken();
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

            	$ch = curl_init(CREATE_ACCOUNT_LINK); 
	            curl_setopt($ch, CURLOPT_URL, CREATE_ACCOUNT_LINK); 
	            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
	            	"Accept: */*",
	            	"client_id: 124f697b927b38dfad1f8d8e28d56e266f66741f", 
	            	"client_secret: 49784e5140683e7381db182ed26bc003c88a57e4",         
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

	            if(!curl_error($ch)) {
	                return $result;
	            } else {
	                return $err;
	            }


        	}catch(Exception $e){
        		return $e->getMessage();
        	}
        }




        public function deleteCustomerAccount($carrierId, $accountIdType, $shortCode, $accountId)
        {
        	try 
        	{
        		// $carrierId = "";
        		$deletionUri = "https://domain.com/api/notification/user-account/CustomerAccount?carrierId=".$carrierId."&accountIdType=".$accountIdType."&accountId=".$accountId;//."&shortCode=".{shortCode}

        		$ch = curl_init($deletionUri); 
	            curl_setopt($ch, CURLOPT_URL, $deletionUri); 
	            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
	            	"Accept: */*",
	            	"client_id: 124f697b927b38dfad1f8d8e28d56e266f66741f", 
	            	"client_secret: 49784e5140683e7381db182ed26bc003c88a57e4",         
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




    }


// /api/notification/user-account/CustomerAccount?carrierId=VDF_Ghana&accountIdType=MSISDN&accountId=233546512002
