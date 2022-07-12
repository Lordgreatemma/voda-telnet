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




		//get all billed details
		public function getBilledDetails($requestId)
		{
			try 
			{
				$today_date = date("Y-m-d");
				
				$query = $this->db_conn->prepare("SELECT offerName, shortCode, clientCorrelator FROM `telnet_sdp`.`mt_charge` WHERE (requestId = '$requestId' AND transactionId != '') AND DATE(created_at) = '$today_date' ORDER BY id ASC");//year(created_at) = year(now()) AND month(created_at) = month(now()) AND day(created_at) = day(now())
				$query->execute();//$values
			    $query->setFetchMode(PDO::FETCH_ASSOC);

			    // $this->db_conn = null;
			    
			    return $query->fetchAll();
			}catch (Exception $e){
				return $e->getMessage();
			}
		}
	}