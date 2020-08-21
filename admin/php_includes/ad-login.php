<?php
session_start();

function test_input($data){
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);		
	return $data;
}

if($_SERVER["REQUEST_METHOD"]=="POST"){
	if(isset($_POST['uname']) && isset($_POST['psw'])){
		$uname=test_input($_POST['uname']);
		$psw=test_input($_POST['psw']);

		if(empty($uname) || empty($psw)) {
			echo 'Empty fields are not accepted.';
		}		
		else {
			include ('../../dbconfig.php');
			if($stmt = $con->prepare("SELECT uid, username, password FROM admin_users WHERE username=? AND password=? LIMIT 1")){
				if($stmt->bind_param("ss", $uname, $psw)){
					$stmt->execute();
					$stmt->bind_result($db_uid, $db_uname, $db_psw);
					if($stmt->fetch()) {
						if($uname==$db_uname && $psw==$db_psw) {
							$_SESSION['admin']=array();
							$_SESSION['admin']['user']=$db_uid;
							echo 'success';
						}											
					}
					else {
						echo 'Invalid username or password.';
					}
					$stmt->close();
					$con->close();
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