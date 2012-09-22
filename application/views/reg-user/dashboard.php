<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office"><head>
	<!-- Load View Data-->
	<?php include('vh.php'); ?>
	<!-- Load Elastic Script-->
	<script src="<?=base_url().$ldr?>scripts/lib/jquery.elastic.source.js"></script>
	<!-- Load Timeago Script-->
	<script src="<?=base_url().$ldr?>scripts/lib/jquery.timeago.js"></script>
	<!-- Load getUrlParam Script-->
	<script src="<?=base_url().$ldr?>scripts/lib/jquery.getUrlParam.js"></script>
	<!-- Load jQuery Placeholder Script-->
	<script src="<?=base_url().$ldr?>scripts/lib/jquery.placeholder.js"></script>
	<!-- Add jQuery-blink Plugin -->
	<script type="text/javascript" src="<?=base_url()?>scripts/jquery-blink.js"></script>
	<!-- Add fancyBox main JS and CSS files -->
	<script type="text/javascript" src="<?=base_url()?><?=$ldr?>scripts/source/jquery.fancybox.js"></script>
	<link rel="stylesheet" type="text/css" href="<?=base_url()?><?=$ldr?>scripts/source/jquery.fancybox.css" media="screen" />
    
    <link rel="stylesheet" type="text/css" href="<?=base_url().$ldr?>dashSidebar.php" />
<meta http-equiv="Content-Language" content="en-us" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Gospel-links</title>

    	<?php
    	if ("http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'] == base_url()) { ?>
    		<script type="text/javascript">
    		$(document).ready(function() {
    			$(window).load(function() {
    				$("#home").trigger("click");
    			});
    		});
    		</script>
    	<?php } ?>

