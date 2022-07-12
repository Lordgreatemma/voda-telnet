<?php 
	include_once 'includes/autoloader.inc.php';
/**
 * MT PRO
 */
class SDPProductionModel extends SPDConn
{
	
	// public $db_conn = NULL;
	// public function __construct()
	// {
	// 	if ($this->db_conn == NULL) {
	// 		$db = new SDPConnPro();
	// 		$this->db_conn = $db->connection();
	// 	}
	// }


	//schedule contents for services........
	public function scheduleNewSampelContents($offerName, $shortCode, $message, $transmission_date)
	{
		try 
		{
			// $messages = strtoupper($offerName).":\n".$message;
			$stmnt = "INSERT INTO contents_scheduled(serviceName, shortCode, message, transmission_date) VALUES(?, ?, ?, ?)";
				$values = array($offerName, $shortCode, $message, $transmission_date);
				$query = $this->db_conn->prepare($stmnt);
				$query->execute($values);

				// $this->db_conn = null;

			    return $query->rowCount();
		} catch (Exception $e) {
			return $e->getMessage();
		}
	}


	//get the scheduled contents due for transmission
	public function getScheduledContents($serviceName, $transmission_date)
	{
		try 
		{
			// $sql = "SELECT * FROM contents WHERE serviceName=:serviceName  AND transmission_date=:transmission_date ORDER BY id ASC LIMIT 0,1";
			// $values = array('serviceName'=>$serviceName, 'transmission_date'=> $transmission_date);
			// $query = $this->db_conn->prepare($sql);
			// $query->execute($values);
			$query = $this->db_conn->prepare("SELECT message, shortCode, serviceName FROM contents_scheduled WHERE serviceName = '$serviceName'  AND transmission_date = '$transmission_date' ORDER BY id ASC LIMIT 0,1");
			$query->execute();
		    $query->setFetchMode(PDO::FETCH_ASSOC);

		    // $this->db_conn = null;

		    return $query->fetchAll();
		} catch (Exception $e) {
			return $e->getMessage();
		}
	}






	//get only gospel sub BATCH 1
	public function getGospelSubscribers($serviceName, $offerId)
	{
		try 
		{
			$query = $this->db_conn->prepare("SELECT msisdn FROM `telnet_sdp`.`mt_subscribers` WHERE serviceName = '$serviceName' AND state = 'Active' ORDER BY id ASC");// LIMIT 0,10000, serviceName, shortCode, serviceId, offerName, state, chargedAmount  LIMIT 0,10000
			$query->execute();//$values
		    $query->setFetchMode(PDO::FETCH_ASSOC);

		    // $this->db_conn = null;

		    return $query->fetchAll();
		}catch (Exception $e){
			return $e->getMessage();
		}
	}

	//get only gospel sub
	public function getGospelSubscribersBatch_2($serviceName, $offerId)
	{
		try 
		{
			$query = $this->db_conn->prepare("SELECT msisdn FROM `telnet_sdp`.`mt_subscribers` WHERE serviceName = '$serviceName' AND state = 'Active' ORDER BY id ASC LIMIT 10000,15000");//, serviceName, shortCode, serviceId, offerName, state, chargedAmount 
			$query->execute();//$values
		    $query->setFetchMode(PDO::FETCH_ASSOC);

		    // $this->db_conn = null;

		    return $query->fetchAll();
		}catch (Exception $e){
			return $e->getMessage();
		}
	}


	//get only wisdom sub
	public function getWisdomSubscribers($serviceName, $offerId)
	{
		try 
		{
			$query = $this->db_conn->prepare("SELECT msisdn FROM `telnet_sdp`.`mt_subscribers` WHERE serviceName = '$serviceName' AND state = 'Active' ORDER BY id ASC");//25830,25830 LIMIT 0,15830, serviceName, shortCode, serviceId, offerName, state, chargedAmount
			$query->execute();//$values 47488/48777>12194.25{12200x4=48800} LIMIT 0,12200
		    $query->setFetchMode(PDO::FETCH_ASSOC);

		    // $this->db_conn = null;
		    while ($rows = $query->fetch()) {
		    	yield($rows);
		    }
		    // return $query->fetchAll();
		}catch (Exception $e){
			return $e->getMessage();
		}
	}


	//get only wisdom sub BATCH 2
	public function getWisdomSubscribersBatch_2($serviceName, $offerId)
	{
		try 
		{
			$query = $this->db_conn->prepare("SELECT msisdn FROM `telnet_sdp`.`mt_subscribers` WHERE serviceName = '$serviceName' AND state = 'Active' ORDER BY id ASC LIMIT 12200,12200");//, serviceName, shortCode, serviceId, offerName, state, chargedAmount
			$query->execute();//$values
		    $query->setFetchMode(PDO::FETCH_ASSOC);

		    // $this->db_conn = null;
		    while ($rows = $query->fetch()) {
		    	yield($rows);
		    }
		    // return $query->fetchAll();
		}catch (Exception $e){
			return $e->getMessage();
		}
	}


