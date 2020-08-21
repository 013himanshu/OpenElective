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
		if(isset($_POST['name'])){
			$name=test_input($_POST['name']);			

			if(empty($name)) {
				echo 'Empty fields are not accepted.';
			}			
			else {
				include ("../../dbconfig.php");
				if($stmt=$con->prepare("SELECT * FROM departments WHERE DepName=?")) {
					if($stmt->bind_param("s", $name)) {
						$stmt->execute();
						if($stmt->fetch()){
							echo 'A department already exists with this name.';
						}
						else {
							//add new department now...
							date_default_timezone_set("Asia/Kolkata");
							$date=$time="";
							$date=date("Y-m-d");				
							$time=date("h:ia");
							include ("../../dbconfig.php");
							if($stmt=$con->prepare("INSERT INTO departments(DepName, add_date, add_time) VALUES(?,?,?)")) {
								if($stmt->bind_param("sss", $name, $date, $time)) {
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