<?php
session_start();

if(isset($_POST['key1'])) {
	echo ' 
		<div class="table-responsive">
			<table class="table table-striped">
				<thead>
					<tr>
						<th>Username</th>
						<th>Name</th>
						<th>Password</th>
						<th>User Type</th>
						<th>Add Date &amp; Time</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
		';				
					include ("../../dbconfig.php");
					if($stmt=$con->prepare("SELECT uid, username, name, password, user_type, add_date, add_time FROM admin_users WHERE user_type=? ORDER BY uid DESC, add_date DESC, add_time DESC")) {
						$stmt->bind_param("s", ($user_type="user"));
						$stmt->execute();
						$stmt->bind_result($eu_uid, $eu_uname, $eu_name, $eu_psw, $eu_u_type, $eu_date, $eu_time);
						while($stmt->fetch()){
							echo '
								<tr>
									<td>'.$eu_uname.'</td>
									<td>'.$eu_name.'</td>
									<td>'.$eu_psw.'</td>		
									<td>'.$eu_u_type.'</td>
									<td>'.$eu_date.' | '.$eu_time.'</td>
									<td>
									<button type="button" class="btn btn-success btn-edit" uid="'.$eu_uid.'"><span class="glyphicon glyphicon-pencil"></span></button>
									<button type="button" class="btn btn-danger btn-trash" uid="'.$eu_uid.'"><span class="glyphicon glyphicon-trash"></span></button>		
									</td>
								</tr>';						
						}
					}			
				echo '
				</tbody>
			</table>
		</div>
	';
}	
?>