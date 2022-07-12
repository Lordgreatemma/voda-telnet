<?php 
/**------------------------------------------------------------------------------------------------------------------------------------------------
* @@Name:              DbConfig

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

	/**
	 * https://docs.google.com/document/d/e/2PACX-1vSpHOzvL5rndhDO2cW66Hfe1n8cQJAQ2bV4-P_O3WzHFqvPP-60zyrByeqGvGhvNH0bKtKy9FNGkI9Y/pub
	 *https://docs.google.com/document/d/e/2PACX-1vSbQJ_UjtZgE7X4x_TeNL_rDpuWcpu094U9bRKkhko61GFZl1-blvbAa9PUfDubutLRz2xzkrtT2Xp3/pub
	 *https://github.com/aaronpk/quick-php-authentication/commit/ff0be3461c3f6a82fb6cc0e2f279c29f38bffc5d
	 */
	class TelnetSdpModel  extends DataAuths
	{
		protected $transactionID;
		protected $accessToken;
		protected $serviceUrl;


		//accessToken
		public function generateToken()
		{
			try 
			{
				$apiKey = "";
				$ch = curl_init(); 
				curl_setopt($ch, CURLOPT_URL, "https://api-gateway......."); 
				curl_setopt($ch, CURLOPT_HTTPHEADER, array(
				    "Authorization: Basic ".urlencode($apiKey),
				    "Accept: */*",
				    "Content-Type: application/x-www-form-urlencoded"
				  )); 
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);   
				curl_setopt($ch, CURLOPT_POST, true);
				$response = curl_exec($ch);
				$status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
				$err = curl_error($ch);
				curl_close($ch);
				$data = json_decode($response);

				return $data;
			} catch (Exception $e) {
				return $e->getMessage();
			}
		}


		// generate transaction id................
		public function generateTransactionToken()
    	{
	        $token_prefix = 'MCC';
	        $token_suffix = substr(md5(time()), 0, 20);
	        $full_token   = $token_prefix . $token_suffix;

	        $opt_code = rand(100000,999999);

	        $uniqueVal    = date("YmdHis");

	        $subRef       = rand(1000000000,100);
	        $rand_        = rand(25, 9999999);
			$token        = "mcc-".$subRef;


			$correlator   = $token.$uniqueVal.$rand_;
	        return $correlator;
    	}
		
		public function initiateNewSubscriptionChannel($msisdn, $state, $offerId, $offerName, $serviceNotificationType, $serviceId, $serviceName, $channelType )
		{
			try 
			{
				// subscriptionId, transactionId, 
				$startTime = date("Y-m-d H:i:s");
				$apiKey = "";
				$ch = curl_init(); 
				curl_setopt($ch, CURLOPT_URL, "https://api-gateway......."); 
				curl_setopt($ch, CURLOPT_HTTPHEADER, array(
				    "Authorization: Basic ".$apiKey,
				    "Content-Type: application/json"
				  )); 
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);   
				curl_setopt($ch, CURLOPT_POST, true);
				curl_setopt( $ch, CURLOPT_POSTFIELDS, array(
					'subscriptionId' => $current_network,
					'msisdn'     => $momo_number,
					'state'     => $momo_amount,
					'offerId'    => $service_name,
					'offerName'          => $device,
					'transactionId'    =>$callback_url,
					'serviceNotificationType'=> $service_description,
					'serviceId'    =>$callback_url,
					'serviceName'=> $service_description,
					'isRenewal'    =>$callback_url,
					'failureReason'=> $service_description,
					'callback_url'    =>$callback_url,
					'service_description'=> $service_description,
					'callback_url'    =>$callback_url,
					'service_description'=> $service_description,
				)); 

				$result = json_decode(curl_exec($ch), 1); 
				curl_getinfo($ch, CURLINFO_HTTP_CODE);
				$err = curl_error($ch);
				curl_close($ch);

				// $json = json_decode($result, true);

				if(curl_error($ch)) 
				{
					return $err;
				} else 
				{
					return $result;
				}
			} catch (Exception $e) 
			{
				// echo $e;
				return $e->getMessage();
			}
			
			
		}


		


