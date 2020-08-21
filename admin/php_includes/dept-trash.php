<?php
function test_input($data){
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);		
	return $data;
} 

if(isset($_POST['deptid']) && isset($_POST['key1'])) {
	$deptid=test_input($_POST['deptid']);
	if($deptid>=0) {
		include ("../../dbconfig.php");
		if($stmt=$con->prepare("DELETE FROM departments WHERE DepId=?")) {
			if($stmt->bind_param("i",$deptid)) {
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