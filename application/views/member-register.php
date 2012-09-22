<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>

	<!-- Add jQuery library -->
	<script src="http://code.jquery.com/jquery-latest.js"></script>
    
	<script type="text/javascript" src="http://jzaefferer.github.com/jquery-validation/jquery.validate.js"></script>

<meta content="en-us" http-equiv="Content-Language" />
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<title>Enter your churches name&nbsp;&nbsp; Enter</title>
<script type="text/javascript">
$(document).ready(function() {
  		$('#username').keyup(function() {
  			username_check();
		});
		 
		function username_check() {
		 	var username = $('#username').val();
			if (username == "" || username.length < 2) {
			
			$('#username').css('border', '3px #CCC solid');
			$('#tick').hide();
			$('#regButton').fadeOut();
			
			} else {
				jQuery.ajax({
					type: "POST",
		   			url: "<?=base_url()?>index.php/home/checkIsUsernameTaken",
		   			data: 'username=' + username,
		   			cache: false,
		   			success: function(response) {
						if (response == 1) {
		    				$('#username').css('border', '3px #C33 solid');
		    				$('#tick').hide();
		    				$('#cross').fadeIn();
		    				$('#regButton').fadeOut();
		    			} else {
		    				$('#username').css('border', '3px #090 solid');
		    				$('#cross').hide();
		    				$('#regButton').fadeIn();
		    				$('#tick').fadeIn();
		    			}
		 
					}
				});
			}
		 
		}

	  $("#church_register").validate({
		  rules: {
			  	church_name: "required",
				church_name: "required",
				street_address: "required",
				locational_state: "required",
				locational_zip: "required",
				locational_country: "required",
				locational_city: "required",
				overseer_account_id: "required",
				tax_exemption_number: "required",
				username: "required",
				password: "required",
				retype_password: {
     			 equalTo: "#password"
				},
				firstname: "required",
				lastname: "required",
				email: "required"
		  }
	  });
  });
</script>
<style type="text/css">
.normal-font1 {
	font-family: Tahoma;
	font-size: small;
}
.textbox1 {
	border: 1px solid #C0C0C0;
	padding: 5px;
	font-family: Tahoma;
	font-size: small;
	border-radius: 3px;
	outline: none;
}
.button11 {
	background-color: #003366;
	border-style: solid;
	border-width: 2px;
	border-color: #999999;
	color: #FFFFFF;
	font-family: Tahoma;
	font-size: 10pt;
	border-radius: 3px;
}
#username_memberRegister { padding:3px; font-size:18px; border:3px #CCC solid; }
 
#tick_memberRegister { display: none }
#cross_memberRegister { display: none }

</style>
</head>

<body>

<form id="church_register" method="post" action="<?=base_url()?>index.php/home/member_reg">
	<div class="wrapper">
	<p><a class="normal-font1">Create a m</a><span class="normal-font1">ember 
	account.</span><br />
	  <a class="normal-font1" spellcheck="false" autocomplete="off" style="font-size: 9pt; font-style: italic; color: grey;">
	With a member account, you&#39;ll be able to follow your churches page and 
	connect and share information and media with members within your church.</a><br />
	  <br />
	  <a class="normal-font1">Select a username</a><br />
	  <table>
	  	<tr>
	  		<th><input onkeypress="return event.keyCode!=13" autofocus name="username" id="username" spellcheck="false" autocomplete="off" type="text" class="textbox1" /></th>
	  		<th>
	  			<img id="tick" style="display: none" src="http://papermashup.com/demos/check-username/tick.png" width="16" height="16"/>
				<img id="cross" style="display: none" src="http://papermashup.com/demos/check-username/cross.png" width="16" height="16"/>
			</th>
	  	</tr>
	  </table>
	  <br />
	  <a class="normal-font1">Select a password</a><br />
	  <input onkeypress="return event.keyCode!=13" id="password" name="password" spellcheck="false" autocomplete="off" type="password" class="textbox1" /><br />
	  <br />
	  <a class="normal-font1">Retype your selected password</a><br />
	  <input onkeypress="return event.keyCode!=13" name="retype_password" spellcheck="false" autocomplete="off" type="password" class="textbox1" /><br />
	  <br />
	  <a class="normal-font1">Enter your first name</a><br />
	  <input onkeypress="return event.keyCode!=13" name="firstname" type="text spellcheck="false" autocomplete="off"" class="textbox1" /><br />
	  <br />
	  <a class="normal-font1">Enter your last name</a><br />
	  <input onkeypress="return event.keyCode!=13" name="lastname" type="text" spellcheck="false" autocomplete="off" class="textbox1" /><br />
	  <br />
	  <a class="normal-font1">Enter in your email</a><br />
	  <input onkeypress="return event.keyCode!=13" name="email" type="text" spellcheck="false" autocomplete="off" class="textbox1" />
  </p>
	<p>
	<input onkeypress="return event.keyCode!=13" name="submit" type="submit" id="regButton" value="Register" class="button11" style="width: 77px; height: 29px; display: none" /></p>
</form>

</body>
</html>
