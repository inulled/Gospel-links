<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class regUserDash extends CI_Controller {
	public function postToWall() {
		$this->load->helper("date");
		$userid = $this->session->userdata('userid');
        $query  = $this->db->query("SELECT * FROM churchMembers WHERE cMuserId = '{$userid}'");
        $row = $query->row();
        $myChurchId = $row->cMchurchId;
		$entryData = $this->input->post('updater');
		// fix ignore problem... it has to do with mysql....

		$data = array('entryData' => $entryData,
   					  'entryCreationDateTime' => NOW(),
   					  'postingUserId' => $userid,
   					  'wpChurchId' => $myChurchId);

$this->db->insert('wallPosts', $data);
		$insertedId = $this->db->insert_id();

		$wallPostQuery1 = $this->db->query("SELECT * FROM wallPosts");
		foreach ($wallPostQuery1->result() as $row) {
			if ($row->idwallPosts == $insertedId) {
				$idWallPostsJSON		   = $row->idwallPosts;
				$entryDataJSON 			   = $row->entryData;
				$entryCreationDateTimeJSON = date('m/d/Y H:ia ', strtotime($row->entryCreationDateTime));
			}
		}
		$usersQuery1 = $this->db->query("SELECT * FROM users");
		foreach ($usersQuery1->result() as $row) {
			if ($row->userid == $userid) {
				$firstname_JSON 	= $row->firstname;
				$lastname_JSON 		= $row->lastname;
				$defaultImgURI_JSON = base_url().$row->defaultImgURI;
			}
		}
		echo json_encode(array('postedToWall' => true, 'idWallPosts_JSON' => $idWallPostsJSON, 'firstname_JSON' => $firstname_JSON, 'lastname_JSON' => $lastname_JSON, 'defaultImgURI_JSON' => $defaultImgURI_JSON, 'entryDataJSON' => $entryDataJSON, 'entryCreationDateTimeJSON' => $entryCreationDateTimeJSON));
	} public function wallPostComments() {
		// This function processes wall post comments

		// pull the submitted comment data
		$returnedPostId = $this->inuput->post('entryId');
		$returnedCommentData = $this->input->post('returnedCommentData');

		// pull the required session data
		$userid = $this->session->userdata('userid');

		// select the sql data from wallPosts and wallPostComments
		$query = $this->db->query("SELECT * FROM wallPosts, wallPostComments");
		
		// loop through the mysql rows and process the expanded sql code
		foreach ($query->result() as $row) {
			if($row->idwallPosts == $returnedPostId) {
				echo json_encode(array('commentedToWall' => true, 'commentData_JSON' => $returnedCommentData, 'returnedPostId' => $returnedPostId));
			} else {
				echo json_encode(array('commentedToWall' => false));
			}
		}
	} public function delPost() {
		$returnedEntryId = $this->input->post('entryId');
		$this->db->where("idwallPosts", $returnedEntryId);
		$this->db->delete("wallposts");
		echo json_encode(array('postDeleted' => true));
	} public function sessionExpire() {
		if ($this->session->userdata("logged") == "1") {
			echo json_encode(array("sessionExpired" => false));
		} elseif($this->session->userdata("logged") == "0") {
			echo json_encode(array("sessionExpire" => true));
		}
	} public function extendSession() {
		// set loggedIn session var
		$this->session->set_userdata('logged', '1');
		// return json to ajax call
		echo json_encode(array("extendedSession" => true));
	} public function commentsList() {
		$query1 = $this->db->query("SELECT * FROM wallpostcomments WHERE wallPostId = '{$row->idwallPosts}'");
		if ($query->num_rows() > 0) {
			echo json_encode(array("entryData" => $row1->entryData));
		} else {
			echo json_encode(array("noCommentData" => TRUE));
		}
	} public function addComment() {
		$returnedEntryId = $this->input->post("newId");
		$returnedData	 = $this->input->post("commentBoxData");
		$returnedUserId	 = $this->input->post("userid");
		
		$this->db->query("INSERT IGNORE INTO wallpostcomments (entryData, DateTimeCreated, userid, wallPostId)
			 			  VALUES('{$returnedData}', NOW(), '{$returnedUserId}', '{$returnedEntryId}')");
		$usersQuery1 = $this->db->query("SELECT * FROM users");
		foreach ($usersQuery1->result() as $row) {
			if ($row->userid == $returnedUserId) {
				$firstname	 	= $row->firstname;
				$lastname 		= $row->lastname;
				$defaultImgURI 	= base_url().$row->defaultImgURI;
		$wallPostCommentQuery = $this->db->query("SELECT * FROM wallpostcomments");
		foreach ($wallPostCommentQuery->result() as $row1) {
			$entryCreationDateTime = date('m/d/Y H:ia ', strtotime($row1->DateTimeCreated));
		}		
				echo json_encode(array('commentAdded' => true, 'defaultImgURI' => $defaultImgURI, 'firstname' => $firstname, 'lastname' => $lastname, 'returnedEntryId' => $returnedEntryId, 'returnedData' => $returnedData, 'returnedUserId' => $returnedUserId, 'entryCreationDateTime' => $entryCreationDateTime));
			}
		}
	} public function addFriend() {
		$userid = $this->session->userdata('userid');
		$targetedUserId = $this->input->post('targetedUserId');
		
		$this->db->query("INSERT IGNORE INTO friend (userid_friends, friendId_friends, relationSince_friends, relationStatus_friends)
						  VALUES('{$userid}', '{$targetedUserId}', NOW(), 'requested')");

		echo json_encode(array('addFriendSuccess' => TRUE));
	} public function acceptFriend() {
		// the following is when the user accepts the friend request
		$userid = $this->session->userdata('userid');
		$targetedUserId = $this->input->post('targetedUserId');
		
		$this->db->query("UPDATE friend SET relationStatus_friends = 'friends' WHERE friendId_friends = '{$userid}' AND userid_friends = '{$targetedUserId}'");
		echo json_encode(array('acceptFriendSuccess' => TRUE));
	} public function cancelFriendship() {
		// the following is when the user cancels a friendship connection
		$userid = $this->session->userdata('userid');
		$targetedUserId = $this->input->post('targetedUserId');
		
		$this->db->query("DELETE FROM friend WHERE userid_friends = '{$userid}' AND friendId_friends = '{$targetedUserId}' OR userid_friends = '{$targetedUserId}' AND friendId_friends = '{$userid}' ");
		echo json_encode(array('friendshipCanceled' => true));
	} public function updateUserInfo() {
		$userid = $this->session->userdata('userid');
		$birthdate = $this->input->post("birthdate");
		$sex = $this->input->post("sex");
		$interestedIn = $this->input->post("interestedIn");
		$relationshipStatus = $this->input->post("relationshipStatus");
		$languages = $this->input->post("languages");
		$religiousViews = $this->input->post("religiousViews");
		$politicalViews = $this->input->post("politicalViews");
		$aboutMe = $this->input->post("aboutMe");
		$mobilePhone = $this->input->post("mobilePhone");
		$neighborhood = $this->input->post("neighborhood");
		$websites = $this->input->post("websites");
		$email = $this->input->post("email");
		
		$this->db->query("INSERT INTO user_info (birthdate, sex, interestedIn, relationshipStatus, Languages, religiousViews, politicalViews, aboutMe, mobilePhone, neighborhood, websites, email, userid)
						  VALUES('{$birthdate}', '{$sex}', '{$interestedIn}', '{$relationshipStatus}', '{$languages}', '{$religiousViews}', '{$politicalViews}', '{$aboutMe}', '{$mobilePhone}', '{$neighborhood}', '{$websites}', '{$email}', '{$userid}')");

		echo json_encode(array('userInfoUpdated' => true));
	} public function checkIsLoggedIn() {
		if ($this->session->userdata("logged") == '1') { // if is logged in process the following
			echo json_encode(array('loggedIn' => true));
		} elseif($this->session->userdata("logged") == '0') {
			echo json_encode(array("loggedIn" => false));
		}
	} public function checkIsChurchRegistered() {
		$userid = $this->session->userdata('userid');
		$sql = $this->db->query("SELECT * FROM users WHERE userid = '{$userid}'");

		if ($sql->num_rows() > 0) {
  	 		$row = $sql->row();
			} if ($row->isChurchRegistered == 'No') {
				echo json_encode(array('isRegistered' => 'No'));
			} elseif ($row->isChurchRegistered == 'Yes') {
				echo json_encode(array('isRegistered' => 'Yes'));
			}
	} public function addCommentToStartpageWall() {
		$userid = $this->session->userdata("userid");
		$postingUserId = $this->input->post("postinguserid");
			
		$query = $this->db->query("SELECT * FROM churchmembers WHERE cMuserid = '{$userid}'");
		foreach ($query->result() as $row) {
			$id1 = "";
			$id2 = "";
			if ($postingUserId == $row->cMuserId) { // check to see what church the posting user is a member of
				$id1 = $row->cMchurchId; // if posting user is a member of a church set it to var id1
			} if ($userid == $row->cMuserId) { // check to see what church myuserid is a member of
				$id2 = $row->cMchurchId; // if myuserid is a member of a church set it to var2
			} if ($id1 == $id2) { // if posting user and myuserid are a member of the same church process the following
				echo json_encode(array('isMembershipSame' => true));
			} elseif ($id1 != $id2) { // if posting user and myuserid are not a member of the same user process the following
				echo json_encode(array('isMembershipSame' => false));
			}
		}
	} public function instantSearch() {
		$q = $this->input->get("q");
		if ($q) {
    		$sql = $this->db->query("SELECT * FROM users WHERE (firstname LIKE '%{$q}%' OR lastname LIKE '%{$q}%') OR concat_ws(' ', firstname, lastname) LIKE '%{$q}%' LIMIT 5");

    		$results=array();
    		foreach ($sql->result() as $row) {
    			$results[] = array('firstname' => $row->firstname, 'lastname' => $row->lastname, 'userid' => $row->userid, 'defaultImgURI' => base_url().$row->defaultImgURI);
    		} echo json_encode($results);
		}
	} public function postToOpenWall() {
		$this->load->helper("date");
		$userid = $this->session->userdata('userid');
        $query  = $this->db->query("SELECT * FROM churchmembers WHERE cMuserId = '{$userid}'");
        $row = $query->row();
        $myChurchId = $row->cMchurchId;
		$entryData = $this->input->post('updater');
		// fix ignore problem... it has to do with mysql....
		
		$time = time();

		$data = array('entryData' => $entryData,
   					  'entryCreationDateTime' => unix_to_human($time),
   					  'postingUserId' => $userid,
   					  'wpChurchId' => $myChurchId);

		$this->db->insert('wallposts', $data);
		$insertedId = $this->db->insert_id();

		$wallPostQuery1 = $this->db->query("SELECT * FROM wallposts");
		foreach ($wallPostQuery1->result() as $row) {
			if ($row->idwallPosts == $insertedId) {
				$idWallPostsJSON		   = $row->idwallPosts;
				$entryDataJSON 			   = $row->entryData;
				$entryCreationDateTimeJSON = date('m/d/Y H:ia ', strtotime($row->entryCreationDateTime));
			}
		}
		$usersQuery1 = $this->db->query("SELECT * FROM users");
		foreach ($usersQuery1->result() as $row) {
			if ($row->userid == $userid) {
				$firstname_JSON 	= $row->firstname;
				$lastname_JSON 		= $row->lastname;
				$defaultImgURI_JSON = base_url().$row->defaultImgURI;
			}
		}
		echo json_encode(array('postedToWall' => true, 'idWallPosts_JSON' => $idWallPostsJSON, 'firstname_JSON' => $firstname_JSON, 'lastname_JSON' => $lastname_JSON, 'defaultImgURI_JSON' => $defaultImgURI_JSON, 'entryDataJSON' => $entryDataJSON, 'entryCreationDateTimeJSON' => $entryCreationDateTimeJSON));
	} public function addMessage() {
		$responseMessage = $this->input->post('responseMessage');
		$messageSentById = $this->session->userdata('userid');
		$messageRecipientId = $this->input->post('messageRecipientId');

		$query = $this->db->query("INSERT INTO messages (messageBody, messageSentById, messageRecipientId, dateTimeCreated, notificationStatus)
								   VALUES('{$responseMessage}', '{$messageSentById}', '{$messageRecipientId}', NOW(), 'Unread')");

		echo json_encode(array('inserted' => true));
	} public function ajaxMore() {
		$id = $this->input->post('id');
		$result = $this->db->query("SELECT * FROM wallposts WHERE idwallPosts < '$id' ORDER BY idwallPosts DESC LIMIT 9");

		$idWallPostsArray = array();
		foreach ($result->result() as $row) {
			$idWallPostArray = array();
			$idWallPostArray['idWallPosts'] = $row->idwallPosts;
			$idWallPostsArray[] = $idWallPostArray;
		}
		echo json_encode(array("idWallPosts" => $idWallPostsArray));
		//foreach($result->result() as $row) {
	//		echo json_encode(array('idwallPosts' => $row->idwallPosts));
		//}
	}
}
?>