// 21 sub
// 		{
// 			"subscriptionId": "{{OfferSubscriptionId}}",
// 			"msisdn":"{{MSISDN}}",
// 			"state":"{{OfferState}}",
// 			"offerId":"{{OfferId}}",
// 			"offerName":"{{OfferName}}",
// 			"transactionId":"{{TransactionId}}",
// 			"serviceNotificationType":"{{serviceNotificationType}}",
// 			"serviceId":"{{ServiceId}}",
// 			"serviceName":"{{ServiceName}}",
// 			"isRenewal":"{{isRenewal}}",
// 			"failureReason":"{{failureReason}}",
// 			"subscriptionStartDate": "{{subscriptionStartDate}}",
// 			"subscriptionEndDate": "{{subscriptionEndDate}}",
// 			"nextChargingDate": "{{nextChargingDate}}",
// 			"lastRenewalDate": "{{lastRenewalDate}}",
// 			"channelType": "{{channelType}}",
// 			"chargingPeriod": "{{chargingPeriod}}",
// 			"subscriptionCounter": "{{subscriptionCounter}}",
// 			"requestDate": "{{requestDate}}",
// 			"chargedAmount": "{{chargedAmount}}",
// 			"inTry": "{{inTry}}"
// 		}



		// Unsubscribe:
		// curl --location --request PUT 'https://vfgh-test.telenity.com/vfgh/gw/subscription/v1/unsubscribe' \
		// --header 'Authorization: Bearer 45aabd145da2839e9367fabb16f5634d' \
		// --header 'Content-Type: application/json' \
		// --data-raw '{
		//     "TransactionId": "TEST-6814844842262572825",
		//     "Channel": "SMS",
		//     "msisdn":"233508889999",
		//     "offer": "Vodafone Test Daily",
		//     "inactivationReason": "Will of the customer"
		// }'
		public function unsubCustomer($msisdn, $reseason, $offer)
		{
			try 
			{
				$expiresIn = "";
				$expirationTime = "";
				$newExpirationTime = "";
				$oldToken = "";
				$startTime = date("Y-m-d H:i:s");
        		$newExpirationTime = date('Y-m-d H:i:s',strtotime('+58 minutes',strtotime($startTime)));
        		$this->transactionID->generateTransactionToken();

				

				foreach ($this->checkTokenExpiration() as $key) 
				{
					$oldToken = $key['access_token'];
					$expiresIn = $key['expires_in'];
					$expirationTime = $key['expires_time'];
				}

				if($startTime <= $expirationTime) {
					$data = json_decode($this->generateToken(), 1);

					$this->saveGeneratedTokens($data->access_token, $data->token_type, $data->expires_in, $newExpirationTime);
					$this->accessToken = $data->access_token;
				} else {
					$this->accessToken = $oldToken;
				}
				

				$this->serviceUrl = "https://vfgh-test.telenity.com/vfgh/gw/subscription/v1/unsubscribe";
				$ch = curl_init(); 
				curl_setopt($ch, CURLOPT_URL, $this->serviceUrl); 
				curl_setopt($ch, CURLOPT_HTTPHEADER, array(
				    "Authorization: Bearer ".$this->accessToken,
				    "Content-Type: application/json"
				  ));
				// curl_setopt($ch, CURLOPT_POST, true); 				  				
				curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
				curl_setopt( $ch, CURLOPT_POSTFIELDS, array(
					'TransactionId' => $this->transactionID,
					'msisdn'        => $msisdn,
					'offer'         => $offer,
					'inactivationReason' => $reseason
				)); 
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
				$result = curl_exec($ch);
				
				curl_getinfo($ch, CURLINFO_HTTP_CODE);
				$err = curl_error($ch);
				curl_close($ch);
				
				$jsonData = json_decode($result, 1); 

				if (curl_exec($ch)) {
					return $jsonData;
				} else {
					return curl_error($ch);
				}
				

				// curl_setopt($ch, CURLOPT_URL, $url);
			 //    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
			 //    $result = curl_exec($ch);
			 //    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
			 //    curl_close($ch);
			} catch (Exception $e) {
				return $e->getMessage();
			}
		}




		public function CallAPI($method, $api, $data) 
		{
		    $url = "http://localhost:82/slimdemo/RESTAPI/" . $api;
		    $curl = curl_init($url);
		    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		    
		    switch ($method) {
		        case "GET":
		            curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));
		            curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "GET");
		            break;
		        case "POST":
		            curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));
		            curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
		            break;
		        case "PUT":
		            curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));
		            curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PUT");
		            break;
		        case "DELETE":
		            curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "DELETE"); 
		            curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));
		            break;
		    }
		    $response = curl_exec($curl);
		    $data = json_decode($response);

		    /* Check for 404 (file not found). */
		    $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
		    // Check the HTTP Status code
		    switch ($httpCode) {
		        case 200:
		            $error_status = "200: Success";
		            return ($data);
		            break;
		        case 404:
		            $error_status = "404: API Not found";
		            break;
		        case 500:
		            $error_status = "500: servers replied with an error.";
		            break;
		        case 502:
		            $error_status = "502: servers may be down or being upgraded. Hopefully they'll be OK soon!";
		            break;
		        case 503:
		            $error_status = "503: service unavailable. Hopefully they'll be OK soon!";
		            break;
		        default:
		            $error_status = "Undocumented error: " . $httpCode . " : " . curl_error($curl);
		            break;
		    }
		    curl_close($curl);
		    echo $error_status;
		    die;





			//     CALL Delete Method

			// $data = array('id'=>$_GET['did']);
			// $result = CallAPI('DELETE', "DeleteCategory", $data);

			//     CALL Post Method

			// $data = array('title'=>$_POST['txtcategory'],'description'=>$_POST['txtdesc']);
			// $result = CallAPI('POST', "InsertCategory", $data);

		}


		public function curl_del($path, $json = '')
		{
		    $url = $this->__url.$path;
		    $ch = curl_init();
		    curl_setopt($ch, CURLOPT_URL, $url);
		    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
		    curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
		    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		    $result = curl_exec($ch);
		    $result = json_decode($result);
		    curl_close($ch);

		    return $result;
		}

	}