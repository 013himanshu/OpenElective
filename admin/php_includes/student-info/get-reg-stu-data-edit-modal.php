<?php
function test_input($data){
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);		
	return $data;
}

function getOEbox($db_sem, $db_dept, $compare_oe){
	include ("../../../dbconfig.php");
	if($stmt=$con->prepare("SELECT oename FROM oechoice WHERE Semester=? AND Department!=? ORDER BY oename, add_date DESC, add_time DESC")) {
		$stmt->bind_param("is", $db_sem, $db_dept);
		$stmt->execute();
		$stmt->bind_result($oename);
		echo '<option value="">Choose OE</option>';
		while($stmt->fetch()) {
			echo '
				<option value="'.$oename.'">'.$oename.'</option>
			';	 											
		}
	}
}

if(isset($_POST['key1'])) {
	if(isset($_POST['uname']) && $_POST['uname']>=0) {
		$uname=test_input($_POST['uname']);
		if(empty($uname) && $uname<0) {
			echo 'Something went wrong. Try again later.';
		}
		else {
			include ("../../../dbconfig.php");
			if($stmt=$con->prepare("SELECT RegistrationNo, Department, Semester, OE1, OE2, OE3, OE4, OE5, OE6 FROM studentinforanked WHERE RegistrationNo=?")) {
				if($stmt->bind_param("i",$uname)) {
					$stmt->execute();
					$stmt->bind_result($db_uname, $db_dept, $db_sem, $db_oe1, $db_oe2, $db_oe3, $db_oe4, $db_oe5, $db_oe6);
					if($stmt->fetch()){
						if($db_uname==$uname) {
							echo '
							<div class="row">
								<span class="stu-data-err"></span> 
								<div class="input-group">
									<label for="stu-reg-data-uname">Reg. No.</label><br>						
									<input type="tel" id="stu-reg-data-uname" name="stu-reg-data-uname" class="form-control" placeholder="Enter Registration No" maxlength="15" minlength="1" value="'.$db_uname.'" disabled required />
								</div>							
								<div class="input-group">
									<label for="stu-reg-data-dept">Department</label><br>	
										<select id="stu-reg-data-dept" name="stu-reg-data-dept" class="form-control" required>';

										include ("../../../dbconfig.php");
										if($stmt=$con->prepare("SELECT DepName FROM departments ORDER BY DepName, add_date DESC, add_time DESC")) {
											$stmt->execute();
											$stmt->bind_result($depname);
											echo '<option value="">Select Department</option>';
											while($stmt->fetch()) {
												echo '
													<option value="'.$depname.'"';
														if($depname==$db_dept) {
															echo 'selected';
														}
													echo '
														>'.$depname.'</option>
													';	 											
											}
										}

							   		echo '</select>
								</div>
								<div class="input-group">
									<label for="stu-reg-data-sem">Semester</label><br>	
										<select id="stu-reg-data-sem" name="stu-reg-data-sem" class="form-control" required>';

										include ("../../../dbconfig.php");
										if($stmt=$con->prepare("SELECT Semester FROM semester ORDER BY Semester, add_date DESC, add_time DESC")) {
											$stmt->execute();
											$stmt->bind_result($semname);
											echo '<option value="">Select Semester</option>';
											while($stmt->fetch()) {
												echo '
													<option value="'.$semname.'"';
														if($semname==$db_sem) {
															echo 'selected';
														}
													echo '
														>'.$semname.'</option>
													';	 											
											}
										}

							   		echo '</select>
								</div>
								<hr>
								<div class="row">
									<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
										<div class="input-group">
											<label for="lb1">OE 1</label><br>
												<select id="lb1" name="lb1" class="form-control xx" required>';

												getOEbox($db_sem, $db_dept, $db_oe1);

									   		echo '</select>
										</div>
									</div>
									<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
										<div class="input-group">
											<label for="lb2">OE 2</label><br>
												<select id="lb2" name="lb2" class="form-control xx" required>';

												getOEbox($db_sem, $db_dept, $db_oe2);

									   		echo '</select>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
										<div class="input-group">
											<label for="lb3">OE 3</label><br>
												<select id="lb3" name="lb3" class="form-control xx" required>';

												getOEbox($db_sem, $db_dept, $db_oe3);

									   		echo '</select>
										</div>
									</div>
									<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
										<div class="input-group">
											<label for="lb4">OE 4</label><br>
												<select id="lb4" name="lb4" class="form-control xx" required>';

												getOEbox($db_sem, $db_dept, $db_oe4);

									   		echo '</select>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
										<div class="input-group">
											<label for="lb5">OE 5</label><br>
												<select id="lb5" name="lb5" class="form-control xx" required>';

												getOEbox($db_sem, $db_dept, $db_oe5);

									   		echo '</select>
										</div>
									</div>
									<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
										<div class="input-group">
											<label for="lb6">OE 6</label><br>
												<select id="lb6" name="lb6" class="form-control xx" required>';

												getOEbox($db_sem, $db_dept, $db_oe6);

									   		echo '</select>
										</div>
									</div>
								</row>																	
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