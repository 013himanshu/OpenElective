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
		<title>OE Subjects | Admin | MUJ OE &amp; HE</title>
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
		<h1 class="white-sheet-title text-center">OE Subjects</h1>
		<div class="row">
			<span class="pull-right" style="padding: 15px 10px;"><input type="button" name="add-sub" id="add-sub" data-toggle="modal" data-target="#add-sub-modal" value="Add OE Subject" /></span>
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 sub-data-table-box" style="padding: 0px;">
				<!--OE Subjects List-->

			</div>
		</div>
	</div>
</div>


<!-- Add OE Sub Modal -->
<div class="modal fade" id="add-sub-modal" role="dialog">
	<div class="modal-dialog">    	        
      	<div class="modal-content">
		    <div class="modal-header text-center">
		        <button type="button" class="close" data-dismiss="modal">&times;</button>
		        <h3 class="modal-title">Add New OE Subject</h3>
		    </div>
        	<div class="modal-body">
          		<form id="add-sub-modal-form" name="add-sub-modal-form" autocomplete="off">          		
          			<span class="add_sub_err"></span>          			
          			<div class="input-group">
          				<label for="add_sub_name">Subject</label><br>
          				<input type="text" name="add_sub_name" id="add_sub_name" class="form-control" minlength="1" maxlength="100" placeholder="Enter Subject Name" required />
          			</div>  
          			<div class="input-group">
          				<label for="add_sub_sem">Semester</label><br>
          				<select name="add_sub_sem" id="add_sub_sem" class="form-control" required>
          					<option value="">Choose The Semester</option>
          					<?php 
          						include ("../dbconfig.php");
          						if($stmt=$con->prepare("SELECT DISTINCT Semester FROM semester")) {
          							$stmt->execute();
          							$stmt->bind_result($semval);
          							while ($stmt->fetch()) {
          								echo'
          									<option value="'.$semval.'">'.$semval.'</option>
          								';
          							}
          						}
          					?>
          				</select>
          			</div>
          			<div class="input-group">
          				<label for="add_sub_dept">Department</label><br>
          				<select name="add_sub_dept" id="add_sub_dept" class="form-control" required>
          					<option value="">Choose The Department</option>
          					<?php 
          						include ("../dbconfig.php");
          						if($stmt=$con->prepare("SELECT DISTINCT DepName FROM departments")) {
          							$stmt->execute();
          							$stmt->bind_result($deptval);
          							while ($stmt->fetch()) {
          								echo'
          									<option value="'.$deptval.'">'.$deptval.'</option>
          								';
          							}
          						}
          					?>
          				</select>
          			</div>        			
          			<div class="input-group">
          				<input type="submit" name="add_sub_submit" id="add_sub_submit" value="ADD" />
          			</div>
          		</form>			          	
        	</div>
		    <div class="modal-footer">
		        <span data-dismiss="modal" style="cursor: pointer;font-size: 20px;">Cancel</span>
		    </div>
      	</div>     	   
    </div>
</div>

<!--Edit Sub Modal -->
<div class="modal fade" id="edit-sub-modal" role="dialog">
	<div class="modal-dialog">    	        
      	<div class="modal-content">
		    <div class="modal-header text-center">
		        <button type="button" class="close" data-dismiss="modal">&times;</button>
		        <h3 class="modal-title">Edit OE Subject</h3>
		    </div>
        	<div class="modal-body">
          		<form id="edit-sub-modal-form" name="edit-sub-modal-form" autocomplete="off">          	
          			<!--php_includes/get-sub-data-edit-modal-->

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
		$('.sub-data-table-box').load("php_includes/get-sub-data.php", { key1:'<?php echo str_shuffle("1234567890ABCDabcd"); ?>' });
	});
</script>
<script>
	$(document).on("submit", "#add-sub-modal-form", function(event){
		event.preventDefault();
		var name=document.forms["add-sub-modal-form"]["add_sub_name"].value;
		var sem=document.forms["add-sub-modal-form"]["add_sub_sem"].value;
		var dept=document.forms["add-sub-modal-form"]["add_sub_dept"].value;		

		var formData={ name:name, sem:sem, dept:dept, key1:'<?php echo str_shuffle("1234567890ABCDabcd"); ?>' }
		$.ajax({
			method: "POST",
			url: "php_includes/add-sub.php",
			data: formData
		}).done(function(msg){
			if(msg=="success") {
				$('.add_sub_err').hide().html('<p class="success" style="display:inline-block;border-radius:2px;"><span class="glyphicon glyphicon-ok-sign"></span> OE subject added successfully.</p>').fadeIn(1000);
				$('.sub-data-table-box').load("php_includes/get-sub-data.php", { key1:'<?php echo str_shuffle("1234567890ABCDabcd"); ?>' });
				document.getElementById("add-sub-modal-form").reset();
			}
			else {
				$('.add_sub_err').hide().html('<p class="danger" style="display:inline-block;border-radius:2px;"><span class="glyphicon glyphicon-remove-sign"></span> '+msg+'</p>').fadeIn(1000);
			}
		});
	});
</script>
<script>
	$(document).on("click", ".sub-btn-trash", function(event){
		event.preventDefault();
		var sid=$(this).attr("sid");
		if(sid>=0) {
			var formData={ sid:sid, key1:'<?php echo str_shuffle("1234567890ABCDabcd"); ?>' }
			$.ajax({
				method: "POST",
				url: "php_includes/sub-trash.php",
				data: formData
			}).done(function(msg){
				if(msg=="success") {
					$('.sub-data-table-box').load("php_includes/get-sub-data.php", { key1:'<?php echo str_shuffle("1234567890ABCDabcd"); ?>' });
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
	$(document).on("click", ".sub-btn-edit", function(event){
		event.preventDefault();
		var sub=$(this).attr("sid");
		if(sub>=0) {
			$("#edit-sub-modal-form").load("php_includes/get-sub-data-edit-modal.php", {sub:sub, key1:'<?php echo str_shuffle("1234567890ABCDabcd"); ?>'});
			$("#edit-sub-modal").modal();
			$(document).on("submit", "#edit-sub-modal-form", function(event){
				event.preventDefault();				
				var new_sub_name=$("#sub-name").val();
				var new_sub_dept=$("#sub-dept").val();
				var new_sub_sem=$("#sub-sem").val();				

				var formData={ oeid:sub, sub_name:new_sub_name, sub_dept:new_sub_dept, sub_sem:new_sub_sem, key1:'<?php echo str_shuffle("1234567890ABCDabcd"); ?>' }

				$.ajax({
					method: "POST",
					url: "php_includes/update-sub-data.php",
					data: formData
				}).done(function(msg){
					if(msg=="success") {
						$('.sub-data-table-box').load("php_includes/get-sub-data.php", { key1:'<?php echo str_shuffle("1234567890ABCDabcd"); ?>' });
						$("#edit-sub-modal").modal("hide");						
					}
					else {
						$('.edit_sub_err').hide().html('<p class="danger" style="display:inline-block;border-radius:2px;"><span class="glyphicon glyphicon-remove-sign"></span> '+msg+'</p>').fadeIn(1000);
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