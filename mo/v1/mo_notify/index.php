<?php 
header('Content-Type: application/json; charset=utf-8');
$data1 = file_get_contents("php://input");

$data = json_decode($data1, 1);

// file_put_contents('logs/request.log', print_r($data, true));
$createdTime = date("Y-m-d");
$file = fopen("responseData-$createdTime.log", 'a');
$current = "[  \n$data1\n  ];\n";
fwrite($file, "$current");
fclose($file);
?>