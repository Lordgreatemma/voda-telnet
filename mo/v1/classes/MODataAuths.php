
<?php 
/**------------------------------------------------------------------------------------------------------------------------------------------------
* @@Name:              send sms

* @@Author:            Lordgreat -  Adri Emmanuel <'rexmerlo@gmail.com'>
* @@Tell:              +233543645688/+233273593525

* @Date:               2022-04-02 11:40:30
* @Last Modified by:   Lordgreat - Adri Emmanuel
* @Last Modified time: 2022-04-02 12:08:17

* @Copyright:          MobileContent.Com Ltd <'owner'>

* @Website:            https://mobilecontent.com.gh
*-------------------------------------------------------------------------------------------------------------------------------------------------
*/

    include_once 'includes/autoloader.inc.php';


    include_once 'DbConfig.php';
    /**
     * 
     */
    class MODataAuths //extends DbConfig
    {
    	public $db_conn = null;

    	public function __construct()
    	{
            if($this->db_conn == null){
                $db = new DbConfig();
                $this->db_conn = $db->connection();               
            }    		
    	}



    	public function saveChargeCustomerResponse($amount, $msisdn, $shortCode, $channel, $clientChargeTransactionId, $clientRequestId, $transactionId,  $offerName, $description, $unit, $errorCode, $errorMsg, $rootErrorCode )
    	{
    		try 
    		{
    			$stmnt = "INSERT INTO `mo_charge`(amount, msisdn, shortCode, channel, clientChargeTransactionId, clientRequestId, transactionId, offerName, description, unit, errorCode, errorMsg, rootErrorCode) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
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



        // logging the callback response..........completed_tansactions
        public function logContentDeliveryResponse($msisdn, $shortCode, $clientCorrelator, $senderName, $deliveryStatus, $requestId, $offerName)
        {
            try 
            {
                $stmnt = "INSERT INTO `mo_delivery_response`(msisdn, shortCode, clientCorrelator, senderName, deliveryStatus, requestId, offerName) VALUES(?, ?, ?, ?, ?, ?, ?)";
                $values = array($msisdn, $shortCode, $clientCorrelator, $senderName, $deliveryStatus, $requestId, $offerName);
                $query = $this->db_conn->prepare($stmnt);
                $query->execute($values);

                $this->db_conn = null;

                return $query->rowCount();
            } catch (Exception $exc) 
            {
                echo $exc->getMessage();
            }
        }


        public function logContentData($msisdn, $shortCode, $clientCorrelator, $senderName, $message, $offerName)
        {
            try {
                $sql = 'INSERT INTO `mo_contents` (msisdn, shortCode, clientCorrelator, senderName, message, offerName) VALUES(?, ?, ?, ?, ?, ?)';
                $values = array($msisdn, $shortCode, $clientCorrelator, $senderName, $message, $offerName);
                $query = $this->db_conn->prepare($sql);
                $query->execute($values);

                $this->db_conn = null;

                return $query->rowCount();
            } catch (Exception $exc) {
                echo $exc->getMessage();    
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
    }

        // {
        //      "merchantId": "XYZ",
        //      "carrierId": "VDF_Ghana",
        //      "shortCode": "625001",
        //      "accountInfo": {
        //      "accountIdType": "MSISDN",
        //      "accountId": "233546512000"
        //      },
        //      "smsText": "DCB: TEXT",
        //      "carrierTransactionId": "7001474976385954321"
        // }