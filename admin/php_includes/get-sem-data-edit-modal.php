<?php
function test_input($data){
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);		
	return $data;
}

if(isset($_POST['key1'])) {
	if(isset($_POST['semid']) && $_POST['semid']>=0) {
		$semid=test_input($_POST['semid']);
		if(empty($semid) && $semid<0) {
			echo 'Something went wrong. Try again later.';
		}
		else {
			include ("../../dbconfig.php");
			if($stmt=$con->prepare("SELECT Semester FROM semester WHERE SemId=?")) {
				if($stmt->bind_param("i",$semid)) {
					$stmt->execute();
					$stmt->bind_result($db_semno);
					if($stmt->fetch()){						
						echo '
							<span class="edit_sem_err"></span>
		          			<div class="input-group">
		          				<label for="edit_sem_no">New Semester No.</label><br>
		          				<input type="number" name="edit_sem_no" id="edit_sem_no" class="form-control" min="1" placeholder="Enter Semester No." value="'.$db_semno.'" required />
		          			</div>          			
		          			<div class="input-group">
		          				<input type="submit" name="edit_sem_submit" id="edit_sem_submit" value="SAVE" />
		          			</div>
						';
					}
					else {
						echo 'Something went wrong. Try again later.';
					}
				}
				else {
					echo 'Something went wrong. Try again later.';
				}
			}
			else {
				echo 'Something went wrong. Try again later.';
			}
		}	
	}
	else {
		echo 'Something went wrong. Try again later.';
	}
}
else {
	echo 'Something went wrong. Try again later.';
}
?>