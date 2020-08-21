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
		<title>Edit User | Admin | MUJ OE &amp; HE</title>
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
			th, td {
				text-align: center !important;
				vertical-align: middle !important;
			}
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
			.table-responsive {
				max-height: 200px;
				overflow: auto;
			}
		</style>
	</head>
<body>
	<?php 
		require 'php_includes/admin-navbar.php';
	?>

	<div style="padding: 5px;">
		<div class="container white-sheet">
			<h1 class="white-sheet-title text-center">Edit User</h1>
			<div class="row">
				<h4>Users</h4>
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 u-table-box">
					<!-- user Table Contents -->

				</div>		
			</div>
			<br><br>
			<div class="row">
				<h4>Super Users</h4>
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 s-table-box">
					<!-- superuser Table Contents -->

				</div>		
			</div>
		</div>
		<div class="container">
			<div class="row">
				<h5>*You cannot edit another superuser data.</h5>
			</div>
		</div>
	</div>

<!-- Modal -->
<div class="modal fade" id="edit-modal" role="dialog">
	<div class="modal-dialog">    	        
      		<div class="modal-content">
		        <div class="modal-header text-center">
		          <button type="button" class="close" data-dismiss="modal">&times;</button>
		          <h3 class="modal-title">Edit User</h3>
		        </div>
        		<div class="modal-body">
          			<form id="modal-form" name="modal-form" autocomplete="off">
          				
          			</form>			          	
        		</div>
		        <div class="modal-footer">
		          <span data-dismiss="modal" style="cursor: pointer;font-size: 20px;">Cancel</span>
		          &nbsp; &nbsp; &nbsp;
		          <span id="proceed" style="color: #d67323;cursor: pointer;font-size: 20px;">Make Changes</span>
		        </div>
      		</div>     	   
    </div>
</div>	

<script>
	$( document ).ready(function() {
		$('.u-table-box').load("php_includes/get-users.php", { key1:'<?php echo str_shuffle("1234567890ABCDabcd"); ?>' });
		$('.s-table-box').load("php_includes/get-super-users.php", { key1:'<?php echo str_shuffle("1234567890ABCDabcd"); ?>' });
	});
</script>
<script>
	$(document).on("click", ".btn-trash", function(event){
		event.preventDefault();
		var uid=$(this).attr("uid");
		if(uid>=0) {
			var formData={ uid:uid, key1:'<?php echo str_shuffle("1234567890ABCDabcd"); ?>' }
			$.ajax({
				method: "POST",
				url: "php_includes/user-trash.php",
				data: formData
			}).done(function(msg){
				if(msg=="success") {
					$('.u-table-box').load("php_includes/get-users.php", { key1:'<?php echo str_shuffle("1234567890ABCDabcd"); ?>' });
				}
				else {
					alert(msg);
				}
			});
		}
		else {
			alert("Something went wrong. Try again later.");
		}		
	});
</script>
<script>
	$(document).on("click", ".btn-edit", function(event){
		event.preventDefault();
		var uid=$(this).attr("uid");
		if(uid>=0) {	
			$("#modal-form").load("php_includes/get-edit-user-modal.php", {uid:uid, key1:'<?php echo str_shuffle("1234567890ABCDabcd"); ?>'});
			$("#edit-modal").modal();
			$(document).on("click", "#proceed", function(event){
				var new_uname=document.forms["modal-form"]["add-user-uname"].value;
				var new_name=document.forms["modal-form"]["add-user-name"].value;
				var new_psw=document.forms["modal-form"]["add-user-psw"].value;
				var new_utype=document.forms["modal-form"]["add-user-type"].value;
				
				var formData={ uid:uid, uname:new_uname, name:new_name, psw:new_psw, utype:new_utype, key1:'<?php echo str_shuffle("1234567890ABCDabcd"); ?>' }
				
				$.ajax({
					method: "POST",
					url: "php_includes/update-edit-user.php",
					data: formData
				}).done(function(msg){
					if(msg=="success") {
						$('.u-table-box').load("php_includes/get-users.php", { key1:'<?php echo str_shuffle("1234567890ABCDabcd"); ?>' });
						$('.s-table-box').load("php_includes/get-super-users.php", { key1:'<?php echo str_shuffle("1234567890ABCDabcd"); ?>' });
						$("#edit-modal").modal("hide");
					}
					else {
						$('.err').hide().html('<p class="danger" style="display:inline-block;border-radius:2px;"><span class="glyphicon glyphicon-ok-sign"></span> '+msg+'</p>').fadeIn(1000);
					}
				});

			});			
		}
		else {
			alert("Something went wrong. Try again later.");
		}		
	});
</script>	
</body>
</html>