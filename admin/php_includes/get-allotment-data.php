<?php
session_start();

if(isset($_POST['key1'])) {
	echo ' 
		<div class="table-responsive">
			<table class="table table-striped">
				<thead>
					<tr>
						<th>Reg. No.</th>
						<th>Subject Alloted</th>														
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
		';				
					include ("../../dbconfig.php");
					if($stmt=$con->prepare("SELECT * FROM electivealloted ORDER BY Rg_No asc")) {					
						$stmt->execute();
						$stmt->bind_result($regno, $sub);
						while($stmt->fetch()){
							echo '
								<tr>
									<td>'.$regno.'</td>
									<td>'.$sub.'</td>
									<td>
									<!--<button type="button" class="btn btn-success alot-btn-edit" aid="'.$regno.'"><span class="glyphicon glyphicon-pencil"></span></button>-->
									<button type="button" class="btn btn-danger alot-btn-trash" aid="'.$regno.'"><span class="glyphicon glyphicon-trash"></span></button>		
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