<?php 


Please find sample requests below.

Get OAuth Token:
curl --location --request POST 'https://vfgh-test.telenity.com/oauth/token?grant_type=client_credentials' \
--header 'Content-Type: application/x-www-form-urlencoded' \
--data-urlencode 'client_id=ab2e22a2df3aac8d8424675ddce7ce4598f6f785' \
--data-urlencode 'client_secret=4d2212843f2s9b7554255ee88c8775a11866ac8'

Unsubscribe:
curl --location --request PUT 'https://vfgh-test.telenity.com/vfgh/gw/subscription/v1/unsubscribe' \
--header 'Authorization: Bearer 45aabd145da2839e9367fabb16f5634d' \
--header 'Content-Type: application/json' \
--data-raw '{
    "TransactionId": "TEST-6814844842262572825",
    "Channel": "SMS",
    "msisdn":"233508889999",
    "offer": "Vodafone Test Daily",
    "inactivationReason": "Will of the customer"
}'

Send SMS:
curl --location --request POST 'https://vfgh-test.telenity.com/vfgh/gw/messaging/v1/outbound' \
--header 'Content-Type: application/json' \
--header 'Authorization: Bearer 1dd7c4a1f4fa6a75c843aa81b6c019bb' \
--data-raw '{
	"address":[
    	"233508889999"
	],
	"senderAddress":"1212",
	"outboundSMSTextMessage":{
    	"message":"A test message triggered by Telenity."
	},
	"clientCorrelator":"123456",
	"receiptRequest":{
    	"notifyURL":"http://127.0.0.1:8080/dummy_delivery_notification",
    	"callbackData":"some-data-useful-to-the-requester"
	},
	"senderName":"Telenity"
}'