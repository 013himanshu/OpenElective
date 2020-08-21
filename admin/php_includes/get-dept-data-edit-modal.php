<?php
function test_input($data){
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);		
	return $data;
}

if(isset($_POST['key1'])) {
	if(isset($_POST['deptid']) && $_POST['deptid']>=0) {
		$deptid=test_input($_POST['deptid']);
		if(empty($deptid) && $deptid<0) {
			echo 'Something went wrong. Try again later.';
		}
		else {
			include ("../../dbconfig.php");
			if($stmt=$con->prepare("SELECT DepName FROM departments WHERE DepId=?")) {
				if($stmt->bind_param("i",$deptid)) {
					$stmt->execute();
					$stmt->bind_result($db_depname);
					if($stmt->fetch()){						
						echo '
							<span class="edit_dept_err"></span>
		          			<div class="input-group">
		          				<label for="edit_dept_name">New Department Name</label><br>
		          				<input type="text" name="edit_dept_name" id="edit_dept_name" class="form-control" maxlength="20" minlength="1" placeholder="Enter Department Name" value="'.$db_depname.'" required />
		          			</div>          			
		          			<div class="input-group">
		          				<input type="submit" name="edit_dept_submit" id="edit_dept_submit" value="SAVE" />
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