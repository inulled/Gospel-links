<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office"><head>
	<!-- Add elastic library -->
	<script src="<?=base_url()?>vd/1.0/New/scripts/lib/jquery.elastic.source.js"></script>
	<script src="<?=base_url()?>vd/1.0/New/scripts/lib/jquery.tinyscrollbar.min.js"></script>
	<? $logged = $this->session->userdata("logged") ?>

<script type="text/javascript">
$(document).ready(function() {
		$("#updater").placeholder();
		$(".textbox1").placeholder();
   		$("#updater").elastic();
   		$('.auto-style10').fancybox();


		$.getJSON('<?=base_url()?>index.php/regUserDash/checkIsLoggedIn', function(data) {
            if (data.loggedIn == true) { // if user is logged in, proceed
            	$("#updater").focus(); // set focus() to updater if user is logged in
            		$.getJSON('<?=base_url()?>index.php/regUserDash/checkIsChurchRegistered', function(data) {
    					if (data.isRegistered == 'Yes') { // if user is logged in, proceed
    						return;
        				} else if (data.isRegistered == 'No') {
           					$('#searchA_churchHiddenLink').trigger('click');
        				}
    				});
            } else if (data.loggedIn == false) {
            	$("#username").focus(); // if user isn't logged in, set focus() to the #username field
            }
        });
   		
		jQuery(".addComment").on('click', function() {
			id = jQuery(this).attr("rel");
			jQuery("#commentBox-"+id).toggle();
		});
		
		jQuery(".viewCommentsLink").live('click', function() {
			id = jQuery(this).attr("idbd");
			jQuery("#viewComments-"+id).toggle();
		});
		
		// the below function handles the procedures needed to add a comment
		jQuery(".textbox1").live('keydown', function(event) {
	    	var keyCode = event.keyCode || event.which;
			if (keyCode === 13) {
				// below is the bootstrapper for the addComment function
				if ($.trim($($(this)).val()) == '') { // if updater contains only spaces, alert user
					alert("Please add something meaningful");
				} else if ($($(this)).val().length === 0) { // if commentBox contains nothing, alert user
					alert("Please type something meaningful");
				} else if ($($(this)).val().length > 0) { // if commentBox contains useful content, process addComment()
					addComment($(this));
	        	}
	        }
		});

		// process postToWall()
		jQuery("#shareButton").live('click', function() {
			// if updater contains only spaces, alert user
			if ($.trim($('#updater').val()) == '') {
				alert("Please add something meaningful");
				
			} else if ($("#updater").val().length === 0) { // if updater contains nothing, alert user
				alert("Please type something meaningful");
			} else if ($("#updater").val().length > 0) { // if updater contains useful content, process podtToWall()
				$.getJSON('<?=base_url()?>index.php/regUserDash/checkIsLoggedIn', function(data) {
            		if (data.loggedIn == true) {
					postToOpenWall();
				} else if (data.loggedIn == false) {
            		if (window.confirm('You are not logged in. Please login to continue')) {
            			$("#dd").effect("shake", {times:3}, 2000);
            			$("#username").focus();
            		}
            	}
				});
			}
		}); function addNewCommentData(defaultImgURI, firstname, lastname, returnedData, entryCreationDateTime) {
		return '<table cellpadding="0" cellspacing="0" style="width: 96.3%" class="style1 commentStyle">'+
		'<tr>'+
		'<td valign="top" style="width: 10px">'+
		'<img style="padding: 3px" id="defaultImg a0" src="' + defaultImgURI + '" align="left" width="25px" height="25px" />'+
		'</td>'+
		'<td valign="top" style="width: 319px">'+
		'<a class="font1 link-font1"><b>' + firstname + ' ' + lastname + '</b></a> ' + returnedData + '<br>' + entryCreationDateTime +
		'</td>'+
		'</tr>'+
		'</table>';
	}
		function addComment(e) {
			var id = $(e).attr("id"); // grab post id
			var postuserid = $(e).attr("postuserid"); // grab posting user id
			var newId = id.replace("commentBox1-", ""); // strip 'commentBox' from grabbed post id
			var commentBoxData = $("#commentBox1-"+newId).val();
			var userid = "<?=$this->session->userdata('userid')?>";
			$.getJSON('<?=base_url()?>index.php/regUserDash/checkIsLoggedIn', function(data) {
            	if (data.loggedIn == true) {
            		$.ajax({
						type: "POST",
						dataType: "JSON",
						url: "<?=base_url()?>index.php/regUserDash/addCommentToStartpageWall",
						data: {
							postinguserid: postuserid
						},
						success: function(data) {
							if (data.isMembershipSame == true) {
								$("#viewComments-"+newId).show();
								$.ajax({
									type: "POST",
									dataType: "JSON",
									url: "<?=base_url()?>index.php/regUserDash/addComment",
									data: {
									commentBoxData: commentBoxData,
									userid: userid,
									newId: newId,
									commentAdded: true
								}, success: function(data, id) {
										if (data.commentAdded === true) {
											var html = addNewCommentData(data.defaultImgURI, data.firstname, data.lastname, data.returnedData, data.entryCreationDateTime);
											e.closest('.wallPosts').find('.commentsList').append(html); // needs to insert before commentBox
											$('#commentBox1-'+newId).val('');
										} else {
											return false;
										}
									}
								});
							} else if (data.isMembershipSame == false) {
								alert("You two are not associated with the same church, therefor you cannot add a comment to this wall post");
							}
						}
					});
            	} else if (data.loggedIn == false) {
            		if (window.confirm('You are not logged in. Please login to continue')) {
            			$("#dd").effect("shake", {times:3}, 2000);
            			$("#username").focus();
            		} else {
            			return;
            		}
            	}
        	});
		}
	jQuery(".delpost").live('click', function() {
		delPost(this);
	});

	function delPost(e) {
	    // this function deletes the current post
	    var entryId = jQuery(e).attr("delpost");
	    var dataString = "&entryId=" + entryId;
			jQuery.ajax({
			type: "POST",
			dataType: "JSON",
			url: "<?=base_url()?>index.php/regUserDash/delPost",
			data: dataString,
			json: {postedToWall: true},
			success: function(data) {
			if(data.postDeleted == true) {
				// hide the post
				jQuery("#load_status_out-"+entryId).fadeOut();
			}
		  }
	   });
	}
	function openWallTable(defaultImgURI, firstname, lastname, entryData, entryCreationDateTime, idWallPosts) {
		return '<table cellpadding="0" cellspacing="0" style=""><tr>'+
		'<td valign="top" rowspan="5">'+
        '<img style="padding: 3px" id="defaultImg a1" src="' + defaultImgURI + '" width="59" height="64" /></td><td valign="top">'+
        '<a href="<?=base_url()?>index.php/routers/regUserDash?id=<?=$this->session->userdata("userid")?>&requestedPageType=userProfiles" class="font1 link-font1 postname"><b>' + firstname + ' '+ lastname + '</b></a>'+
		'<td style="height: 19px"></td></tr><tr><td valign="top"><span class="font1">' + entryData + '</span></td><td></td></tr><tr><td valign="top">'+
		'<a class="link-font1 addComment" rel="' + idWallPosts + '">Add Comment&nbsp; </a><span class="font1">|&nbsp;</span> <a class="link-font1 viewCommentsLink" idbd="' + idWallPosts + '">'+
		'View Comments</a>&nbsp;<span class="font1"> |&nbsp;</span> <span class="font1">' + entryCreationDateTime + '</span></td>'+
		'<td style="height: 19px"></td></tr><tr><td valign="top"><span class="commentsList" id="viewComments-' + idWallPosts + '" style="width: 104%; display: none"></tr></table><br>';
	}

    function postToOpenWall() {
		var updater = jQuery("#updater").val();
		var dataString = '&updater=' + updater;
			jQuery.ajax({
			type: "POST",
			dataType: "JSON",
			url: "<?=base_url()?>index.php/regUserDash/postToOpenWall",
			data: dataString,
			json: {postedToWall: true},
			success: function(data) {
			if(data.postedToWall == true) {
				var html = openWallTable(data.defaultImgURI_JSON, data.firstname_JSON, data.lastname_JSON, data.entryDataJSON, data.entryCreationDateTimeJSON, data.idWallPosts_JSON);
				jQuery(html).fadeIn().prependTo("#new_posts");
				// after the post is added and displayed clear form and reselect the textarea
				jQuery("#updater").val("").focus();
			} else if(data.postedToWall == false) {
				return false;
		   	}
		  }
	   });
	}

	$(window).scroll(function() {
		if ($(window).scrollTop() + 100 > $(document).height() - $(window).height() ) {
		var id = $('.wallPosts:last').attr("relOne");
		$.ajax({
			type: "POST",
			url: "<?=base_url()?>index.php/routers/ajaxMore",
			data:  {id: id},
			cache: false,
			success: function(data) {
					$(data).appendTo('#main');
			}
		});
	}
	});
});
</script>
<style type="text/css">
	.changeWallTypeBox {
		background-color: #FFFFEE;
		padding: 5pt;

		border-color: #CDCDCD;
	 	border-top-style: solid;
	 	border-right-style: solid;
	 	border-bottom-style: solid;
	 	border-left-style: solid;
	 	border-bottom-width: 1pt;
	 	border-right-width: 1pt;
	 	border-left-width: 1pt;
	 	border-top-width: 1pt;

	 	border-radius: 3pt;
	}
