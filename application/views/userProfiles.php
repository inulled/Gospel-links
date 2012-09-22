<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<?php include('vh.php');
	  $selectedId = $_REQUEST['id'];
      $myuserid = $this->session->userdata('userid');
      $logged = $this->session->userdata('logged');
?>
<head>
	<link href='http://fonts.googleapis.com/css?family=Merienda+One' rel='stylesheet' type='text/css'>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<!-- Load getUrlParam Script-->
	<script src="<?=base_url().$ldr?>scripts/lib/jquery.getUrlParam.js"></script>
<title>wall</title>
	<style type="text/css">
.style2 {
	border: 2px solid #AFAA7A;
}
.style3 {
	background-color: #B3AE80;
	padding: 3px;
	font-size: 10pt;
	color: white;
	font-family: Tahoma;
}
.sideBarRegStyle1_OrigTheme {
	background-color: #F0F0F0;
}
.sideBarHeaderStyle1_OrigTheme {
	background-color: #C6CDE0;
}
.sideBarBorderBottom1_OrigTheme {
	border-width: 2px;
	border-color: #D3D9E7;
	border-top-style: none;
	border-right-style: solid;
	border-bottom-style: solid;
	border-left-style: solid;
	border-bottom-right-radius: 3pt;
	border-bottom-left-radius: 3pt;
}
.sideBarBorderReg1_OrigTheme {
	border-width: 2px;
	border-color: #D3D9E7;
	border-top-style: none;
	border-right-style: solid;
	border-bottom-style: none;
	border-left-style: solid;
}
.sideBarBorderTopStyle1_OrigTheme {
	border-width: 2px;
	border-color: #D3D9E7;
	border-top-style: solid;
	border-right-style: solid;
	border-bottom-style: none;
	border-left-style: solid;
	border-top-right-radius: 3px;
	border-top-left-radius: 3px;
}
</style>
</head>
<body>
<table cellpadding="0" cellspacing="0" style="width: 522px; height: 186px">
	<tr>
		<td valign="top" style="height: 148px; width: 137px;">
