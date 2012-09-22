<?php include("vh.php"); ?>
<script type="text/javascript">
	$(document).ready(function() {
	$("#submitForm").live('click', function() {
		updateUserInfo();
	});

	function updateUserInfo() {
		jQuery.ajax({
			type: "POST",
			dataType: "JSON",
			url: "<?=base_url()?>index.php/regUserDash/updateUserInfo",
			data: { birthdate: birthdate = $("#birthdate").val(),
					sex: sex = $("#sex :selected").val(),
					interestedIn: interestedIn = $("#interestedIn :selected").val(),
					relationshipStatus: relationshipStatus = $("#relationshipStatus :selected").val(),
					knownLanguages: knownLanguages = $("#knownLanguages").val(),
					religiousViews: $("#religiousViews").val(),
					politicalViews: $("#politicalViews").val(),
					aboutMe: $("#aboutMe").val(),
					mobilePhone: $("#mobilePhone").val(),
					neighborhood: $("#neighborhood").val(),
					website: $("#website").val(),
					email: $("#email").val()
			}, success: function(data) {
			if(data.userInfoUpdated == true) {
				alert("Your information has been added");
				window.location.reload();
			}
		  }
	   });
	}
	});
</script>
<?php $selectedId = $_REQUEST['id'];
	  $myuserid = $this->session->userdata('userid'); ?>
						<table style="width: 34%">
								<tr>
									<td style="width: 193px"><span class="font1">Birthdate</span></td>
									<td style="width: 275px">
									<input id="birthdate" class="textbox1" style="width: 200pt" type="text" /></td>
								</tr>
								<tr>
									<td style="width: 193px"><span class="font1">Sex</span></td>
									<td style="width: 275px">
									<select class="textbox1" id="sex" style="width: 207pt">
									<option selected="selected">Select your sex</option>
									<option>Male</option>
									<option>Female</option>
									</select></td>
								</tr>
								<tr>
									<td style="width: 193px" class="font1">Interested In</td>
									<td style="width: 275px">
									<select class="textbox1" id="interestedIn" style="width: 207pt">
									<option selected="selected">Select your interest</option>
									<option>Men</option>
									<option>Women</option>
									</select></td>
								</tr>
								<tr>
									<td style="width: 193px" class="font1">Relationship Status</td>
									<td style="width: 275px">
									<select class="textbox1" id="relationshipStatus" style="width: 207pt">
									<option selected="selected">Select your relationship status</option>
									<option>Single</option>
									<option>In a relationship</option>
									<option>Engaged</option>
									<option>Married</option>
									<option>It's complicated</option>
									<option>In an open relationship</option>
									<option>Widowed</option>
									<option>Seperated</option>
									<option>Divorsed</option>
									<option>In a civil union</option>
									<option>In a domestic partnership</option>
									</select></td>
								</tr>
								<tr>
									<td style="width: 193px" class="font1">Known Languages</td>
									<td style="width: 275px">
									<input class="textbox1" id="knownLanguages" style="width: 200pt" type="text" /></td>
								</tr>
								<tr>
									<td style="width: 193px" class="font1">Religious Views</td>
									<td style="width: 275px">
									<input class="textbox1" id="religiousViews" style="width: 200pt" type="text" /></td>
								</tr>
								<tr>
									<td style="width: 193px" class="font1">Political Views</td>
									<td style="width: 275px">
									<input class="textbox1" id="politicalViews" style="width: 200pt" type="text" /></td>
								</tr>
								<tr>
									<td style="width: 193px" class="font1">About Me<br />
									<br />
									<br />
									<br />
									</td>
									<td style="width: 275px">
									<textarea class="textarea2" id="aboutMe" style="width: 198pt; height: 93px"></textarea></td>
								</tr>
								<tr>
									<td style="width: 193px" class="font1">Mobile Phone</td>
									<td style="width: 275px">
									<input class="textbox1" id="mobilePhone" style="width: 200pt" type="text" /></td>
								</tr>
								<tr>
									<td style="width: 193px" class="font1">Neighborhood</td>
									<td style="width: 275px">
									<input class="textbox1" id="neighborhood" style="width: 200pt" type="text" /></td>
								</tr>
								<tr>
									<td style="width: 193px" class="font1">Website</td>
									<td style="width: 275px">
									<input class="textbox1" id="website" style="width: 200pt" type="text" /></td>
								</tr>
								<tr>
									<td style="width: 193px" class="font1">Email</td>
									<td style="width: 275px">
									<input class="textbox1" id="email" style="width: 200pt" type="text" /></td>
								</tr>
								<tr>
									<td style="width: 193px" class="font1">&nbsp;</td>
									<td style="width: 275px; text-align: right">
									<input id="submitForm" type="button" value="Submit" style="width: 63px; height: 28px" class="button1"></td>
								</tr>
							</table>