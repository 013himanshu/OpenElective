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
		
			if(isset($_POST['semid']) && isset($_POST['no'])) {
				
					
					$semid=test_input($_POST['semid']);					
					$no=test_input($_POST['no']);

					if(empty($semid) || empty($no)) {
						echo 'Empty fields are not accepted.';
					}					
					else {
						include ('../../dbconfig.php');
						if($stmt = $con->prepare("SELECT Semester FROM semester WHERE Semester=? LIMIT 1")){
							if($stmt->bind_param("i", $no)){
								$stmt->execute();								
								if($stmt->fetch()) {									
									echo 'A semester already exists with this no.';
								}	
								else {										
										include ("../../dbconfig.php");
										if($stmt=$con->prepare("UPDATE semester SET Semester=? WHERE semid=?")) {
											if($stmt->bind_param("ii", $no, $semid)) {
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