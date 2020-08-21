<?php 
session_start();

if(isset($_SESSION['user'])) {
	session_destroy();
	header("Location:../index.php");
	exit(0);
}
if(!isset($_SESSION['admin']['user'])) {
	session_destroy();
	header("Location:../index.php");
	exit(0);
}

include ("../dbconfig.php");
if($stmt = $con->prepare("SELECT uid FROM admin_users WHERE uid=? LIMIT 1")){
	if($stmt->bind_param("i", $_SESSION['admin']['user'])){
		$stmt->execute();
		$stmt->bind_result($db_uid);
		if($stmt->fetch()) {
			if($_SESSION['admin']['user']!=$db_uid) {
				session_destroy();
				die("Sorry! An error occured. Please try again later.");
				exit(0);
			}
		}	
		$stmt->close();
		$con->close();
	}
}
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Add New Student | Admin | MUJ OE &amp; HE</title>
		<meta charset="utf-8">
		<meta name="robots" content="noindex, nofollow">
		<meta name="googlebot" content="noindex, nofollow">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">		
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
		<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700|Roboto:400,700" rel="stylesheet">
		<link href="../css/style.css" rel="stylesheet">
		<style>
			.form-control {
				border-width: 2px;
				width: 220px !important;
				display: inline-block;
				transition: border .3s linear; 
			    -moz-transition: border .3s linear; 
			    -o-transition: border .3s linear; 
			    -webkit-transition: border .3s linear;			    
			}
			.form-control:focus {
				box-shadow: none;
				border: 2px solid #d67323;						    		
			}
			.input-group {
				padding: 10px;
			}
			input[type="button"] {
				width: 80px !important;
			}
			input[type="submit"] {                
                font-size: 2em;                
                height: 50px;
                width: 220px;                
                box-shadow: 0 0 7px rgba(0,0,0,0.5);
            }		
		</style>
	</head>
<body>

<?php 
	require 'php_includes/admin-navbar.php';
?>

<div style="padding: 5px;">
	<div class="container white-sheet">
		<h1 class="white-sheet-title text-center">Add Student</h1>
		<div class="row">
			<form id="add-stu-form" name="add-stu-form" autocomplete="off" style="padding: 10px;">
				<div class="row">
					<div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
						<span class="err"></span>
						<div class="input-group">
							<label for="add-stu-uname">Username</label><br>						
							<input type="text" id="add-stu-uname" name="add-stu-uname" class="form-control" placeholder="Enter Username" maxlength="50" minlength="3" required />
						</div>
						<div class="input-group">
							<label for="add-user-psw">Password</label><br>						
							<input type="password" id="add-stu-psw" name="add-stu-psw" class="form-control" placeholder="Enter Password" maxlength="10" minlength="4" required />
							<input type="button" id="add-stu-psw-gen" name="add-stu-psw-gen" class="form-control" value="Generate" />
						</div>						
						<div class="input-group">
							<label for="add-stu-cgpa">CGPA</label><br>						
							<input type="text" id="add-stu-cgpa" name="add-stu-cgpa" class="form-control" placeholder="Enter CGPA" maxlength="50" minlength="3" required />
						</div>
						<div class="input-group">
							<input type="submit" id="add-stu-submit" name="add-stu-submit" value="Add" />
							<br>						
						</div>
					</div>
					<div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
						
					</div>
				</div>
			</form>
		</div>
	</div>
</div>		

</body>
</html>