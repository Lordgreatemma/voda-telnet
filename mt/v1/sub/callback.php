
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
 	<title>Callback-Page</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

	<link rel="stylesheet" href="telnet.css">
		<!-- <script id="script" type="text/javascript" src="http://gh-vdfone.telenity.com/registerhelper4/Register.js"></script> -->
		<script id="script" type="text/javascript" src="telnet.js"></script>


		<style>
	        input[text],button:active 
	        {
	          background-color: #3e8e41;
	          box-shadow: 0 5px #666;
	          transform: translateY(4px);
	        }
    	</style>
</head>
<body style="background: #f2f2f2; padding-top: 20px;">
	<div id="container" class="container">
		<div class="row justify-content-md-center">
			
			<div class="col-md-4 col-sm-3  col-md-offset-4 col-sm-offset-3">
				<div class="mb-4 col-auto">
					<label for="form-label" class="form-label btn-lg btn-info" style="font-weight: bolder;">Subscription Successful!</label>
				</div>
				<!-- <form class="widget_form g-3" id="widget_form" onsubmit="return validatePhoneNumber(this);">
					<div id="form_div">
						<input type="hidden" name="token" id="token" value="<?php echo $token; ?>">
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

                </div> -->


			</div>
		</div>
	</div>


	<script src="jquery.js"></script>


	<script >
		function validatePhoneNumber(contactValue)
	    {
	        const phonenoFormat = /^\+?([0-9]{2})\)?[-. ]?([0-9]{4})[-. ]?([0-9]{4})$/;
	       // const phoneno       = /^\(?([0-9]{3})\)?[-. ]?([0-9]{3})[-. ]?([0-9]{4})$/;
	        var re              = /^\(?(\d{3})\)?[- ]?(\d{3})[- ]?(\d{4})$/;
	        if(contactValue.match(re))
	        {
	           return true;
	        }else
	        {
	            alert("Contact value not valid, enter valid numbers only");
	            // alert(contactValue)
	            return re.test(contactValue);
	            // return false;
	        }
	         return re.test(contactValue);
	    }
	</script>
</body>
</html>