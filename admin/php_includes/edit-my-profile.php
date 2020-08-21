<?php 
session_start();

function test_input($data){
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);		
	return $data;
}

if($_SERVER["REQUEST_METHOD"]=="POST"){
	if(isset($_POST['uname']) && isset($_POST['name'])) {
		$uname=test_input($_POST['uname']);
		$name=test_input($_POST['name']);

		if(empty($uname) && empty($name)) {
			echo 'Empty fields are not accepted.';
		}
		else {
			include ('../../dbconfig.php');
			if($stmt=$con->prepare("SELECT uid, username FROM admin_users WHERE uid <> ? AND username=?")) {
				if($stmt->bind_param("is", $_SESSION['admin']['user'], $uname)) {
					$stmt->execute();					
					if($stmt->fetch()) {
						echo 'Try another username.';
					}
					else {
						
						//update profile now..
						include ('../../dbconfig.php');
						if($stmt=$con->prepare("UPDATE admin_users SET username=?, name=? WHERE uid=?")) {
							if($stmt->bind_param("ssi", $uname, $name, $_SESSION['admin']['user'])) {
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