<script type="text/javascript" language="javascript">
$(document).ready(function() {
	//$('#numMessages').click(function() {
	//	$('#messagesList').toggle();
	//});
	function staticLoginScript() {
		return '<form action="<?=base_url()?>index.php/home/staticLogin" method="POST">'
		+'<span style="position: fixed">'
		+'<span class="font1">Login below:</span><br>'
		+'<input type="text" id="username" name="username" autocomplete="off" placeholder="Username" class="textbox2" style="width: 150pt; border-radius: 3px"/><br>'
		+'<input type="password" id="password" name="password" autocomplete="off" placeholder="Password" class="textbox2" style="width: 150pt; border-radius: 3px"/>'
		+'<input name="login" onclick="form.submit()" type="button" value="Login" style="width: 58px; height: 28px" class="button1"><br>'
		+'<a id="main_register" href="<?=base_url()?>index.php/routers/register" class="grab auto-style10 fancybox.iframe"><strong>Register</strong></a><span class="font1"> | </span>'
		+'<a href="<?=base_url()?>index.php/routers/register_church" class="grab auto-style10 fancybox.iframe"><strong>Register your church</strong></a>'
		+'<span id="login_failure" style="display: none" style="width: 208px" class="login-failure-box">'
		+'<em class="auto-style4">Login failed! '
		+'<a id="sub_register" href="<?=base_url()?>index.php/routers/register" class="auto-style10 fancybox.iframe">Register</a> or '
		+'<a id="reset" href="#" class="auto-style5">Reset</a></em><br /><a style="display: none" id="pending">If your overseer account is pending aproval, login will be deinied.</a></td>'
		+'<td class="right-align-button1">'
		+'</span>'
		+'</span></form>';
	}

	if ($.browser.msie  && parseInt($.browser.version, 10) <= 9) {
		$("#dd").replaceWith(staticLoginScript());
	} // detects if browser is ie 8 or below and sets isM to true if it is
	
	$("#username").placeholder();
	$('#password').placeholder();
	$(".respond").placeholder();
	$('#q').placeholder();
	$('.auto-style10').fancybox();
	$('#churchRepo').fancybox();
	$("#showUserBlink").hide(); // hide on initial load
	//$('#messagesList').hide();

	setInterval(function() {
		jQuery.getJSON("<?=base_url()?>index.php/regUserDash/sessionExpire", function(data) {
			var sessionState = jQuery.parseJSON('{"sessionExpired":"true","sessionExpired":"false"}');
			if(sessionState.sessionExpired === "true") { // if session is expired run the following code
				var dataString = 'true';
				jQuery.ajax({	// send the expired signal to Ci so that it knows the session has expired
					type: 'POST',
					dataType: 'JSON',
					url: '<?=base_url()?>index.php/regUserDash/extendSession',
					data: {'dataString': true},
					success: function(data) {
						if (data.extendedSession == true) {
							alert('success');
						} else {
							return false;
						}
					}
				});
			} else if(sessionState.sessionExpired == "false") {
				return;
			}
		});
    }, 120000); // loop through every 2 minutes
 
    if ($(document).getUrlParam("requestedPageType") === 'startpage') {
    	// loads the wall when the user firsts logs in
		jQuery('#main').load('<?=base_url()?>index.php/routers/startpage');
	} else if ($(document).getUrlParam('requestedPageType') === 'wall_1') {
		var churchid = $(document).getUrlParam("churchid");
		var req = $(document).getUrlParam("requestedPageType");
		$('#main').load('<?=base_url()?>index.php/routers/wall_1',{churchid: churchid, req: req});
		$('#logoTd').remove();
    } else if ($(document).getUrlParam("requestedPageType") === 'userProfiles') {
    	// loads the wall when the user firsts logs in
    	var ide = $(document).getUrlParam("id");
		jQuery('#main').load('<?=base_url()?>index.php/routers/userProfiles',{id:ide});
    } else if ($(document).getUrlParam("requestedPageType") === 'addEditUserInfo') {
    	var ide1 = $(document).getUrlParam("id");
    	jQuery('#main').load('<?=base_url()?>index.php/routers/addEditUserInfo', {id:ide1});
    } if ($(document).getUrlParam("loggingStatus") === 'loggedIn') {
    	$("#showUserBlink").fadeIn(1000); // show and blink when user first logs in

    }
    
	// when the home link is clicked, fadeIn in the wall
	jQuery("#home").click(function() {
		window.location.href = '<?=base_url()?>index.php/routers/regUserDash?requestedPageType=startpage';
	});
	jQuery("#logout").click(function() {
		window.location = '<?=base_url()?>index.php/home/kill_sess';
	});
	$("#loginButton").click(function() {
		logsig();
	});
	jQuery("#password").keyup(function(event) {
    	var keyCode = event.keyCode || event.which;
    	if(keyCode === 13) {
        	logsig();
    	}
	});
	jQuery("#reset").click(function() {
		jQuery("#username, #password").val('');
		jQuery("#username").focus();
		jQuery("#login_failure").fadeOut(400);
	});
	jQuery("#login").click(function() {
		logsig();
	});


	function logsig() {
		var username = jQuery("#username").val();
		var password = jQuery("#password").val();
		var dataString = '&username=' + username + '&password=' + password;
		if(username=='' ||  password=='') {
			jQuery('#success').fadeOut(400).hide();
			jQuery('#error').fadeOut(400).show();
		} else {
			jQuery.ajax({
			type: "POST",
			dataType: "JSON", 
			url: "<?=base_url()?>index.php/home/logsig",
			data: dataString,
			json: {session_state: true},
			cache: false,
			success: function(data) {
			if(data.session_state == true) {
				window.location = "<?=base_url()?>index.php/routers/regUserDash?churchid=<?=$this->session->userdata('mychurchid')?>&requestedPageType=wall_1";
			} else if(data.session_state == false) {
				jQuery("#login_failure").fadeIn(400);
		   	}
		  }
	   });
	}
	}

	var runningRequest = false;
    var request;
   //Identify the typing action
    $('input#q').keyup(function(e) {
        e.preventDefault();
        var $q = $(this);

        if ($q.val() == '') {
            $('div#results').html('');
            return false;
        }

        //Abort opened requests to speed it up
        if (runningRequest) {
        	request.abort();
        }

        runningRequest = true;
       
        request = $.getJSON("<?=base_url()?>index.php/regUserDash/instantSearch", {
        	q: $q.val()
        }, function(data) {           
            showResults(data, $q.val());
            runningRequest = false;
        });




//Create HTML structure for the results and insert it on the result div
function showResults(data, highlight) {
           var resultHtml = '';
            $.each(data, function(i, item) {
                resultHtml += '<div class="result">';
                resultHtml += '<img style="padding: 3px" id="defaultImg a0" src="' + item.defaultImgURI + '" align="left" width="25px" height="25px" />';
                resultHtml += '<h2><a class="link-font3" href="<?=base_url()?>index.php/routers/regUserDash?id=' + item.userid + '&requestedPageType=userProfiles">' + item.firstname + ' ' + item.lastname + '</a></h2>';
                resultHtml += '</div>';
            });

            $('div#results').html(resultHtml);
        }

        $('form').submit(function(e) {
            e.preventDefault();
        });
    });

	// the below takes all messages in the notification pane and hides then
    $(".messageBody").each(
        function( intIndex ) {
        	var textToHide = $(this).text().substring(100);
        	var visibleText = $(this).text().substring(1, 100);

        	$(this).html(visibleText + ('<span>' + textToHide + '</span>'))
        		.append('<a id="read-more"><b>...</b></a>')
            	.click(function() {
                	$(this).find('span').toggle();
                	$(this).find('a:last').toggle();
            }); $(this).find("span").hide();
     	}
    )
});
</script>
<style type="text/css">
.form {
      margin:15px;
      padding:5px;
      border-bottom:1px solid #ddd;
    }
      form input[type=submit]{display:none;}

      div#results{
        padding:10px 0px 0px 15px;
       }

      div#results div.result{
           padding:10px 0px;
           margin:10px 0px 10px;
       }

      div#results div.result a.readMore{color:green;}

      div#results div.result h2{
       font-size:19px;
       margin:0px 0px 5px;
       padding:0px;
       color:#1111CC;
       font-weight:normal;
       }

      div#results div.result h2 a{
        text-decoration:none;
       border-bottom:1px solid #1111cc;
      }

      div#results div.result p{
       margin:0;
      padding:0;
}

      span.highlight{
       background:#FCFFA3;
       padding:3px;
       font-weight:bold;
}
.dropdownResults {
	 position: fixed;
	 background-color: white;
	 width: 200pt;
	 padding: 3px;
	 z-index: 1;

	 border-color: #AFC7C7;
	 border-top-style: none;
	 border-right-style: solid;
	 border-bottom-style: solid;
	 border-left-style: solid;
	 border-bottom-width: 1pt;
	 border-right-width: 1pt;
	 border-left-width: 1pt;

	 border-bottom-right-radius: 3px;
	 border-bottom-left-radius: 3px;
}
.notificationsPane {
	 background-color: white;
	 width: 200.5pt;
	 padding: 3px;

	 border-color: #CDCDCD;
	 border-top-style: solid;
	 border-right-style: solid;
	 border-bottom-style: solid;
	 border-left-style: solid;
	 border-bottom-width: 1pt;
	 border-right-width: 1pt;
	 border-left-width: 1pt;
	 border-top-width: 0px;

	 border-bottom-right-radius: 3pt;
	 border-bottom-left-radius: 3pt;
}
.navbarStyle {
	border-style: none none solid none;
	border-width: 5px;
	border-color: #8E442B;
	position: fixed;
	z-index: auto;
	width: 100%;
	top: 0px;
	right: 0px;
	left: 0px;
	background-color: #B65B3B;
}
.textbox1_OrigTheme {
	padding: 3px;
	border-radius: 3pt;
	font-family: Verdana;
	font-size: 8pt;
	outline: none;
	border-style: none;
	background-image: url('<?=base_url()?><?=$ldr?>images/searchBox.fw.png');
}
.navBarStyle1 {
	font-family: georgia;
	font-size: 10pt;
	color: #FFFFFF;
	padding: 3pt;
	text-align: center;
}
.readMore {
	border-color: #E6DB55;
	border-top-style: solid;
	border-right-style: solid;
	border-bottom-style: solid;
	border-left-style: solid;
	border-bottom-width: 1pt;
	border-right-width: 1pt;
	border-left-width: 1pt;
	border-top-width: 1pt;
	border-radius: 3pt;

	font-family: sans-serif;
	font-size: 11px;
	line-height: 1.4em;
	padding: 2px;
	color: black;
	background: #fffedf;
	display: block;
	cursor: pointer;
	position: relative;
	width: 50pt;
	text-align: center;
}
</style>
</head>
<?php	/*$userid = $this->session->userdata('userid');
        $query1 = $this->db->query("SELECT firstname, lastname FROM users WHERE userid = '{$userid}'");
        $row = $query1->row();
        foreach ($query1->result() as $row1) { */
