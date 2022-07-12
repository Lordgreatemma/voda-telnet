<?php 
/**------------------------------------------------------------------------------------------------------------------------------------------------
* @@Name:              DataAuths

* @@Author:            Lordgreat -  Adri Emmanuel <'rexmerlo@gmail.com'>
* @@Tell:              +233543645688/+233273593525

* @Date:               2022-04-02 13:40:30
* @Last Modified by:   Lordgreat - Adri Emmanuel
* @Last Modified time: 2022-04-12 08:48:17

* @Copyright:          MobileContent.Com Ltd <'owner'>

* @Website:            https://mobilecontent.com.gh
*-------------------------------------------------------------------------------------------------------------------------------------------------
*/
	include_once 'includes/autoloader.inc.php';

	/**
	 * 
	 */
	class DataAuths  extends DbConfig
	{
		
		// // logging the request..........
		public function saveGeneratedTokens($accessToken, $tokenType, $expiresIn, $expiresTime)
		{
			try 
			{
				$stmnt = "INSERT INTO oauth_client(access_token, token_type, expires_in, expires_time) VALUES(?, ?, ?, ?)";
				$values = array($accessToken, $tokenType, $expiresIn, $expiresTime);
				$query = $this->db_conn->prepare($stmnt);
				$query->execute($values);

				// $this->db_conn = null;

			    return $query->rowCount();
			} catch (Exception $exc) 
			{
				echo $exc->getMessage();
			}
		}



		public function checkTokenExpiration($accessToken)
		{
			try 
			{
				$query =  $this->db_conn->query("SELECT * FROM oauth_client WHERE access_token = '$accessToken' LIMIT 0,1");
				$query->execute();

				// set the resulting array to associative
				$result = $query->setFetchMode(PDO::FETCH_ASSOC);
				// return  $query->rowCount();

				// $this->db_conn = null;

				return $query->fetchAll();
				
			} catch (Exception $ex) {
				return $ex->getMessage();
			}
		}


		public function deleteExpiredToken($accessToken)
		{
			try 
			{
				$query = $this->db_conn->prepare("DELETE FROM oauth_client WHERE access_token=:access_token");
				$value = array('access_token'=>$accessToken);
				
				$query->execute($value);

				// $this->db_conn = null;

				//count number of row affected
				return $query->rowCount();
			} catch (Exception $e) 
			{
				echo __LINE__ . $e->getMessage();
			}
		}

		// logging the callback response..........completed_tansactions
		public function logContentDeliveryResponse($msisdn, $shortCode, $clientCorrelator, $senderName, $deliveryStatus, $requestId, $offerName)
		{
			try 
			{
				$stmnt = "INSERT INTO `mt_delivery_response`(msisdn, shortCode, clientCorrelator, senderName, deliveryStatus, requestId, serviceName) VALUES(?, ?, ?, ?, ?, ?, ?)";
				$values = array($msisdn, $shortCode, $clientCorrelator, $senderName, $deliveryStatus, $requestId, $offerName);
				$query = $this->db_conn->prepare($stmnt);
				$query->execute($values);

				// $this->db_conn = null;

			    return $query->rowCount();
			} catch (Exception $exc) 
			{
				echo $exc->getMessage();
			}
		}


		public function logContentData($msisdn, $shortCode, $clientCorrelator, $senderName, $message, $offerName)
		{
			try {
				$sql = 'INSERT INTO `contents` (msisdn, shortCode, clientCorrelator, senderName, message, serviceName) VALUES(?, ?, ?, ?, ?, ?)';
		        $values = array($msisdn, $shortCode, $clientCorrelator, $senderName, $message, $offerName);
				$query = $this->db_conn->prepare($sql);
				$query->execute($values);

				// $this->db_conn = null;

			    return $query->rowCount();
			} catch (Exception $exc) {
				echo $exc->getMessage();	
			}
		}












    	public function saveChargeCustomerResponse($amount, $msisdn, $shortCode, $channel, $clientChargeTransactionId, $clientRequestId, $transactionId,  $offerName, $description, $unit, $errorCode, $errorMsg, $rootErrorCode )
    	{
    		try 
    		{
    			$stmnt = "INSERT INTO `mt_charge`(amount, msisdn, shortCode, channel, clientChargeTransactionId, clientRequestId, transactionId, offerName, description, unit, errorCode, errorMsg, rootErrorCode) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
                $values = array($amount, $msisdn, $shortCode, $channel, $clientChargeTransactionId, $clientRequestId, $transactionId,  $offerName, $description, $unit, $errorCode, $errorMsg, $rootErrorCode);
                $query = $this->db_conn->prepare($stmnt);
                $query->execute($values);

                $this->db_conn = null;

                return $query->rowCount();
    		} 
    		catch (Exception $e)
    		{
    			return $e->getMessage();
    		}
    	}



    	public function saveMOSubscription($merchantId, $carrierId, $shortCode, $accountIdType, $accountId, $smsText, $carrierTransactionId)
        {
            try 
            {
                $sql = 'INSERT INTO `dcb_users`(merchantId, carrierId, shortCode, accountIdType, accountId, smsText, carrierTransactionId) VALUES(?, ?, ?, ?, ?, ?, ?)';
                $values = array($merchantId, $carrierId, $shortCode, $accountIdType, $accountId, $smsText, $carrierTransactionId);
                $query = $this->db_conn->prepare($sql);
                $query->execute($values);

                $this->db_conn = null;
                
                return $query->rowCount();
            } catch (Exception $e) {
                echo $exc->getMessage();    
            }
        }





		// format the user msisdn to the required format...........
	    public function _formart_number($raw_number)
	    {
	        $myNew_value = null;
	        $user_number = '';
	        if(strlen($raw_number) == 10)
            {   
                //convert your string into array
                $array_num = str_split($raw_number);

                for($i = 1; $i <count($array_num) ; $i++)
                {        
                    $myNew_value .= $array_num[$i];
                }
                 
                $user_number = '233'. $myNew_value;
            }else
            {
                $user_number = $raw_number; 
            }

	        return $user_number;
	    }













	    //get all billed sub
		public function getBilledSubscribers($offerName)
		{
			try 
			{
				$today_date = date("Y-m-d");
				
				$query = $this->db_conn->prepare("SELECT DISTINCT(msisdn) AS msisdn, offerName, id FROM `telnet_sdp`.`mt_charge` WHERE (offerName = '$offerName' AND transactionId != '') AND DATE(created_at) = '$today_date' ORDER BY id ASC");//year(created_at) = year(now()) AND month(created_at) = month(now()) AND day(created_at) = day(now())
				$query->execute();//$values
			    $query->setFetchMode(PDO::FETCH_ASSOC);

			    // $this->db_conn = null;
			    
			    return $query->fetchAll();
			}catch (Exception $e){
				return $e->getMessage();
			}
		}
	}