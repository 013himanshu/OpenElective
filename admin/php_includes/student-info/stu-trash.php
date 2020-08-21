<?php
function test_input($data){
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);		
	return $data;
} 

if(isset($_POST['uname']) && isset($_POST['key1'])) {
	$uname=test_input($_POST['uname']);
	if($uname>=0) {
		include ("../../../dbconfig.php");
		if($stmt=$con->prepare("DELETE FROM users WHERE username=?")) {
			if($stmt->bind_param("i",$uname)) {
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