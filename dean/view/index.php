<?php

if(session_status() == PHP_SESSION_NONE) {
    session_start();
}

if(isset($_SESSION['acc_type_id'])) {

	if ($_SESSION['acc_type_id'] == 2) 
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
	<link rel="shortcut icon" type="image/x-icon" href="../global/img/logo.png">
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
			<div class="col-md-3">
					<section id="add-schedule">
						<a href="../">Go back</a>
					<header>
						<h2>VIEW SCHEDULE</h2>
					</header>
					<hr>
					<form action="php/functions.php" method="POST">
						<p>Filter Schedule </p>
						<input type="hidden" name="add_schedule" id="add_schedule" value="1">

						<b>By Professor</b>
						<select multiple class="form-control" id="select-prof" class="form-control" required>
							
						</select>
						<hr>
						<b>By Class</b>
						<select multiple class="form-control" id="select-class" class="form-control" required>
							
						</select>
						<hr>
						<b>By Room</b>
						<select multiple class="form-control" id="select-room" class="form-control" required>
						</select>
						<div id="error_msg"></div>

					</form>
				</section>
			</div>
			<div class="col-md-9">
				<div class="h7" id="request-status"></div>
				<hr>
				<div class="h4" id="title_name"></div>
				<div id="dp"></div>
				<a href="../../global/php/export.php" target="_blank"><button id="export">Export to Excel File</button></a>
			</div>
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

	<footer><i>Footer here (work in progress).</i></footer>
	<script type="text/javascript" src="js/script.js"></script>
</body>
</html>