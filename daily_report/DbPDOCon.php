<?php

	$host = '192.168.193.254';
    $db = 'telnet_sdp';
    $user = 'adri';
    $pass = 'adRi@1234&5$HaW9(1&Mcc';
    $charset = 'utf8mb4';
    $db_sqlCon = NULL;

    $dsn = "mysql:host=$host;dbname=$db";
    $options = array(
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false
    );

    try 
    {
        $db_sqlCon = new PDO($dsn, $user, $pass, $options);
        if($db_sqlCon) 
        {
            // verify pgsql driver is activated
            if (!defined('PDO::ATTR_DRIVER_NAME')) 
            {
              echo 'PDO unavailable <br>';
            }
            echo "Connected to $db <br>";
            return $db_sqlCon;
        } else {
            echo "No connection to $db <br>";
        }
    } catch(\PDOException $e) {
        throw new \PDOException($e->getMessage(), (int)$e->getCode());
    }