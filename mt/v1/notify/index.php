<?php
header('Content-Type: application/json; charset=utf-8');

// include_once 'includes/autoloader.inc.php';


// $dataObj = new DataAuths();


$response = file_get_contents("php://input");
file_put_contents("logs/data.log", $response);
$result = json_decode($response, true);


// 		// ob_start();
//   //       var_dump($GLOBALS);
//   //       $data = ob_get_clean();

        // $createdTime = date("Y-m-d H:i:s");
        // $file = fopen("logs/delivery.log", 'a');
        // $current = "REQUEST $response\n";
        // fwrite($file, "$current");
        // fclose($file);

// // echo $response;


//   //       $response     = json_decode(@file_get_contents('php://input')); 
//   //       // $data = json_decode($response);
// 		// file_put_contents('logs/con_query.log', print_r($response, true));


// // echo $result['outboundSMSMessageRequest']['deliveryInfoList']['deliveryInfo']['deliveryStatus'];


// foreach ($result['outboundSMSMessageRequest']['deliveryInfoList']['deliveryInfo'] as $data) {
//  // $sav =  $dataObj->logContentDeliveryResponse($result['outboundSMSMessageRequest']['address'], $result['outboundSMSMessageRequest']['shortCode'], $result['outboundSMSMessageRequest']['clientCorrelator'], $result['outboundSMSMessageRequest']['senderName'], $data['deliveryStatus'], $data['requestId']);
// file_put_contents('logs/respo.log', print_r($data, true));
//  // var_dump($sav);
// }



// {
//     "outboundSMSMessageRequest": {
//         "address": [
//             "233207743783"
//         ],
//         "senderAddress": "1212",
//         "outboundSMSTextMessage": {
//             "message": "Another test triggered by API-M. Sorry for the inconvenience. TEST"
//         },
//         "receiptRequest": {
//             "notifyURL": "http://127.0.0.1:8080/dummy_delivery_notification",
//             "callbackData": "some-data-useful-to-the-requester"
//         },
//         "clientCorrelator": "123456",
//         "senderName": "Telenity",
//         "deliveryInfoList": {
//             "deliveryInfo": [
//                 {
//                     "address": "233207743783",
//                     "deliveryStatus": "DeliveredToNetwork",
//                     "requestId": "309515482"
//                 }
//             ]
//         }
//     }
// }



// {"outboundSMSMessageRequest":{
//         "address":["233207743783"],"senderAddress":"1212","outboundSMSTextMessage":{"message":"Another test triggered by API-M. Sorry for the inconvenience. TEST"},"receiptRequest":{"notifyURL":"http://127.0.0.1:8080/dummy_delivery_notification","callbackData":"some-data-useful-to-the-requester"},"clientCorrelator":"123456","senderName":"Telenity",
//         "deliveryInfoList":{
//             "deliveryInfo":[
//                 {
//                     "address":"233207743783",
//                     "deliveryStatus":"DeliveredToNetwork",
//                     "requestId":"309515482"
//                 }
//             ]
//         }
//     }
// }