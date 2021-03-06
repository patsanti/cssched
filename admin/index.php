<?php
if(session_status() == PHP_SESSION_NONE) {
    session_start();
}
if(isset($_SESSION['acc_type_id'])) {
	if($_SESSION['acc_type_id'] == 2)
		header("Location: ../");
	elseif ($_SESSION['acc_type_id'] == 3) 
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
	<script type="text/javascript" src="js/script.js"></script>
</head>
<body>
	<!-- NAVIGATION BAR -->
	<nav class="navbar navbar-expand-md sticky-top navbar-light bg-light navbar-color">
	  	<div class="navbar-brand" style="user-select: none">
			<img src="../global/img/logo.png" alt="CSIT departmental logo">
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
					<li><a class="nav-link" style="color: black" href="../account">Account</a></li>
					<li><a class="nav-link" style="color: black" href="../global/php/authenticate.php?logout=1">Log Out</a></li>
				</ul>
			</li>
		</ul>
	</nav> <!-- END OF TNAVIGATION BAR -->

	
	<div class="container">
		<div class="row">
				<div class="col-md-2">
					<div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
				  <a class="nav-link active" id="v-pills-home-tab" data-toggle="pill" href="#add-user" role="tab" aria-controls="v-pills-home" aria-selected="true">Add User</a>
				  <a class="nav-link" id="v-pills-profile-tab" data-toggle="pill" href="#manage-user" role="tab" aria-controls="v-pills-profile" aria-selected="false">Manage Users</a>
				  <a class="nav-link" id="v-pills-profile-tab" data-toggle="pill" href="#website-setting" role="tab" aria-controls="v-pills-profile" aria-selected="false">Website Settings</a>
				</div>

			</div>
			<div class="col-md-10">
				<div class="tab-content" id="v-pills-tabContent">
				  <div class="tab-pane fade show active" id="add-user" role="tabpanel" aria-labelledby="v-pills-home-tab">
				  	<h4>Create User Account</h4>
				  	<form method="post" enctype="multipart/form-data">
					    <div class="form-group">
					      <label for="email">Username:</label>
					      <input type="email" class="form-control" id="username" placeholder="Enter Username" name="username">
					    </div>
					    <div class="form-group">
					      <label for="pwd">Password:</label>
					      <input type="password" class="form-control" id="password" placeholder="Enter password" name="password">
					    </div>
						 <div class="form-group">
						  <label for="sel1">User Type</label>
						  <select class="form-control" id="user_type">
						    <option value="2">Department Chair</option>
						    <option value="3">College Dean</option>
						    <option value="4">Administrator</option>

						  </select>
						</div>
						<div id="error_msg"></div> 
					    <button type="submit" class="btn btn-primary" name="submit" id="submit" onclick="return(create_user());">Create User</button >
					  </form>
				  </div>
				  
				  <div class="tab-pane fade" id="manage-user" role="tabpanel" aria-labelledby="v-pills-profile-tab">
				  		<h3>Manage User</h3>
					  	<div id="manage-user-data"></div>
					  	<div id="collapse3" class="panel-collapse collapse">
								<ul class="list-group">
									<label for="deac_pass1">New Password</label>
									<li class="list-group-item">
										<input type="password" name="deac_pass1" id="deac_pass1" class="form-control" />
									</li>
									<div id="deactivate_error"></div>
									<li class="list-group-item">
										<input type="button" name="change_password" id="change_password" value="Change" class="btn btn-success" onclick="return(YNconfirm());">
									</li>
								</ul>
							</div>

				  </div>
				  <div class="tab-pane fade" id="website-setting" role="tabpanel" aria-labelledby="v-pills-profile-tab">
				  		<div id="preview"><img src="../global/img/logo.png" /></div>
					  	<h4>Change Logo</h4>
						<form action="php/functions.php" method="post" enctype="multipart/form-data">
						    <input class="form-control" type="file" name="fileToUpload" id="fileToUpload">
						    <input class="form-control" type="submit" value="Upload" name="submit">
						</form>

				  </div>

				</div>
			</div>
		</div>
	</div>

</body>
</html>