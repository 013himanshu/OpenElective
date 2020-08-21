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
		
			.nav-tabs { border-bottom: 3px solid #ddd; }
			
			.nav-tabs > li.active > a, .nav-tabs > li.active > a:focus, .nav-tabs > li.active > a:hover { border-width: 0; }
			
			.nav-tabs > li > a { padding-left:10px;padding-right:10px; border:none; color:#666; font-weight: 700; font-size:15px; letter-spacing: 1px;  }
			
			.nav-tabs > li.active > a, .nav-tabs > li > a:hover { border: none; color: #d67323 !important; background: transparent; }
			
			.nav-tabs > li > a::after { content: ""; background: #d67323; height: 3px; position: absolute; width: 100%; left: 0px; bottom: -2px; transition: all 250ms ease 0s; transform: scale(0); }
			
			.nav-tabs > li.active > a::after, .nav-tabs > li:hover > a::after { transform: scale(1); }
			
			.tab-pane { padding-bottom:15px; }
		
			.tabs{background:#fff none repeat scroll 0% 0%; box-shadow: 0px 1px 3px rgba(0, 0, 0, 0.3); margin-top:10px;margin-bottom:10px;}
		</style>
	</head>
<body>

<?php 
	require 'php_includes/admin-navbar.php';
?>

<div style="padding: 5px;">
	<div class="container white-sheet">
		<h1 class="white-sheet-title text-center">Edit My Profile</h1>
		<div class="row">

			<ul class="nav nav-tabs">
				<li class="active"><a data-toggle="tab" href="#my_profile">Edit My Profile</a></li>
			    <li><a data-toggle="tab" href="#del_act">Delete Account</a></li>			    			
			</ul>
			<div class="tab-content" style="padding-top: 20px;">
				<div id="my_profile" class="tab-pane fade in active">
			    	<form id="my_profile-form" name="my_profile-form" autocomplete="off">
			    		<div class="row">
			    			<span class="e_err"></span>
			    			<div class="input-group">
								<label for="e_uname">Username</label><br>						
								<input type="text" id="e_uname" name="e_uname" class="form-control" placeholder="Enter Username" maxlength="50" minlength="3" value=<?php echo '"'.$db_uname.'"'; ?> required />
							</div>
							<div class="input-group">
								<label for="e_name">Name</label><br>						
								<input type="text" id="e_name" name="e_name" class="form-control" placeholder="Enter Name" maxlength="50" minlength="2" value=<?php echo '"'.$db_name.'"'; ?> required />
							</div>							
							<div class="input-group">
								<input type="submit" id="e_submit" name="e_submit" value="SAVE" />
							</div>	
			    		</div>
			    	</form>  
			    </div>
			    <div id="del_act" class="tab-pane fade in">
			    	<form id="del_act-form" name="del_act-form" autocomplete="off">
			    		<div class="row">
			    			<span class="d_err"></span>
			    			<div class="input-group">
								<label for="d_uname">Username</label><br>						
								<input type="text" id="d_uname" name="d_uname" class="form-control" placeholder="Enter Username" maxlength="50" minlength="3" required />
							</div>
							<div class="input-group">
								<label for="d_psw">Password</label><br>						
								<input type="password" id="d_psw" name="d_psw" class="form-control" placeholder="Enter Password" maxlength="10" minlength="4" required />
							</div>							
							<div class="input-group">
								<input type="submit" id="d_submit" name="d_submit" value="DELETE" />
							</div>	
			    		</div>
			    	</form>  
			    </div>
			</div>

		</div>
	</div>
</div>			


<script>
	$(document).on("submit", "#my_profile-form", function(event){
		event.preventDefault();
		var uname=$("#e_uname").val();
		var name=$("#e_name").val();

		var formData= { uname:uname, name:name }
		$.ajax({
			method: "POST",
			url: "php_includes/edit-my-profile.php",
			data: formData
		}).done(function(msg){
			if(msg=="success") {
				$('.e_err').hide().html('<p class="success" style="display:inline-block;border-radius:2px;"><span class="glyphicon glyphicon-ok-sign"></span> Profile updated successfully.</p>').fadeIn(1000);
			}
			else {
				$('.e_err').hide().html('<p class="danger" style="display:inline-block;border-radius:2px;"><span class="glyphicon glyphicon-remove-sign"></span> '+msg+'</p>').fadeIn(1000);
			}
		});
	});
</script>
<script>
	$(document).on("submit", "#del_act-form", function(event){
		event.preventDefault();
		var uname=$("#d_uname").val();
		var psw=$("#d_psw").val();

		var formData= { uname:uname, psw:psw }
		$.ajax({
			method: "POST",
			url: "php_includes/dlt_act.php",
			data: formData
		}).done(function(msg){
			if(msg!="success") {
				$('.d_err').hide().html('<p class="danger" style="display:inline-block;border-radius:2px;"><span class="glyphicon glyphicon-remove-sign"></span> '+msg+'</p>').fadeIn(1000);
			}
			else {
				window.open("index.php", "_self");
			}
		});
	}); 
</script>
</body>	
</html>		