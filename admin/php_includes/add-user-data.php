<?php
session_start();

function test_input($data){
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);		
	return $data;
}

if($_SERVER["REQUEST_METHOD"]=="POST"){
	if(isset($_POST['uname']) && isset($_POST['name'])){
		if(isset($_POST['psw']) && isset($_POST['u_type'])){
			$uname=test_input($_POST['uname']);
			$name=test_input($_POST['name']);
			$psw=test_input($_POST['psw']);
			$u_type=test_input($_POST['u_type']);

			if(empty($uname) || empty($name) || empty($psw) || empty($u_type)) {
				echo 'Empty fields are not accepted.';
			}
			else {
				include ('../../dbconfig.php');
				if($stmt = $con->prepare("SELECT username FROM admin_users WHERE username=? LIMIT 1")){
					if($stmt->bind_param("s", $uname)){
						$stmt->execute();
						$stmt->bind_result($db_uname);
						if($stmt->fetch()) {
							if($uname==$db_uname) {
								echo 'Try another username.';
							}
						}
						else {
							date_default_timezone_set("Asia/Kolkata");
							$date=$time="";
							$date=date("Y-m-d");				
							$time=date("h:ia");

							if($stmt=$con->prepare("INSERT INTO admin_users (username, name, password, user_type, add_date, add_time) VALUES (?,?,?,?,?,?)")){
								if($stmt->bind_param("ssssss",$uname,$name,$psw,$u_type, $date, $time)){
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
}
else {
	echo 'An error occured. Try again later.';
}

?>