<?php


	spl_autoload_register('myAutoloader');

	function myAutoloader($className)
	{
		$path = dirname(__DIR__) ."/classes/";
		$extension = ".php";
		$fullPath = $path.$className.$extension;

		if (file_exists($fullPath)) 
		{
			include_once $fullPath;
		}elseif (file_exists(dirname(__DIR__) ."/".$className.$extension)) {
			include_once dirname(__DIR__) ."/".$className.$extension;
		}else
		{
			include_once dirname(__DIR__) .$className.$extension;
		}
		
	}




	// spl_autoload_register(function($className){

	// 	$path = strtolower($className).".php";
	// 	if(file_exists($path)){
	// 		require_once($path);
	// 	}else{
	// 		echo "File $path is not found.";
	// 	}
	// })



?>