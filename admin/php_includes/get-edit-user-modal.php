<?php
function test_input($data){
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);		
	return $data;
}

if(isset($_POST['key1'])) {
	if(isset($_POST['uid']) && $_POST['uid']>=0) {
		$uid=test_input($_POST['uid']);
		if(empty($uid) && $uid<0) {
			echo 'Something went wrong. Try again later.';
		}
		else {
			include ("../../dbconfig.php");
			if($stmt=$con->prepare("SELECT username, name, password, user_type FROM admin_users WHERE uid=?")) {
				if($stmt->bind_param("i",$uid)) {
					$stmt->execute();
					$stmt->bind_result($db_uname, $db_name, $db_psw, $db_utype);
					if($stmt->fetch()){
						if($db_utype=="superuser") {
							$db_psw="*****";
						}
						echo '
							<span class="err"></span> 
							<div class="input-group">
								<label for="add-user-uname">Username</label><br>						
								<input type="text" id="add-user-uname" name="add-user-uname" class="form-control" placeholder="Enter Username" maxlength="50" minlength="3" value="'.$db_uname.'" required />
							</div>
							<div class="input-group">
								<label for="add-user-name">Name</label><br>						
								<input type="text" id="add-user-name" name="add-user-name" class="form-control" placeholder="Enter Name" maxlength="50" minlength="2" value="'.$db_name.'" required />
							</div>
							<div class="input-group">
								<label for="add-user-psw">Password</label><br>						
								<input type="text" id="add-user-psw" name="add-user-psw" class="form-control" placeholder="Enter Password" maxlength="10" minlength="4" value="'.$db_psw.'" required />	
							</div>
							<div class="input-group">
								<label for="add-user-type">Choose User Type</label><br>

								<input type="radio" id="superuser" name="add-user-type" value="superuser"'; if($db_utype=="superuser") {echo 'checked';} echo ' required />
								<label for="superuser" class="add-user-type" style="width:160px;">Super User</label>

								<input type="radio" id="user" name="add-user-type" value="user"'; if($db_utype=="user") {echo 'checked';} echo ' required />
								<label for="user" class="add-user-type" style="width:160px;">User</label>
							</div>
							';
					}
				}
			}
		}	
	}
}
?>