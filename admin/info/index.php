<?php

if(session_status() == PHP_SESSION_NONE) {
    session_start();
}
if(isset($_SESSION['acc_type_id'])) {
	if($_SESSION['acc_type_id'] == 2)
		header("Location: ../../");
	elseif ($_SESSION['acc_type_id'] == 3) 
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
	<script type="text/javascript" src="js/script.js"></script>
</head>
<body>
	<!-- NAVIGATION BAR -->
	<nav class="navbar navbar-expand-md sticky-top navbar-light bg-light navbar-color">
	  	<div class="navbar-brand" style="user-select: none">
			<img src="../../global/img/logo.png" alt="CSIT departmental logo">
			<h1>CLASS SCHEDULER ADMINISTRATOR</h1>
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
		<a href="../#manage-user">Go Back</a>
		<hr>
		<input type="hidden" id="id" value="<?php echo $_GET['id']; ?>">

		<div id="data_here"></div>
		<button id="reset_pass" style="margin-top: 20px;" class="btn btn-success"> Reset Password </button>
		<hr>
		<div id="msg"></div>

	</div>

</body>
</html>