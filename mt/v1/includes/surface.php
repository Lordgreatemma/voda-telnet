<?php
define('CLIENT_ID', '124f697b927b38dfad1f8d8e28d56e266f66741f');
define('CLIENT_SECRET', '49784e5140683e7381db182ed26bc003c88a57e4');
define('ACCESS_TOKEN_LINK', 'https://vfgh-test.telenity.com/oauth/token?grant_type=client_credentials');

/*MT Services*/ 
define('SEND_MT_SMS', 'https://preprod.api.mtn.com/v1/oauth/access_token/accesstoken?grant_type=client_credentials');
define('GET_MT_NOTIFY', 'https://mysmsinbox.com/telnet_sdp/mt/v1/send-sms-response.php');
define('UNSUB_MT_LINK', 'https://vfgh-test.telenity.com/vfgh/gw/subscription/v1/unsubscribe');



// echo "included file works";