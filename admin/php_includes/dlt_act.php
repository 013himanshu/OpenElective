<?php 
session_start();

function test_input($data){
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);		
	return $data;
}

if($_SERVER["REQUEST_METHOD"]=="POST") {
	if(isset($_POST['uname']) && isset($_POST['psw'])) {
		$uname=test_input($_POST['uname']);
		$psw=test_input($_POST['psw']);

		if(empty($uname) || empty($psw)) {
			echo 'Empty fields are not accepted.';
		}
		else {
			include ('../../dbconfig.php');
			if($stmt=$con->prepare("SELECT uid, username, password FROM admin_users WHERE uid=? AND username=? AND password=?")) {
				if($stmt->bind_param("iss", $_SESSION['admin']['user'], $uname, $psw)) {
					$stmt->execute();
					if($stmt->bind_result($db_uid, $db_uname, $db_psw)){
						if($stmt->fetch()) {
							if($db_uid==$_SESSION['admin']['user'] && $db_uname==$uname && $db_psw==$psw) {
								//deleting user now...
								include ('../../dbconfig.php');
								if($stmt=$con->prepare("DELETE FROM admin_users WHERE uid=?")) {
									if($stmt->bind_param("i", $_SESSION['admin']['user'])) {
										$stmt->execute();
										session_destroy();
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
							echo 'Invalid info.';
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
	}
	else {
		echo 'An error occured. Try again later.';
	}
}
else {
	echo 'An error occured. Try again later.';
}


?>