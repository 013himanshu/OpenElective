<?php 
	echo '
		<nav class="navbar navbar-fixed-top">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
      <a class="navbar-brand" href="dashboard.php">
       	<h3 style="margin-top: -8px;">
       		<img src="../images/muj-logo.png" alt="Manipal University Jaipur" width="40px" /> Admin Panel
       	</h3>
      </a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">      
      <ul class="nav navbar-nav navbar-right">
        <li><a href="seat-allotment.php">Seat Allotment</a></li>
        <li><a href="allotment.php">Subject Allotment</a></li>
      	<li><a href="departments.php">Departments</a></li>
        <li><a href="semesters.php">Semesters</a></li>
        <li><a href="oe-subjects.php">OE Subjects</a></li>
        <li><a href="student-info.php">Student Info.</a></li>
        <li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" href="#">More <span class="caret"></span></a>
          <ul class="dropdown-menu">
		';
          	
        if($db_user_type=="superuser"){
        	echo '
        		<li><a href="add-user.php"><span class="glyphicon glyphicon-user"></span> Add User</a></li>
            <li><a href="edit-user.php"><span class="glyphicon glyphicon-pencil"></span> Edit User</a></li>
        	';
        }
          	
        echo '  	            
            <li><a href="my-profile.php"><span class="glyphicon glyphicon-pencil"></span> Edit My Profile</a></li>
            <li><a href="change-password.php"><span class="glyphicon glyphicon-lock"></span> Change My Password</a></li>
            <li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
          </ul>
        </li>
      </ul>
    </div>
  </div>
</nav>
	';
?>