	//get only wisdom sub BATCH 3
	public function getWisdomSubscribersBatch_3($serviceName, $offerId)
	{
		try 
		{
			$query = $this->db_conn->prepare("SELECT msisdn FROM `telnet_sdp`.`mt_subscribers` WHERE serviceName = '$serviceName' AND state = 'Active' ORDER BY id ASC LIMIT 24400,12200");//, serviceName, shortCode, serviceId, offerName, state, chargedAmount
			$query->execute();//$values
		    $query->setFetchMode(PDO::FETCH_ASSOC);

		    // $this->db_conn = null;
		    while ($rows = $query->fetch()) {
		    	yield($rows);
		    }
		    // return $query->fetchAll();
		}catch (Exception $e){
			return $e->getMessage();
		}
	}

	//get only wisdom sub BATCH 3
	public function getWisdomSubscribersBatch_4($serviceName, $offerId)
	{
		try 
		{
			$query = $this->db_conn->prepare("SELECT msisdn FROM `telnet_sdp`.`mt_subscribers` WHERE serviceName = '$serviceName' AND state = 'Active' ORDER BY id ASC LIMIT 36600,12200");//, serviceName, shortCode, serviceId, offerName, state, chargedAmount
			$query->execute();//$values
		    $query->setFetchMode(PDO::FETCH_ASSOC);

		    // $this->db_conn = null;
		    while ($rows = $query->fetch()) {
		    	yield($rows);
		    }
		    // return $query->fetchAll();
		}catch (Exception $e){
			return $e->getMessage();
		}
	}


	//get all other sub
	public function getSubscribers($offerName, $offerId)
	{
		try 
		{
			$query = $this->db_conn->prepare("SELECT msisdn FROM `telnet_sdp`.`mt_subscribers` WHERE serviceName = '$offerName' AND state = 'Active' ORDER BY id ASC ");//, serviceName, shortCode, serviceId, offerName, state, chargedAmount
			$query->execute();//$values
		    $query->setFetchMode(PDO::FETCH_ASSOC);

		    // $this->db_conn = null;
		    
		    return $query->fetchAll();
		}catch (Exception $e){
			return $e->getMessage();
		}
	}



	public function getTest($offerName)
	{
		try 
		{
			$query = $this->db_conn->prepare("SELECT msisdn FROM `telnet_sdp`.`mt_subscribers` WHERE serviceName = '$offerName' AND state = 'Active' ORDER BY id DESC ");//LIMIT 13
			$query->execute();//$values
		    $query->setFetchMode(PDO::FETCH_ASSOC);

		    // $this->db_conn = null;
		    while ($rows = $query->fetch()) {
		    	yield($rows);
		    }
		    // return $query->fetchAll();
		}catch (Exception $e){
			return $e->getMessage();
		}
	}





	// logging the callback response..........completed_tansactions
		public function logContentDeliveryResponse($msisdn, $shortCode, $clientCorrelator, $senderName, $deliveryStatus, $requestId, $offerName, $message)
		{
			try 
			{
				$stmnt = "INSERT INTO `content_delivery_report`(address, shortCode, clientCorrelator, senderName, deliveryStatus, requestId, serviceName, message) VALUES(?, ?, ?, ?, ?, ?, ?, ?)";
				$values = array($msisdn, $shortCode, $clientCorrelator, $senderName, $deliveryStatus, $requestId, $offerName, $message);
				$query = $this->db_conn->prepare($stmnt);
				$query->execute($values);

				// $this->db_conn = null;

			    return $query->rowCount();
			} catch (Exception $exc) 
			{
				echo $exc->getMessage();
			}
		}


		// Save transmitted contents
		public function logContentData($msisdn, $shortCode, $clientCorrelator, $senderName, $message, $offerName)
		{
			try {
				$sql = 'INSERT INTO `contents_sentout` (msisdn, shortCode, clientCorrelator, senderName, message, serviceName) VALUES(?, ?, ?, ?, ?, ?)';
		        $values = array($msisdn, $shortCode, $clientCorrelator, $senderName, $message, $offerName);
				$query = $this->db_conn->prepare($sql);
				$query->execute($values);

				// $this->db_conn = null;

			    return $query->rowCount();
			} catch (Exception $exc) {
				echo $exc->getMessage();	
			}
		}


}