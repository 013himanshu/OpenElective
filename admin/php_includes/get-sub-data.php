<?php
session_start();

if(isset($_POST['key1'])) {
	echo ' 
		<div class="table-responsive">
			<table class="table table-striped">
				<thead>
					<tr>
						<th>OE ID</th>
						<th>OE Name</th>
						<th>Semester</th>	
						<th>Department</th>						
						<th>Add Date &amp; Time</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
		';				
					include ("../../dbconfig.php");
					if($stmt=$con->prepare("SELECT * FROM oechoice ORDER BY oeid DESC")) {					
						$stmt->execute();
						$stmt->bind_result($oeid, $oename, $sem, $dept, $date, $time);
						while($stmt->fetch()){
							echo '
								<tr>
									<td>'.$oeid.'</td>
									<td>'.$oename.'</td>
									<td>'.$sem.'</td>
									<td>'.$dept.'</td>									
									<td>'.$date.'<br>'.$time.'</td>									
									<td>
									<button type="button" class="btn btn-success sub-btn-edit" sid="'.$oeid.'"><span class="glyphicon glyphicon-pencil"></span></button>
									<button type="button" class="btn btn-danger sub-btn-trash" sid="'.$oeid.'"><span class="glyphicon glyphicon-trash"></span></button>		
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