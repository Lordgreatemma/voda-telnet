<?php 
    include_once 'includes/autoloader.inc.php';
/**
 * 
 */
class SDPController extends SDPModel
{
	
	public function __construct()
	{
		
	}


	public function sendContent($address, $shortCode, $message, $offerName, $clientCorrelator)
	{
		$requestId		= ""; 
		// $address		= "";
		$deliveryStatus = "";
		try 
		{
		 	$ch = curl_init("https://mysmsinbox.com/telnet_sdp/mo/v1/mo-send-content.php"); 
            // curl_setopt($ch, CURLOPT_URL, 'https://mysmsinbox.com/telnet_sdp/mo/v1/mo-send-content.php'); 
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
					// $this->dataObj->logContentDeliveryResponse($address, $shortCode, $clientCorrelator, $senderName, $data['deliveryStatus'], $data['requestId'], $offerName);
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

	public function subscribeCustomer()
	{
		echo "Hello";
	}

	public function unsubscribeCustomer($address, $channel, $offerName, $reseason)
	{
		try 
		{
			$ch = curl_init("https://mysmsinbox.com/telnet_sdp/mo/v1/mo-delete-account.php"); 
            // curl_setopt($ch, CURLOPT_URL, 'https://mysmsinbox.com/telnet_sdp/mo/v1/mo-delete-account.php'); 
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
			$ch = curl_init("https://mysmsinbox.com/telnet_sdp/mo/v1/mo-charge-request.php"); 
            // curl_setopt($ch, CURLOPT_URL, 'https://mysmsinbox.com/telnet_sdp/mt/v1/charge.php'); 
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
}