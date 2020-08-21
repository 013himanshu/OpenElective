<?php 
session_start();

function test_input($data){
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);		
	return $data;
}

if($_SERVER["REQUEST_METHOD"]=="POST"){
	if(isset($_POST['key1'])){
		if(isset($_POST['reg_no']) && isset($_POST['psw']) && isset($_POST['cgpa']) && isset($_POST['cgpa1']) && isset($_POST['name'])){
			$reg_no=test_input($_POST['reg_no']);
			$name=test_input($_POST['name']);
			$psw=test_input($_POST['psw']);
			$cgpa=test_input($_POST['cgpa']);
			$cgpa1=test_input($_POST['cgpa1']);

			if(empty($reg_no) || empty($name) || empty($psw) || empty($cgpa) || empty($cgpa1)) {
				echo 'Empty fields are not accepted.';
			}
			else if($reg_no<10 || $cgpa<0 || $cgpa1<0) {
				echo 'An error occured. Try again later.';
			}
			else {
				include ("../../../dbconfig.php");
				if($stmt=$con->prepare("SELECT * FROM users WHERE username=?")) {
					if($stmt->bind_param("i", $reg_no)) {
						$stmt->execute();
						if($stmt->fetch()){
							echo 'A student already exists with this registration no.';
						}
						else {
							//add new student now...
							include ("../../../dbconfig.php");
							if($stmt=$con->prepare("INSERT INTO users VALUES(?,?,?,?,?)")) {
								if($stmt->bind_param("issdd", $reg_no, $name, $psw, $cgpa, $cgpa1)) {
									$stmt->execute();
									$stmt->close();
									$con->close();
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