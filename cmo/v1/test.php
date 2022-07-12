<?php 
header('Content-Type: application/json; charset=utf-8');
include_once 'includes/autoloader.inc.php';


         

$data1 = file_get_contents("php://input");
$data = json_decode($data1, 1);
if(trim($data['rootErrorCode']) && trim($data['errorMsg']) && trim($data['errorCode']))
{
	echo "Error";
}else{
	echo "No error";
}

 ?>