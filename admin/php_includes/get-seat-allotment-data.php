<?php
session_start();

if(isset($_POST['key1'])) {
	echo ' 
		<div class="table-responsive">
			<table class="table table-striped">
				<thead>
					<tr>
						<th>Sub. Code</th>
						<th>Seats Alloted</th>														
						<!--<th>Action</th>-->
					</tr>
				</thead>
				<tbody>
		';				
					include ("../../dbconfig.php");
					if($stmt=$con->prepare("SELECT * FROM subseatposition ORDER BY sub_code asc")) {
						$stmt->execute();
						$stmt->bind_result($subcode, $seats);
						while($stmt->fetch()){
							echo '
								<tr>
									<td>'.$subcode.'</td>
									<td>'.$seats.'</td>
									<td>
									<!--<button type="button" class="btn btn-success alot-btn-edit" aid="'.$subcode.'"><span class="glyphicon glyphicon-pencil"></span></button>
									<button type="button" class="btn btn-danger alot-btn-trash" aid="'.$subcode.'"><span class="glyphicon glyphicon-trash"></span></button>		
									</td>-->
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