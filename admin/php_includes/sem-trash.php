<?php
function test_input($data){
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);		
	return $data;
} 

if(isset($_POST['semid']) && isset($_POST['key1'])) {
	$semid=test_input($_POST['semid']);
	if($semid>=0) {
		include ("../../dbconfig.php");
		if($stmt=$con->prepare("DELETE FROM semester WHERE SemId=?")) {
			if($stmt->bind_param("i",$semid)) {
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
	else {
		echo 'An error occured. Try again later.';
	}
}
else {
	echo 'An error occured. Try again later.';
}
?>