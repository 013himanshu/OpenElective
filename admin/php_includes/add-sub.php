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
		if(isset($_POST['name']) && isset($_POST['sem']) && isset($_POST['dept'])){
			$name=test_input($_POST['name']);
			$sem=test_input($_POST['sem']);
			$dept=test_input($_POST['dept']);			

			if(empty($name) || empty($sem) || empty($dept)) {
				echo 'Empty fields are namet accepted.';
			}			
			else {
				include ("../../dbconfig.php");
				if($stmt=$con->prepare("SELECT * FROM oechoice WHERE oename=? AND Semester=? AND Department=?")) {
					if($stmt->bind_param("sis", $name, $sem, $dept)) {
						$stmt->execute();
						if($stmt->fetch()){
							echo 'A subject already exists with the same data.';
						}
						else {
							//add new subject now...
							date_default_timezone_set("Asia/Kolkata");
							$date=$time="";
							$date=date("Y-m-d");				
							$time=date("h:ia");
							include ("../../dbconfig.php");
							if($stmt=$con->prepare("INSERT INTO oechoice(oename, Semester, Department, add_date, add_time) VALUES(?,?,?,?,?)")) {
								if($stmt->bind_param("sisss", $name, $sem, $dept, $date, $time)) {
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