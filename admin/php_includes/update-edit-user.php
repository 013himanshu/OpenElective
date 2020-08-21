<?php 
session_start();

function test_input($data){
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);		
	return $data;
}

if($_SERVER["REQUEST_METHOD"]=="POST"){
	if(isset($_POST['key1'])) {
		if(isset($_POST['uid']) && $_POST['uid']>=0) {
			if(isset($_POST['uname']) && isset($_POST['name'])) {
				if(isset($_POST['psw']) && isset($_POST['utype'])) {
					$uid=test_input($_POST['uid']);
					$uname=test_input($_POST['uname']);
					$name=test_input($_POST['name']);
					$psw=test_input($_POST['psw']);
					$utype=test_input($_POST['utype']);

					if(empty($uid) || $uid<0) {
						echo 'An error occured. Try again later.';
					}
					else if(empty($uname) || empty($name)) {
						echo 'An error occured. Try again later.';
					}
					else if(empty($psw) || empty($utype)) {
						echo 'An error occured. Try again later.';
					}
					else {
						include ('../../dbconfig.php');
						if($stmt = $con->prepare("SELECT uid, username FROM admin_users WHERE username=? LIMIT 1")){
							if($stmt->bind_param("s", $uname)){
								$stmt->execute();
								$stmt->bind_result($db_uid, $db_uname);
								if($stmt->fetch()) {
									if($uid!=$db_uid && $uname==$db_uname) {
										echo 'Try another username.';
									}
									else {
										include ("../../dbconfig.php");
										if($stmt=$con->prepare("UPDATE admin_users SET username=?, name=?, password=?, user_type=? WHERE uid=?")) {
											if($stmt->bind_param("ssssi", $uname, $name, $psw, $utype, $uid)) {
												$stmt->execute();
												echo 'success';							
											}
											else {
												echo 'An error occured. Try again later.';
											}
										}
										else {
											echo 'An error occured. Try again later.';
										}
									}
								}
								else {
									include ("../../dbconfig.php");
									if($stmt=$con->prepare("UPDATE admin_users SET username=?, name=?, password=?, user_type=? WHERE uid=?")) {
										if($stmt->bind_param("ssssi", $uname, $name, $psw, $utype, $uid)) {
											$stmt->execute();
											echo 'success';							
										}
										else {
											echo 'An error occured. Try again later.';
										}
									}
									else {
										echo 'An error occured. Try again later.';
									}
								}
							}
						}		
					}

				}
				else {
					echo 'An error occured. Try again later.';
				}
			}
			else {
				echo 'An error occured. Try again later.';
			}
		}
		else {
			echo 'An error occured. Try again later.';
		}
	}
	else {
		echo 'An error occured. Try again later.';
	}
}
else {
	echo 'An error occured. Try again later.';
}
?>