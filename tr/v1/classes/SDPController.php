<?php 
	include_once 'includes/autoloader.inc.php';
/**
 * MT
 */
class SDPController extends SDPModel
{
	public $dataObj = null;
	public function __construct()
	{
		$dataObj = new SDPProductionModel();
	}


	//generate corelator id
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

        return "mcc-".$uniqueVal.$token_suffix;//$token.
    }



	public function subscribeCustomer()
	{
		echo "Hello";
	}



	
	public function unsubscribeCustomer($address, $channel, $offerName, $reseason)
	{
		try 
		{
			$ch = curl_init("https://mysmsinbox.com/telnet_sdp/mt/v1/unsub-mt-service.php"); 
            curl_setopt($ch, CURLOPT_URL, 'https://mysmsinbox.com/telnet_sdp/mt/v1/unsub-mt-service.php'); 
            curl_setopt($ch, CURLOPT_POST, true);                                              
            // curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
            curl_setopt( $ch, CURLOPT_POSTFIELDS, array(
            	"address"   =>$address,
            	"channel"   => $channel,
            	"offerName" => $offerName,
            	"reseason"  =>$reseason
            )); 
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
            $result = curl_exec($ch);
                
            curl_getinfo($ch, CURLINFO_HTTP_CODE);
            $err = curl_error($ch);
            curl_close($ch);

            $jsonData = json_decode($result, 1); 

            return $jsonData;
            // {
			// 	"subscriptionId": 2230
			// }

  		   //  {
			// 	"code": "8001022",
			// 	"errorCode": "5201010",
			// 	"message": "Offer not found with name [Test Weekly]."
			// }
		}catch (Exception $e) {
			return $e->getMessage();
		}
	}
	public function chargeCustomer($amount, $channel, $address, $offerName, $description, $unit)
	{
		try 
		{
			$ch = curl_init("https://mysmsinbox.com/telnet_sdp/mt/v1/charge.php"); 
            curl_setopt($ch, CURLOPT_URL, 'https://mysmsinbox.com/telnet_sdp/mt/v1/charge.php'); 
            curl_setopt($ch, CURLOPT_POST, true);                                              
            // curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
            curl_setopt( $ch, CURLOPT_POSTFIELDS, array(
            	"amount"   => $amount,
            	"channel" => $channel,
            	"address"   => $address,
            	"offer" => $offerName,
            	"description" => $description,
            	"unit" => $unit
            )); 
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
            $result = curl_exec($ch);
                
            curl_getinfo($ch, CURLINFO_HTTP_CODE);
            $err = curl_error($ch);
            curl_close($ch);

            $jsonData = json_decode($result, 1); 

            return $jsonData;
   			
		}catch (Exception $e) {
			return $e->getMessage();
		}
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






	public function sendContent( $address, $shortCode, $message, $serviceName, $clientCorrelator)//$network, $action,
	{
		$senderName     = "Mobile Content";
		$requestId		= ""; 
		$deliveryStatus = "";

		try 
		{
			$rawData = array(
				'network'     => 'VODAFONE',//$network,
				'action'	  => 'sendContent',//$action,
                'address' 	  => $address,
                'shortCode'   => $shortCode,
                'message' 	  => $message,
                'serviceName' => $serviceName
            );

            $data = json_encode($rawData);


		 	$ch = curl_init("https://mysmsinbox.com/telnet_sdp/mt/v1/"); 
            // curl_setopt($ch, CURLOPT_URL, 'https://mysmsinbox.com/telnet_sdp/mt/v1/send-sms-notification-to-sdp.php'); 
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
            return $result;
            $jsonData = json_decode($result, 1);

            // $this->logContentData($address, $shortCode, $clientCorrelator, $senderName, $message, $serviceName);


            foreach($jsonData['outboundSMSMessageRequest']['deliveryInfoList']['deliveryInfo'] as $data) {
            	$requestId		= $data["requestId"]; 
				// // $address		= $data["address"];
				$deliveryStatus = $data["deliveryStatus"];
				$this->dataObj->logContentDeliveryResponse($address, $shortCode, $jsonData['outboundSMSMessageRequest']['clientCorrelator'], $senderName, $data['deliveryStatus'], $data['requestId'], $serviceName, $message);
				file_put_contents('logs/delivery/Rawsms.log', print_r($data, true));
				// return $data;
			}
			
			$responseData['address']   = $address;
			$responseData['offerName'] = $serviceName;
			$responseData['clientCorrelator'] = $clientCorrelator;
			$responseData['requestId'] = $requestId;
			$responseData['deliveryStatus'] = $deliveryStatus;
			$response['status'] = 'Success';
			$response['data']   = $responseData;			

			$resp = json_encode($response);
			file_put_contents('logs/delivery/Rawsms.log', print_r($resp, true));
			return $resp;

			// {
			//     "status": "Success",
			//     "data": {
			//         "address": "233206846412",
			//         "offerName": "Gospel Daily",
			//         "clientCorrelator": "232kb43jk43j54b5h",
			//         "requestId": "1778945243",
			//         "deliveryStatus": "DeliveredToNetwork"
			//     }
			// }


		} catch (Exception $e) {
			return $e->getMessage();
		}
	}





































































	public function _sendContentQQQQQQQQQQ($address, $shortCode, $message, $offerName, $clientCorrelator)
	{
		$requestId		= ""; 
		// $address		= "";
		$deliveryStatus = "";
		try 
		{
		 	$ch = curl_init("https://mysmsinbox.com/telnet_sdp/mt/v1/send-sms-notification-to-sdp.php"); 
            curl_setopt($ch, CURLOPT_URL, 'https://mysmsinbox.com/telnet_sdp/mt/v1/send-sms-notification-to-sdp.php'); 
            curl_setopt($ch, CURLOPT_POST, true);                                              
            // curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
            curl_setopt( $ch, CURLOPT_POSTFIELDS, array(
            	"address"   =>$address,
            	"shortCode" => $shortCode,
            	"message"   => $message,
            	"offerName" =>$offerName
            )); 
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
            $result = curl_exec($ch);
                
            curl_getinfo($ch, CURLINFO_HTTP_CODE);
            $err = curl_error($ch);
            curl_close($ch);
            // return $result;
            $jsonData = json_decode($result, 1);
            foreach($jsonData['outboundSMSMessageRequest']['deliveryInfoList']['deliveryInfo'] as $data) {
					// $deliveryStatus = $data['deliveryStatus'];
					// $requestId      = $data['requestId'];
            	$requestId		= $data["requestId"]; 
				// $address		= $data["address"];
				$deliveryStatus = $data["deliveryStatus"];
				$this->dataObj->logContentDeliveryResponse($address, $shortCode, $jsonData['outboundSMSMessageRequest']['clientCorrelator'], $senderName, $data['deliveryStatus'], $data['requestId'], $offerName);
				file_put_contents('logs/delivery/Rawsms.log', print_r($data, true));
				// return $data;
			}
			
			$responseData['address']   = $address;
			$responseData['offerName'] = $offerName;
			$responseData['clientCorrelator'] = $clientCorrelator;
			$responseData['requestId'] = $requestId;
			$responseData['deliveryStatus'] = $deliveryStatus;
			$response['status'] = 'Success';
			$response['data']   = $responseData;			

			$resp = json_encode($response);
			file_put_contents('logs/delivery/Rawsms.log', print_r($resp, true));
			return $resp;

			// {
			//     "status": "Success",
			//     "data": {
			//         "address": "233206846412",
			//         "offerName": "Gospel Daily",
			//         "clientCorrelator": "232kb43jk43j54b5h",
			//         "requestId": "1778945243",
			//         "deliveryStatus": "DeliveredToNetwork"
			//     }
			// }


		} catch (Exception $e) {
			return $e->getMessage();
		}
	}
}




