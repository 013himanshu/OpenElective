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
		<title>Seat Allotment | Admin | MUJ OE &amp; HE</title>
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
				width: 140px !important;
				padding: 5px;
				font-size: 1.2em;
				box-shadow: 0 0 7px rgba(0,0,0,0.5);				
			}
			input[type="submit"] {                
                font-size: 2em;                
                height: 50px;
                width: 220px;                
                box-shadow: 0 0 7px rgba(0,0,0,0.5);
            }		
            .table-responsive {
				max-height: 600px;
				overflow: auto;
			}
			th, td {
				text-align: center !important;
				vertical-align: middle !important;
			}
			</style>
	</head>
<body>

<?php 
	require 'php_includes/admin-navbar.php';
?>

<div style="padding: 8px;">
	<div class="container white-sheet" style="padding: 0px;">
		<h1 class="white-sheet-title text-center">Seat Allotment</h1>
		<div class="row">
			<!--<span class="pull-right" style="padding: 15px 10px;"><input type="button" name="add-sub" id="add-sub" data-toggle="modal" data-target="#add-sub-modal" value="" /></span>-->
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 seat-alot-data-table-box" style="padding: 0px;">
				<!--Seat Allotment List-->

			</div>
		</div>
	</div>
</div>

<!--Edit allotment Modal -->
<!--<div class="modal fade" id="edit-sub-modal" role="dialog">
	<div class="modal-dialog">    	        
      	<div class="modal-content">
		    <div class="modal-header text-center">
		        <button type="button" class="close" data-dismiss="modal">&times;</button>
		        <h3 class="modal-title">Edit OE Subject</h3>
		    </div>
        	<div class="modal-body">
          		<form id="edit-sub-modal-form" name="edit-sub-modal-form" autocomplete="off">          	
          			php_includes/get-sub-data-edit-modal

          		</form>			          	
        	</div>
		    <div class="modal-footer">
		        <span data-dismiss="modal" style="cursor: pointer;font-size: 20px;">Cancel</span>
		    </div>
      	</div>     	   
    </div>
</div>-->

<script>
	$( document ).ready(function() {
		$('.seat-alot-data-table-box').load("php_includes/get-seat-allotment-data.php", { key1:'<?php echo str_shuffle("1234567890ABCDabcd"); ?>' });
	});
</script>
<!--
<script>
	$(document).on("click", ".alot-btn-trash", function(event){
		event.preventDefault();
		var aid=$(this).attr("aid");
		if(aid>=0) {
			var formData={ aid:aid, key1:'<?php //echo str_shuffle("1234567890ABCDabcd"); ?>' }
			$.ajax({
				method: "POST",
				url: "php_includes/alot-trash.php",
				data: formData
			}).done(function(msg){
				if(msg=="success") {
					$('.alot-data-table-box').load("php_includes/get-allotment-data.php", { key1:'<?php //echo str_shuffle("1234567890ABCDabcd"); ?>' });
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
	$(document).on("click", ".btn-stu-data-edit", function(event){
		event.preventDefault();
		var uname=$(this).attr("uname");
		if(uname>=0) {
			$("#stu-data-modal-form").load("php_includes/student-info/get-stu-data-edit-modal.php", {uname:uname, key1:'<?php //echo str_shuffle("1234567890ABCDabcd"); ?>'});
			$("#stu-data-modal").modal();
			$(document).on("click", "#stu-data-proceed", function(event){
				var new_name=$("#stu-data-name").val();				
				var new_psw=$("#stu-data-psw").val();
				var new_cgpa=$("#stu-data-cgpa").val();
				var new_cgpa1=$("#stu-data-cgpa1").val();

				var formData={ uname:uname, name:new_name, psw:new_psw, cgpa:new_cgpa, cgpa1:new_cgpa1, key1:'<?php //echo str_shuffle("1234567890ABCDabcd"); ?>' }

				$.ajax({
					method: "POST",
					url: "php_includes/student-info/update-stu-data.php",
					data: formData
				}).done(function(msg){
					if(msg=="success") {						
						$('.stu-data-table-box').load("php_includes/student-info/get-student-data.php", { key1:'<?php //echo str_shuffle("1234567890ABCDabcd"); ?>' });
						$('.unreg-stu-table-box').load("php_includes/student-info/get-unreg-student.php", { key1:'<?php //echo str_shuffle("1234567890ABCDabcd"); ?>' });
						$('.reg-stu-table-box').load("php_includes/student-info/get-reg-student.php", { key1:'<?php //echo str_shuffle("1234567890ABCDabcd"); ?>' });
						$("#stu-data-modal").modal("hide");						
					}
					else {
						$('.stu-data-err').hide().html('<p class="danger" style="display:inline-block;border-radius:2px;"><span class="glyphicon glyphicon-remove-sign"></span> '+msg+'</p>').fadeIn(1000);
					}
				});
			});
		}
		else {
			alert("Something went wrong. Try again later.");
		}
	});
</script>
-->
</body>
</html>		