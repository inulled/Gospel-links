<?php $userid = $this->session->userdata('userid');
	  $selectedId = $_REQUEST['id'];
	  $query1 = $this->db->query("SELECT * FROM userProfilePhotos p, userProfileAlbums a
	  							  WHERE p.isAlbumCover = 'Yes' AND p.userid = a.userid
	  							  AND a.userid = '{$selectedId}' AND a.albumId = p.albumId");

if ($userid == $selectedId) { // if loggedIn user is viewing his own albums, display the following
	echo '<div style="text-align: right"><span class="link-font3">Create Album</span><span class="font1"> | </span><span class="link-font3">Edit Albums</span></div>';
} foreach($query1->result() as $row1) { // loop through the following ?>

	<script type="text/javascript">
	$(document).ready(function() {
	function heightOverWidth() {
		return '<div style="width: 102px; height: 136px; border-radius: 3pt; background-color: white; border: 1px solid #C1C1C1; padding: 10pt">'+
			   '<img id="profileImg" alt="" height="130" src="<?=base_url().$row1->imgURI?>" width="100" />'+
			   '</div><span class="link-font3"><?=$row1->albumName?></span> <span class="font1"> - <?=$row1->albumDesc?></span><br><br>';
	}
	var img = $(".profileImg");
	if (img.attr('width') >= img.attr('height')) {
		alert("1");
	} if (img.attr('height') >= img.attr('width')) {
		$("#albumList").append(heightOverWidth());
	}
	});
	</script>

<? list($width, $height, $type, $attr) = getimagesize(base_url() . $row1->imgURI) ?>

<div id="albumList" style="padding: 10pt">
	<img style="display: none" class="profileImg" alt="" height="<?=$height?>" width="<?=$width?>" src="<?=base_url().$row1->imgURI?>" />
</div>

<?php } ?>