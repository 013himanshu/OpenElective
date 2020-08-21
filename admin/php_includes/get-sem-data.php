<?php
session_start();

if(isset($_POST['key1'])) {
	echo ' 
		<div class="table-responsive">
			<table class="table table-striped">
				<thead>
					<tr>
						<th>Sem. ID</th>
						<th>Sem. Name</th>						
						<th>Add Date &amp; Time</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
		';				
					include ("../../dbconfig.php");
					if($stmt=$con->prepare("SELECT * FROM semester ORDER BY SemId")) {						
						$stmt->execute();
						$stmt->bind_result($semid, $semno, $date, $time);
						while($stmt->fetch()){
							echo '
								<tr>
									<td>'.$semid.'</td>
									<td>'.$semno.'</td>									
									<td>'.$date.'<br>'.$time.'</td>									
									<td>
									<button type="button" class="btn btn-success sem-btn-edit" sid="'.$semid.'"><span class="glyphicon glyphicon-pencil"></span></button>
									<button type="button" class="btn btn-danger sem-btn-trash" sid="'.$semid.'"><span class="glyphicon glyphicon-trash"></span></button>		
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