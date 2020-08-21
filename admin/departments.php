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
		<title>Departments | Admin | MUJ OE &amp; HE</title>
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
		<h1 class="white-sheet-title text-center">Departments</h1>
		<div class="row">
			<span class="pull-right" style="padding: 15px 10px;"><input type="button" name="add-dept" id="add-dept" data-toggle="modal" data-target="#add-dept-modal" value="Add Department" /></span>
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 dept-data-table-box" style="padding: 0px;">
				<!--Departments List-->

			</div>
		</div>
	</div>
</div>


<!-- Add Department Modal -->
<div class="modal fade" id="add-dept-modal" role="dialog">
	<div class="modal-dialog">    	        
      	<div class="modal-content">
		    <div class="modal-header text-center">
		        <button type="button" class="close" data-dismiss="modal">&times;</button>
		        <h3 class="modal-title">Add New Department</h3>
		    </div>
        	<div class="modal-body">
          		<form id="add-dept-modal-form" name="add-dept-modal-form" autocomplete="off">          		
          			<span class="add_dept_err"></span>
          			<div class="input-group">
          				<label for="add_dept_name">Department Name</label><br>
          				<input type="text" name="add_dept_name" id="add_dept_name" class="form-control" maxlength="20" minlength="1" placeholder="Enter Department Name" required />
          			</div>          			
          			<div class="input-group">
          				<input type="submit" name="add_dept_submit" id="add_dept_submit" value="ADD" />
          			</div>
          		</form>			          	
        	</div>
		    <div class="modal-footer">
		        <span data-dismiss="modal" style="cursor: pointer;font-size: 20px;">Cancel</span>
		    </div>
      	</div>     	   
    </div>
</div>

<!--Edit Department Modal -->
<div class="modal fade" id="edit-dept-modal" role="dialog">
	<div class="modal-dialog">    	        
      	<div class="modal-content">
		    <div class="modal-header text-center">
		        <button type="button" class="close" data-dismiss="modal">&times;</button>
		        <h3 class="modal-title">Edit Department</h3>
		    </div>
        	<div class="modal-body">
          		<form id="edit-dept-modal-form" name="edit-dept-modal-form" autocomplete="off">          	
          			<!--php_includes/get-dept-data-edit-modal-->

          		</form>			          	
        	</div>
		    <div class="modal-footer">
		        <span data-dismiss="modal" style="cursor: pointer;font-size: 20px;">Cancel</span>
		    </div>
      	</div>     	   
    </div>
</div>

<script>
	$( document ).ready(function() {
		$('.dept-data-table-box').load("php_includes/get-dept-data.php", { key1:'<?php echo str_shuffle("1234567890ABCDabcd"); ?>' });
	});
</script>
<script>
	$(document).on("submit", "#add-dept-modal-form", function(event){
		event.preventDefault();
		var name=$("#add_dept_name").val();		

		var formData={ name:name, key1:'<?php echo str_shuffle("1234567890ABCDabcd"); ?>' }
		$.ajax({
			method: "POST",
			url: "php_includes/add-dept.php",
			data: formData
		}).done(function(msg){
			if(msg=="success") {
				$('.add_dept_err').hide().html('<p class="success" style="display:inline-block;border-radius:2px;"><span class="glyphicon glyphicon-ok-sign"></span> Department added successfully.</p>').fadeIn(1000);
				$('.dept-data-table-box').load("php_includes/get-dept-data.php", { key1:'<?php echo str_shuffle("1234567890ABCDabcd"); ?>' });
				document.getElementById("add-dept-modal-form").reset();
			}
			else {
				$('.add_dept_err').hide().html('<p class="danger" style="display:inline-block;border-radius:2px;"><span class="glyphicon glyphicon-remove-sign"></span> '+msg+'</p>').fadeIn(1000);
			}
		});
	});
</script>
<script>
	$(document).on("click", ".dept-btn-trash", function(event){
		event.preventDefault();
		var deptid=$(this).attr("did");
		if(deptid>=0) {
			var formData={ deptid:deptid, key1:'<?php echo str_shuffle("1234567890ABCDabcd"); ?>' }
			$.ajax({
				method: "POST",
				url: "php_includes/dept-trash.php",
				data: formData
			}).done(function(msg){
				if(msg=="success") {
					$('.dept-data-table-box').load("php_includes/get-dept-data.php", { key1:'<?php echo str_shuffle("1234567890ABCDabcd"); ?>' });
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
	$(document).on("click", ".dept-btn-edit", function(event){
		event.preventDefault();
		var deptid=$(this).attr("did");
		if(deptid>=0) {
			$("#edit-dept-modal-form").load("php_includes/get-dept-data-edit-modal.php", {deptid:deptid, key1:'<?php echo str_shuffle("1234567890ABCDabcd"); ?>'});
			$("#edit-dept-modal").modal();
			$(document).on("submit", "#edit-dept-modal-form", function(event){
				event.preventDefault();				
				var new_dept=$("#edit_dept_name").val();				

				var formData={ deptid:deptid, name:new_dept, key1:'<?php echo str_shuffle("1234567890ABCDabcd"); ?>' }

				$.ajax({
					method: "POST",
					url: "php_includes/update-dept-data.php",
					data: formData
				}).done(function(msg){
					if(msg=="success") {
						$('.dept-data-table-box').load("php_includes/get-dept-data.php", { key1:'<?php echo str_shuffle("1234567890ABCDabcd"); ?>' });
						$("#edit-dept-modal").modal("hide");						
					}
					else {
						$('.edit_dept_err').hide().html('<p class="danger" style="display:inline-block;border-radius:2px;"><span class="glyphicon glyphicon-remove-sign"></span> '+msg+'</p>').fadeIn(1000);
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