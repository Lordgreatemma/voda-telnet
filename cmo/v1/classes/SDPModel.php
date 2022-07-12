<?php 
	include_once 'includes/autoloader.inc.php';
/**
 * 
 */
class SDPModel extends SPDConn
{
	
	public $db_conn = NULL;
	public function __construct()
	{
		if ($this->db_conn == NULL) {
			$db = new SPDConn();
			$this->db_conn = $db->connection();
		}
	}


	public function getScheduledContents($offerName, $transmission_date)
	{
		try 
		{
			$sql = "SELECT * FROM contents WHERE offerName=:offerName AND transmission_date=:transmission_date ORDER BY id ASC LIMIT 0,1";
			$values = array('offerName'=>$offerName, 'transmission_date'=> $transmission_date);
			$query = $this->db_conn->prepare($sql);
			$query->execute($values);
		    $query->setFetchMode(PDO::FETCH_ASSOC);
		    return $query->fetchAll();
		} catch (Exception $e) {
			return $e->getMessage();
		}
	}



	public function saveContentsDeliveryReport($address, $shortCode, $offerName, $senderName, $deliveryStatus, $requestId, $clientCorrelator, $message)
	{
		try 
		{
			$stmnt = "INSERT INTO content_delivery_report(address, shortCode, offerName, senderName, deliveryStatus, requestId, clientCorrelator, message) VALUES(?, ?, ?, ?, ?, ?, ?, ?)";
				$values = array($address, $shortCode, $offerName, $senderName, $deliveryStatus, $requestId, $clientCorrelator, $message);
				$query = $this->db_conn->prepare($stmnt);
				$query->execute($values);
			    return $query->rowCount();
		} catch (Exception $e) {
			return $e->getMessage();
		}
	}



	//get all other sub
	public function getSubscribers($offerName, $offerId)
	{
		try 
		{
			$sql = "SELECT * FROM mo_subscribers WHERE offerName=:offerName AND offerId=:offerId AND state=:state ORDER BY id ASC ";
			$values = array('offerName'=>$offerName, 'offerId'=> $offerId , 'state'=> 'ACTIVE');
			$query = $this->db_conn->prepare($sql);
			$query->execute($values);
		    $query->setFetchMode(PDO::FETCH_ASSOC);
		    return $query->fetchAll();
		}catch (Exception $e){
			return $e->getMessage();
		}
	}



	public function scheduleNewSampelContents($offerName, $shortCode, $message, $transmission_date)
	{
		try 
		{
			$stmnt = "INSERT INTO contents(offerName, shortCode, message, transmission_date)VALUES(?, ?, ?, ?)";
			$values = array($offerName, $shortCode, $message, $transmission_date);
			$query = $this->db_conn->prepare($stmnt);
			$query->execute($values);
		    return $query->rowCount();
		} catch (Exception $e) {
			return $e->getMessage();
		}
	}
}