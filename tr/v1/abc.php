<?php 
 $serverName = "192.168.193.254";
    $databaseName = "telnet_sdp"; #"";
    $databaseUser = "adri";
    $databasePassword = 'adRi@1234&5$HaW9(1&Mcc'; #"";

    $database = mysqli_connect($serverName, $databaseUser, $databasePassword, $databaseName);

    if (!$database) {
        die("unable to connect to database");
    }
    // else{
    // 	echo "connected";
    // }



    function formatNumber($user_number)
    {
    	$array_num = str_split($user_number);

        for($i = 1; $i <count($array_num) ; $i++)
        {        
            $myNew_value .= $array_num[$i];
        }
         
        $raw_number = ''. $myNew_value;
        return $raw_number;
    }
    $msisdn = "";
    $ids = "";

     $query = "SELECT id, msisdn FROM mt_subscribers WHERE serviceName = 'gfa' ORDER BY id ASC ";

        $result = mysqli_query($database, $query);

        if (mysqli_num_rows($result) > 0) 
        {
            while ($row = mysqli_fetch_assoc($result)) 
            {
            	$ids = $row['id'];
                $msisdn = $row['msisdn'];
      			var_dump($msisdn);
      			
                $user_number = formatNumber($msisdn);
      			// var_dump($user_number);

      			$updateUserQuery = "UPDATE mt_subscribers SET msisdn = '$user_number' WHERE id = '$ids' ";
   				 mysqli_query($database, $updateUserQuery);
            }

        }


        mysqli_close($database);

    // $updateUserQuery = "UPDATE mt_subscribers SET msisdn = '$user_number' WHERE id = '$ids' ";
    // mysqli_query($database, $updateUserQuery);

        echo "Done.";