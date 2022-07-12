<?php
	require_once 'database.php';

	/**
	 * 
	 */
	class unityContentFunctions extends db_connect
	{
		
		public function check_duplicates($today_date, $serviceName)
		{
			try 
			{	
				$today_date = date("Y-m-d");
				$query =  $this->db_conn->query("SELECT COUNT(serviceName) AS today_entry FROM `daily_reports` WHERE serviceName = '$serviceName' AND DATE(`created_at`) = '$today_date' ");//(year(created_at) = year(now()) AND month(created_at) = month(now()) AND day(created_at) = day(now())) DATE(`created_at`) = '$today_date'
				$query->execute();

				$query->setFetchMode(PDO::FETCH_ASSOC);
				$result = $query->fetchAll();
				foreach ($result as $key) {
					$value = $key['today_entry'];
				}
				return $value;
			} catch (Exception $e)
			{
				echo $e->getMessage();
			}
		}



		public function get_service_for_update($today_date, $serviceName)
		{
			try 
			{
				$today_date = date("Y-m-d");
				$query =  $this->db_conn->query("SELECT * FROM `daily_reports` WHERE serviceName = '$serviceName' AND  DATE(`created_at`) = '$today_date' LIMIT 0,1");//(year(created_at) = year(now()) AND month(created_at) = month(now()) AND day(created_at) = day(now()))
				$query->execute();
				// set the resulting array to associative
				$result = $query->setFetchMode(PDO::FETCH_ASSOC);
				return $query->fetchAll();
			} catch (Exception $e)
			{
				echo $e->getMessage();
			}
		}

 



		// do new insertion...................
		public function do_data_summary_entry($serviceName, $serviceid, $total_subs, $total_sms, $total_delivery, $amount_billed, $billed_date = null)
		{
			try 
			{	$billed_date = date("Y-m-d");

				$stmnt = "INSERT INTO daily_reports(serviceName, serviceId, totalSub, totalsms, billedCount, billedAmount, billedDate) VALUES(?, ?, ?, ?, ?, ?, ?)";
				$values = array($serviceName, $serviceid, $total_subs, $total_sms, $total_delivery, $amount_billed, $billed_date);

				$query = $this->db_conn->prepare($stmnt);
				$query->execute($values);
				$counts = $query->rowCount();
				// var_dump($counts);
				return $counts;	
			} catch (Exception $exc) 
			{
				echo __LINE__ . $exc->getMessage();
			}
		}


		// do data records update................
		public function update_new_values($id, $serviceName, $serviceId, $total_subs, $total_sms, $billedCount, $today_date, $billedAmount)
		{
			try 
			{
				$today_date = date('Y-m-d');

				$stmnt = "UPDATE daily_reports SET totalSub=:totalSub, totalsms=:totalsms, billedCount=:billedCount, billedAmount=:billedAmount WHERE (id=:id AND serviceName=:serviceName AND serviceId=:serviceId) AND  DATE(`created_at`) = '$today_date' ";//(year(created_at) = year(now()) AND month(created_at) = month(now()) AND day(created_at) = day(now()))
				$query =  $this->db_conn->prepare($stmnt);
				$values = array('totalSub' => $total_subs, 'totalsms'=>$total_sms, 'billedCount'=>$billedCount, 'billedAmount'=>$billedAmount, 'id'=>$id, 'serviceName'=> $serviceName, 'serviceId'=>$serviceId);
				$query->execute($values);
				return $query->rowCount();
			} catch (Exception $e){
				echo $e->getMessage();
			}
		}




		// get service id for this keyword.................keywords
		public function get_service_id($serviceName)
		{
			try 
			{
				$query =  $this->db_conn->query("SELECT * FROM `keywords` WHERE service_name = '$serviceName' ");
				$query->execute();
				// set the resulting array to associative
				$result = $query->setFetchMode(PDO::FETCH_ASSOC);
				return $query->fetchAll();
				// $counts = $query->rowCount();
				// return $counts;	
			} catch (Exception $e){
				echo $e->getMessage();
			}
		}






























		##################################   DAILY BILLED FUNCTIONS  ##################################
		###############################################################################################

		//check on dupplicate entry...........
		public function check_billed_duplicates($today_date = null)
		{
			try 
			{
				$today_date = date('Y-m-d');

				$query =  $this->db_conn->query("SELECT COUNT(total_sms_sent) AS total_sms_sent FROM `daily_billed` WHERE DATE(`created_at`) = '$today_date' ");// DATE(`entry_date`) = '$today_date'year(created_at) = year(now()) AND month(created_at) = month(now()) AND day(created_at) = day(now())
				$query->execute();
				// return $query->rowCount();
				$query->setFetchMode(PDO::FETCH_ASSOC);
				$result = $query->fetchAll();
				foreach ($result as $key) {
					$value = $key['total_sms_sent'];
				}
				return $value;
			} catch (Exception $e)
			{
				echo $e->getMessage();
			}
		}





		// do new billed data insertion...................
		public function do_billed_data_summary_entry($total_subs, $total_sms, $total_delivery, $amount_billed)
		{
			try 
			{	
				$stmnt = "INSERT INTO daily_billed(total_sub, total_sms_sent, total_delivery, amount_billed) VALUES(?, ?, ?, ?)";
				$values = array($total_subs, $total_sms, $total_delivery, $amount_billed);

				$query = $this->db_conn->prepare($stmnt);
				$query->execute($values);
				return $query->rowCount();
				// var_dump($counts);
			} catch (Exception $exc) 
			{
				echo __LINE__ . $exc->getMessage();
			}
		}




		// get all summary data for update.........
		public function get_billed_data_for_update()
		{
			try 
			{
				$today_date = date("Y-m-d");

				$query =  $this->db_conn->query("SELECT * FROM `daily_billed` WHERE DATE(`created_at`) = '$today_date' LIMIT 0,1");//DATE(`entry_date`) = '$today_date' (year(created_at) = year(now()) AND month(created_at) = month(now()) AND day(created_at) = day(now()))
				$query->execute();
				// set the resulting array to associative
				$result = $query->setFetchMode(PDO::FETCH_ASSOC);
				return $query->fetchAll();	
			} catch (Exception $e)
			{
				echo $e->getMessage();
			}
		}



		// do billed data records update................
		public function update_new_billed_values($id, $total_subs, $total_sms, $total_delivery, $today_date, $amount_billed)
		{
			try 
			{
				$today_date = date("Y-m-d");

				$stmnt = "UPDATE daily_billed SET total_sub=:total_sub, total_sms_sent=:total_sms_sent, total_delivery=:total_delivery, amount_billed=:amount_billed WHERE (id=:id) AND  DATE(`created_at`) = '$today_date' ";//DATE(`entry_date`) = '$today_date' (year(created_at) = year(now()) AND month(created_at) = month(now()) AND day(created_at) = day(now()))
				$query  =  $this->db_conn->prepare($stmnt);
				$values = array('total_sub' => $total_subs, 'total_sms_sent'=>$total_sms, 'total_delivery'=>$total_delivery, 'amount_billed'=>$amount_billed, 'id'=>$id);
				$query->execute($values);
				$counts = $query->rowCount();
				return $counts;	
			} catch (Exception $e){
				echo $e->getMessage();
			}
		}






		// get total subs.....................
		public function get_keyword_counts($serviceName)
		{
			try 
			{
				$stmt = "SELECT COUNT(msisdn) AS  msisdn_count FROM mt_subscribers WHERE serviceName = '$serviceName'";//limit 50
		        $query = $this->db_conn->prepare($stmt);
		        $query->execute();
	        	// return $query->rowCount();
	        	$query->setFetchMode(PDO::FETCH_ASSOC);
				$result = $query->fetchAll();
				foreach ($result as $key) {
					$value = $key['msisdn_count'];
				}
				return $value;
			}catch (Exception $e){
				echo $e->getMessage();
			}
		}



				// get total content sent today..................
		public function get_sms_content_counts($offerName, $today_date)
		{
			try 
			{
				$today_date = date("Y-m-d");

				$stmt  = "SELECT COUNT(msisdn) AS  msisdn_count FROM mt_charge WHERE offerName = '$offerName' AND DATE(`created_at`) = '$today_date' ";//(year(created_at) = year(now()) AND month(created_at) = month(now()) AND day(created_at) = day(now()))
		        $query = $this->db_conn->prepare($stmt);
		        $query->execute();
	        	// return $query->rowCount();
	        	$query->setFetchMode(PDO::FETCH_ASSOC);
				$result = $query->fetchAll();
				foreach ($result as $key) {
					$value = $key['msisdn_count'];
				}
				return $value;
			}catch (Exception $e){
				echo $e->getMessage();
			}
		}



				// get total content delivered today..................
		public function get_sms_delivery_counts($offerName, $today_date)
		{
			try 
			{
				$today_date = date("Y-m-d");
				
				$stmt  = "SELECT COUNT(msisdn) AS  msisdn_count FROM mt_charge WHERE (offerName = '$offerName' AND transactionId != '' ) AND DATE(`created_at`) = '$today_date' ";//(year(created_at) = year(now()) AND month(created_at) = month(now()) AND day(created_at) = day(now()))
		        $query = $this->db_conn->prepare($stmt);
		        $query->execute();
	        	// return $query->rowCount();
	        	$query->setFetchMode(PDO::FETCH_ASSOC);
				$result = $query->fetchAll();
				foreach ($result as $key) {
					$value = $key['msisdn_count'];
				}
				return $value;
			}catch (Exception $e){
				echo $e->getMessage();
			}
		}



//SELECT DISTINCT(offerName) AS keyword, SUM(amount) AS amount, COUNT(msisdn) AS counts FROM mt_charge WHERE transactionId != '' AND DATE(created_at) = "2022-05-29" GROUP BY keyword

		//get daily billed amount
		public function get_keyword_billed_amount($offerName)
		{
			try 
			{
				$today_date = date("Y-m-d");

				$stmt  = "SELECT SUM(amount) AS amount FROM mt_charge WHERE (offerName = '$offerName' AND transactionId != '') AND DATE(`created_at`) = '$today_date' ";//(year(created_at) = year(now()) AND month(created_at) = month(now()) AND day(created_at) = day(now()))
		        $query = $this->db_conn->prepare($stmt);
		        $query->execute();
		        $query->setFetchMode(PDO::FETCH_ASSOC);
				return $query->fetchAll();
			}catch (Exception $e){
				echo $e->getMessage();
			}
		}






		// (year(created_at) = year(now()) AND month(created_at) = month(now()) AND day(created_at) = day(now()))

		##################################   DAILY BILLED FUNCTIONS  ##################################
		###############################################################################################

		// count total subscribers...................
		public function get_count_subscribers($keyOne, $keyTwo)
		{
			try 
			{			
				$sql   = "SELECT COUNT(msisdn) AS total_sub FROM mt_subscribers WHERE serviceName = '$keyOne' OR serviceName = '$keyTwo' ";
		        $query = $this->db_conn->prepare($sql);
				$query->execute();
		        // return $query->rowCount();
				$query->setFetchMode(PDO::FETCH_ASSOC);
				$result = $query->fetchAll();
				foreach ($result as $key) {
					$value = $key['total_sub'];
				}
				return $value;
			} catch (Exception $exc) 
			{
				echo $exc->getMessage();
			}
		}




		// load total keywod active.............................
		public function fetch_total_active_subscription()
		{
			try 
			{			
				$sql   = "SELECT * FROM mt_subscribers  WHERE status = 'ACTIVE' ";//WHERE `update_desc` = 'Deletion' 
		        $query = $this->db_conn->prepare($sql);
				$query->execute();
		        return $query->rowCount();
			} catch (Exception $exc) 
			{
				echo $exc->getMessage();
			}
		}



		// get count of content sent for today...........
		public function fetch_total_content_sent_today()
		{
			try 
			{	
				$today_date = date("Y-m-d");	

				$sql = "SELECT COUNT(msisdn) AS total_sms_sent FROM mt_charge WHERE  DATE(`created_at`) = '$today_date'";//(year(created_at) = year(now()) AND month(created_at) = month(now()) AND day(created_at) = day(now()))
		        $query = $this->db_conn->prepare($sql);
				$query->execute();
				// return $query->rowCount();
				$query->setFetchMode(PDO::FETCH_ASSOC);
				$result = $query->fetchAll();
				foreach ($result as $key) {
					$value = $key['total_sms_sent'];
				}
				return $value;
			} catch (Exception $exc) 
			{
				echo $exc->getMessage();
			}
		}



		// get count of content delivery for today...........
		public function fetch_today_delivery($today = null)
		{
			try 
			{	
				$today_date = date("Y-m-d");		

				$sql = "SELECT COUNT(msisdn) AS total_delivered FROM mt_charge WHERE transactionId != '' AND DATE(`created_at`) = '$today_date'";//(year(created_at) = year(now()) AND month(created_at) = month(now()) AND day(created_at) = day(now())) 
		        $query = $this->db_conn->prepare($sql);
				$query->execute();
				// return $query->rowCount();
				$query->setFetchMode(PDO::FETCH_ASSOC);
				$result = $query->fetchAll();
				foreach ($result as $key) {
					$value = $key['total_delivered'];
				}
				return $value;
			} catch (Exception $exc) 
			{
				echo $exc->getMessage();
			}
		}




	}