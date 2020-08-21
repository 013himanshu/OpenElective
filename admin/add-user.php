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
		<title>Add User | Admin | MUJ OE &amp; HE</title>
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
		th,td {
			padding: 3px;
			vertical-align: top;
		}
		th{
			text-align: right;
		}
		</style>
	</head>
<body>

<?php 
	require 'php_includes/admin-navbar.php';
?>

<div style="padding: 5px;">
	<div class="container white-sheet">
		<h1 class="white-sheet-title text-center">Add User</h1>
		<div class="row">			
			<form id="add-user-form" name="add-user-form" autocomplete="off" style="padding: 10px;">		
				<div class="row">					
					<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
						<div class="input-group">
							<label for="add-user-uname">Username</label><br>						
							<input type="text" id="add-user-uname" name="add-user-uname" class="form-control" placeholder="Enter Username" maxlength="50" minlength="3" required />
						</div>
						<div class="input-group">
							<label for="add-user-name">Name</label><br>						
							<input type="text" id="add-user-name" name="add-user-name" class="form-control" placeholder="Enter Name" maxlength="50" minlength="2" required />
						</div>
						<div class="input-group">
							<label for="add-user-psw">Password</label><br>						
							<input type="password" id="add-user-psw" name="add-user-psw" class="form-control" placeholder="Enter Password" maxlength="10" minlength="4" required />
							<input type="button" id="add-user-psw-gen" name="add-user-psw-gen" class="form-control" value="Generate" />
						</div>
					</div>
					<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
						<div class="input-group">
							<label for="add-user-type">Choose User Type</label><br>			
							<input type="radio" id="superuser" name="add-user-type" value="superuser" required />
							<label for="superuser" class="add-user-type" style="width:160px;">Super User</label>
							<input type="radio" id="user" name="add-user-type" value="user" checked required />
							<label for="user" class="add-user-type" style="width:160px;">User</label>
						</div>
					</div>
				</div>
				<div class="row">	
					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
						<div class="input-group">
							<input type="submit" id="add-user-submit" name="add-user-submit" value="Add" />
							<br><br>
							<span class="err"></span>
						</div>	
					</div>
				</div>	
			</form>			
		</div>
	</div>	
</div>
<div class="container" style="padding: 2px;">
	<table>
		<tr>
			<th>Super User:</th>
			<td>He can add other super users and users as well as edit other user's data.</td>
		</tr>
		<tr>
			<th>User:</th>
			<td>He can't add other super users and users.</td>
		</tr>
	</table>		
</div>

<script>
	$(document).on("click", "#add-user-psw-gen", function(event){
		event.preventDefault();
		var chars = "abcdefghijklmnopqrstuvwxyz!@#$*-+ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890";
	    var pass = "";
	    for (var x = 0; x < 8; x++) {
	    	var i = Math.floor(Math.random() * chars.length);
	    	pass += chars.charAt(i);
	    }
	    $("#add-user-psw").val(pass);
	});
</script>
<script>
	$(document).on("submit", "#add-user-form", function(event){
		event.preventDefault();
		var uname=document.forms["add-user-form"]["add-user-uname"].value;
		var name=document.forms["add-user-form"]["add-user-name"].value;
		var psw=document.forms["add-user-form"]["add-user-psw"].value;
		var u_type=document.forms["add-user-form"]["add-user-type"].value;
		var formData={ uname:uname, name:name, psw:psw, u_type:u_type };
		$.ajax({
			method: "POST",
			url: "php_includes/add-user-data.php",
			data: formData
		}).done(function(msg){	
			if(msg!="success") {
				$('.err').hide().html('<p class="danger" style="display:inline-block;border-radius:2px;"><span class="glyphicon glyphicon-remove-sign"></span> '+msg+'</p>').fadeIn(1000);				
			}
			else {
				$('.err').hide().html('<p class="success" style="display:inline-block;border-radius:2px;"><span class="glyphicon glyphicon-ok-sign"></span> New user added successfully.</p>').fadeIn(1000);
				document.getElementById("add-user-form").reset();
			}					
		});		
	});
</script>
</body>	
</html>	