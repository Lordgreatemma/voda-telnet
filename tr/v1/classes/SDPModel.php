<?php 
	include_once 'includes/autoloader.inc.php';
/**
 * MT
 */
class SDPModel //extends SPDConn
{
	
	public $db_conn = NULL;
	public function __construct()
	{
		if ($this->db_conn == NULL) {
			$db = new SPDConn();
			$this->db_conn = $db->connection();
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

				// $this->db_conn = null;
				
			    return $query->rowCount();
		} catch (Exception $e) {
			return $e->getMessage();
		}
	}








	// logging the callback response..........completed_tansactions
		public function logContentDeliveryResponse($msisdn, $shortCode, $clientCorrelator, $senderName, $deliveryStatus, $requestId, $offerName)
		{
			try 
			{
				$stmnt = "INSERT INTO `content_delivery_report`(address, shortCode, clientCorrelator, senderName, deliveryStatus, requestId, serviceName) VALUES(?, ?, ?, ?, ?, ?, ?)";
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


		
}