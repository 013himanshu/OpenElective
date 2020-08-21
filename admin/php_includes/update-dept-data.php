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
		
			if(isset($_POST['deptid']) && isset($_POST['name'])) {
				
					
					$deptid=test_input($_POST['deptid']);					
					$name=test_input($_POST['name']);

					if(empty($deptid) || empty($name)) {
						echo 'Empty fields are not accepted.';
					}					
					else {
						include ('../../dbconfig.php');
						if($stmt = $con->prepare("SELECT DepName FROM departments WHERE DepName=? LIMIT 1")){
							if($stmt->bind_param("s", $name)){
								$stmt->execute();								
								if($stmt->fetch()) {									
									echo 'A department already exists with this name.';
								}	
								else {										
										include ("../../dbconfig.php");
										if($stmt=$con->prepare("UPDATE departments SET DepName=? WHERE DepId=?")) {
											if($stmt->bind_param("si", $name, $deptid)) {
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
	}
	else {
		echo 'An error occured. Try again later.';
	}
}
else {
	echo 'An error occured. Try again later.';
}

?>