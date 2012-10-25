<!-- Load View Data-->
<?php include('vh.php'); ?>
<div style="background-color: #C41E3A;
			font-family: Tahoma;
			font-size: 11pt;
			color: white;
			padding: 3pt;
			border-radius: 3pt">Oops, something went wrong. Please try again.</div>
<img src="<?=base_url()?>vd/user-data/church.jpg" style="padding: 3pt; float: left" width="130" height="142" alt="" />
<span class="font1"> - This is the default profile image for Gospel-links.</span><br>
<a href="<?=base_url()?>index.php/routers/search_aChurch" class="grab"><strong>Use This Image.</strong></a><br><br><br><br>
<a class="font1">Or upload your own:</a>
	<?php echo form_open_multipart('home/uploadDefaultImg');?>
	<input type="file" name="userfile" size="20" /><br>
<input sumit name="continue" id="continue" type="submit" value="Continue with Registration" style="width: 190px; height: 28px" class="button1" /><br><br><br><br>
</form>