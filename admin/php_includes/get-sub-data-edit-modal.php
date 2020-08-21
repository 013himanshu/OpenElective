<?php
function test_input($data){
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);		
	return $data;
}

if(isset($_POST['key1'])) {
	if(isset($_POST['sub']) && $_POST['sub']>=0) {
		$sub=test_input($_POST['sub']);
		if(empty($sub) && $sub<0) {
			echo 'Something went wrong. Try again later.';
		}
		else {
			include ("../../dbconfig.php");
			if($stmt=$con->prepare("SELECT oename, Semester, Department FROM oechoice WHERE oeid=?")) {
				if($stmt->bind_param("i",$sub)) {
					$stmt->execute();
					$stmt->bind_result($db_name, $db_sem, $db_dept);
					if($stmt->fetch()){						
						echo '
							<span class="edit_sub_err"></span>
		          			<div class="input-group">
		          				<label for="sub-name">Name</label><br>
		          				<input type="text" id="sub-name" name="sub-name" class="form-control" maxlength="100" minlength="1" placeholder="Enter Subject Name" value="'.$db_name.'" required />
		          			</div>
		          			<div class="input-group">
		          				<label for="department">Department</label><br>
		          					  <select id="sub-dept" name="sub-dept" class="form-control" required>';
		          					  	include ("../../dbconfig.php");
		          					  	if($stmt=$con->prepare("SELECT DepName FROM departments")) {
		          					  		$stmt->execute();
		          					  		$stmt->bind_result($dept);
		          					  		while($stmt->fetch()) {
		          					  			echo '
		          					  				<option value="'.$dept.'"';if($db_dept==$dept) {echo 'selected';}echo '>'.$dept.'</option> 
		          					  			';
		          					  		}
		          					  	}
		          				echo '</select>
		          			</div>
		          			<div class="input-group">
		          				<label for="semester">Semester</label><br>
		          					  <select id="sub-sem" name="sub-sem" class="form-control" required>';
		          					  	include ("../../dbconfig.php");
		          					  	if($stmt=$con->prepare("SELECT Semester FROM semester")) {
		          					  		$stmt->execute();
		          					  		$stmt->bind_result($sem);
		          					  		while($stmt->fetch()) {
		          					  			echo '
		          					  				<option value="'.$sem.'"';if($db_sem==$sem) {echo 'selected';}echo '>'.$sem.'</option> 
		          					  			';
		          					  		}
		          					  	}
		          				echo '</select>
		          			</div>          			
		          			<div class="input-group">
		          				<input type="submit" name="edit_sub_submit" id="edit_sub_submit" value="SAVE" />
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