</style>
<body>
			<table align="left" style="width: 26%" class="status-updater-box1">
				<tr>
					<td>
						<textarea id="updater" placeholder="What's on your mind?" class="updaterTextarea" name="TextArea2" style="border-radius: 3px; width: 499px; height: -3px" cols="20" rows="1"></textarea></td>
					</tr>
				<tr>
					<td class="right">
						<table cellpadding="0" cellspacing="0" style="width: 100%">
							<tr>
								<td class="left" style="width: 477px">
									&nbsp;<a class="grab"><strong>Grab Images</strong></a>&nbsp;&nbsp;
									<a class="grab"><strong>Grab Links</strong></a>
								</td>
								<td>
									<input name="share" id="shareButton" type="submit" value="Share" style="width: 58px; height: 28px" class="button1" />
								</td>
							</tr>
						</table>
					</td>
				</tr>
		</table>
		<td valign="top" style="width: 506px">
<?php if ($logged == '1') { ?>
<div class="changeWallTypeBox">
	<span class="font1">
		All proceeding wall posts are from all users across Gospel-links.org
	</span><br><a class="link-font3" href="<?=base_url()?>index.php/routers/regUserDash?requestedPageType=wall_1">Click here to go to your churches wall</a></div>
<?php } elseif ($logged == '0') { } ?>
<?php $this->load->helper('date');
	  $userid = $this->session->userdata('userid');
	   $query = $this->db->query("SELECT * FROM wallposts wp, users u WHERE u.userid = wp.postingUserId ORDER BY wp.idWallPosts DESC LIMIT 200");
      foreach ($query->result() as $row) {
      	$idwall = $row->idwallPosts;
		//$sql1 = $this->db->query("SELECT * FROM church_repo, churchmembers INNER JOIN church_repo u ON u.churchId = churchmembers.cMchurchId WHERE churchmembers.cMuserId = '{$row->userid}'");
		//foreach($sql1->result() as $row3) { ?>
<span id="new_posts"></span>
<table cellpadding="0" cellspacing="0" style="width: 506px; height: 49px" class="wallPosts" relOne="<?=$row->idwallPosts?>">
	<tr>
		<td valign="top" rowspan="5">
        <img style="padding: 3px" id="defaultImg a1" src="<?php echo base_url().$row->defaultImgURI; ?>" width="59" height="64" /></td>
		<td valign="top">
        <a href="<?=base_url()?>index.php/routers/regUserDash?id=<?=$row->userid?>&requestedPageType=userProfiles" class="font1 link-font1 postname"><b><?=$row->firstname . " " . $row->lastname?></b></a>
		<td style="height: 19px"></td>
	</tr>
	<tr>
		<td valign="top">
			<span class="font1_white"><?=$row->entryData?></span>
		</td>
		<td></td>
	</tr>
	<tr>
		<td valign="top">
		<a class="link-font1 addComment" rel="<?=$row->idwallPosts?>">Add Comment&nbsp; </a><span class="font1">|&nbsp;</span> <a class="link-font1 viewCommentsLink" idbd="<?=$row->idwallPosts?>">
		View Comments</a>&nbsp;<span class="font1"> |&nbsp;</span> <span class="font1_white"><?=date('m/d/Y h:ia ', strtotime($row->entryCreationDateTime))?></span></td>
		<td style="height: 19px"></td>
	</tr>
	<tr>
		<td valign="top">
        	<span class="commentsList" id="viewComments-<?php echo $row->idwallPosts; ?>" style="width: 104%; display: none">
<?php	$query1 = $this->db->query("SELECT * FROM wallpostcomments wp INNER JOIN users u ON u.userid = wp.userid WHERE wallPostId = '{$row->idwallPosts}' ORDER BY wp.idwallPostComments ASC");
		foreach($query1->result() as $row1)
			if ($query->num_rows() > 0) { ?>
			<div style="width: 96%">
			<table cellpadding="0" cellspacing="0" style="width: 408px; height: 5px;" class="style1 commentStyle">
			<tr>
			<td valign="top" style="width: 10px">
			<img style="padding: 3px" id="defaultImg a0" src="<?=base_url().$row1->defaultImgURI?>" align="left" width="25px" height="25px" />
			&nbsp;</td>
			<td valign="top" style="width: 319px">
			<a href="<?=base_url()?>index.php/routers/regUserDash?id=<?=$row1->userid?>&requestedPageType=userProfiles" class="font1 link-font1"><b><?=$row1->firstname.' '.$row1->lastname?> </b></a><?=$row1->entryData."<br><!--<img delComment='$row1->idwallPostComments' alt='Suni' style='float:right;' />-->".date('m/d/Y h:ia ', strtotime($row1->DateTimeCreated))?></a>
			</td>
		</tr>
	</table>
	</div>
	<?php } ?>
	</span>
		</td>
		</td>
	</tr>
	<tr>
		<td valign="top" style="width: 408px" rowspan="2">
		<span style="display: none" id="commentBox-<?=$row->idwallPosts?>">
			<input placeholder="Write a comment..." class="textbox1" postuserid="<?=$row->postingUserId?>" id="commentBox1-<?=$row->idwallPosts?>" style="width: 398px"></input>
		</span>
		</td>
		<td style="height: 1px"></td>
	</tr>
	<tr>
		<td style="width: 65px"></td>
		<td style="height: 18px; width: 33px"></td>
	</tr>
</table>

		</td>
	</tr>
</table>

</body>

</html>
<?php } //} ?>