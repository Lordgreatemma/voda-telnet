<?php 

	$keys = array(
        'client_id' => '124f697b927b38dfad1f8d8e28d56e266f66741f',
        'client_secret' => '49784e5140683e7381db182ed26bc003c88a57e4'
    );

    //basic auth key generation
    $basic_auth_key = 'Basic '.base64_encode('124f697b927b38dfad1f8d8e28d56e266f66741f:49784e5140683e7381db182ed26bc003c88a57e4');
    // $request_url = "https://vfgh-test.telenity.com/oauth/token?grant_type=client_credentials";
    $data_to_post = urlencode($keys);

    $ch =  curl_init('https://vfgh-test.telenity.com/oauth/token?grant_type=client_credentials');  
			curl_setopt( $ch, CURLOPT_POST, true );  
			curl_setopt( $ch, CURLOPT_POSTFIELDS, $data_to_post);  
			curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );  
			curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0); 
			curl_setopt( $ch, CURLOPT_HTTPHEADER, array(
			    'Authorization: '.$basic_auth_key,
			    'grant_type: client_credentials',
			    'Content-Type: application/x-www-form-urlencoded',
			  ));

	$result = curl_exec($ch); 
	$err = curl_error($ch);
	curl_close($ch);

	$accessToken = json_decode($result, true);
	$token = $accessToken['access_token'];

?>

<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>
		Sub
	</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

	<link rel="stylesheet" href="telnet.css">
		<!-- <script id="script" type="text/javascript" src="http://gh-vdfone.telenity.com/registerhelper4/Register.js"></script> -->
		<script id="script" type="text/javascript" src="telnet.js"></script>


		<style>
	        button:hover
	        {

	           /* background-color: ;#45a049*/
	            /*color: gray;
	            border: 1px solid gray;
	            border-top-left-radius: 15px;
	            border-bottom-right-radius: 15px;
	            box-shadow: 0 6px #666;
	            transform: translateY(4px);
	            background-color: gray;*/
	        }

	        input[text],button:active 
	        {
	          background-color: #3e8e41;
	          box-shadow: 0 5px #666;
	          transform: translateY(4px);
	        }
    	</style>
