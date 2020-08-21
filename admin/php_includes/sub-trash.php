<?php
function test_input($data){
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);		
	return $data;
} 

if(isset($_POST['sid']) && isset($_POST['key1'])) {
	$sid=test_input($_POST['sid']);
	if($sid>=0) {
		include ("../../dbconfig.php");
		if($stmt=$con->prepare("DELETE FROM oechoice WHERE oeid=?")) {
			if($stmt->bind_param("i",$sid)) {
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