<?php   $query  = $this->db->query("SELECT * FROM users WHERE userid = '{$selectedId}'");
        $row = $query->row();
        foreach ($query->result() as $row) { ?>
		<table cellspacing="0" style="width: 57px">
	<tr>
		<td style="width: 90px">
		<img id="defaultImg" src="<?=base_url().$row->defaultImgURI?>" width="130" height="142" /><br />
&nbsp;<br />
	</tr>
	<tr>
		<td class="sideBarRegStyle1_OrigTheme sideBarBorderTopStyle1_OrigTheme headerFont1" style="padding: 3px; width: 90px">
		<a id="viewMyWall" href="<?=base_url()?>index.php/routers/regUserDash?id=<?=$selectedId?>&requestedPageType=userProfiles" class="headerFont1">View My Wall</a></td>
	</tr>
	<tr>
		<td class="sideBarRegStyle1_OrigTheme sideBarBorderReg1_OrigTheme headerFont1" style="padding: 3px; width: 89px">
		<a id="viewMyImages">View My Images</a></td>
	</tr>
	<tr>
		<td class="sideBarRegStyle1_OrigTheme sideBarBorderReg1_OrigTheme headerFont1" style="padding: 3px; width: 89px">
		<a id="viewMyInfo" class="headerFont1">View My Info</a></td>
	</tr>
	<tr>
		<td class="sideBarHeaderStyle1_OrigTheme style3" style="width: 89px">Friends&nbsp;</td>
	</tr>
	<tr>
		<td class="sideBarBorderReg1_OrigTheme" style="width: 89px; padding: 3pt">
<?	  $query3 = $this->db->query("SELECT * FROM friends f INNER JOIN users u WHERE f.node1id = '{$selectedId}' OR f.node2id = '{$selectedId}' AND f.relationType = 'friends' LIMIT 5");
	   foreach($query3->result() as $row1) {
			if ($row1->relationType == 'requested') { // if friendship is still in request mode, do not display
			} elseif ($row1->node1id == $selectedId && $row1->userid == $row1->node2id) { ?>
				<span class="font1">
					<img style="padding: 3px" id="defaultImg a0" src="<?=base_url().$row1->defaultImgURI?>" align="left" width="25px" height="25px" />
					<a class="link-font3" href="<?=base_url()?>index.php/routers/regUserDash?id=<?=$row1->userid?>&requestedPageType=userProfiles"><?=$row1->firstname.' '.$row1->lastname?></a>
				</span><br>
<?			} elseif ($row1->node2id == $selectedId && $row1->userid == $row1->node1id) { ?>
				<span class="font1">
					<img style="padding: 3px" id="defaultImg a0" src="<?=base_url().$row1->defaultImgURI?>" align="left" width="25px" height="25px" />
					<a class="link-font3" href="<?=base_url()?>index.php/routers/regUserDash?id=<?=$row1->userid?>&requestedPageType=userProfiles"><?=$row1->firstname.' '.$row1->lastname?></a>
				</span><br>
		<?  }
		} ?>
		<br />
		<br />
		<br />
		<br />
		</td>
	</tr>
	<tr>
		<td class="sideBarHeaderStyle1_OrigTheme style3" style="width: 89px">Mutual Friends&nbsp;</td>
	</tr>
	<tr>
		<td class="sideBarBorderBottom1_OrigTheme" style="width: 89px"><br />
		<br />
		<br />
		<br />
		<br />
		<br />
		</td>
	</tr>
</table>
</td>
		<td class="nameDisplay_userProfiles" valign="top">
			<?=$row->firstname." ".$row->lastname?>


<script type="text/javascript" language="javascript">
$(document).ready(function() {

	var Isexcuted = 0;
	function sendMessageAppendData() {
		Isexcuted = 1;
    	return '<table id="newMessageBox1" cellpadding="0" cellspacing="0" style="border-radius: 3pt; width: 267px; border: 1px solid #CCCCCC">'+
			   '<tr>'+
			   '<td valign="top" class="font1" style="text-align: center; padding: 3pt">You are messaging <?php echo $row->firstname." ".$row->lastname ?></td>'+
			   '</tr>'+
			   '<tr>'+
			   '<td valign="top" style="text-align: center; width: 253px; padding: 3pt">'+
			   '<input autofocus placeholder="Type your message" id="responseMessage" spellcheck="false" autocomplete="off" class="textbox1" type="text" style="width: 185pt; height: 17px" /></td>'+
			   '</tr>'+
			   '</table>';
	}

	$('#clickSendAMessage').live('click', function() {
		if (Isexcuted == 0) {
			$('#newMessageSpace').prepend(sendMessageAppendData());
		}
	});
       var ide1 = $(document).getUrlParam("id");
       $("#viewMyInfo").click(function() {
              $("#dynoSpace").fadeOut(150, function() {
                     $(this).load("<?=base_url()?>index.php/routers/viewInfoSlider", {id:ide1}, function() {
                           $(this).fadeIn(150);
                     });
              });
       });
       $("#addEditUserInfoClicker").live('click', function() {
              $("#dynoSpace").fadeOut(150, function() {
                     $(this).load("<?=base_url()?>index.php/routers/addEditUserInfoSlider", {id:ide1}, function() {
                           $(this).fadeIn(150);
                     });
              });
       });

       // the below function handles the procedures needed to add a message
		jQuery("#responseMessage").live('keydown', function(event) {
	    	var keyCode = event.keyCode || event.which;
			if (keyCode === 13) { // is enter is pressed
				// below is the bootstrapper for the addComment function
				if ($.trim($($(this)).val()) == '') { // if updater contains only spaces, alert user
					alert("Please add something meaningful");
				} else if ($($(this)).val().length === 0) { // if commentBox contains nothing, alert user
					alert("Please type something meaningful");
				} else if ($($(this)).val().length > 0) { // if commentBox contains useful content, process addComment()
					addMessage();
	        	}
	        }
		});
       
       $("#viewMyImages").click(function() {
              $("#dynoSpace").fadeOut(150, function() {
                     $(this).load("<?=base_url()?>index.php/routers/viewUserProfileAblumsSlider", {id:ide1}, function() {
                           $(this).fadeIn(150);
                     });
              });
       });
	$("#addFriend").click(function() {
		addFriend();
	});
	
	$("#acceptRequest").live('click', function() {
		acceptFriend();
	});
	
	$('#cancelFriendship').live('click', function() {
		cancelFriendship();
	});

	var targetedUserId = $(document).getUrlParam("id");
	
    function addFriend() {
		jQuery.ajax({
			type: "POST",
			dataType: "JSON",
			url: "<?=base_url()?>index.php/regUserDash/addFriend",
			data: { targetedUserId: targetedUserId },
			json: {addFriendSuccess: true},
			success: function(data) {
			if(data.addFriendSuccess == true) {
				$("#addFriend").replaceWith('<input name="currentlyFriends" id="currentlyFriends" type="submit" value="Request Sent" style="width: 100px; height: 28px" class="button1" />');
			}
		  }
	   });
	} function acceptFriend() {
		jQuery.ajax({
			type: "POST",
			dataType: "JSON",
			url: "<?=base_url()?>index.php/regUserDash/acceptFriend",
			data: { targetedUserId: targetedUserId },
			json: {acceptFriendSuccess: true},
			success: function(data) {
			if(data.acceptFriendSuccess == true) {
				$("#requestAlert").replaceWith('<span class="font1">You two are now friends</span>');
			}
		  }
	   });
	} function cancelFriendship() {
		jQuery.ajax({
			type: "POST",
			dataType: "JSON",
			url: "<?=base_url()?>index.php/regUserDash/cancelFriendship",
			data: { targetedUserId: targetedUserId },
			json: {friendshipCaneled: true},
			success: function(data) {
			if(data.friendshipCanceled == true) {
				$("#cancelFriendship").replaceWith('<span class="font1">You two are no longer friends </span>');
			}
		  }
	   });
	} function addMessage() {
		var responseMessage = $('#responseMessage').val();
		messageRecipientId  = "<?=$row->userid?>";
		jQuery.ajax({
			type: "POST",
			dataType: "JSON",
			url: "<?=base_url()?>index.php/regUserDash/addMessage",
			data: {responseMessage: responseMessage, messageRecipientId: messageRecipientId},
			json: {addFriendSuccess: true},
			success: function(data) {
			if(data.inserted == true) {
				alert('Your message has been sent');
				$('#newMessageBox1').hide();	
			}
		  }
	   });
	}
});
</script>


<?php if ($logged == '1') { ?>
		<input name="addFriend" id="addFriend" type="submit" value="Add Friend" style="width: 95px; height: 28px" class="button1" />
<?php } elseif ($logged == '0') return false;

 // the following php is the bootstrapper for the friendship connector
        $friendshipQuery = $this->db->query("SELECT * FROM friends");
        foreach($friendshipQuery->result() as $row) {
                if ($myuserid == $selectedId) { ?>
                        <script type="text/javascript">
                                $(document).ready(function() {
                                        $("#addFriend").hide();
                                });
                        </script>
<?php } } $query1 = $this->db->query("SELECT * FROM friend WHERE relationStatus_friends = 'requested' AND userid_friends = '${selectedId}' AND friendId_friends = '$myuserid'");
          foreach($query1->result() as $row) { ?>
                        <script type="text/javascript">
                                $(document).ready(function() {
                                        $("#addFriend").replaceWith('<span id="requestAlert"><span class="font1">wants to be your friend&nbsp;</span><input type="submit" id="acceptRequest" value="Accept" style="width: 60px; height: 28px" class="button1" />&nbsp;<input type="submit" id="denyRequest" value="Deny" style="width: 50px; height: 28px" class="button1" /></span>');
                                });
                        </script>
<?php } $query1 = $this->db->query("SELECT * FROM friend WHERE relationStatus_friends = 'requested' AND userid_friends = '${myuserid}' AND friendId_friends = '$selectedId'");
            foreach($query1->result() as $row) { ?>
                        <script type="text/javascript">
                                $(document).ready(function() {
                                        $("#addFriend").replaceWith('<span class="font1">Friend request sent</span>');
                                });
                        </script>
<?php } $query2 = $this->db->query("SELECT * FROM friend WHERE userid_friends = '{$myuserid}' AND friendId_friends = '${selectedId}' OR userid_friends = '{$selectedId}' AND friendId_friends = '{$myuserid}'");
                foreach($query2->result() as $row) {
                if ($row->relationStatus_friends == 'friends') { ?>
                        <script type="text/javascript">
                                $(document).ready(function() {
                                        $("#addFriend").replaceWith('<span id="cancelFriendship" class="font1 area1">You two are friends. <a class="link-font1" href="javascript:void(0)"><strong>Cancel friendship?</strong></a>');
                                });
                        </script>
<?php } } if ($myuserid != $selectedId) { ?>
<br><div id="clickSendAMessage" class="grab">Send a message</div>
<?php } ?>
			<div id="dynoSpace"></div>
			<div id="viewMyInfoSlider" style="display: none">
			<?php $userid = $this->session->userdata('userid');
			$selectUserInfo = $this->db->query("SELECT * FROM user_info WHERE userid = '{$_REQUEST['id']}'");
			if ($userid != $selectedId) { // if user is not viewing his own page
				if ($selectUserInfo->num_rows() > 0) { 
					foreach ($selectUserInfo->result() as $row) { ?>
						<span class="headerFont_userInfo">General Info:</span><br>
						<span class="font1">Birthdate: <?=$row->birthdate?></span><br>
						<span class="font1">Sex: <?=$row->sex?></span><br>
						<span class="font1">Interested In: <?=$row->interestedIn?></span><br>
						<span class="font1">Relationship Status: <?=$row->relationshipStatus?></span><br>
						<span class="font1">Languages: <?=$row->Languages?></span><br>
						<span class="font1">Religious Views: <?=$row->religiousViews?></span><br>
						<span class="font1">Political Views: <?=$row->politicalViews?></span><br>
						<span class="font1">About Me: <?=$row->aboutMe?></span><br>
						<br>
						<span class="headerFont_userInfo">Contact Info:</span><br>
						<span class="font1">Mobile Phones: <?=$row->mobilePhone?></span><br>
						<span class="font1">Neighborhood: <?=$row->neighborhood?></span><br>
						<span class="font1">Websites: <?=$row->websites?></span><br>
						<span class="font1">Email: <?=$row->email?></span><br>
			<?php } 
				} elseif ($selectUserInfo->num_rows() == 0) {
				echo "<span class='font1'>This user has no info to display.</span>";
				}
			} elseif ($userid == $selectedId) { // if user is viewing his own page
			if ($selectUserInfo->num_rows() > 0) {
				foreach ($selectUserInfo->result() as $row) { ?>
					<span class="headerFont_userInfo">General Info:</span><br>
					<span class="font1">Birthdate: <?=$row->birthdate?></span><br>
					<span class="font1">Sex: <?=$row->sex?></span><br>
					<span class="font1">Interested In: <?=$row->interestedIn?></span><br>
					<span class="font1">Relationship Status: <?=$row->relationshipStatus?></span><br>
					<span class="font1">Languages: <?=$row->Languages?></span><br>
					<span class="font1">Religious Views: <?=$row->religiousViews?></span><br>
					<span class="font1">Political Views: <?=$row->politicalViews?></span><br>
					<span class="font1">About Me: <?=$row->aboutMe?></span><br>
					<br>
					<span class="headerFont_userInfo">Contact Info:</span><br>
					<span class="font1">Mobile Phones: <?=$row->mobilePhone?></span><br>
					<span class="font1">Neighborhood: <?=$row->neighborhood?></span><br>
					<span class="font1">Websites: <?=$row->websites?></span><br>
					<span class="font1">Email: <?=$row->email?></span><br>
		<?php } 
			} else { ?>
				<span class='font1'>You need to add info! <a id='addEditUserInfoClicker' class='headerFont1'>Click here</a> to add data to your info page.</span>
		<?php } } ?>


			</div>
		</td>
		</tr>
	</table>
	<?php } ?>
</body>

</html>