</head>
<body style="padding-top: 20px;">
	<div id="container" class="container">
		<div class="row justify-content-md-center">
			<!-- <input type="hidden" name="token" id="token" value="<?php echo $token; ?>">
			<a id="login" class="btn btn-md btn-light" href="#" onclick="signIn('signin')" style="margin-bottom: 6px;">Login</a>
			<a id="subscribe"  class="btn btn-md btn-light" href="#" onclick="signUp('signup')">Subscribe</a> -->

			<div class="col-md-4 col-sm-4  col-md-offset-4 col-sm-offset-4">
				<form class="widget_form g-3" id="widget_form" onsubmit="">
					<div id="form_div">
						<input type="hidden" name="token" class="token" id="token" value="<?php echo $token; ?>">
						<div class="mb-3 col-auto">
						    <label for="phone-number" class="form-label" style="font-weight: bolder;">Enter Your Vodafone Mobile Number</label>
						    <input type="text" class="form-control phone-number" id="phone-number" name="phone-number" aria-describedby="phone-number"  placeholder="Phone Number(eg. 233207654321)">
						</div>
						
						<button type="submit" class="btn btn-success sendotp">Send OTP</button>
					</div>
				</form>

				<div class="" id="opt_div">
                    <div class="mb-3">
					    <label for="opt_code" class="form-label" style="font-weight: bolder;" >Enter the OPT</label>
					    <input type="text" class="form-control opt_code"   name="opt_code" id="opt_code" name="phone-number" aria-describedby="opt_code"  placeholder="Verification Code">
					</div>
					
					<button type="submit" class="btn btn-success send_opt" id="send_opt" name="send_opt">Verify Code</button>
                </div>


			</div>
		</div>
	</div>


	<script src="jquery.js"></script>
	<script >
		const token = $("#token").val();

		const signUp = (action) => {
			window.location.assign('register?' +encodeURIComponent('token='+token+'&action=' + action))
		}

		const signIn = (action) => {
			window.location.assign('signin?' +encodeURIComponent('token='+token+'&action=' + action))
		}
	</script>


	<script >
		function validatePhoneNumber(contactValue)
	    {
	        const phonenoFormat = /^\+?([0-9]{2})\)?[-. ]?([0-9]{4})[-. ]?([0-9]{4})$/;
	        const phoneno       = /^\(?([0-9]{3})\)?[-. ]?([0-9]{3})[-. ]?([0-9]{4})$/;
	        var re              = /^\(?(\d{3})\)?[- ]?(\d{3})[- ]?(\d{4})$/;
	        if(contactValue.match(re))
	        {
	           return true;
	        }else
	        {
	            alert("Contact value not valid, enter valid numbers only");
	            // alert(contactValue)
	            // return re.test(contactValue);
	            // return false;
	        }
	         return re.test(contactValue);
	    }

	 //    function validatePhoneNumber(input_str) {
		//   var re = /^\(?(\d{3})\)?[- ]?(\d{3})[- ]?(\d{4})$/;

		//   return re.test(input_str);
		// }

		$(document).ready(function(){
	       document.getElementById('opt_div').style.display="none";
	        

	        $('.sendotp').on('click',function(event){
	        	event.preventDefault();
	        	const token = $(".token").val();
	        	const phone_number = $(".phone-number").val();
	        	if(phone_number == "") {
	                alert('Enter a valid vodafone number to continue.');
	                return false;
            	}
            	if (phone_number.trim().length < 12 || phone_number.trim().length > 12) {
            		alert('Enter a valid vodafone number in the format (eg. 233207654321)');
	                return false;
            	}
            	if(phone_number.trim() != "") 
		        {
		            if(phone_number.trim().length == 12)
		            {
		              // return  validatePhoneNumber(phone_number);
		            }
		        }

            	// validatePhoneNumber(phone_number)
	        	

            	// TODO:///
            	// verify number and send OPT code via sms. 
            	const data = {
		            phone_number: phone_number,
		            token:token
		        }

            	$.post("sendotp.php", data, function(response) {
		            console.log(response)
		            if (response.success) {
		                // showSuccessMessage(response.message);
		                document.getElementById('form_div').style.display = 'none';
            			document.querySelector('#opt_div').style.display = 'block';
            			console.log(response.code)
		                setTimeout(() => {
		                    // window.location.href = 'callback.php';//
		                }, 2000);
		            } else {
		                // showErrorMessage(response.message);
		                alert(response.message)
		            }
		        })
	        })




	        if($('.send_opt').on('click')) {
	           	$('.send_opt').on('click',function(event){
	               event.preventDefault();

	                const opt_code = $("#opt_code").val();
	                const token = $(".token").val();
	        		const phone_number = $(".phone-number").val();
	                if (opt_code == "") {
	                    alert("Please provide OPT code sent to your phone");
	                    $(".opt_code").focus();
	                    return false; 
	                }
	                else
	                {
	                	const params = {
	                		contestant_name:nominee_name,
                            contestant_num:contestant_id,
                            category:contestant_num,
	                	}

	                	$.ajax({
				            url: "?" + $.param(params),
				            beforeSend: function(xhrObj){
				                // Request headers
				                xhrObj.setRequestHeader("X-Reference-Id","");
				                xhrObj.setRequestHeader("Content-Type","application/json");
				                xhrObj.setRequestHeader("Ocp-Apim-Subscription-Key","{subscription key}");
				            },
				            type: "POST",
				            // Request body
				            data: "{body}",
			        	})
				        .done(function(data) {
				            alert("success");
				            window.location.href = 'callback.php';
				        })
				        .fail(function() {
				            alert("error");
				        });



	                    $.ajax({
	                        url: "payment_api/momo/execute_pay.php",
	                        type: "POST",
	                        data: {
	                            contestant_name:nominee_name,
	                            contestant_num:contestant_id,
	                            category:contestant_num,
	                            contestant_id:contestant_id,
	                            amount:amount,
	                            api_key:api_key,
	                            number:number,
	                            channel:channel,
	                            device:'online',
	                            opt_code:opt_code
	                        },
	                        beforeSend: function() {
	                            $("#testModal").modal('hide');
	                        },
	                        success:function(response){
	                            // alert("Vote is being process. Check and confirm payment!");
	                            alert(response.Data.Message);
	                            $('.payment').trigger('reset');
	                            window.location.reload();
	                        }
	                    });
	                }
	            });
        	}
    	})
	</script>
</body>
</html>