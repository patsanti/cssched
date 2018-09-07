<?php

if(session_status() == PHP_SESSION_NONE) {
    session_start();
}

if(isset($_SESSION['account_id'])) {
    header($_SERVER['SERVER_PROTOCOL']." 302 Found");
	header("Location: http://localhost/cssched");
	exit();
}

?>

<!DOCTYPE html>
<html>
<head>
	<title>login</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="css/index.css"/>
	<link rel="stylesheet" href="../css/bootstrap.min.css">
</head>
<body>
	<?php
	if(isset($_GET['activated'])) {
		echo '<input type="hidden" name="activated" id="activated" value="1">';
	}
	$redir_link = 'http://localhost/augeo/user/account';
	if(isset($_GET['redir'])) {
		$redir_link = $_GET['redir'];
		unset($_GET['redir']);
	}
	echo '<input type="hidden" id="redir_link" value="'.$redir_link.'">';
	?>

	<!-- Login form -->
	<div class="container login_form">
		<div align="center">
			<img src="../img/bucs-logo.png" id="brand-logo1">
			<h3>Sign in to CSIT Scheduler</h3>
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
					<span class="help-block" id ="error_msg"></span>
				</div>
				<input type="submit" class="btn btn-md" name="submit" id="submit" value="Login" onclick="return(login_submit());">
				<div id="forgot_pass"><a href="#" class="show_hide2"> Forgot Password</a></div>
			</form>
		</div>
	</div>

	<!-- Password Reset Form-->
	<div class="container email_d" >
		<div align="center">
			<img src="../img/bucs-logo.png" id="brand-logo1">
			<h3>Recover Account</h3>
		</div>
		<div class="panel-login">
			<form method="post" enctype="multipart/form-data">
				<div class="form-group">
					<label>Enter your Email</label>
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
				<h4 class="modal-title">Email Sent!</h4>
			</div>
			<div class="modal-body">
				<h2 align="center"> Please check your Email to reset your password</h2>
			</div>
		</div>
	</div>
</div>

	<!--Activated Account-->
	<div id="activated_modal" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title">Account has been Activated!</h4>
				</div>
				<div class="modal-body">
					<h2 align="center"> To continue, Please login</h2>
				</div>
			</div>
		</div>
	</div>

	<script src="../js/jquery.min.js"></script>
	<script src="../js/bootstrap.min.js"></script>
	<script src="js/index.js"></script>
</body>
</html>