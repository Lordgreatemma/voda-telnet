<?php 
$transmission_date = date("Y-m-d H:i");
echo $transmission_date;

$scheduledDate = date('Y-d-m H:i',strtotime($transmission_date));
echo $scheduledDate;

	//eei man... you don't understand wai...!
	$r = "Mason Greenwoods suspension earlier this season played a part in the break down in the clubs relationship with Jesse Lingard as he could not move to Newcastle";
	var_dump($r);
?>