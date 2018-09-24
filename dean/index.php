<?php

if(session_status() == PHP_SESSION_NONE) {
    session_start();
}

if(isset($_SESSION['acc_type_id'])) {

	if ($_SESSION['acc_type_id'] == 2) 
		header("Location: ../");
	elseif ($_SESSION['acc_type_id'] == 4) 
		header("Location: ../");
}
else
	header("Location: ../");


?>

<!DOCTYPE html>
<html lang="en">
<head>
  	<title>CSIT Class Scheduler</title>
	<meta charset="utf-8">
	<meta http-equiv="Content-Type" content="text/html;charset=ISO-8859-1">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="shortcut icon" type="image/x-icon" href="../global/img/logo.png">
	<link rel="stylesheet" href="../global/css/bootstrap.min.css">
	<link rel="stylesheet" href="../global/css/navbar.css">
	<link rel="stylesheet" href="../global/css/default-theme.css">
	<link rel="stylesheet" href="../global/css/footer.css">
	<script type="text/javascript" src="../global/js/jquery.min.js"></script>
  	<script type="text/javascript" src="../global/js/bootstrap.min.js"></script>
	<script src="js/daypilot-all.min.js?v=2018.2.232" type="text/javascript"></script>
</head>
<body>
	<!-- NAVIGATION BAR -->
	<nav class="navbar navbar-expand-md sticky-top navbar-light bg-light navbar-color">
	  	<div class="navbar-brand" style="user-select: none">
			<img src="../global/img/logo.png" alt="CSIT departmental logo">
			<h1>CLASS SCHEDULER</h1>
		</div>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
	  	<div class="collapse navbar-collapse" id="navbarNav">

	  	</div>
	  	<ul class="nav navbar-nav navbar-right">
			<li class="dropdown">
				<a class="dropdown-toggle" data-toggle="dropdown" href="#">
					<span class="caret" style="color:black">Settings</span>
				</a>
				<ul class="dropdown-menu">
					<li><a class="nav-link" style="color: black" href="../account">Account</a></li>
					<li><a class="nav-link" style="color: black" href="../global/php/authenticate.php?logout=1">Log Out</a></li>
				</ul>
			</li>
		</ul>
	</nav> <!-- END OF TNAVIGATION BAR -->
	<div class="container">
		<h3> <b>Select Schedule Options</b></h3>
		<ul class="nav nav-tabs" role="tablist">
		    <li class="nav-item">
		      <a class="nav-link active" data-toggle="pill" href="#pending"><b>Pending Schedule Request</b></a>
		    </li>
		    <li class="nav-item">
		      <a class="nav-link" data-toggle="pill" href="#approved"><b>Approved Schedule</b></a>
		    </li>
		    <li class="nav-item">
		      <a class="nav-link" data-toggle="pill" href="#rejected"><b>Rejected Schedule</b></a>
		    </li>
		</ul>
			<div class="tab-content">
	  			<div class="col-md-12 jumbotron  tab-pane active" id="pending" >
	  				<h3>Open Pending Schedule Request</h3>
					<form class="form-horizontal" method="post" enctype="multipart/form-data">
						    <div class="form-group">

						       <select class="form-control" id="sched_name">
						       </select>
						    </div>
						    <div class="form-group">        
						      <div class="col-sm-offset-2 col-sm-10">
						        <button class="btn btn-primary" id="profile" type="submit"
								onclick="return(open_schedule(document.getElementById('sched_name').value));">Open Schedule Request</button>
								<div id="error_msg_open" style="position: absolute;"></div>

						      </div>
						    </div>
	  				</form>
	  			</div>

  				<div class="col-md-12 jumbotron  tab-pane" id="approved" >
  					<h3>View Approved Schedules</h3>
					<form class="form-horizontal" method="post" enctype="multipart/form-data">
						    <div class="form-group">

						       <select class="form-control" id="sched_name_view">
						       </select>
						    </div>
						    <div class="form-group">        
						      <div class="col-sm-offset-2 col-sm-10">
						        <button class="btn btn-primary" id="view" type="submit"
								onclick="return(view_schedule(document.getElementById('sched_name_view').value));">View Schedule</button>
								<div id="error_msg_view" style="position: absolute;"></div>

						      </div>
						    </div>
	  				</form>
  				</div>

  				<div class="col-md-12 jumbotron  tab-pane" id="rejected" >
  					<h3>View Rejected Schedules</h3>
					<form class="form-horizontal" method="post" enctype="multipart/form-data">
						    <div class="form-group">

						       <select class="form-control" id="sched_name_rejected">
						       </select>
						    </div>
						    <div class="form-group">        
						      <div class="col-sm-offset-2 col-sm-10">
						        <button class="btn btn-primary"id="view" type="submit"
								onclick="return(view_schedule_rejected(document.getElementById('sched_name_rejected').value));">View Schedule</button>
								<div id="error_msg_rejected" style="position: absolute;"></div>

						      </div>
						    </div>
	  				</form>
  				</div>
	  		</div>


	  	<div id="subjects">
			<h3 style="margin-top: 60px;;"><b>Manage Database</b></h3>

			<ul class="nav nav-tabs" role="tablist">
			    <li class="nav-item">
			      <a class="nav-link active" data-toggle="pill" href="#prof"><b>Professor</b></a>
			    </li>
			    <li class="nav-item">
			      <a class="nav-link" data-toggle="pill" href="#class"><b>Class</b></a>
			    </li>
			    <li class="nav-item">
			      <a class="nav-link" data-toggle="pill" href="#room"><b>Room</b></a>
			    </li>
			</ul>

			<div class="tab-content">
				
				<div class="col-md-12 tab-pane active" id="prof">
					<button class="btn-success form-control-sm" id="btn-confirm" type="submit" style="float: right">Add Professor</button>	
					<div id="all-professor-table"></div>
				</div>

				<div class="col-md-12 tab-pane" id="class">
					<button class="btn-success form-control-sm" id="btn-confirm2" type="submit" style="float: right">Add Class</button>	
					<div id="all-class-table"></div>
				</div>

				<div class="col-md-12 tab-pane" id="room">
					<button class="btn-success form-control-sm" id="btn-confirm3" type="submit" style="float: right">Add Room</button>	
					<div id="all-room-table"></div>
				</div>
			</div>	
		</div>



	</div>
	<div><br><br><br><br><br><br></div>
	<footer><i>Footer here (work in progress).</i></footer>



	<div class="modal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" id="mi-modal">
	  <div class="modal-dialog modal-sm">
	    <div class="modal-content">
	      <div class="modal-header">
	      	<h4 class="modal-title" id="myModalLabel">Add Professor</h4>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	      </div>
	      <div class="modal-content">
	      	<div class="modal-body">
	      		<div>
	      			<label>First Name</label>
	      			<input type="text" id="fname" class="form-control" required>
	      			<label>Middle Name</label>
	      			<input type="text" id="mname" class="form-control" required>
	      			<label>Last Name</label>
	      			<input type="text" id="lname" class="form-control" required>
	      		</div>
	      	</div>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-success" id="modal-btn-si">Add</button>
	        <button type="button" class="btn btn-default" id="modal-btn-no">Cancel</button>
	      </div>
	    </div>
	  </div>
	</div>

	<div class="modal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" id="mi-modal2">
	  <div class="modal-dialog modal-sm">
	    <div class="modal-content">
	      <div class="modal-header">
	      	<h4 class="modal-title" id="myModalLabel">Add Class</h4>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	      </div>
	      <div class="modal-content">
	      	<div class="modal-body">
	      		<div>
	      			<label>Class Name</label>
	      			<input type="text" id="class_name" class="form-control" required>
	      		</div>
	      	</div>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-success" id="modal-btn-si2">Add</button>
	        <button type="button" class="btn btn-default" id="modal-btn-no2">Cancel</button>
	      </div>
	    </div>
	  </div>
	</div>


	<div class="modal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" id="mi-modal3">
	  <div class="modal-dialog modal-sm">
	    <div class="modal-content">
	      <div class="modal-header">
	      	<h4 class="modal-title" id="myModalLabel">Add Room</h4>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	      </div>
	      <div class="modal-content">
	      	<div class="modal-body">
	      		<div>
	      			<label>Room Name</label>
	      			<input type="text" id="room_name" class="form-control" required>
	      		</div>
	      	</div>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-success" id="modal-btn-si3">Add</button>
	        <button type="button" class="btn btn-default" id="modal-btn-no3">Cancel</button>
	      </div>
	    </div>
	  </div>
	</div>
	<script type="text/javascript" src="js/script.js"></script>
</body>
</html>