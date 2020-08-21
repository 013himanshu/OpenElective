<?php
function test_input($data){
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);		
	return $data;
} 

if(isset($_POST['aid']) && isset($_POST['key1'])) {
	$aid=test_input($_POST['aid']);
	if($aid>=0) {
		include ("../../dbconfig.php");
		if($stmt=$con->prepare("DELETE FROM electivealloted WHERE Rg_No=?")) {
			if($stmt->bind_param("i",$aid)) {
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