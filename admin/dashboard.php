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
if($stmt = $con->prepare("SELECT uid, username, name, user_type FROM admin_users WHERE uid=? LIMIT 1")){
	if($stmt->bind_param("i", $_SESSION['admin']['user'])){
		$stmt->execute();
		$stmt->bind_result($db_uid, $db_uname, $db_name, $db_user_type);
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
		<title>Dashboard | Admin | MUJ OE &amp; HE</title>
		<meta charset="utf-8">
		<meta name="robots" content="noindex, nofollow">
		<meta name="googlebot" content="noindex, nofollow">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">		
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
		<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700|Roboto:400,700" rel="stylesheet">
		<link href="../css/style.css" rel="stylesheet">
	</head>
<body>

<?php 
	require 'php_includes/admin-navbar.php';
?>

<div style="padding: 8px;">
	<div class="container white-sheet" style="padding: 0px;">		
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center" style="padding-top: 10%;padding-bottom: 10%;">
				<img src="../images/muj-logo.png" alt="Manipal University Jaipur" />
				<h2 class="text-center" style="letter-spacing: 2px;padding-bottom: 5px;">
					<span style="display: inline-block;">Hi!</span> 
					<span style="display: inline-block;"><?php echo $db_name; ?></span>
				</h2>
				<h5 class="text-center" style="letter-spacing: 2px;">
					<span style="display: inline-block;">Username: <strong><?php echo $db_uname; ?></strong>,</span>
					<span style="display: inline-block;">User Type: <strong><?php echo $db_user_type; ?></strong></span>
				</h5>
			</div>
		</div>
	</div>
</div>

</body>	
</html>		