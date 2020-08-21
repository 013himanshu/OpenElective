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
		if(isset($_POST['no'])){
			$no=test_input($_POST['no']);			

			if(empty($no)) {
				echo 'Empty fields are not accepted.';
			}			
			else {
				include ("../../dbconfig.php");
				if($stmt=$con->prepare("SELECT * FROM semester WHERE Semester=?")) {
					if($stmt->bind_param("i", $no)) {
						$stmt->execute();
						if($stmt->fetch()){
							echo 'A semester already exists with this no.';
						}
						else {
							//add new semester now...
							date_default_timezone_set("Asia/Kolkata");
							$date=$time="";
							$date=date("Y-m-d");				
							$time=date("h:ia");
							include ("../../dbconfig.php");
							if($stmt=$con->prepare("INSERT INTO semester(Semester, add_date, add_time) VALUES(?,?,?)")) {
								if($stmt->bind_param("iss", $no, $date, $time)) {
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