<?php

if(session_status() == PHP_SESSION_NONE) {
    session_start();
}

if(isset($_SESSION['acc_type_id'])) {

	if ($_SESSION['acc_type_id'] == 3) 
		header("Location: ../../");
	elseif ($_SESSION['acc_type_id'] == 4) 
		header("Location: ../../");
}
else
	header("Location: ../../");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  	<title>CSIT Class Scheduler</title>
	<meta charset="utf-8">
	<meta http-equiv="Content-Type" content="text/html;charset=ISO-8859-1">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="shortcut icon" type="image/x-icon" href="../../global/img/logo.png">
	<link rel="stylesheet" href="../../global/css/bootstrap.min.css">
	<link rel="stylesheet" href="../../global/css/navbar.css">
	<link rel="stylesheet" href="../../global/css/default-theme.css">
	<link rel="stylesheet" href="../../global/css/footer.css">
	<script type="text/javascript" src="../../global/js/jquery.min.js"></script>
  	<script type="text/javascript" src="../../global/js/bootstrap.min.js"></script>
	<script src="../../global/js/daypilot-all.min.js?v=2018.2.232" type="text/javascript"></script>
</head>
<body>
	<!-- NAVIGATION BAR -->
	<nav class="navbar navbar-expand-md sticky-top navbar-light bg-light navbar-color">
	  	<div class="navbar-brand" style="user-select: none">
			<img src="../../global/img/logo.png" alt="CSIT departmental logo">
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
					<li><a class="nav-link" style="color: black" href="../../account">Account</a></li>
					<li><a class="nav-link" style="color: black" href="../../global/php/authenticate.php?logout=1">Log Out</a></li>
				</ul>
			</li>
		</ul>
	</nav> <!-- END OF TNAVIGATION BAR -->
	<div class="container">
		<div class="row">
			<div class="col-md-2">
					<section id="add-schedule">
						<a href="../" >Go Back</a>
						<hr>
					<header>

						<h2>ADD CLASS SCHEDULE</h2>
					</header>
					<form action="php/functions.php" method="POST">
						<p style="color:green;font-size: 15px;">Select schedule information here before adding schedule</p>
						<input type="hidden" name="add_schedule" id="add_schedule" value="1">
						<label for="select-course">Course Code</label>
						<select id="select-course" class="form-control form-control-sm" required>
						</select>

						<label id="label-prof">Professor</label>
						<select id="select-prof" class="form-control form-control-sm" required></select>

						<label id="label-class">Class</label>
						<select id="select-class" class="form-control form-control-sm" required></select>


						<label id="label-room">Room</label>
						<select id="select-room" class="form-control form-control-sm" required></select>
						<div id="error_msg"></div>

					</form>
				</section>
			</div>
			<div class="col-md-8">
				<div class="h7" id="request-name"></div>
				<hr>
				<div class="h4" id="title_name">Schedule of professor</div>
				<div id="dp"></div>
			</div>
			<div class="col-md-2">
				<header>
					<div> &nbsp</div>
					<hr>
					<h2>SELECT SCHEDULE</h2>
				</header>
				<p style="color:green; font-size: 15px;">Select the name of the professor/class to add schedule.</p>
				<label>Select by Professor</label>
				<select class="form-control form-control-sm" id="select-prof-view" class="form-control" required></select>
				
				<label>Select by Class</label>
				<select class="form-control form-control-sm" id="select-class-view" class="form-control" required></select>
				
				<label>Select by Room</label>
				<select class="form-control form-control-sm" id="select-room-view" class="form-control" required></select>
			</div>
			<div class="col-md-2"></div>
			<div class="col-md-8">
				<button class="form-control btn-success form-control-sm" id="btn-confirm" type="submit">Submit Schedule Request to College Dean</button>
				<div id="success_msg"></div>
			</div>
			<div class="col-md-2"></div>
		</div>


	</div>

	<div class="modal fade" id="myModal" role="dialog">
	    <div class="modal-dialog">
	      <!-- Modal content-->
	      <div class="modal-content">
	        <div class="modal-header">
	          <h4 class="modal-title">Schedule Information</h4>
	          <button type="button" class="close" data-dismiss="modal">&times;</button>
	        </div>
	        <div class="modal-body">
	          <div id="course_code">Course code here</div>
	          <div id="course_description">Course description here</div>
	          <div id="professor">Professor here</div>
	          <div id="class">class here</div>
	          <div id="room">room here</div>
	          <div id="schedule">Schedule here</div>
	        </div>
	        <div class="modal-footer">
	          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	        </div>
	      </div>
	    </div>
	</div>
	<!--another modal -->
	<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" id="mi-modal">
	  <div class="modal-dialog modal-sm">
	    <div class="modal-content">
	      <div class="modal-header">
	      	<h4 class="modal-title" id="myModalLabel">Schedule Request</h4>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	      </div>
	      <div class="modal-content">
	      	<div class="modal-body">
	      		<div><p>
	      			Are you sure you want to submit schedule request to College Dean?<br><br></p>
	      			<p style="color: red; font-size: 12px;"> Reminder: Make sure
	      		    the schedule request you're submitting is FINAL. Submitted request CANNOT be cancelled!! </p>
	      		</div>
	      	</div>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-success" id="modal-btn-si">Submit</button>
	        <button type="button" class="btn btn-default" id="modal-btn-no">Cancel</button>
	      </div>
	    </div>
	  </div>
	</div>

	<footer><i>Footer here (work in progress).</i></footer>
	<script type="text/javascript" src="js/script.js"></script>
</body>
</html>