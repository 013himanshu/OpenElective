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
			if($db_user_type!="superuser"){
				session_destroy();
				header("Location:index.php");
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
		<title>My Profile | Admin | MUJ OE &amp; HE</title>
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
			input[type="submit"] {                
                font-size: 2em;                
                height: 50px;                
                box-shadow: 0 0 7px rgba(0,0,0,0.5);
                width: 220px;
            }
        </style>
    </head>
<body>
	
<?php 
	require 'php_includes/admin-navbar.php';
?>

<div style="padding: 5px;">
	<div class="container white-sheet" style="padding-bottom: 10px;">
		<h1 class="white-sheet-title text-center">Change Password</h1>
		<div class="row">
			<form id="change_psw" name="change_psw" autocomplete="off">
				<span class="err"></span>
				<div class="input-group">
					<label for="uname">Username</label><br>						
					<input type="text" id="uname" name="uname" class="form-control" placeholder="Enter Username" maxlength="50" minlength="3" required />
				</div>
				<div class="input-group">
					<label for="cpsw">Curent Password</label><br>						
					<input type="password" id="cpsw" name="cpsw" class="form-control" placeholder="Enter Current Password" maxlength="10" minlength="4" required />
				</div>
				<div class="input-group">
					<label for="npsw">New Password</label><br>						
					<input type="password" id="npsw" name="npsw" class="form-control" placeholder="Enter New Password" maxlength="10" minlength="4" required />
				</div>							
				<div class="input-group">
					<input type="submit" id="submit" name="submit" value="CHANGE" />
				</div>
			</form>	
		</div>
	</div>
</div>		

<script>
	$(document).on("submit", "#change_psw", function(event){
		event.preventDefault();
		var uname=$("#uname").val();
		var cpsw=$("#cpsw").val();
		var npsw=$("#npsw").val();

		var formData= { uname:uname, cpsw:cpsw, npsw:npsw }
		$.ajax({	
			method: "POST",
			url: "php_includes/update-psw.php",
			data: formData
		}).done(function(msg){
			if(msg=="success") {
				$('.err').hide().html('<p class="success" style="display:inline-block;border-radius:2px;"><span class="glyphicon glyphicon-ok-sign"></span> Password updated successfully.</p>').fadeIn(1000);
				document.getElementById("change_psw").reset();
			}
			else {
				$('.err').hide().html('<p class="danger" style="display:inline-block;border-radius:2px;"><span class="glyphicon glyphicon-remove-sign"></span> '+msg+'</p>').fadeIn(1000);	
			}
		});
	});
</script>
</body>
</html>           