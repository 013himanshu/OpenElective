<?php 
session_start();
if(isset($_SESSION['user'])) {
	session_destroy();
	header("Location:index.php");
	exit(0);
}
if(isset($_SESSION['admin'])) {
	header("Location:dashboard.php");
	exit(0);
}
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Admin | MUJ OE &amp; HE</title>
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
			body {
				background-color: #f7f7f7;
			}
			.ad-form-row {
				margin-top: 20%;
				padding: 15px;
			}
			.ad-form-div {
				background-color: #ffffff;				
				padding: 10px 30px 30px 30px;
				border-radius: 2px;
				box-shadow: 0 0 20px rgba(0,0,0,0.5);
			}
			.ad-login-title {
				margin-top: 10px;
				letter-spacing: 2px;
				text-align: center;
				border-bottom: 3px solid #d67323;
				width: 175px;
				padding-bottom: 5px;
			}
			@media only screen and (max-width: 338px) {
				h3 {
					font-size: 18px !important;
				}
				.ad-login-title {
					width: 150px;
				}
				a {
					font-size: 10px;
				}
			}			
		</style>
	</head>
<body>
	<div class="container">		
		<div class="row ad-form-row">
			<div class="col-md-4 col-sm-12 col-xs-12"></div>
			<div class="col-md-4 col-sm-12 col-xs-12 ad-form-div">
				<img src="../images/muj-logo.png" alt="Manipal University Jaipur" width="40px" />
				<h3 class="ad-login-title" style="display: inline;">ADMIN LOGIN</h3><br><br>	
				<form id="ad-login" name="ad-login" method="POST">
					<span class="err"></span>
					<div class="input-group">
						<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
						<input id="ad-user" type="text" class="form-control" name="ad-user" placeholder="Username" required />
					</div>
					<div class="input-group">
						<span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
						<input id="ad-pass" type="password" class="form-control" name="ad-pass" placeholder="Password" required />
					</div>
					<!--<a href="resetpwd.php" class="pull-left" style="margin-top: 6px;">Forgot Your Password?</a>-->
					<input type="submit" id="ad-submit" name="ad-submit" value="Login" class="pull-right"/>
				</form>										
			</div>
			<div class="col-md-12 col-sm-12 col-xs-12"></div>
		</div>				
	</div>

<script>
	$(document).on("submit", "#ad-login", function(event){
		event.preventDefault();
		var uname = $('#ad-user').val();
		var psw = $('#ad-pass').val();
		var formData={ uname:uname, psw:psw };
		$.ajax({
			method: "POST",
			url: "php_includes/ad-login.php",
			data: formData
		}).done(function(msg){			
			if(msg!="success") {
				$('.err').hide().html('<p class="danger"><span class="glyphicon glyphicon-remove-sign"></span> '+msg+'</p>').fadeIn(1000);	
			}
			else {
				window.open("dashboard.php", "_self");
			}			
		});		
	});
</script>
</body>
</html>