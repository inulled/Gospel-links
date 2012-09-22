			<?php $userid = $this->session->userdata('userid');
			 $selectedId = $_REQUEST['id'];
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