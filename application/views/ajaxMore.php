<? $id = $this->input->post('id'); $logged = $this->session->userdata('logged'); include('vh.php'); ?>
		<td valign="top" style="width: 506px">
<?php $this->load->helper('date');
	  $userid = $this->session->userdata('userid');
	   $query = $this->db->query("SELECT * FROM wallposts wp, users u WHERE u.userid = wp.postingUserId AND wp.idWallPosts < '$id' ORDER BY wp.idWallPosts DESC LIMIT 50");
      foreach ($query->result() as $row) {
      	$idwall = $row->idwallPosts;
		//$sql1 = $this->db->query("SELECT * FROM church_repo, churchmembers INNER JOIN church_repo u ON u.churchId = churchmembers.cMchurchId WHERE churchmembers.cMuserId = '{$row->userid}'");
		//foreach($sql1->result() as $row3) { ?>
<span id="new_posts"></span>
<table cellpadding="0" cellspacing="0" relOne="<?=$row->idwallPosts?>" style="width: 506px; height: 49px" class="wallPosts">
	<tr>
		<td valign="top" rowspan="5">
        <img style="padding: 3px" id="defaultImg a1" src="<?php echo base_url().$row->defaultImgURI; ?>" width="59" height="64" /></td>
		<td valign="top">
        <a href="<?=base_url()?>index.php/routers/regUserDash?id=<?=$row->userid?>&requestedPageType=userProfiles" class="font1 link-font1 postname"><b><?=$row->firstname . " " . $row->lastname?></b></a>
		<td style="height: 19px"></td>
	</tr>
	<tr>
		<td valign="top">
			<span class="font1"><?=$row->entryData?></span>
		</td>
		<td></td>
	</tr>
	<tr>
		<td valign="top">
		<a class="link-font1 addComment" rel="<?=$row->idwallPosts?>">Add Comment&nbsp; </a><span class="font1">|&nbsp;</span> <a class="link-font1 viewCommentsLink" idbd="<?=$row->idwallPosts?>">
		View Comments</a>&nbsp;<span class="font1"> |&nbsp;</span> 
		<span class="font1"><?=date('m/d/Y h:ia ', strtotime($row->entryCreationDateTime))?></span>
	</td>
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
			<a href="<?=base_url()?>index.php/routers/regUserDash?id=<?=$row1->userid?>&requestedPageType=userProfiles" class="font1 link-font1"><b><?=$row1->firstname.' '.$row1->lastname?> </b></a><?=$row1->entryData."<br><!--<img delComment='$row1->idwallPostComments' src='".base_url().$ldr."images/dashboard/delButton.png' alt='Suni' style='float:right;' />-->".date('m/d/Y h:ia ', strtotime($row1->DateTimeCreated))?></a>
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
<?php } //} ?>