?>
<body style="background-color: #f9f9f9"> <!-- old: f9f9f9, #ede8cb, fcf7da -->
		<?php $logged = $this->session->userdata('logged');
			  if ($logged == '1') { ?>
		<table style="width: 100%" align="center" class="navbarStyle">
			<tr>
				<td>
				<table style="width: 754px" cellspacing="0" cellpadding="0" align="center" class="navBarStyle1">
					<tr>
						<td id="home" style="padding: 2pt; border-left: 1px solid #D6957E; border-right: 1px none #D6957E; border-top: 1px none #D6957E; border-bottom: 1px none #D6957E; width: 100px" class="style1 area1">Home</td>
						<?php if ($this->session->userdata('logged') == '1') {
							$userid = $this->session->userdata('userid'); ?>
							<td style="border-left: 1px solid #D6957E; border-right: 1px none #D6957E; border-top: 1px none #D6957E; border-bottom: 1px none #D6957E; width: 100px" class="area1"><a class="link-font4_dashboard" href="<?=base_url()?>index.php/routers/regUserDash?id=<?=$userid?>&requestedPageType=userProfiles">Profile</a></td>
						<?php } elseif ($this->session->userdata('logged') == '0') { ?>
							<td style="border-style: none none none solid; border-width: 1px; border-color: #D6957E; width: 100px" class="area1">Profile</td>
						<?php } ?>
						<td style="border-style: none none none solid; border-width: 1px; border-color: #D6957E; width: 100px" class="area1">Mail</td>
						<?php if ($this->session->userdata('logged') == '1') { ?>
							<td id="churchRepo" class="area1 fancybox.iframe" href="<?=base_url()?>index.php/routers/search_aChurch" style="border-style: none none none solid; border-width: 1px; border-color: #D6957E; width: 100px">Church Repo</td>
						<?php } elseif ($this->session->userdata('logged') == '0') { } ?>
						<?php if ($this->session->userdata('logged') == '1') { ?>
							<td id="logout" style="	border-style: none none none solid; border-width: 1px; border-color: #D6957E; width: 100px" class="area1">Logout</td>
						<?php } elseif ($this->session->userdata('logged') == '0') { } ?>
						<td>
						<table style="width: 100%" cellspacing="0" cellpadding="0">
							<tr>
								<td style="width: 100pt"></td>
								<td>
						</table>
						</td>
					</tr>
				</table>
				</td>
			</tr>
		</table><br><br>
		<? } elseif ($logged == '0') { } ?>

		<table id="main2" cellpadding="0" cellspacing="0" style="width: 773px; height: 617px" align="center">
			<!-- MSTableType="layout" -->
			<tr id="logoTd">

				<td valign="top" style="height: 32px">
				<table style="width: 99%" align="center">
					<tr>
						<td style="width: 400px">
				<img id="logo" alt="" src="<?=base_url()?><?=$ldr?>images/logo.png" /></td>
						<td>
							<span class="font1" id="showUserBlink">Welcome <?=$this->session->userdata('username')?></span>
						</td>
					</tr>
				</table> 
				</td>
				</tr>
			<tr>
				<td valign="top" class="mainAreaStyle1" style="height: 585px; width: 773px">
				<table cellpadding="0" cellspacing="0" style="width: 773px; height: 396px">
					<tr>
						<td valign="top" style="width: 522px">
						<div class="leftAlign1">
							<table cellpadding="3" style="width: 100%">
								<tr>
									<td id="main">
									<? /*if ($_GET["requestedPageType"] == 'startpage') {
										include(base_url()."index.php/routers/startpage");
									} elseif ($_GET['requestedPageType'] == 'wall_1') {
										include(base_url()."index.php/routers/wall_1");
									} */?>
									</td>
								</tr>
							</table>
						&nbsp;</div>
						
						</td>
		<?php /*} $userid = $this->session->userdata('userid');
		        $query = $this->db->query("SELECT * FROM churchMembers WHERE cMuserId = '{$userid}'");
		        $row = $query->row();
				if ($query->num_rows() != 0	) {
				$membersChurchId = $row->cMchurchId;
		        $query = $this->db->query("SELECT * FROM church_repo WHERE churchId = '{$membersChurchId}'");
		        foreach ($query->result() as $row) { */
		?>
						<td valign="top" style="height: 396px; width: 245px; padding: 3px;">
						<table cellpadding="0" cellspacing="0" style="width: 242px; height: 547px">

							<tr>
								<td valign="top" style="height: 19px">
									<div style="display: none" class="dropdownResults" id="results"></div>
							<!--	<span class="headerFont1"><strong><?php //echo $row->church_name ?></strong></span> <span class="black-font1">
								(Your a Member of this Church)</span>--></td>
		<?php if ($this->session->userdata('logged') == '0') { ?>
									<span id="dd" style="position: fixed">
										<span class="font1">Login below:</span><br>
										<input type="text" id="username" autocomplete="off" placeholder="Username" class="textbox2" style="width: 150pt; border-radius: 3px"/><br>
										<input type="password" id="password" autocomplete="off" placeholder="Password, Press enter to continue" class="textbox2" style="width: 150pt; border-radius: 3px"/>
										<input name="login" id="loginButton" type="submit" value="Login" style="width: 58px; height: 28px" class="button1"><br>
										<a id="main_register" href="<?=base_url()?>index.php/routers/register" class="grab auto-style10 fancybox.iframe"><strong>Register</strong></a><span class="font1"> | </span>
										<a href="<?=base_url()?>index.php/routers/register_church" class="grab auto-style10 fancybox.iframe"><strong>Register your church</strong></a>
											<span id="login_failure" style="display: none" style="width: 208px" class="login-failure-box">
											<em class="auto-style4">Login failed! 
											<a id="sub_register" href="<?=base_url()?>index.php/routers/register" class="auto-style10 fancybox.iframe">Register</a> or 
											<a id="reset" href="#" class="auto-style5">Reset</a></em><br /><a style="display: none" id="pending">If your overseer account is pending aproval, login will be deinied.</a></td>
											<td class="right-align-button1">
											</span>
									</span>

		<?php } elseif ($this->session->userdata('logged') == '1') { ?>
			<div class="notificationsPane" style="position: fixed; top: 0pt; width: 285px; overflow-x: hidden; overflow-y: scroll; height: 300pt">
				<span style="position: fixed; background-color: white">
					<input placeholder="Begin Searching" id="q" name="Text2" spellcheck="false" autocomplete="off" class="searchBox1" type="text" style="width: 193pt; height: 17px" />
					<div id="results"></div>
				</span><br><br>
				<span id="newMessageSpace">
					<?  $query5 = $this->db->query("SELECT * FROM messages m INNER JOIN users u ON m.messageSentById = u.userid WHERE messageRecipientId = '{$userid}' AND m.notificationStatus = 'Unread' ORDER BY messageId DESC"); ?>
						<!--<span style="font-family: tahoma; font-size: 10pt">You have <span style="color: #00416A">(<?=$query5->num_rows()?>)</span> new messages: <span id="numMessages" class="grab"><b>Click to view</b></span></span><br>-->

					<span id="messagesList">
					<?php foreach ($query5->result() as $row) { ?>
							<img align="left" style="padding: 3px" id="defaultImg a1" src="<?php echo base_url().$row->defaultImgURI; ?>" width="30" height="30" /></td>
							<a class="link-font1_dashboard" href="<?=base_url()?>index.php/routers/regUserDash?id=<?=$row->userid?>&requestedPageType=userProfiles"><strong><?=$row->firstname." ".$row->lastname?></strong></a></span>
							<span class="messageBody" style="font-family: tahoma; font-size: 8pt"> messaged you: "<?=$row->messageBody?>"</span>
							<br />
							<input type="text" style="font-family: tahoma; font-size: 8pt; width: 192pt; border-radius: 3px" id="respond" autocomplete="off" placeholder="Respond and press enter" class="textbox2 respond" /><br>
						<? } ?>
					</span>
				</span>
				<br><br><br><br><br>
			</div>
		<?php } ?>

							</tr>
							<tr>
								<td valign="top" style="height: 19px">
							<!--	<div class="headerFont1"><strong>Blah Blah </strong></div> <div class="black-font1">(Your Following this Church)</div></td> -->
							</tr>
							<tr>
								<td valign="top" style="height: 251px">
								</td>
							</tr>
							<tr>
				<!--				<td valign="top" colspan="3" style="height: 196px">
									<a class="font1">
										<?php $verse = $this->db->query("SELECT * FROM bible_verses ORDER BY RAND() LIMIT 5");
											  foreach ($verse->result() as $row) {
								  			  echo "<i>".$row->verseLocation.nl2br(": </i>").$row->verseEntry.nl2br("\n \n");
											  }
										?>
									</a>
								</td>
								-->
										<?php /*} } else { }*/ ?>
							</tr>
						</table></td>
					</tr>
				</table>
				</td>
				</tr>
		</table>
</body>
</html>