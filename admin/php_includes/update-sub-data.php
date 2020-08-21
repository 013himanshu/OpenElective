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
		
			if(isset($_POST['oeid']) && isset($_POST['sub_name']) && isset($_POST['sub_dept']) && isset($_POST['sub_sem'])) {
				
					
					$oeid=test_input($_POST['oeid']);					
					$sub_name=test_input($_POST['sub_name']);
					$sub_dept=test_input($_POST['sub_dept']);
					$sub_sem=test_input($_POST['sub_sem']);

					if(empty($oeid) || empty($sub_name) || empty($sub_dept) || empty($sub_sem)) {
						echo 'Empty fields are not accepted.';
					}					
					else {
						include ('../../dbconfig.php');
						if($stmt = $con->prepare("SELECT oename, Semester, Department FROM oechoice WHERE oename=? AND Semester=? AND Department=? LIMIT 1")){
							if($stmt->bind_param("sis", $sub_name, $sub_sem, $sub_dept)){
								$stmt->execute();								
								if($stmt->fetch()) {									
									echo 'A Subject already exists with these details.';
								}	
								else {										
										include ("../../dbconfig.php");
										if($stmt=$con->prepare("UPDATE oechoice SET oename=?, Semester=?, Department=? WHERE oeid=?")) {
											if($stmt->bind_param("sisi", $sub_name, $sub_sem, $sub_dept, $oeid)) {
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