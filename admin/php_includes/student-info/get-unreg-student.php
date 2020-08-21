<?php 
session_start();

if(isset($_POST['key1'])) {
	echo ' 
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-condensed">
				<thead>
					<tr>
						<th>Reg. No.</th>												
						<th>Department</th>
						<th>Semester</th>
						<th>OE1</th>
						<th>OE2</th>
						<th>OE3</th>
						<th>OE4</th>
						<th>OE5</th>
						<th>OE6</th>						
						<th>Previous Semester CGPA</th>
						<th>1<sup>st</sup> Year CGPA</th>
						<th>Entry Date, Time</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
		';
		include ("../../../dbconfig.php");
		if($stmt=$con->prepare("SELECT * FROM studentinfo")) {
			$stmt->execute();
			$stmt->bind_result($reg_no, $dept, $sem, $oe1, $oe2, $oe3, $oe4, $oe5, $oe6, $cgpa, $cgpa1, $etime);
			while($stmt->fetch()) {
				echo '
					<tr>
						<td>'.$reg_no.'</td>						
						<td>'.$dept.'</td>
						<td>'.$sem.'</td>
						<td>'.$oe1.'</td>
						<td>'.$oe2.'</td>
						<td>'.$oe3.'</td>
						<td>'.$oe4.'</td>
						<td>'.$oe5.'</td>
						<td>'.$oe6.'</td>						
						<td>'.$cgpa.'</td>
						<td>'.$cgpa1.'</td>
						<td>'.$etime.'</td>
						<td>
							<button type="button" class="btn btn-success btn-unreg-stu-edit" unregid="'.$reg_no.'"><span class="glyphicon glyphicon-pencil"></span></button>
							<button type="button" class="btn btn-danger btn-unreg-stu-trash" unregid="'.$reg_no.'"><span class="glyphicon glyphicon-trash"></span></button>
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