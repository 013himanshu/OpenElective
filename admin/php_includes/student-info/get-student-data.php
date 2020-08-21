<?php 
session_start();

if(isset($_POST['key1'])) {
	echo ' 
		<div class="table-responsive">
			<table class="table table-striped table-bordered">
				<thead>
					<tr>
						<th>Username</th>
						<th>Name</th>						
						<th>Password</th>												
						<th>Previous Semester CGPA</th>			
						<th>1<sup>st</sup> Year CGPA</th>			
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
		';
		include ("../../../dbconfig.php");
		if($stmt=$con->prepare("SELECT * from users ORDER BY username ASC")) {
			$stmt->execute();
			$stmt->bind_result($uname, $name, $psw, $cgpa, $cgpa1);
			while($stmt->fetch()) {
				echo '
					<tr>
						<td>'.$uname.'</td>
						<td>'.$name.'</td>
						<td>'.$psw.'</td>						
						<td>'.$cgpa.'</td>
						<td>'.$cgpa1.'</td>						
						<td>
							<button type="button" class="btn btn-success btn-stu-data-edit" uname="'.$uname.'"><span class="glyphicon glyphicon-pencil"></span></button>
							<button type="button" class="btn btn-danger btn-stu-data-trash" uname="'.$uname.'"><span class="glyphicon glyphicon-trash"></span></button>
						</td>
					</tr>
				';
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