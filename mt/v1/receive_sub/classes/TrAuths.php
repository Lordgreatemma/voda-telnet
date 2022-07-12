<?php 
include_once 'includes/autoloader.inc.php';
	/**
	 * TrCon
	 */
	include_once 'DBConnect.php';
	class TrAuths //extends TrCon
	{
		public $db_conn = NULL;
		public function __construct()
		{
			if ($this->db_conn == NULL) {
				$db = new TrCon();
				$this->db_conn = $db->connection();
			}
		}







		public function saveTrSubscription($msisdn, $state, $offerId, $offerName, $transactionId, $subscriptionId, $serviceNotificationType, $isRenewal, $serviceId, $serviceName, $failureReason, $channelType, $subscriptionCounter, $chargedAmount, $subscriptionStartDate, $subscriptionEndDate, $nextChargingDate, $lastRenewalDate, $chargingPeriod, $requestDate, $inTry, $inRenewal)
		{
			try 
			{
				$sql = "INSERT INTO mt_subscribers(msisdn, state, offerId, offerName , transactionId, subscriptionId, serviceNotificationType, isRenewal, serviceId, serviceName, failureReason, channelType, subscriptionCounter, chargedAmount, subscriptionStartDate, subscriptionEndDate, nextChargingDate, lastRenewalDate, chargingPeriod, requestDate, inTry, inRenewal) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
				$values = array($msisdn, $state, $offerId, $offerName , $transactionId, $subscriptionId, $serviceNotificationType, $isRenewal, $serviceId, $serviceName, $failureReason, $channelType, $subscriptionCounter, $chargedAmount, $subscriptionStartDate, $subscriptionEndDate, $nextChargingDate, $lastRenewalDate, $chargingPeriod, $requestDate, $inTry, $inRenewal);
				$query = $this->db_conn->prepare($sql);
				$query->execute($values);
				return $query->rowCount();			
			} catch (Exception $e) {
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
                return $query->rowCount();
            } catch (Exception $e) {
                echo $exc->getMessage();    
            }
        }


		//update subscription status...............
		public function updateTrStateChange($msisdn, $state, $offerId, $offerName, $transactionId, $serviceNotificationType, $serviceId, $serviceName, $failureReason, $subscriptionStartDate, $subscriptionEndDate, $nextChargingDate, $lastRenewalDate, $channelType, $inRenewal, $chargingPeriod, $subscriptionCounter, $requestDate, $chargedAmount, $inTry, $trailToPaid)
		{
			try 
			{
				$stmnt = "UPDATE mt_subscribers SET state=:state, offerId=:offerId, offerName=:offerName, transactionId=:transactionId, serviceNotificationType=:serviceNotificationType, serviceId=:serviceId, serviceName=:serviceName, failureReason=:failureReason, subscriptionStartDate=:subscriptionStartDate, subscriptionEndDate=:subscriptionEndDate, nextChargingDate=:nextChargingDate, lastRenewalDate=:lastRenewalDate, channelType=:channelType, inRenewal=:inRenewal, chargingPeriod=:chargingPeriod, subscriptionCounter=:subscriptionCounter, requestDate=:requestDate, chargedAmount=:chargedAmount, inTry=:inTry, trailToPaid=:trailToPaid WHERE msisdn=:msisdn";
				$query = $this->db_conn->prepare($stmnt);
				$value = array('state'=>$state, 'offerId'=>$offerId, 'offerName'=>$offerName, 'transactionId'=>$transactionId, 'serviceNotificationType'=>$serviceNotificationType, 'serviceId'=>$serviceId, 'serviceName'=>$serviceName, 'failureReason'=>$failureReason, 'subscriptionStartDate'=>$subscriptionStartDate, 'subscriptionEndDate'=>$subscriptionEndDate, 'nextChargingDate'=>$nextChargingDate, 'lastRenewalDate'=>$lastRenewalDate, 'channelType'=>$channelType, 'inRenewal'=>$inRenewal, 'chargingPeriod'=>$chargingPeriod, 'subscriptionCounter'=>$subscriptionCounter, 'requestDate'=>$requestDate, 'chargedAmount'=>$chargedAmount, 'inTry'=>$inTry, 'trailToPaid'=>$trailToPaid, 'msisdn'=>$msisdn);
				
				$query->execute($value);

				//count number of row affected
				$count_row = $query->rowCount();
				return $count_row;
			} catch (Exception $e) 
			{
				echo __LINE__ . $e->getMessage();
			}
		}
	

		public function scheduleNewSampelContents($offerName, $shortCode, $message, $transmission_date)
		{
			try 
			{
				$stmnt = "INSERT INTO contents(offerName, shortCode, message, transmission_date) VALUES(?, ?, ?, ?)";
					$values = array($offerName, $shortCode, $message, $transmission_date);
					$query = $this->db_conn->prepare($stmnt);
					$query->execute($values);
				    return $query->rowCount();
			} catch (Exception $e) {
				return $e->getMessage();
			}
		}



		

	}
?>