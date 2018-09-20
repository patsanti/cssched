<?php

if(session_status() == PHP_SESSION_NONE) {
    session_start();
}

if(isset($_SESSION['acc_type_id'])) {
	if($_SESSION['acc_type_id'] == 2)
		header("Location: department/");
	elseif ($_SESSION['acc_type_id'] == 3) 
		header("Location: dean/");
	elseif ($_SESSION['acc_type_id'] == 4) 
		header("Location: admin/");
}

?>

<!DOCTYPE html>
<html>
<head>
	<title>login</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="login/css/index.css"/>
	<link rel="shortcut icon" type="image/x-icon" href="global/img/logo.png">
	<link rel="stylesheet" href="global/css/bootstrap.min.css">
</head>
<body>


	<!-- Login form -->
	<div class="container login_form">
		<div align="center">
			<img src="global/img/logo.png" id="brand-logo1">
			<h4>Sign in to BU Class Scheduler</h4>
		</div>
		<div class="panel-login">
			<form method="post" enctype="multipart/form-data">
				<div class="form-group">
					<label>Username</label>
					<input type="text" class="form-control" name="uname" id="uname" required>
				</div>
				<div class="form-group">
					<label>Password</label>
					<input type="password" class="form-control" name="pass" id="pass" required>
					<span class="help-block" id ="error_msg" style="font-size: 15px;"></span>
				</div>
				<input type="submit" class="btn btn-md" name="submit" id="submit" value="Login" onclick="return(login_submit());">
				<div id="forgot_pass"><a href="#" class="show_hide2"> Forgot Password</a></div>
			</form>
		</div>
	</div>

	<!-- Password Reset Form-->
	<div class="container email_d" >
		<div align="center">
			<img src="global/img/bucs-logo.png" id="brand-logo1">
			<h3>Recover Account</h3>
		</div>
		<div class="panel-login">
			<form method="post" enctype="multipart/form-data">
				<div class="form-group">
					<label>Enter your username</label>
					<input type="email" class="input-group" name="email" id="email">
					<span class="help-block" id ="error_email"></span>
				</div>
				<input type="submit" class="btn btn-default" name="send_mail" id="send_mail" value="send" onclick="return(email_submit());">
			</form>
		</div>
	</div>


<!-- Email success -->
<div id="myModal" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">Password Reset request pending</h4>
			</div>
			<div class="modal-body">
				<h2 align="center"> Please wait untill your administrator approves your request</h2>
			</div>
		</div>
	</div>
</div>


	<script src="global/js/jquery.min.js"></script>
	<script src="global/js/bootstrap.min.js"></script>
	<script src="login/js/index.js"></script>
</body>
</html>