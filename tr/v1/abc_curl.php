<?php 
// https://mysmsinbox.com/telnet_sdp/tr/v1/send_content_wisdom.php
// curl --location --request GET -k 'https://mysmsinbox.com/telnet_sdp/tr/v1/send_content_wisdom.php' \


	$url = "https://mysmsinbox.com/telnet_sdp/tr/v1/send_content_wisdom.php";
    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_RETURNTRANSFER => 1,
        CURLOPT_URL => $url
    ));
   
    $result = curl_exec($curl);
    $error = curl_error($curl);

    if ($error) {
        echo "There was an: ". $error;
    } 
    // echo json_encode($result);
    curl_close($curl);

    echo $result ;
?>