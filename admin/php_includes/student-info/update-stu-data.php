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
		
			if(isset($_POST['uname']) && isset($_POST['name']) && isset($_POST['psw']) && isset($_POST['cgpa']) && isset($_POST['cgpa1'])) {
				
					
					$uname=test_input($_POST['uname']);
					$name=test_input($_POST['name']);					
					$psw=test_input($_POST['psw']);
					$cgpa=test_input($_POST['cgpa']);
					$cgpa1=test_input($_POST['cgpa1']);
					
					if(empty($uname) || empty($name)) {
						echo 'Empty fields are not accepted.';
					}
					else if(empty($psw) || empty($cgpa) || empty($cgpa1)) {
						echo 'Empty fields are not accepted.';
					}
					else {
						include ('../../../dbconfig.php');
						if($stmt = $con->prepare("SELECT username FROM users WHERE username=? LIMIT 1")){
							if($stmt->bind_param("s", $uname)){
								$stmt->execute();
								$stmt->bind_result($db_uname);
								if($stmt->fetch()) {
									if($uname!=$db_uname) {
										echo 'An error occured. Try again later.';
									}
									else {
										$flag=0;
										include ("../../../dbconfig.php");
										if($stmt=$con->prepare("UPDATE users SET name=?, password=?, CGPA=?, CGPA1=? WHERE username=?")) {
											if($stmt->bind_param("ssdds",$name, $psw, $cgpa, $cgpa1, $uname)) {
												$stmt->execute();
												$stmt->close();
												$con->close();
												$flag++;							
											}
											else {
												echo 'An error occured. Try again later.';
											}
										}
										else {
											echo 'An error occured. Try again later.';
										}
										include ("../../../dbconfig.php");
										if($stmt=$con->prepare("UPDATE studentinforanked SET CGPA=?, CGPA1=? WHERE RegistrationNO=?")) {
											if($stmt->bind_param("ddi", $cgpa, $cgpa1, $uname)) {
												$stmt->execute();
												$stmt->close();
												$con->close();
												$flag++;							
											}
											else {
												echo 'An error occured. Try again later.';
											}
										}
										else {
											echo 'An error occured. Try again later.';
										}
										include ("../../../dbconfig.php");
										if($stmt=$con->prepare("UPDATE studentinfo SET CGPA=?, CGPA1=? WHERE RegistrationNO=?")) {
											if($stmt->bind_param("ddi", $cgpa, $cgpa1, $uname)) {
												$stmt->execute();
												$stmt->close();
												$con->close();
												$flag++;							
											}
											else {
												echo 'An error occured. Try again later.';
											}
										}
										if($flag>3) {
											echo 'success';
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