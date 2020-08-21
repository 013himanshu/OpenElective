<?php
function test_input($data){
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);		
	return $data;
}

if(isset($_POST['key1'])) {
	if(isset($_POST['uname']) && $_POST['uname']>=0) {
		$uname=test_input($_POST['uname']);
		if(empty($uname) && $uname<0) {
			echo 'Something went wrong. Try again later.';
		}
		else {
			include ("../../../dbconfig.php");
			if($stmt=$con->prepare("SELECT username, name, password, cgpa, cgpa1 FROM users WHERE username=?")) {
				if($stmt->bind_param("s",$uname)) {
					$stmt->execute();
					$stmt->bind_result($db_uname, $db_name, $db_psw, $db_cgpa, $db_cgpa1);
					if($stmt->fetch()){
						if($db_uname==$uname) {
							echo '
							<span class="stu-data-err"></span> 
							<div class="input-group">
								<label for="stu-data-uname">Username</label><br>						
								<input type="text" id="stu-data-uname" name="stu-data-uname" class="form-control" placeholder="Enter Username" maxlength="50" minlength="3" value="'.$db_uname.'" disabled required />
							</div>
							<div class="input-group">
		          				<label for="stu-data-name">Name</label><br>
		          				<input type="text" name="stu-data-name" id="stu-data-name" class="form-control" maxlength="30" minlength="1" placeholder="Enter Name" value="'.$db_name.'" required />
		          			</div>							
							<div class="input-group">
								<label for="stu-data-psw">Password</label><br>						
								<input type="text" id="stu-data-psw" name="stu-data-psw" class="form-control" placeholder="Enter Password" maxlength="10" minlength="4" value="'.$db_psw.'" required />	
							</div>
							<div class="input-group">
								<label for="stu-data-cgpa">Previous Semester CGPA</label><br>				
								<input type="tel" id="stu-data-cgpa" name="stu-data-cgpa" class="form-control" placeholder="Enter Previous Semester CGPA" maxlength="5" minlength="1" value="'.$db_cgpa.'" required />
							</div>
							<div class="input-group">
								<label for="stu-data-cgpa">1<sup>st</sup> Year CGPA</label><br>				
								<input type="tel" id="stu-data-cgpa1" name="stu-data-cgpa1" class="form-control" placeholder="Enter 1st Year CGPA" maxlength="5" minlength="1" value="'.$db_cgpa1.'" required />
							</div>							
							';
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