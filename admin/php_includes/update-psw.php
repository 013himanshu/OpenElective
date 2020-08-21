<?php 
session_start();

function test_input($data){
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);		
	return $data;
}

if($_SERVER["REQUEST_METHOD"]=="POST") {
	if($_POST['uname'] && $_POST['cpsw'] && $_POST['npsw']) {
		$uname=test_input($_POST['uname']);
		$cpsw=test_input($_POST['cpsw']);
		$npsw=test_input($_POST['npsw']);

		if(empty($uname) || empty($cpsw) || empty($npsw)) {
			echo 'Empty fields are not accepted.';
		}
		else {
			include ('../../dbconfig.php');
			if($stmt=$con->prepare("SELECT uid, username, password FROM admin_users WHERE uid=? AND username=? AND password=?")) {
				if($stmt->bind_param("iss", $_SESSION['admin']['user'], $uname, $cpsw)) {
					$stmt->execute();
					if($stmt->bind_result($db_uid, $db_uname, $db_cpsw)){
						if($stmt->fetch()) {
							if($db_uid==$_SESSION['admin']['user'] && $db_uname==$uname && $db_cpsw==$cpsw) {
								//change password now...
								include ('../../dbconfig.php');
								if($stmt=$con->prepare("UPDATE admin_users SET password=? WHERE uid=? AND username=?")) {
									if($stmt->bind_param("sis", $npsw, $_SESSION['admin']['user'], $uname)) {
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