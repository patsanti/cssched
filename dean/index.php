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
		<h3>Select Schedule Options</h3>
			<hr>
		<div class="row">

  			<div class="col-md-6 jumbotron" >
  				<h2><b><ins>Open Pending Schedule Request</ins></b></h2>
				<form class="form-horizontal" method="post" enctype="multipart/form-data">
					    <div class="form-group">

					       <select class="form-control" id="sched_name" style="margin-top: 50px;">
					       </select>
					    </div>
					    <div id="error_msg_open" style="position: absolute;"></div>
					    <div class="form-group">        
					      <div class="col-sm-offset-2 col-sm-10">
					        <button class="btn btn-primary" style="margin-top: 35px;" id="profile" type="submit"
							onclick="return(open_schedule(document.getElementById('sched_name').value));">Open Schedule Request</button>
					      </div>
					    </div>
  				</form>
  			</div>

  				<div class="col-md-6 jumbotron" >
  					<h2><b><ins>View Approved Schedules</ins></b></h2>
				<form class="form-horizontal" method="post" enctype="multipart/form-data">
					    <div class="form-group">

					       <select class="form-control" id="sched_name_view" style="margin-top: 50px;">
					       </select>
					    </div>
					    <div id="error_msg_view" style="position: absolute;"></div>
					    <div class="form-group">        
					      <div class="col-sm-offset-2 col-sm-10">
					        <button class="form-control btn btn-primary" style="margin-top: 35px;" id="view" type="submit"
							onclick="return(view_schedule(document.getElementById('sched_name_view').value));">View</button>
					      </div>
					    </div>
  				</form>
  			</div>
		</div>
	</div>
	<div><br><br><br><br><br><br></div>
	<footer><i>Footer here (work in progress).</i></footer>
	<script type="text/javascript" src="js/script.js"></script>
</body>
</html>