<?php 
/**------------------------------------------------------------------------------------------------------------------------------------------------
* @@Name:              state change notification handler

* @@Author:            Lordgreat -  Adri Emmanuel <'rexmerlo@gmail.com'>
* @@Tell:              +233543645688/+233273593525

* @Date:               2022-04-19 11:40:30
* @Last Modified by:   Lordgreat - Adri Emmanuel
* @Last Modified time: 2022-04-19 13:08:17

* @Copyright:          MobileContent.Com Ltd <'owner'>

* @Website:            https://mobilecontent.com.gh
*-------------------------------------------------------------------------------------------------------------------------------------------------
*/
    // include_once 'includes/autoloader.inc.php';
    include_once 'DBConnect.php';
/**
 * STATECHANGE
 */
class DataAuths //extends DbCon
{
	public $db_conn = NULL;
	
	public function __construct()
	{
		if ($this->db_conn == NULL) {
			$db = new DBConnect();
			$this->db_conn = $db->connection();
		}
	}



	// The new changes they broaght, saving sub record...........
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







    // check for duplicate entries 
	public function checkSubscriptionState($msisdn)
	{
		try 
		{
			$query =  $this->db_conn->prepare("SELECT * FROM `mt_subscribers`  WHERE `msisdn` = '$msisdn' ");//mt_subscribers
			$query->execute();

			// set the resulting array to associative
			$result = $query->setFetchMode(PDO::FETCH_ASSOC);
			return  $query->rowCount();
			// return $query->fetchAll();
			
		} catch (Exception $ex) {
			return $ex->getMessage();
		}
	}





    // save new sub record for MT services
	public function insertNewSubscription($msisdn, $state, $offerId, $offerName, $transactionId, $subscriptionId, $serviceNotificationType, $isRenewal, $serviceId, $serviceName, $failureReason, $channelType, $subscriptionCounter, $chargedAmount, $subscriptionStartDate, $subscriptionEndDate, $nextChargingDate, $lastRenewalDate, $chargingPeriod, $requestDate, $inTry, $inRenewal)
	{
		try 
		{
			$sql = "INSERT INTO mt_subscribers(msisdn, state, offerId, offerName , transactionId, subscriptionId, serviceNotificationType, isRenewal, serviceId, serviceName, failureReason, channelType, subscriptionCounter, chargedAmount, subscriptionStartDate, subscriptionEndDate, nextChargingDate, lastRenewalDate, chargingPeriod, requestDate, inTry, inRenewal) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
			$values = array($msisdn, $state, $offerId, $offerName , $transactionId, $subscriptionId, $serviceNotificationType, $isRenewal, $serviceId, $serviceName, $failureReason, $channelType, $subscriptionCounter, $chargedAmount, $subscriptionStartDate, $subscriptionEndDate, $nextChargingDate, $lastRenewalDate, $chargingPeriod, $requestDate, $inTry, $inRenewal);
			$query = $this->db_conn->prepare($sql);
			$query->execute($values);
			return $query->rowCount();			
		} catch (Exception $e) {
			
		}
	}






	//update subscription status...............
	public function updateStateChange($msisdn, $state, $offerId, $offerName, $transactionId, $serviceNotificationType, $serviceId, $serviceName, $failureReason, $subscriptionStartDate, $subscriptionEndDate, $nextChargingDate, $lastRenewalDate, $channelType, $inRenewal, $chargingPeriod, $subscriptionCounter, $requestDate, $chargedAmount, $inTry, $trailToPaid)
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
}



// CREATE TABLE `telnet_sdp`.`mt_subscribers` (
//   `id` INT NOT NULL AUTO_INCREMENT,
//   `msisdn` VARCHAR(45) NULL,
//   `state` VARCHAR(45) NULL,
//   `offerId` VARCHAR(100) NULL,
//   `offerName` VARCHAR(100) NULL,
//   `transactionId` VARCHAR(255) NULL,
//   `subscriptionId` VARCHAR(100) NULL,
//   `serviceNotificationType` VARCHAR(100) NULL,
//   `isRenewal` VARCHAR(45) NULL,
//   `serviceId` VARCHAR(50) NULL,
//   `serviceName` VARCHAR(100) NULL,
//   `failureReason` TEXT NULL,
//   `channelType` VARCHAR(45) NULL,
//   `subscriptionCounter` VARCHAR(45) NULL,
//   `chargedAmount` VARCHAR(45) NULL,
//   `subscriptionStartDate` DATETIME NULL,
//   `subscriptionEndDate` DATETIME NULL,
//   `nextChargingDate` DATETIME NULL,
//   `lastRenewalDate` DATETIME NULL,
//   `chargingPeriod` VARCHAR(100) NULL,
//   `requestDate` DATETIME NULL,
//   `inTry` VARCHAR(45) NULL,
//   `trailToPaid` VARCHAR(45) NULL,
//   `created_at` TIMESTAMP NULL DEFAULT current_timestamp,
//   `update_at` TIMESTAMP NULL on update current_timestamp,
//   PRIMARY KEY (`id`));


