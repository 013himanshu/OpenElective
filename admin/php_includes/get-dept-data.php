<?php
session_start();

if(isset($_POST['key1'])) {
	echo ' 
		<div class="table-responsive">
			<table class="table table-striped">
				<thead>
					<tr>
						<th>Dept. ID</th>
						<th>Dept. Name</th>						
						<th>Add Date &amp; Time</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
		';				
					include ("../../dbconfig.php");
					if($stmt=$con->prepare("SELECT * FROM departments")) {						
						$stmt->execute();
						$stmt->bind_result($depid, $depname, $date, $time);
						while($stmt->fetch()){
							echo '
								<tr>
									<td>'.$depid.'</td>
									<td>'.$depname.'</td>									
									<td>'.$date.'<br>'.$time.'</td>									
									<td>
									<button type="button" class="btn btn-success dept-btn-edit" did="'.$depid.'"><span class="glyphicon glyphicon-pencil"></span></button>
									<button type="button" class="btn btn-danger dept-btn-trash" did="'.$depid.'"><span class="glyphicon glyphicon-trash"></span></button>		
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