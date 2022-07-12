<?php
	set_time_limit(13000);
    require_once 'unityContentFunctions.php';


	$today_date = date("Y-m-d");
	$unity_Obj = new unityContentFunctions();
	$run_time = date('H:i:s');
	// var_dump($run_time);

// if (trim($run_time) == "07:00:01" || trim($run_time) > "07:00:05") {
// 	echo "run";
// } else {
// 	echo "not now";
// }









	#if you wish to check the data entry for a given keyword, kindly ckeck through if that keyword is already added and commented, uncomment it out and edit the details and then run script or add the keyword below:...............





	









	


	#=================================THE REST OF THE KEYWORDS===============================================










$run_time = date('H:i');
// $duplicate = $unity_Obj->check_duplicates($today_date, "GOSPEL");
// var_dump($duplicate);
// die($run_time);

if (trim($run_time) === "07:00" || trim($run_time) > "07:00") {


/*

	###########################  FAITHS KEYWORD  ###########################
	$today_date = date("Y-m-d");
	$dup_faith = $unity_Obj->check_duplicates($today_date, "FAITHS");

	foreach ($unity_Obj->get_service_id("FAITHS") as $faith) 
	{
		$faith_service = $faith['serviceid'];
		$faith_amount  = $faith['price_point'];
	}

	$faith_sub          = $unity_Obj->get_keyword_counts("FAITHS");
	$faith_sent_sms     = $unity_Obj->get_sms_content_counts("FAITHS", $today_date);

	$faith_delivery_sms = $unity_Obj->get_sms_delivery_counts("FAITHS", $today_date);
	// $faith_total_unsub  = $unity_Obj->get_keyword_unsub_counts("FAITHS");
	// $faith_new_subs     = $unity_Obj->get_keyword_newsub_counts("FAITHS", $today_date);
	foreach ($unity_Obj->get_keyword_billed_amount("FAITHS") as $fai_bill){
		$faith_billed   = $fai_bill['amount'];
	}

	// $faith_billed       = $faith_delivery_sms * $faith_amount;

	if(trim($dup_faith) > 0) 
	{
		// do incoming data update..............
		foreach ($unity_Obj->get_service_for_update($today_date, "FAITHS") as $faith_key) 
		{
			$faith_daily_id    = $faith_key['id'];
			$faith_keyword     = $faith_key['serviceName'];
			$faith_service     = $faith_key['serviceId'];
		}

		$mot = $unity_Obj->update_new_values($faith_daily_id, $faith_keyword, $faith_service, $faith_sub, $faith_sent_sms, $faith_delivery_sms, $today_date, $faith_billed);
		// var_dump($mot);
	} else 
	{
		// do incoming data update..............
		$unity_Obj->do_data_summary_entry("FAITHS", $faith_service, $faith_sub, $faith_sent_sms, $faith_delivery_sms, $faith_billed, $today_date);
	}







	


















	###########################  AG KEYWORD  ###########################
	$today_date = date("Y-m-d");
	$dup_ag = $unity_Obj->check_duplicates($today_date, "AG");

	foreach ($unity_Obj->get_service_id("AG") as $ag) 
	{
		$ag_service  = $ag['serviceid'];
		$faith_amount  = $faith['price_point'];
	}

	$ag_sub          = $unity_Obj->get_keyword_counts("AG");
	$ag_sent_sms     = $unity_Obj->get_sms_content_counts("AG", $today_date);

	$ag_delivery_sms = $unity_Obj->get_sms_delivery_counts("AG", $today_date);
	// $ag_total_unsub  = $unity_Obj->get_keyword_unsub_counts("AG");
	// $ag_new_subs     = $unity_Obj->get_keyword_newsub_counts("AG", $today_date);

	foreach ($unity_Obj->get_keyword_billed_amount("AG") as $ag_bill){
		$ag_billed   = $ag_bill['amount'];
	}
	// $ag_billed       = $ag_delivery_sms * 0.20;

	if(trim($dup_ag) > 0) 
	{
		// do incoming data update..............
		foreach ($unity_Obj->get_service_for_update($today_date, "AG") as $ag_key) 
		{
			$ag_daily_id    = $ag_key['id'];
			$ag_keyword     = $ag_key['serviceName'];
			$ag_service     = $ag_key['serviceId'];
		}

		$mot = $unity_Obj->update_new_values($ag_daily_id, $ag_keyword, $ag_service, $ag_sub, $ag_sent_sms, $ag_delivery_sms, $today_date, $ag_billed);
		// var_dump($mot);
	} else 
	{
		// do incoming data update..............
		$unity_Obj->do_data_summary_entry("AG", $ag_service, $ag_sub, $ag_sent_sms, $ag_delivery_sms, $ag_billed, $today_date);
	}











	###########################  PPP KEYWORD  ###########################
	$today_date = date("Y-m-d");
	$dup_ppp = $unity_Obj->check_duplicates($today_date, "PPP");

	foreach ($unity_Obj->get_service_id("PPP") as $ppp) 
	{
		$ppp_service  = $ppp['serviceid'];
	}

	$ppp_sub          = $unity_Obj->get_keyword_counts("PPP");
	$ppp_sent_sms     = $unity_Obj->get_sms_content_counts("PPP", $today_date);
	// var_dump($wisdom_sent_sms);
	$ppp_delivery_sms = $unity_Obj->get_sms_delivery_counts("PPP", $today_date);
	// $ppp_total_unsub  = $unity_Obj->get_keyword_unsub_counts("PPP");
	// $ppp_new_subs     = $unity_Obj->get_keyword_newsub_counts("PPP", $today_date);

	foreach ($unity_Obj->get_keyword_billed_amount("PPP") as $ppp_bill){
		$ppp_billed   = $ppp_bill['amount'];
	}
	// $ppp_billed       = $ppp_delivery_sms * 0.20;

	if(trim($dup_ppp) > 0) 
	{
		// do incoming data update..............
		foreach ($unity_Obj->get_service_for_update($today_date, "PPP") as $ppp_key) 
		{
			$ppp_daily_id    = $ppp_key['id'];
			$ppp_keyword     = $ppp_key['serviceName'];
			$ppp_service     = $ppp_key['serviceId'];
		}

		$mot = $unity_Obj->update_new_values($ppp_daily_id, $ppp_keyword, $ppp_service, $ppp_sub, $ppp_sent_sms, $ppp_delivery_sms, $today_date, $ppp_billed);
		// var_dump($mot);
	} else 
	{
		// do incoming data update..............
		$unity_Obj->do_data_summary_entry("PPP", $ppp_service, $ppp_sub, $ppp_sent_sms, $ppp_delivery_sms, $ppp_billed, $today_date);
	}






	###########################  PKN KEYWORD  ###########################
	$today_date = date("Y-m-d");
	$dup_pkn = $unity_Obj->check_duplicates($today_date, "PKN");

	foreach ($unity_Obj->get_service_id("PKN") as $pkn) 
	{
		$pkn_service  = $pkn['serviceid'];
	}

	$pkn_sub          = $unity_Obj->get_keyword_counts("PKN");
	$pkn_sent_sms     = $unity_Obj->get_sms_content_counts("PKN", $today_date);

	$pkn_delivery_sms = $unity_Obj->get_sms_delivery_counts("PKN", $today_date);
	// $pkn_total_unsub  = $unity_Obj->get_keyword_unsub_counts("PKN");
	// $pkn_new_subs     = $unity_Obj->get_keyword_newsub_counts("PKN", $today_date);

	foreach ($unity_Obj->get_keyword_billed_amount("PKN") as $pkn_bill){
		$pkn_billed   = $pkn_bill['amount'];
	}

	// $pkn_billed       = $pkn_delivery_sms * 0.20;

	if(trim($dup_pkn) > 0) 
	{
		// do incoming data update..............
		foreach ($unity_Obj->get_service_for_update($today_date, "PKN") as $pkn_key) 
		{
			$pkn_daily_id    = $pkn_key['id'];
			$pkn_keyword     = $pkn_key['serviceName'];
			$pkn_service     = $pkn_key['serviceId'];
		}

		$mot = $unity_Obj->update_new_values($pkn_daily_id, "PKN", $pkn_service, $pkn_sub, $pkn_sent_sms, $pkn_delivery_sms, $today_date, $pkn_billed );
		// var_dump($mot);
	} else 
	{
		// do incoming data update..............
		$unity_Obj->do_data_summary_entry("PKN", $pkn_service, $pkn_sub, $pkn_sent_sms, $pkn_delivery_sms, $pkn_billed , $today_date);
	}








	###########################  MOVIES KEYWORD  ###########################
	$today_date = date("Y-m-d");
	$dup_movies = $unity_Obj->check_duplicates($today_date, "MOVIES");

	foreach ($unity_Obj->get_service_id("MOVIES") as $movies) 
	{
		$movies_service  = $movies['serviceid'];
	}

	$movies_sub          = $unity_Obj->get_keyword_counts("MOVIES");
	$movies_sent_sms     = $unity_Obj->get_sms_content_counts("MOVIES", $today_date);
	// var_dump($wisdom_sent_sms);
	$movies_delivery_sms = $unity_Obj->get_sms_delivery_counts("MOVIES", $today_date);
	// $movies_total_unsub  = $unity_Obj->get_keyword_unsub_counts("MOVIES");
	// $movies_new_subs     = $unity_Obj->get_keyword_newsub_counts("MOVIES", $today_date);

	foreach ($unity_Obj->get_keyword_billed_amount("MOVIES") as $mov_bill){
		$movies_billed   = $mov_bill['amount'];
	}

	// $movies_billed       = $movies_delivery_sms * 0.20;

	if(trim($dup_movies) > 0) 
	{
		// do incoming data update..............
		foreach ($unity_Obj->get_service_for_update($today_date, "MOVIES") as $movies_key) 
		{
			$movies_daily_id    = $movies_key['id'];
			$movies_keyword     = $movies_key['serviceName'];
			$movies_service     = $movies_key['serviceId'];
		}

		$mot = $unity_Obj->update_new_values($movies_daily_id, "MOVIES", $movies_service, $movies_sub,  $movies_sent_sms, $movies_delivery_sms, $today_date, $movies_billed);
		// var_dump($mot);
	} else 
	{
		// do incoming data update..............
		$unity_Obj->do_data_summary_entry("MOVIES", $movies_service, $movies_sub, $movies_sent_sms, $movies_delivery_sms, $movies_billed, $today_date);
	}






	###########################  HEALTH KEYWORD  ###########################
	$today_date = date("Y-m-d");
	$dup_health = $unity_Obj->check_duplicates($today_date, "HEALTH");

	foreach ($unity_Obj->get_service_id("HEALTH") as $health) 
	{
		$health_service  = $health['serviceid'];
	}

	$health_sub          = $unity_Obj->get_keyword_counts("HEALTH");
	$health_sent_sms     = $unity_Obj->get_sms_content_counts("HEALTH", $today_date);
	// var_dump($wisdom_sent_sms);
	$health_delivery_sms = $unity_Obj->get_sms_delivery_counts("HEALTH", $today_date);
	// $health_total_unsub  = $unity_Obj->get_keyword_unsub_counts("HEALTH");
	// $health_new_subs     = $unity_Obj->get_keyword_newsub_counts("HEALTH", $today_date);

	foreach ($unity_Obj->get_keyword_billed_amount("HEALTH") as $health_bill){
		$health_billed   = $health_bill['amount'];
	}

	// $health_billed       = $health_delivery_sms * 0.20;

	if(trim($dup_health) > 0) 
	{
		// do incoming data update..............
		foreach ($unity_Obj->get_service_for_update($today_date, "HEALTH") as $health_key) 
		{
			$health_daily_id    = $health_key['id'];
			$health_keyword     = $health_key['serviceName'];
			$health_service     = $health_key['serviceId'];
		}

		$unity_Obj->update_new_values($health_daily_id, "HEALTH", $health_service, $health_sub, $health_sent_sms, $health_delivery_sms, $today_date, $health_billed);
		// var_dump($mot);
	} else 
	{
		// do incoming data update..............
		$unity_Obj->do_data_summary_entry("HEALTH", $health_service, $health_sub, $health_sent_sms, $health_delivery_sms, $health_billed, $today_date);
	}























	###########################  FINANCE KEYWORD  ###########################
	$today_date = date("Y-m-d");
	$dup_finance = $unity_Obj->check_duplicates($today_date, "FIN");

	foreach ($unity_Obj->get_service_id("FIN") as $finance) 
	{
		$finance_service  = $finance['serviceid'];
	}

	$finance_sub          = $unity_Obj->get_keyword_counts("FIN");
	$finance_sent_sms     = $unity_Obj->get_sms_content_counts("FIN", $today_date);
	// var_dump($wisdom_sent_sms);
	$finance_delivery_sms = $unity_Obj->get_sms_delivery_counts("FIN", $today_date);
	// $finance_total_unsub  = $unity_Obj->get_keyword_unsub_counts("FINANCE");
	// $finance_new_subs     = $unity_Obj->get_keyword_newsub_counts("FINANCE", $today_date);

	foreach ($unity_Obj->get_keyword_billed_amount("FIN") as $finan_bill){
		$finan_billed   = $finan_bill['amount'];
	}
	// $finan_billed         = $finance_delivery_sms * 0.20;

	
	if(trim($dup_finance) > 0) 
	{
		// do incoming data update..............
		foreach ($unity_Obj->get_service_for_update($today_date, "FIN") as $finance_key) 
		{
			$finance_daily_id    = $finance_key['id'];
			$finance_keyword     = $finance_key['serviceName'];
			$finance_service     = $finance_key['serviceId'];
		}

		$mot = $unity_Obj->update_new_values($finance_daily_id, "FIN", $finance_service, $finance_sub, $finance_sent_sms, $finance_delivery_sms, $today_date, $finan_billed);
		// var_dump($mot);
	} else 
	{
		// do incoming data update..............
		$unity_Obj->do_data_summary_entry("FIN", $finance_service, $finance_sub, $finance_sent_sms, $finance_delivery_sms, $finan_billed);
	}




*/

// $dup_wisdom = $unity_Obj->get_keyword_billed_amount("WSDM");

// var_dump($dup_wisdom);


/*





	$run_time = date('H:i');

	if (trim($run_time) === "07:00" || trim($run_time) > "07:05") {
		###########################  WISDOM KEYWORD  ###########################
		$today_date = date("Y-m-d");
		$dup_wisdom = $unity_Obj->check_duplicates($today_date, "WSDM");

		foreach ($unity_Obj->get_service_id("WSDM") as $wisdom) 
		{
			$wisdom_service  = $wisdom['serviceid'];
		}

		$wisdom_sub          = $unity_Obj->get_keyword_counts("WSDM");
		$wisdom_sent_sms     = $unity_Obj->get_sms_content_counts("WSDM", $today_date);
		// var_dump($wisdom_sent_sms);
		$wisdom_delivery_sms = $unity_Obj->get_sms_delivery_counts("WSDM", $today_date);
		// $wisdom_total_unsub  = $unity_Obj->get_keyword_unsub_counts("WSDM");
		// $wisdom_new_subs     = $unity_Obj->get_keyword_newsub_counts("WSDM", $today_date);

		foreach ($unity_Obj->get_keyword_billed_amount("WSDM") as $wsdm_bill){
			$wisd_billed   = $wsdm_bill['amount'];
		}
		// $wisd_billed         = $wisdom_delivery_sms * 0.20;

		if(trim($dup_wisdom) > 0) 
		{
			// do incoming data update..............
			foreach ($unity_Obj->get_service_for_update($today_date, "WSDM") as $wisdom_key) 
			{
				$wisdom_daily_id    = $wisdom_key['id'];
				$wisdom_keyword     = $wisdom_key['serviceName'];
				$wisdom_service     = $wisdom_key['serviceId'];
			}

			$mot = $unity_Obj->update_new_values($wisdom_daily_id, "WSDM", $wisdom_service, $wisdom_sub, $wisdom_sent_sms, $wisdom_delivery_sms, $today_date,$wisd_billed);
			// var_dump($mot);
		} else 
		{
			// do incoming data update..............
			$unity_Obj->do_data_summary_entry("WSDM", $wisdom_service, $wisdom_sub, $wisdom_sent_sms, $wisdom_delivery_sms, $wisd_billed, $today_date);
		}

	}
	




	$run_time = date('H:i');

	if (trim($run_time) === "07:00" || trim($run_time) > "07:06") {
		###########################  GOSPEL KEYWORD  ###########################
		// GOSPEL keyword contents.................
		$today_date = date("Y-m-d");
		$duplicate = $unity_Obj->check_duplicates($today_date, "GOSPEL");

		foreach ($unity_Obj->get_service_id("GOSPEL") as $motivate) 
		{
			$motivate_service = $motivate['serviceid'];
		}
		var_dump($motivate_service);

		$motivate_sub           = $unity_Obj->get_keyword_counts("GOSPEL");
		$motivate_sent_sms      = $unity_Obj->get_sms_content_counts("GOSPEL", $today_date);
		var_dump($motivate_sent_sms);
		$motivate_delivery_sms  = $unity_Obj->get_sms_delivery_counts("GOSPEL", $today_date);
		// $motivate_total_unsub = $unity_Obj->get_keyword_unsub_counts("GOSPEL");
		// $motivate_new_subs    = $unity_Obj->get_keyword_newsub_counts("GOSPEL", $today_date);

		foreach ($unity_Obj->get_keyword_billed_amount("GOSPEL") as $gosp_bill){
			$motiv_billed   = $gosp_bill['amount'];
		}
		// $motiv_billed         = $motivate_delivery_sms * 0.20;

		var_dump($motiv_billed);

		if(trim($duplicate) > 0) 
		{
			// do incoming data update..............
			foreach ($unity_Obj->get_service_for_update($today_date, "GOSPEL") as $motivate_key) 
			{
				$motivate_daily_id    = $motivate_key['id'];
				$motivate_keyword     = $motivate_key['serviceName'];
				$motivate_service     = $motivate_key['serviceId'];
			}

			$unity_Obj->update_new_values($motivate_daily_id, "GOSPEL", $motivate_service, $motivate_sub, $motivate_sent_sms, $motivate_delivery_sms, $today_date, $motiv_billed);
		} else 
		{
			// do incoming data update..............
			$unity_Obj->do_data_summary_entry("GOSPEL", $motivate_service, $motivate_sub, $motivate_sent_sms, $motivate_delivery_sms, $motiv_billed, $today_date);
		}
	}


##########################################################php
	#########################################################









	#=======================================================================================
	#===============================    TOTAL BILLED SCRIPT   ===============================
	#+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

	$run_time = date('H:i');

	if (trim($run_time) === "07:00" || trim($run_time) > "07:08") {
		// check duplicate billed entry...............
		$today_date = date("Y-m-d");
		$duplicate_billed = $unity_Obj->check_billed_duplicates($today_date);
		


		$total_sub      = $unity_Obj->get_count_subscribers("WSDM", "GOSPEL");
		// $total_active   = $unity_Obj->fetch_total_active_subscription();
		$total_sms_sent = $unity_Obj->fetch_total_content_sent_today();
		$total_delivery = $unity_Obj->fetch_today_delivery($today_date);

		$amount_billed  = $total_delivery * 0.20; 

		if(trim($duplicate_billed) > 0) 
		{
			$bill_id = "";
			foreach ($unity_Obj->get_billed_data_for_update() as $Old_Data) 
			{
				$bill_id            = $Old_Data['id'];
				// $Old_amount_billed  = $Old_Data['amount_billed'];
				// $Old_total_sub      = $Old_Data['total_sub'];
				// $Old_total_sms_sent = $Old_Data['total_sms_sent'];
				// $Old_total_delivery = $Old_Data['total_delivery'];
			}

			$upd = $unity_Obj->update_new_billed_values($bill_id, $total_sub, $total_sms_sent, $total_delivery, $today_date, $amount_billed);
		} else {
			$unity_Obj->do_billed_data_summary_entry($total_sub, $total_sms_sent, $total_delivery, $amount_billed);
		}






		
		$today_date = date("Y-m-d");
		$run_time = date('H:i:s');
		echo "Today current update submission was completed on.... ".$today_date.' '.$run_time;
	}
// var_dump($total_delivery);die()












	
*/










	###########################  PROVERBS KEYWORD  ###########################

	// $dup_proverbs = $unity_Obj->check_duplicates($today_date, "PROVERBS");

	// foreach ($unity_Obj->get_service_id("PROVERBS") as $proverbs) 
	// {
	// 	$proverbs_service  = $proverbs['service'];
	// }

	// $proverbs_sub          = $unity_Obj->get_keyword_counts("PROVERBS");
	// $proverbs_sent_sms     = $unity_Obj->get_sms_content_counts($proverbs_service, $today_date);

	// $proverbs_delivery_sms = $unity_Obj->get_sms_delivery_counts($proverbs_service, $today_date);
	// $proverbs_total_unsub  = $unity_Obj->get_keyword_unsub_counts("PROVERBS");
	// $proverbs_new_subs     = $unity_Obj->get_keyword_newsub_counts("PROVERBS", $today_date);

	// $proverbs_billed       = $proverbs_delivery_sms * 0.20;

	// if(trim($dup_proverbs) > 0) 
	// {
	// 	// do incoming data update..............
	// 	foreach ($unity_Obj->get_service_for_update($today_date, "PROVERBS") as $proverbs_key) 
	// 	{
	// 		$proverbs_daily_id    = $proverbs_key['id'];
	// 		$proverbs_keyword     = $proverbs_key['keyword'];
	// 		$proverbs_service     = $proverbs_key['service'];
	// 	}

	// 	$unity_Obj->update_new_values($proverbs_daily_id, $proverbs_keyword, $proverbs_service, $proverbs_sub, $proverbs_total_unsub, $proverbs_new_subs, $proverbs_sent_sms, $proverbs_delivery_sms, $today_date, $proverbs_billed);
	// 	// var_dump($mot);
	// } else 
	// {
	// 	// do incoming data update..............
	// 	$unity_Obj->do_data_summary_entry("PROVERBS", $proverbs_service, $proverbs_sub, $proverbs_total_unsub, $proverbs_new_subs, $proverbs_sent_sms, $proverbs_delivery_sms, $proverbs_billed);
	// }








	
		// SPORT SERVICES...................





	// ###########################  TOTTENHAM KEYWORD  ###########################
	// $today_date = date("Y-m-d");
	// $dup_tottenham = $unity_Obj->check_duplicates($today_date, "TOTTENHAM");

	// foreach ($unity_Obj->get_service_id("TOTTENHAM") as $tottenham) 
	// {
	// 	$tottenham_service  = $tottenham['service'];
	// }

	// $tottenham_sub          = $unity_Obj->get_keyword_counts("TOTTENHAM");
	// $tottenham_sent_sms     = $unity_Obj->get_sms_content_counts($tottenham_service, $today_date);

	// $tottenham_delivery_sms = $unity_Obj->get_sms_delivery_counts($tottenham_service, $today_date);
	// $tottenham_total_unsub  = $unity_Obj->get_keyword_unsub_counts("TOTTENHAM");
	// $tottenham_new_subs     = $unity_Obj->get_keyword_newsub_counts("TOTTENHAM", $today_date);

	// $tottenham_billed       = $tottenham_delivery_sms * 0.20;


	// if(trim($dup_tottenham) > 0) 
	// {
	// 	// do incoming data update..............
	// 	foreach ($unity_Obj->get_service_for_update($today_date, "TOTTENHAM") as $tottenham_key) 
	// 	{
	// 		$tottenham_daily_id    = $tottenham_key['id'];
	// 		$tottenham_keyword     = $tottenham_key['keyword'];
	// 		$tottenham_service     = $tottenham_key['service'];
	// 	}

	// 	$unity_Obj->update_new_values($tottenham_daily_id, $tottenham_keyword, $tottenham_service, $tottenham_sub, $tottenham_total_unsub, $tottenham_new_subs, $tottenham_sent_sms, $tottenham_delivery_sms, $today_date, $tottenham_billed);
	// } else 
	// {
	// 	// do incoming data update..............
	// 	$unity_Obj->do_data_summary_entry("TOTTENHAM", $tottenham_service, $tottenham_sub, $tottenham_total_unsub, $tottenham_new_subs, $tottenham_sent_sms, $tottenham_delivery_sms, $tottenham_billed);
	// }








	// ###########################  EVERTON KEYWORD  ###########################
	// $today_date = date("Y-m-d");
	// $dup_everton = $unity_Obj->check_duplicates($today_date, "EVERTON");

	// foreach ($unity_Obj->get_service_id("EVERTON") as $everton) 
	// {
	// 	$everton_service  = $everton['service'];
	// }

	// $everton_sub          = $unity_Obj->get_keyword_counts("EVERTON");
	// $everton_sent_sms     = $unity_Obj->get_sms_content_counts($everton_service, $today_date);
	// // var_dump($wisdom_sent_sms);
	// $everton_delivery_sms = $unity_Obj->get_sms_delivery_counts($everton_service, $today_date);
	// $everton_total_unsub  = $unity_Obj->get_keyword_unsub_counts("EVERTON");
	// $everton_new_subs     = $unity_Obj->get_keyword_newsub_counts("EVERTON", $today_date);
	
	// $everton_billed       = $everton_delivery_sms * 0.20;

	// if(trim($dup_everton) > 0) 
	// {
	// 	// do incoming data update..............
	// 	foreach ($unity_Obj->get_service_for_update($today_date, "EVERTON") as $everton_key) 
	// 	{
	// 		$everton_daily_id    = $everton_key['id'];
	// 		$everton_keyword     = $everton_key['keyword'];
	// 		$everton_service     = $everton_key['service'];
	// 	}

	// 	$mot = $unity_Obj->update_new_values($everton_daily_id, $everton_keyword, $everton_service, $everton_sub, $everton_total_unsub, $everton_new_subs, $everton_sent_sms, $everton_delivery_sms, $today_date, $everton_billed);
	// 	// var_dump($mot);
	// } else 
	// {
	// 	// do incoming data update..............
	// 	$unity_Obj->do_data_summary_entry("EVERTON", $everton_service, $everton_sub, $everton_total_unsub, $everton_new_subs, $everton_sent_sms, $everton_delivery_sms, $everton_billed);
	// }







	// ###########################  JUVENTUS KEYWORD  ###########################
	// $today_date = date("Y-m-d");
	// $dup_juventus = $unity_Obj->check_duplicates($today_date, "JUVENTUS");

	// foreach ($unity_Obj->get_service_id("JUVENTUS") as $juventus) 
	// {
	// 	$juventus_service  = $juventus['service'];
	// }

	// $juventus_sub          = $unity_Obj->get_keyword_counts("JUVENTUS");
	// $juventus_sent_sms     = $unity_Obj->get_sms_content_counts($juventus_service, $today_date);
	// // var_dump($wisdom_sent_sms);
	// $juventus_delivery_sms = $unity_Obj->get_sms_delivery_counts($juventus_service, $today_date);
	// $juventus_total_unsub  = $unity_Obj->get_keyword_unsub_counts("JUVENTUS");
	// $juventus_new_subs     = $unity_Obj->get_keyword_newsub_counts("JUVENTUS", $today_date);
	
	// $juventus_billed       = $juventus_delivery_sms * 0.20;

	// if(trim($dup_juventus) > 0) 
	// {
	// 	// do incoming data update..............
	// 	foreach ($unity_Obj->get_service_for_update($today_date, "JUVENTUS") as $juventus_key) 
	// 	{
	// 		$juventus_daily_id    = $juventus_key['id'];
	// 		$juventus_keyword     = $juventus_key['keyword'];
	// 		$juventus_service     = $juventus_key['service'];
	// 	}

	// 	$mot = $unity_Obj->update_new_values($juventus_daily_id, $juventus_keyword, $juventus_service, $juventus_sub, $juventus_total_unsub, $juventus_new_subs, $juventus_sent_sms, $juventus_delivery_sms, $today_date, $juventus_billed);
	// 	// var_dump($mot);
	// } else 
	// {
	// 	// do incoming data update..............
	// 	$unity_Obj->do_data_summary_entry("JUVENTUS", $juventus_service, $juventus_sub, $juventus_total_unsub, $juventus_new_subs, $juventus_sent_sms, $juventus_delivery_sms, $juventus_billed);
	// }








	// ###########################  AFCON KEYWORD  ###########################
	// $today_date = date("Y-m-d");
	// $dup_afcon = $unity_Obj->check_duplicates($today_date, "AFCON");

	// foreach ($unity_Obj->get_service_id("AFCON") as $afcon) 
	// {
	// 	$afcon_service  = $afcon['service'];
	// }

	// $afcon_sub          = $unity_Obj->get_keyword_counts("AFCON");
	// $afcon_sent_sms     = $unity_Obj->get_sms_content_counts($afcon_service, $today_date);
	// // var_dump($wisdom_sent_sms);
	// $afcon_delivery_sms = $unity_Obj->get_sms_delivery_counts($afcon_service, $today_date);
	// $afcon_total_unsub  = $unity_Obj->get_keyword_unsub_counts("AFCON");
	// $afcon_new_subs     = $unity_Obj->get_keyword_newsub_counts("AFCON", $today_date);
	
	// $afcon_billed       = $afcon_delivery_sms * 0.20;

	// if(trim($dup_afcon) > 0) 
	// {
	// 	// do incoming data update..............
	// 	foreach ($unity_Obj->get_service_for_update($today_date, "AFCON") as $afcon_key) 
	// 	{
	// 		$afcon_daily_id    = $afcon_key['id'];
	// 		$afcon_keyword     = $afcon_key['keyword'];
	// 		$afcon_service     = $afcon_key['service'];
	// 	}

	// 	$mot = $unity_Obj->update_new_values($afcon_daily_id, $afcon_keyword, $afcon_service, $afcon_sub, $afcon_total_unsub, $afcon_new_subs, $afcon_sent_sms, $afcon_delivery_sms, $today_date, $afcon_billed);
	// 	// var_dump($mot);
	// } else 
	// {
	// 	// do incoming data update..............
	// 	$unity_Obj->do_data_summary_entry("AFCON", $afcon_service, $afcon_sub, $afcon_total_unsub, $afcon_new_subs, $afcon_sent_sms, $afcon_delivery_sms, $afcon_billed);
	// }








	// ###########################  ATLETICO MADRID KEYWORD  ###########################
	// $today_date = date("Y-m-d");
	// $dup_atletico = $unity_Obj->check_duplicates($today_date, "ATLETICO MADRID");

	// foreach ($unity_Obj->get_service_id("ATLETICO MADRID") as $atletico) 
	// {
	// 	$atletico_service  = $atletico['service'];
	// }

	// $atletico_sub          = $unity_Obj->get_keyword_counts("ATLETICO MADRID");
	// $atletico_sent_sms     = $unity_Obj->get_sms_content_counts($atletico_service, $today_date);
	// // var_dump($wisdom_sent_sms);
	// $atletico_delivery_sms = $unity_Obj->get_sms_delivery_counts($atletico_service, $today_date);
	// $atletico_total_unsub  = $unity_Obj->get_keyword_unsub_counts("ATLETICO MADRID");
	// $atletico_new_subs     = $unity_Obj->get_keyword_newsub_counts("ATLETICO MADRID", $today_date);
	
	// $atletico_billed       = $atletico_delivery_sms * 0.20;

	// if(trim($dup_atletico) > 0) 
	// {
	// 	// do incoming data update..............
	// 	foreach ($unity_Obj->get_service_for_update($today_date, "ATLETICO MADRID") as $atletico_key) 
	// 	{
	// 		$atletico_daily_id    = $atletico_key['id'];
	// 		$atletico_keyword     = $atletico_key['keyword'];
	// 		$atletico_service     = $atletico_key['service'];
	// 	}

	// 	$mot = $unity_Obj->update_new_values($atletico_daily_id, $atletico_keyword, $atletico_service, $atletico_sub, $atletico_total_unsub, $atletico_new_subs, $atletico_sent_sms, $atletico_delivery_sms, $today_date, $atletico_billed);
	// 	// var_dump($mot);
	// } else 
	// {
	// 	// do incoming data update..............
	// 	$unity_Obj->do_data_summary_entry("ATLETICO MADRID", $atletico_service, $atletico_sub, $atletico_total_unsub, $atletico_new_subs, $atletico_sent_sms, $atletico_delivery_sms, $atletico_billed);
	// }






	// ###########################  SOCCERGH KEYWORD  ###########################
	// $today_date = date("Y-m-d");
	// $dup_soccergh = $unity_Obj->check_duplicates($today_date, "SOCCERGH");

	// foreach ($unity_Obj->get_service_id("SOCCERGH") as $soccergh) 
	// {
	// 	$soccergh_service  = $soccergh['service'];
	// }

	// $soccergh_sub          = $unity_Obj->get_keyword_counts("SOCCERGH");
	// $soccergh_sent_sms     = $unity_Obj->get_sms_content_counts($soccergh_service, $today_date);

	// $soccergh_delivery_sms = $unity_Obj->get_sms_delivery_counts($soccergh_service, $today_date);
	// $soccergh_total_unsub  = $unity_Obj->get_keyword_unsub_counts("SOCCERGH");
	// $soccergh_new_subs     = $unity_Obj->get_keyword_newsub_counts("SOCCERGH", $today_date);

	// $soccergh_billed       = $soccergh_delivery_sms * 0.20;

	// if(trim($dup_soccergh) > 0) 
	// {
	// 	// do incoming data update..............
	// 	foreach ($unity_Obj->get_service_for_update($today_date, "SOCCERGH") as $soccergh_key) 
	// 	{
	// 		$soccergh_daily_id    = $soccergh_key['id'];
	// 		$soccergh_keyword     = $soccergh_key['keyword'];
	// 		$soccergh_service     = $soccergh_key['service'];
	// 	}

	// 	$unity_Obj->update_new_values($soccergh_daily_id, $soccergh_keyword, $soccergh_service, $soccergh_sub, $soccergh_total_unsub, $soccergh_new_subs, $soccergh_sent_sms, $soccergh_delivery_sms, $today_date, $soccergh_billed);
	// 	// var_dump($mot);
	// } else 
	// {
	// 	// do incoming data update..............
	// 	$unity_Obj->do_data_summary_entry("SOCCERGH", $soccergh_service, $soccergh_sub, $soccergh_total_unsub, $soccergh_new_subs, $soccergh_sent_sms, $soccergh_delivery_sms, $soccergh_billed);
	// }







	// ###########################  GFA KEYWORD  ###########################
	// $today_date = date("Y-m-d");
	// $dup_gfa = $unity_Obj->check_duplicates($today_date, "GFA");

	// foreach ($unity_Obj->get_service_id("GFA") as $gfa) 
	// {
	// 	$gfa_service  = $gfa['service'];
	// }

	// $gfa_sub          = $unity_Obj->get_keyword_counts("GFA");
	// $gfa_sent_sms     = $unity_Obj->get_sms_content_counts($gfa_service, $today_date);
	
	// $gfa_delivery_sms = $unity_Obj->get_sms_delivery_counts($gfa_service, $today_date);
	// $gfa_total_unsub  = $unity_Obj->get_keyword_unsub_counts("GFA");
	// $gfa_new_subs     = $unity_Obj->get_keyword_newsub_counts("GFA", $today_date);

	// $gfa_billed       = $gfa_delivery_sms * 0.20;

	// if(trim($dup_gfa) > 0) 
	// {
	// 	// do incoming data update..............
	// 	foreach ($unity_Obj->get_service_for_update($today_date, "GFA") as $gfa_key) 
	// 	{
	// 		$gfa_daily_id    = $gfa_key['id'];
	// 		$gfa_keyword     = $gfa_key['keyword'];
	// 		$gfa_service     = $gfa_key['service'];
	// 	}

	// 	$mot = $unity_Obj->update_new_values($gfa_daily_id, $gfa_keyword, $gfa_service, $gfa_sub, $gfa_total_unsub, $gfa_new_subs, $gfa_sent_sms, $gfa_delivery_sms, $today_date, $gfa_billed);
	// 	// var_dump($mot);
	// } else 
	// {
	// 	// do incoming data update..............
	// 	$unity_Obj->do_data_summary_entry("GFA", $gfa_service, $gfa_sub, $gfa_total_unsub, $gfa_new_subs, $gfa_sent_sms, $gfa_delivery_sms, $gfa_billed);
	// }








	// ###########################  REAL MADRID KEYWORD  ###########################
	// $today_date = date("Y-m-d");
	// $dup_madrid = $unity_Obj->check_duplicates($today_date, "REAL MADRID");

	// foreach ($unity_Obj->get_service_id("REAL MADRID") as $madrid) 
	// {
	// 	$madrid_service  = $madrid['service'];
	// }

	// $madrid_sub          = $unity_Obj->get_keyword_counts("REAL MADRID");
	// $madrid_sent_sms     = $unity_Obj->get_sms_content_counts($madrid_service, $today_date);

	// $madrid_delivery_sms = $unity_Obj->get_sms_delivery_counts($madrid_service, $today_date);
	// $madrid_total_unsub  = $unity_Obj->get_keyword_unsub_counts("REAL MADRID");
	// $madrid_new_subs     = $unity_Obj->get_keyword_newsub_counts("REAL MADRID", $today_date);

	// $madrid_billed       = $madrid_delivery_sms * 0.20;

	// if(trim($dup_madrid) > 0) 
	// {
	// 	// do incoming data update..............
	// 	foreach ($unity_Obj->get_service_for_update($today_date, "REAL MADRID") as $madrid_key) 
	// 	{
	// 		$madrid_daily_id    = $madrid_key['id'];
	// 		$madrid_keyword     = $madrid_key['keyword'];
	// 		$madrid_service     = $madrid_key['service'];
	// 	}

	// 	$mot = $unity_Obj->update_new_values($madrid_daily_id, $madrid_keyword, $madrid_service, $madrid_sub, $madrid_total_unsub, $madrid_new_subs, $madrid_sent_sms, $madrid_delivery_sms, $today_date, $madrid_billed);
	// 	// var_dump($mot);
	// } else 
	// {
	// 	// do incoming data update..............
	// 	$unity_Obj->do_data_summary_entry("REAL MADRID", $madrid_service, $madrid_sub, $madrid_total_unsub, $madrid_new_subs, $madrid_sent_sms, $madrid_delivery_sms, $madrid_billed);
	// }





	// ###########################  FABU KEYWORD  ###########################
	// $today_date = date("Y-m-d");
	// $dup_fabu = $unity_Obj->check_duplicates($today_date, "FABU");

	// foreach ($unity_Obj->get_service_id("FABU") as $fabu) 
	// {
	// 	$fabu_service  = $fabu['service'];
	// }

	// $fabu_sub          = $unity_Obj->get_keyword_counts("FABU");
	// $fabu_sent_sms     = $unity_Obj->get_sms_content_counts($fabu_service, $today_date);
	
	// $fabu_delivery_sms = $unity_Obj->get_sms_delivery_counts($fabu_service, $today_date);
	// $fabu_total_unsub  = $unity_Obj->get_keyword_unsub_counts("FABU");
	// $fabu_new_subs     = $unity_Obj->get_keyword_newsub_counts("FABU", $today_date);

	// $fabu_billed       = $fabu_delivery_sms * 0.20;

	// if(trim($dup_fabu) > 0) 
	// {
	// 	// do incoming data update..............
	// 	foreach ($unity_Obj->get_service_for_update($today_date, "FABU") as $fabu_key) 
	// 	{
	// 		$fabu_daily_id    = $fabu_key['id'];
	// 		$fabu_keyword     = $fabu_key['keyword'];
	// 		$fabu_service     = $fabu_key['service'];
	// 	}

	// 	$mot = $unity_Obj->update_new_values($fabu_daily_id, $fabu_keyword, $fabu_service, $fabu_sub, $fabu_total_unsub, $fabu_new_subs, $fabu_sent_sms, $fabu_delivery_sms, $today_date, $fabu_billed);
	// 	// var_dump($mot);
	// } else 
	// {
	// 	// do incoming data update..............
	// 	$unity_Obj->do_data_summary_entry("FABU", $fabu_service, $fabu_sub, $fabu_total_unsub, $fabu_new_subs, $fabu_sent_sms, $fabu_delivery_sms, $fabu_billed);
	// }






	// ###########################  MANCITY KEYWORD  ###########################
	// $today_date = date("Y-m-d");
	// $dup_mancity = $unity_Obj->check_duplicates($today_date, "MANCITY");

	// foreach ($unity_Obj->get_service_id("MANCITY") as $mancity) 
	// {
	// 	$mancity_service  = $mancity['service'];
	// }

	// $mancity_sub          = $unity_Obj->get_keyword_counts("MANCITY");
	// $mancity_sent_sms     = $unity_Obj->get_sms_content_counts($mancity_service, $today_date);
	// // var_dump($wisdom_sent_sms);
	// $mancity_delivery_sms = $unity_Obj->get_sms_delivery_counts($mancity_service, $today_date);
	// $mancity_total_unsub  = $unity_Obj->get_keyword_unsub_counts("MANCITY");
	// $mancity_new_subs     = $unity_Obj->get_keyword_newsub_counts("MANCITY", $today_date);

	// $mancity_billed       = $mancity_delivery_sms * 0.20;

	// if(trim($dup_mancity) > 0) 
	// {
	// 	// do incoming data update..............
	// 	foreach ($unity_Obj->get_service_for_update($today_date, "MANCITY") as $mancity_key) 
	// 	{
	// 		$mancity_daily_id    = $mancity_key['id'];
	// 		$mancity_keyword     = $mancity_key['keyword'];
	// 		$mancity_service     = $mancity_key['service'];
	// 	}

	// 	$mot = $unity_Obj->update_new_values($mancity_daily_id, $mancity_keyword, $mancity_service, $mancity_sub, $mancity_total_unsub, $mancity_new_subs, $mancity_sent_sms, $mancity_delivery_sms, $today_date, $mancity_billed);
	// 	// var_dump($mot);
	// } else 
	// {
	// 	// do incoming data update..............
	// 	$unity_Obj->do_data_summary_entry("MANCITY", $mancity_service, $mancity_sub, $mancity_total_unsub, $mancity_new_subs, $mancity_sent_sms, $mancity_delivery_sms, $mancity_billed);
	// }









	// ###########################  MANU KEYWORD  ###########################
	// $today_date = date("Y-m-d");
	// $dup_manu = $unity_Obj->check_duplicates($today_date, "MANU");

	// foreach ($unity_Obj->get_service_id("MANU") as $manu) 
	// {
	// 	$manu_service  = $manu['service'];
	// }

	// $manu_sub          = $unity_Obj->get_keyword_counts("MANU");
	// $manu_sent_sms     = $unity_Obj->get_sms_content_counts($manu_service, $today_date);

	// $manu_delivery_sms = $unity_Obj->get_sms_delivery_counts($manu_service, $today_date);
	// $manu_total_unsub  = $unity_Obj->get_keyword_unsub_counts("MANU");
	// $manu_new_subs     = $unity_Obj->get_keyword_newsub_counts("MANU", $today_date);

	// $manu_billed       = $manu_delivery_sms * 0.20;

	// if(trim($dup_manu) > 0) 
	// {
	// 	// do incoming data update..............
	// 	foreach ($unity_Obj->get_service_for_update($today_date, "MANU") as $manu_key) 
	// 	{
	// 		$manu_daily_id    = $manu_key['id'];
	// 		$manu_keyword     = $manu_key['keyword'];
	// 		$manu_service     = $manu_key['service'];
	// 	}

	// 	$mot = $unity_Obj->update_new_values($manu_daily_id, $manu_keyword, $manu_service, $manu_sub, $manu_total_unsub, $manu_new_subs, $manu_sent_sms, $manu_delivery_sms, $today_date, $manu_billed);
	// 	// var_dump($mot);
	// } else 
	// {
	// 	// do incoming data update..............
	// 	$unity_Obj->do_data_summary_entry("MANU", $manu_service, $manu_sub, $manu_total_unsub, $manu_new_subs, $manu_sent_sms, $manu_delivery_sms, $manu_billed);
	// }







	




	// ###########################  LIVERPOOL KEYWORD  ###########################
	// $today_date = date("Y-m-d");
	// $dup_liverpool = $unity_Obj->check_duplicates($today_date, "LIVERPOOL");

	// foreach ($unity_Obj->get_service_id("LIVERPOOL") as $liverpool) 
	// {
	// 	$liverpool_service  = $liverpool['service'];
	// }

	// $liverpool_sub          = $unity_Obj->get_keyword_counts("LIVERPOOL");
	// $liverpool_sent_sms     = $unity_Obj->get_sms_content_counts($liverpool_service, $today_date);

	// $liverpool_delivery_sms = $unity_Obj->get_sms_delivery_counts($liverpool_service, $today_date);
	// $liverpool_total_unsub  = $unity_Obj->get_keyword_unsub_counts("LIVERPOOL");
	// $liverpool_new_subs     = $unity_Obj->get_keyword_newsub_counts("LIVERPOOL", $today_date);

	// $liverpool_billed       = $liverpool_delivery_sms * 0.20;

	// if(trim($dup_liverpool) > 0) 
	// {
	// 	// do incoming data update..............
	// 	foreach ($unity_Obj->get_service_for_update($today_date, "LIVERPOOL") as $liverpool_key) 
	// 	{
	// 		$liverpool_daily_id    = $liverpool_key['id'];
	// 		$liverpool_keyword     = $liverpool_key['keyword'];
	// 		$liverpool_service     = $liverpool_key['service'];
	// 	}

	// 	$mot = $unity_Obj->update_new_values($liverpool_daily_id, $liverpool_keyword, $liverpool_service, $liverpool_sub, $liverpool_total_unsub, $liverpool_new_subs, $liverpool_sent_sms, $liverpool_delivery_sms, $today_date, $liverpool_billed);
	// 	// var_dump($mot);
	// } else 
	// {
	// 	// do incoming data update..............
	// 	$unity_Obj->do_data_summary_entry("LIVERPOOL", $liverpool_service, $liverpool_sub, $liverpool_total_unsub, $liverpool_new_subs, $liverpool_sent_sms, $liverpool_delivery_sms, $liverpool_billed);
	// }









	// ###########################  ARSENAL KEYWORD  ###########################
	// $today_date = date("Y-m-d");
	// $dup_arsenal = $unity_Obj->check_duplicates($today_date, "ARSENAL");

	// foreach ($unity_Obj->get_service_id("ARSENAL") as $arsenal) 
	// {
	// 	$arsenal_service  = $arsenal['service'];
	// }

	// $arsenal_sub          = $unity_Obj->get_keyword_counts("ARSENAL");
	// $arsenal_sent_sms     = $unity_Obj->get_sms_content_counts($arsenal_service, $today_date);

	// $arsenal_delivery_sms = $unity_Obj->get_sms_delivery_counts($arsenal_service, $today_date);
	// $arsenal_total_unsub  = $unity_Obj->get_keyword_unsub_counts("ARSENAL");
	// $arsenal_new_subs     = $unity_Obj->get_keyword_newsub_counts("ARSENAL", $today_date);

	// $arsenal_billed       = $arsenal_delivery_sms * 0.20;

	// if(trim($dup_arsenal) > 0) 
	// {
	// 	// do incoming data update..............
	// 	foreach ($unity_Obj->get_service_for_update($today_date, "ARSENAL") as $arsenal_key) 
	// 	{
	// 		$arsenal_daily_id    = $arsenal_key['id'];
	// 		$arsenal_keyword     = $arsenal_key['keyword'];
	// 		$arsenal_service     = $arsenal_key['service'];
	// 	}

	// 	$mot = $unity_Obj->update_new_values($arsenal_daily_id, $arsenal_keyword, $arsenal_service, $arsenal_sub, $arsenal_total_unsub, $arsenal_new_subs, $arsenal_sent_sms, $arsenal_delivery_sms, $today_date, $arsenal_billed);
	// 	// var_dump($mot);
	// } else 
	// {
	// 	// do incoming data update..............
	// 	$unity_Obj->do_data_summary_entry("ARSENAL", $arsenal_service, $arsenal_sub, $arsenal_total_unsub, $arsenal_new_subs, $arsenal_sent_sms, $arsenal_delivery_sms, $arsenal_billed);
	// }










	// ###########################  BARCELONA KEYWORD  ###########################
	// $today_date = date("Y-m-d");
	// $dup_barcelona = $unity_Obj->check_duplicates($today_date, "BARCELONA");

	// foreach ($unity_Obj->get_service_id("BARCELONA") as $barcelona) 
	// {
	// 	$barcelona_service  = $barcelona['service'];
	// }

	// $barcelona_sub          = $unity_Obj->get_keyword_counts("BARCELONA");
	// $barcelona_sent_sms     = $unity_Obj->get_sms_content_counts($barcelona_service, $today_date);
	// // var_dump($wisdom_sent_sms);
	// $barcelona_delivery_sms = $unity_Obj->get_sms_delivery_counts($barcelona_service, $today_date);
	// $barcelona_total_unsub  = $unity_Obj->get_keyword_unsub_counts("BARCELONA");
	// $barcelona_new_subs     = $unity_Obj->get_keyword_newsub_counts("BARCELONA", $today_date);

	// $barcelona_billed       = $barcelona_delivery_sms * 0.20;

	// if(trim($dup_barcelona) > 0) 
	// {
	// 	// do incoming data update..............
	// 	foreach ($unity_Obj->get_service_for_update($today_date, "BARCELONA") as $barcelona_key) 
	// 	{
	// 		$barcelona_daily_id    = $barcelona_key['id'];
	// 		$barcelona_keyword     = $barcelona_key['keyword'];
	// 		$barcelona_service     = $barcelona_key['service'];
	// 	}

	// 	$mot = $unity_Obj->update_new_values($barcelona_daily_id, $barcelona_keyword, $barcelona_service, $barcelona_sub, $barcelona_total_unsub, $barcelona_new_subs, $barcelona_sent_sms, $barcelona_delivery_sms, $today_date, $barcelona_billed);
	// 	// var_dump($mot);
	// } else 
	// {
	// 	// do incoming data update..............
	// 	$unity_Obj->do_data_summary_entry("BARCELONA", $barcelona_service, $barcelona_sub, $barcelona_total_unsub, $barcelona_new_subs, $barcelona_sent_sms, $barcelona_delivery_sms, $barcelona_billed);
	// }






	// ###########################  CHELSEA KEYWORD  ###########################
	// $today_date = date("Y-m-d");
	// $dup_chelsea = $unity_Obj->check_duplicates($today_date, "CHELSEA");

	// foreach ($unity_Obj->get_service_id("CHELSEA") as $chelsea) 
	// {
	// 	$chelsea_service  = $chelsea['service'];
	// }

	// $chelsea_sub          = $unity_Obj->get_keyword_counts("CHELSEA");
	// $chelsea_sent_sms     = $unity_Obj->get_sms_content_counts($chelsea_service, $today_date);
	
	// $chelsea_delivery_sms = $unity_Obj->get_sms_delivery_counts($chelsea_service, $today_date);
	// $chelsea_total_unsub  = $unity_Obj->get_keyword_unsub_counts("CHELSEA");
	// $chelsea_new_subs     = $unity_Obj->get_keyword_newsub_counts("CHELSEA", $today_date);

	// $chelsea_billed       = $chelsea_delivery_sms * 0.20;

	// if(trim($dup_chelsea) > 0) 
	// {
	// 	// do incoming data update..............
	// 	foreach ($unity_Obj->get_service_for_update($today_date, "CHELSEA") as $chelsea_key) 
	// 	{
	// 		$chelsea_daily_id    = $chelsea_key['id'];
	// 		$chelsea_keyword     = $chelsea_key['keyword'];
	// 		$chelsea_service     = $chelsea_key['service'];
	// 	}

	// 	$mot = $unity_Obj->update_new_values($chelsea_daily_id, $chelsea_keyword, $chelsea_service, $chelsea_sub, $chelsea_total_unsub, $chelsea_new_subs, $chelsea_sent_sms, $chelsea_delivery_sms, $today_date, $chelsea_billed);
	// 	// var_dump($mot);
	// } else 
	// {
	// 	// do incoming data update..............
	// 	$unity_Obj->do_data_summary_entry("CHELSEA", $chelsea_service, $chelsea_sub, $chelsea_total_unsub, $chelsea_new_subs, $chelsea_sent_sms, $chelsea_delivery_sms, $chelsea_billed);
	// }




















	//TEMPLATE FOR ANY OTHER KEYWORD................................

	###########################  NB KEYWORD  ###########################

	// $dup_nb = $unity_Obj->check_duplicates($today_date, "NB");

	// foreach ($unity_Obj->get_service_id("NB") as $nb) 
	// {
	// 	$nb_service  = $nb['service'];
	// }

	// $nb_sub          = $unity_Obj->get_keyword_counts("NB");
	// $nb_sent_sms     = $unity_Obj->get_sms_content_counts($nb_service, $today_date);
	// // var_dump($wisdom_sent_sms);
	// $nb_delivery_sms = $unity_Obj->get_sms_delivery_counts($nb_service, $today_date);
	// $nb_total_unsub  = $unity_Obj->get_keyword_unsub_counts("NB");
	// $nb_new_subs     = $unity_Obj->get_keyword_newsub_counts("NB", $today_date);
	
	//$nb_billed       = $nb_delivery_sms * 0.20;

	// if(trim($dup_nb) > 0) 
	// {
	// 	// do incoming data update..............
	// 	foreach ($unity_Obj->get_service_for_update($today_date, "NB") as $nb_key) 
	// 	{
	// 		$nb_daily_id    = $nb_key['id'];
	// 		$nb_keyword     = $nb_key['keyword'];
	// 		$nb_service     = $nb_key['service'];
	// 	}

	// 	$mot = $unity_Obj->update_new_values($nb_daily_id, $nb_keyword, $nb_service, $nb_sub, $nb_total_unsub, $nb_new_subs, $nb_sent_sms, $nb_delivery_sms, $today_date, $nb_billed);
	// 	// var_dump($mot);
	// } else 
	// {
	// 	// do incoming data update..............
	// 	$unity_Obj->do_data_summary_entry("NB", $nb_service, $nb_sub, $nb_total_unsub, $nb_new_subs, $nb_sent_sms, $nb_delivery_sms, $nb_billed);
	// }







						// MCC INHOUSE.........

	// 						// EDSON


	// ###########################  DEVOTION KEYWORD  ###########################
	// $today_date = date("Y-m-d");
	// $dup_devotion = $unity_Obj->check_duplicates($today_date, "DEVOTION");

	// foreach ($unity_Obj->get_service_id("DEVOTION") as $devotion) 
	// {
	// 	$devotion_service  = $devotion['service'];
	// }

	// $devotion_sub          = $unity_Obj->get_keyword_counts("DEVOTION");
	// $devotion_sent_sms     = $unity_Obj->get_sms_content_counts($devotion_service, $today_date);
	
	// $devotion_delivery_sms = $unity_Obj->get_sms_delivery_counts($devotion_service, $today_date);
	// $devotion_total_unsub  = $unity_Obj->get_keyword_unsub_counts("DEVOTION");
	// $devotion_new_subs     = $unity_Obj->get_keyword_newsub_counts("DEVOTION", $today_date);

	// $devotion_billed       = $devotion_delivery_sms * 0.20;


	// if(trim($dup_devotion) > 0) 
	// {
	// 	// do incoming data update..............
	// 	foreach ($unity_Obj->get_service_for_update($today_date, "DEVOTION") as $devotion_key) 
	// 	{
	// 		$devotion_daily_id    = $devotion_key['id'];
	// 		$devotion_keyword     = $devotion_key['keyword'];
	// 		$devotion_service     = $devotion_key['service'];
	// 	}

	// 	$mot = $unity_Obj->update_new_values($devotion_daily_id, $devotion_keyword, $devotion_service, $devotion_sub, $devotion_total_unsub, $devotion_new_subs, $devotion_sent_sms, $devotion_delivery_sms, $today_date, $devotion_billed);
	// 	// var_dump($mot);
	// } else 
	// {
	// 	// do incoming data update..............
	// 	$unity_Obj->do_data_summary_entry("DEVOTION", $devotion_service, $devotion_sub, $devotion_total_unsub, $devotion_new_subs, $devotion_sent_sms, $devotion_delivery_sms, $devotion_billed);
	// }








	// ###########################  INSPIRER KEYWORD  ###########################
	// $today_date = date("Y-m-d");
	// $dup_inspirer = $unity_Obj->check_duplicates($today_date, "INSPIRER");

	// foreach ($unity_Obj->get_service_id("INSPIRER") as $inspirer) 
	// {
	// 	$inspirer_service  = $inspirer['service'];
	// }

	// $inspirer_sub          = $unity_Obj->get_keyword_counts("INSPIRER");
	// $inspirer_sent_sms     = $unity_Obj->get_sms_content_counts($inspirer_service, $today_date);

	// $inspirer_delivery_sms = $unity_Obj->get_sms_delivery_counts($inspirer_service, $today_date);
	// $inspirer_total_unsub  = $unity_Obj->get_keyword_unsub_counts("INSPIRER");
	// $inspirer_new_subs     = $unity_Obj->get_keyword_newsub_counts("INSPIRER", $today_date);

	// $inspirer_billed       = $inspirer_delivery_sms * 0.20;


	// if(trim($dup_inspirer) > 0) 
	// {
	// 	// do incoming data update..............
	// 	foreach ($unity_Obj->get_service_for_update($today_date, "INSPIRER") as $inspirer_key) 
	// 	{
	// 		$inspirer_daily_id    = $inspirer_key['id'];
	// 		$inspirer_keyword     = $inspirer_key['keyword'];
	// 		$inspirer_service     = $inspirer_key['service'];
	// 	}

	// 	$mot = $unity_Obj->update_new_values($inspirer_daily_id, $inspirer_keyword, $inspirer_service, $inspirer_sub, $inspirer_total_unsub, $inspirer_new_subs, $inspirer_sent_sms, $inspirer_delivery_sms, $today_date, $inspirer_billed);
	// 	// var_dump($mot);
	// } else 
	// {
	// 	// do incoming data update..............
	// 	$unity_Obj->do_data_summary_entry("INSPIRER", $inspirer_service, $inspirer_sub, $inspirer_total_unsub, $inspirer_new_subs, $inspirer_sent_sms, $inspirer_delivery_sms, $inspirer_billed);
	// }








	// ###########################  HOROSCOPE KEYWORD  ###########################
	// $today_date = date("Y-m-d");
	// $dup_horoscope = $unity_Obj->check_duplicates($today_date, "HOROSCOPE");

	// foreach ($unity_Obj->get_service_id("HOROSCOPE") as $horoscope) 
	// {
	// 	$horoscope_service  = $horoscope['service'];
	// }

	// $horoscope_sub          = $unity_Obj->get_keyword_counts("HOROSCOPE");
	// $horoscope_sent_sms     = $unity_Obj->get_sms_content_counts($horoscope_service, $today_date);

	// $horoscope_delivery_sms = $unity_Obj->get_sms_delivery_counts($horoscope_service, $today_date);
	// $horoscope_total_unsub  = $unity_Obj->get_keyword_unsub_counts("HOROSCOPE");
	// $horoscope_new_subs     = $unity_Obj->get_keyword_newsub_counts("HOROSCOPE", $today_date);

	// $horoscope_billed       = $horoscope_delivery_sms * 0.20;

	// if(trim($dup_horoscope) > 0) 
	// {
	// 	// do incoming data update..............
	// 	foreach ($unity_Obj->get_service_for_update($today_date, "HOROSCOPE") as $horoscope_key) 
	// 	{
	// 		$horoscope_daily_id    = $horoscope_key['id'];
	// 		$horoscope_keyword     = $horoscope_key['keyword'];
	// 		$horoscope_service     = $horoscope_key['service'];
	// 	}

	// 	$mot = $unity_Obj->update_new_values($horoscope_daily_id, $horoscope_keyword, $horoscope_service, $horoscope_sub, $horoscope_total_unsub, $horoscope_new_subs, $horoscope_sent_sms, $horoscope_delivery_sms, $today_date, $horoscope_billed);
	// 	// var_dump($mot);
	// } else 
	// {
	// 	// do incoming data update..............
	// 	$unity_Obj->do_data_summary_entry("HOROSCOPE", $horoscope_service, $horoscope_sub, $horoscope_total_unsub, $horoscope_new_subs, $horoscope_sent_sms, $horoscope_delivery_sms, $horoscope_billed);
	// }





	// ###########################  LUVGUIDE KEYWORD  ###########################
	// $today_date = date("Y-m-d");
	// $dup_luvguide = $unity_Obj->check_duplicates($today_date, "LUVGUIDE");

	// foreach ($unity_Obj->get_service_id("LUVGUIDE") as $luvguide) 
	// {
	// 	$luvguide_service  = $luvguide['service'];
	// }

	// $luvguide_sub          = $unity_Obj->get_keyword_counts("LUVGUIDE");
	// $luvguide_sent_sms     = $unity_Obj->get_sms_content_counts($luvguide_service, $today_date);

	// $luvguide_delivery_sms = $unity_Obj->get_sms_delivery_counts($luvguide_service, $today_date);
	// $luvguide_total_unsub  = $unity_Obj->get_keyword_unsub_counts("LUVGUIDE");
	// $luvguide_new_subs     = $unity_Obj->get_keyword_newsub_counts("LUVGUIDE", $today_date);

	// $luvguide_billed       = $luvguide_delivery_sms * 0.20;


	// if(trim($dup_luvguide) > 0) 
	// {
	// 	// do incoming data update..............
	// 	foreach ($unity_Obj->get_service_for_update($today_date, "LUVGUIDE") as $luvguide_key) 
	// 	{
	// 		$luvguide_daily_id    = $luvguide_key['id'];
	// 		$luvguide_keyword     = $luvguide_key['keyword'];
	// 		$luvguide_service     = $luvguide_key['service'];
	// 	}

	// 	$mot = $unity_Obj->update_new_values($luvguide_daily_id, $luvguide_keyword, $luvguide_service, $luvguide_sub, $luvguide_total_unsub, $luvguide_new_subs, $luvguide_sent_sms, $luvguide_delivery_sms, $today_date, $luvguide_billed);
	// 	// var_dump($mot);
	// } else 
	// {
	// 	// do incoming data update..............
	// 	$unity_Obj->do_data_summary_entry("LUVGUIDE", $luvguide_service, $luvguide_sub, $luvguide_total_unsub, $luvguide_new_subs, $luvguide_sent_sms, $luvguide_delivery_sms, $luvguide_billed);
	// }









						// CORDIAL







	// ###########################  PRG KEYWORD  ###########################
	// $today_date = date("Y-m-d");
	// $dup_prg = $unity_Obj->check_duplicates($today_date, "PRG");

	// foreach ($unity_Obj->get_service_id("PRG") as $prg) 
	// {
	// 	$prg_service  = $prg['service'];
	// }

	// $prg_sub          = $unity_Obj->get_keyword_counts("PRG");
	// $prg_sent_sms     = $unity_Obj->get_sms_content_counts($prg_service, $today_date);
	// // var_dump($wisdom_sent_sms);
	// $prg_delivery_sms = $unity_Obj->get_sms_delivery_counts($prg_service, $today_date);
	// $prg_total_unsub  = $unity_Obj->get_keyword_unsub_counts("PRG");
	// $prg_new_subs     = $unity_Obj->get_keyword_newsub_counts("PRG", $today_date);

	// $prg_billed       = $prg_delivery_sms * 0.20;

	// if(trim($dup_prg) > 0) 
	// {
	// 	// do incoming data update..............
	// 	foreach ($unity_Obj->get_service_for_update($today_date, "PRG") as $prg_key) 
	// 	{
	// 		$prg_daily_id    = $prg_key['id'];
	// 		$prg_keyword     = $prg_key['keyword'];
	// 		$prg_service     = $prg_key['service'];
	// 	}

	// 	$mot = $unity_Obj->update_new_values($prg_daily_id, $prg_keyword, $prg_service, $prg_sub, $prg_total_unsub, $prg_new_subs, $prg_sent_sms, $prg_delivery_sms, $today_date, $prg_billed);
	// 	// var_dump($mot);
	// } else 
	// {
	// 	// do incoming data update..............
	// 	$unity_Obj->do_data_summary_entry("PRG", $prg_service, $prg_sub, $prg_total_unsub, $prg_new_subs, $prg_sent_sms, $prg_delivery_sms, $prg_billed);
	// }






	// // ###########################  SRH KEYWORD  ###########################
	// $today_date = date("Y-m-d");
	// $dup_srh = $unity_Obj->check_duplicates($today_date, "SRH");

	// foreach ($unity_Obj->get_service_id("SRH") as $srh) 
	// {
	// 	$srh_service  = $srh['service'];
	// }

	// $srh_sub          = $unity_Obj->get_keyword_counts("SRH");
	// $srh_sent_sms     = $unity_Obj->get_sms_content_counts($srh_service, $today_date);
	// // var_dump($wisdom_sent_sms);
	// $srh_delivery_sms = $unity_Obj->get_sms_delivery_counts($srh_service, $today_date);
	// $srh_total_unsub  = $unity_Obj->get_keyword_unsub_counts("SRH");
	// $srh_new_subs     = $unity_Obj->get_keyword_newsub_counts("SRH", $today_date);

	// $srh_billed       = $srh_delivery_sms * 0.20;

	// if(trim($dup_srh) > 0) 
	// {
	// 	// do incoming data update..............
	// 	foreach ($unity_Obj->get_service_for_update($today_date, "SRH") as $srh_key) 
	// 	{
	// 		$srh_daily_id    = $srh_key['id'];
	// 		$srh_keyword     = $srh_key['keyword'];
	// 		$srh_service     = $srh_key['service'];
	// 	}

	// 	$unity_Obj->update_new_values($srh_daily_id, $srh_keyword, $srh_service, $srh_sub, $srh_total_unsub, $srh_new_subs, $srh_sent_sms, $srh_delivery_sms, $today_date, $srh_billed);
	// 	// var_dump($mot);
	// } else 
	// {
	// 	// do incoming data update..............
	// 	$unity_Obj->do_data_summary_entry("SRH", $srh_service, $srh_sub, $srh_total_unsub, $srh_new_subs, $srh_sent_sms, $srh_delivery_sms, $srh_billed);
	// }






	// // ###########################  NB KEYWORD  ###########################
	// $today_date = date("Y-m-d");
	// $dup_nb = $unity_Obj->check_duplicates($today_date, "NB");

	// foreach ($unity_Obj->get_service_id("NB") as $nb) 
	// {
	// 	$nb_service  = $nb['service'];
	// }

	// $nb_sub          = $unity_Obj->get_keyword_counts("NB");
	// $nb_sent_sms     = $unity_Obj->get_sms_content_counts($nb_service, $today_date);

	// $nb_delivery_sms = $unity_Obj->get_sms_delivery_counts($nb_service, $today_date);
	// $nb_total_unsub  = $unity_Obj->get_keyword_unsub_counts("NB");
	// $nb_new_subs     = $unity_Obj->get_keyword_newsub_counts("NB", $today_date);

	// $nb_billed       = $nb_delivery_sms * 0.20;

	
	// if(trim($dup_nb) > 0) 
	// {
	// 	// do incoming data update..............
	// 	foreach ($unity_Obj->get_service_for_update($today_date, "NB") as $nb_key) 
	// 	{
	// 		$nb_daily_id    = $nb_key['id'];
	// 		$nb_keyword     = $nb_key['keyword'];
	// 		$nb_service     = $nb_key['service'];
	// 	}

	// 	$mot = $unity_Obj->update_new_values($nb_daily_id, $nb_keyword, $nb_service, $nb_sub, $nb_total_unsub, $nb_new_subs, $nb_sent_sms, $nb_delivery_sms, $today_date, $nb_billed);
	// 	// var_dump($mot);
	// } else 
	// {
	// 	// do incoming data update..............
	// 	$unity_Obj->do_data_summary_entry("NB", $nb_service, $nb_sub, $nb_total_unsub, $nb_new_subs, $nb_sent_sms, $nb_delivery_sms, $nb_billed);
	// }









	// ###########################  LSN KEYWORD  ###########################
	// $today_date = date("Y-m-d");
	// $dup_lsn = $unity_Obj->check_duplicates($today_date, "LSN");

	// foreach ($unity_Obj->get_service_id("LSN") as $lsn) 
	// {
	// 	$lsn_service  = $lsn['service'];
	// }

	// $lsn_sub          = $unity_Obj->get_keyword_counts("LSN");
	// $lsn_sent_sms     = $unity_Obj->get_sms_content_counts($lsn_service, $today_date);
	// // var_dump($wisdom_sent_sms);
	// $lsn_delivery_sms = $unity_Obj->get_sms_delivery_counts($lsn_service, $today_date);
	// $lsn_total_unsub  = $unity_Obj->get_keyword_unsub_counts("LSN");
	// $lsn_new_subs     = $unity_Obj->get_keyword_newsub_counts("LSN", $today_date);

	// $lsn_billed       = $lsn_delivery_sms * 0.20;

	
	// if(trim($dup_lsn) > 0) 
	// {
	// 	// do incoming data update..............
	// 	foreach ($unity_Obj->get_service_for_update($today_date, "LSN") as $lsn_key) 
	// 	{
	// 		$lsn_daily_id    = $lsn_key['id'];
	// 		$lsn_keyword     = $lsn_key['keyword'];
	// 		$lsn_service     = $lsn_key['service'];
	// 	}

	// 	$mot = $unity_Obj->update_new_values($lsn_daily_id, $lsn_keyword, $lsn_service, $lsn_sub, $lsn_total_unsub, $lsn_new_subs, $lsn_sent_sms, $lsn_delivery_sms, $today_date, $lsn_billed);
	// 	// var_dump($mot);
	// } else 
	// {
	// 	// do incoming data update..............
	// 	$unity_Obj->do_data_summary_entry("LSN", $lsn_service, $lsn_sub, $lsn_total_unsub, $lsn_new_subs, $lsn_sent_sms, $lsn_delivery_sms, $lsn_billed);
	// }










	// ###########################  NEWS KEYWORD  ###########################
	// $today_date = date("Y-m-d");
	// $dup_news = $unity_Obj->check_duplicates($today_date, "NEWS");

	// foreach ($unity_Obj->get_service_id("NEWS") as $news) 
	// {
	// 	$news_service  = $news['service'];
	// }

	// $news_sub          = $unity_Obj->get_keyword_counts("NEWS");
	// $news_sent_sms     = $unity_Obj->get_sms_content_counts($news_service, $today_date);
	// // var_dump($wisdom_sent_sms);
	// $news_delivery_sms = $unity_Obj->get_sms_delivery_counts($news_service, $today_date);
	// $news_total_unsub  = $unity_Obj->get_keyword_unsub_counts("NEWS");
	// $news_new_subs     = $unity_Obj->get_keyword_newsub_counts("NEWS", $today_date);

	// $news_billed       = $news_delivery_sms * 0.20;

	// if(trim($dup_news) > 0) 
	// {
	// 	// do incoming data update..............
	// 	foreach ($unity_Obj->get_service_for_update($today_date, "NEWS") as $news_key) 
	// 	{
	// 		$news_daily_id    = $news_key['id'];
	// 		$news_keyword     = $news_key['keyword'];
	// 		$news_service     = $news_key['service'];
	// 	}

	// 	$unity_Obj->update_new_values($news_daily_id, $news_keyword, $news_service, $news_sub, $news_total_unsub, $news_new_subs, $news_sent_sms, $news_delivery_sms, $today_date, $news_billed);
	// 	// var_dump($mot);
	// } else 
	// {
	// 	// do incoming data update..............
	// 	$unity_Obj->do_data_summary_entry("NEWS", $news_service, $news_sub, $news_total_unsub, $news_new_subs, $news_sent_sms, $news_delivery_sms, $news_billed);
	// }


































	#------------ TEMPLATE FOR USE,  DO NOT UNCOMMENT-------------------
	###########################  NB KEYWORD  ###########################

	// $dup_nb = $unity_Obj->check_duplicates($today_date, "NB");

	// foreach ($unity_Obj->get_service_id("NB") as $nb) 
	// {
	// 	$nb_service  = $nb['service'];
	// }

	// $nb_sub          = $unity_Obj->get_keyword_counts("NB");
	// $nb_sent_sms     = $unity_Obj->get_sms_content_counts($nb_service, $today_date);
	// // var_dump($wisdom_sent_sms);
	// $nb_delivery_sms = $unity_Obj->get_sms_delivery_counts($nb_service, $today_date);
	// $nb_total_unsub  = $unity_Obj->get_keyword_unsub_counts("NB");
	// $nb_new_subs     = $unity_Obj->get_keyword_newsub_counts("NB", $today_date);
	
	//$nb_billed       = $nb_delivery_sms * 0.20;

	// if(trim($dup_nb) > 0) 
	// {
	// 	// do incoming data update..............
	// 	foreach ($unity_Obj->get_service_for_update($today_date, "NB") as $nb_key) 
	// 	{
	// 		$nb_daily_id    = $nb_key['id'];
	// 		$nb_keyword     = $nb_key['keyword'];
	// 		$nb_service     = $nb_key['service'];
	// 	}

	// 	$mot = $unity_Obj->update_new_values($nb_daily_id, $nb_keyword, $nb_service, $nb_sub, $nb_total_unsub, $nb_new_subs, $nb_sent_sms, $nb_delivery_sms, $today_date, $nb_billed);
	// 	// var_dump($mot);
	// } else 
	// {
	// 	// do incoming data update..............
	// 	$unity_Obj->do_data_summary_entry("NB", $nb_service, $nb_sub, $nb_total_unsub, $nb_new_subs, $nb_sent_sms, $nb_delivery_sms, $nb_billed);
	// }
















} else {
	echo "not yet time to run this script, please....";
}
