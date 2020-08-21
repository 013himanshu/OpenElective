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
						<th>User Type</th>
						<th>Add Date &amp; Time</th>						
					</tr>
				</thead>
				<tbody>
		';				
					include ("../../dbconfig.php");
					if($stmt=$con->prepare("SELECT uid, username, name, user_type, add_date, add_time FROM admin_users WHERE user_type=? ORDER BY uid DESC, add_date DESC, add_time DESC")) {
						$stmt->bind_param("s", ($user_type="superuser"));
						$stmt->execute();
						$stmt->bind_result($eu_uid, $eu_uname, $eu_name, $eu_u_type, $eu_date, $eu_time);
						while($stmt->fetch()){
							echo '
								<tr>
									<td>'.$eu_uname.'</td>
									<td>'.$eu_name.'</td>
								';								

								echo '																	
									<td>'.$eu_u_type.'</td>
									<td>'.$eu_date.' | '.$eu_time.'</td>													
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