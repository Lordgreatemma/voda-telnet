<?php 
/**------------------------------------------------------------------------------------------------------------------------------------------------
* @@Name:              SDPConnPro

* @@Author:            Lordgreat -  Adri Emmanuel <'rexmerlo@gmail.com'>
* @@Tell:              +233543645688/+233273593525

* @Date:               2022-04-02 11:40:30
* @Last Modified by:   Lordgreat - Adri Emmanuel
* @Last Modified time: 2022-04-02 12:08:17

* @Copyright:          MobileContent.Com Ltd <'owner'>

* @Website:            https://mobilecontent.com.gh 
*-------------------------------------------------------------------------------------------------------------------------------------------------
*/

	class SDPConnPro
	{
		private $db_host = '192.168.193.254';
		private $db_name = 'telnet_sdp_pro';
		private $db_username = 'adri';
		private $pass_word = 'adRi@1234&5$HaW9(1&Mcc';//FAg8(3P^tJVnBDsF%F Mccg8(3P^tJVnBDsF
		private $charset   = 'utf8mb4';

		//access to server/database connection 2018-04-09 16:02:44
		public $db_conn;
		

		// public function  __construct()
		// {
			
		// 	//test connection is null
		// 	if($this->db_conn == null)
		// 	{

		// 		try 
		// 		{
		// 			$serverName = "192.168.193.254";
		// 		    $databaseName = "telnet_sdp_pro"; #"gmb";
		// 		    $databaseUser = "adri";
		// 		    $databasePassword = 'adRi@1234&5$HaW9(1&Mcc';

		// 		    // $connect = new PDO('mysql:host='.$serverName. ';dbname=' .$databaseName, $databaseUser, $databasePassword); 
  //   				// $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);	

		// 			$server_path = "mysql:host=".$this->getHostName().";dbname=".$this->getDatabaseName().";charset=".$this->getCharacterSet();
		// 			$pdo_features = array(
		// 					PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
		// 					PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
		// 					PDO::ATTR_EMULATE_PREPARES   => false,
		// 				);
		// 			//making an instance of pdo
		// 			// $this->db_conn = new PDO($server_path,$this->getUserName(),$this->getPassword());
		// 			// $this->db_conn->setAttribute(PDO::ATTR_AUTOCOMMIT,FALSE);
		// 			$this->db_conn =  new PDO('mysql:host='.$serverName. ';dbname=' .$databaseName, $databaseUser, $databasePassword);
		// 			$this->db_conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		// 			//close connection
		// 			var_dump($this->db_conn);
		// 		    return $this->db_conn;
		// 		} 
		// 		//if error throw exception
		// 		catch (PDOException $e) {
		// 			return $e->getMessage();
		// 		}  
		//    }
			
		// }


		private $server = '192.168.193.254';
        private $dbname = 'telnet_sdp_pro';
        private $user = 'adri';
        private $pass = 'adRi@1234&5$HaW9(1&Mcc';

    	public function connection(){
    	   try {    	   	
    	   	  $connection = new PDO('mysql:host='.$this->server. ';dbname=' .$this->dbname, $this->user, $this->pass);  
              $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
              return $connection;
    	   } catch (PDOException $error) {	   	   
    	   	   echo "Connection failed: ".$error->getMessage();
    	   }          
    	}

    	

		//creating out getters method
		private function getHostName()
		{
			return $this->db_host;
		}

		private function getDatabaseName()
		{
			return $this->db_name;
		}

		private function getUserName()
		{
			return $this->db_username;
		}
		private function getPassword()
		{
			return $this->pass_word;
		}

		private function getCharacterSet()
		{
			return $this->charset;
		}

		//destroy connection when class is not needed
		public function __destruct(){
			$this->db_conn = null;
		}

	}

