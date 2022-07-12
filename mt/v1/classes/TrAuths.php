<?php 
include_once 'includes/autoloader.inc.php';
	/**
	 * TrCon
	 */
	class TrAuths 
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
				$stmnt = "INSERT INTO mt_subscribers(msisdn, state, offerId, offerName, transactionId, serviceNotificationType, isRenewal, serviceId, serviceName, failureReason, channelType, subscriptionCounter, chargedAmount, subscriptionStartDate, subscriptionEndDate, nextChargingDate, lastRenewalDate, chargingPeriod, requestDate, inTry, inRenewal) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
					$values = array($msisdn, $state, $offerId, $offerName, $transactionId, $subscriptionId, $serviceNotificationType, $isRenewal, $serviceId, $serviceName, $failureReason, $channelType, $subscriptionCounter, $chargedAmount, $subscriptionStartDate, $subscriptionEndDate, $nextChargingDate, $lastRenewalDate, $chargingPeriod, $requestDate, $inTry, $inRenewal);
					$query = $this->db_conn->prepare($stmnt);
					$query->execute($values);

					// $this->db_conn = null;

				    return $query->rowCount();
			} catch (Exception $e) {
				return $ex->getMessage();
			}
		}







		//update subscription status...............
		public function updateTrStateChange($msisdn, $state, $offerId, $offerName, $transactionId, $serviceNotificationType, $serviceId, $serviceName, $failureReason, $subscriptionStartDate, $subscriptionEndDate, $nextChargingDate, $lastRenewalDate, $channelType, $inRenewal, $chargingPeriod, $subscriptionCounter, $requestDate, $chargedAmount, $inTry)
		{
			try 
			{
				$stmnt = "UPDATE mt_subscribers SET state=:state, offerId=:offerId, offerName=:offerName, transactionId=:transactionId, serviceNotificationType=:serviceNotificationType, serviceId=:serviceId, serviceName=:serviceName, failureReason=:failureReason, subscriptionStartDate=:subscriptionStartDate, subscriptionEndDate=:subscriptionEndDate, nextChargingDate=:nextChargingDate, lastRenewalDate=:lastRenewalDate, channelType=:channelType, inRenewal=:inRenewal, chargingPeriod=:chargingPeriod, subscriptionCounter=:subscriptionCounter, requestDate=:requestDate, chargedAmount=:chargedAmount, inTry=:inTry WHERE msisdn=:msisdn";
				$query = $this->db_conn->prepare($stmnt);
				$value = array('state'=>$state, 'offerId'=>$offerId, 'offerName'=>$offerName, 'transactionId'=>$transactionId, 'serviceNotificationType'=>$serviceNotificationType, 'serviceId'=>$serviceId, 'serviceName'=>$serviceName, 'failureReason'=>$failureReason, 'subscriptionStartDate'=>$subscriptionStartDate, 'subscriptionEndDate'=>$subscriptionEndDate, 'nextChargingDate'=>$nextChargingDate, 'lastRenewalDate'=>$lastRenewalDate, 'channelType'=>$channelType, 'inRenewal'=>$inRenewal, 'chargingPeriod'=>$chargingPeriod, 'subscriptionCounter'=>$subscriptionCounter, 'requestDate'=>$requestDate, 'chargedAmount'=>$chargedAmount, 'inTry'=>$inTry, 'msisdn'=>$msisdn);
				
				$query->execute($value);

				//count number of row affected
				$count_row = $query->rowCount();

				// $this->db_conn = null;
				
				return $count_row;
			} catch (Exception $e) 
			{
				echo __LINE__ . $e->getMessage();
			}
		}
	





		//get the scheduled contents due for transmission
		public function getScheduledContents($serviceName, $transmission_date)
		{
			try 
			{
				$sql = "SELECT * FROM contents WHERE serviceName = '$serviceName' AND transmission_date = '$transmission_date' ORDER BY id ASC LIMIT 0,1";
				$query = $this->db_conn->prepare($sql);
				$query->execute();
			    $query->setFetchMode(PDO::FETCH_ASSOC);

			    // $this->db_conn = null;

			    return $query->fetchAll();
			} catch (Exception $e) {
				return $e->getMessage();
			}
		}

	}
?>