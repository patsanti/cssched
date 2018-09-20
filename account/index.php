<?php
if(session_status() == PHP_SESSION_NONE) {
    session_start();
}
if(!isset($_SESSION['acc_type_id'])) 
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
			<h1>CLASS SCHEDULER</h1>
		</div>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
	  	<div class="collapse navbar-collapse" id="navbarNav">
	    	<ul id="nav-list" class="navbar-nav">
	      		<li class="nav-item">
	        		<a class="nav-link" href="../">Home</a>
	      		</li>
	    	</ul>
	  	</div>
	  	<ul class="nav navbar-nav navbar-right">
			<li class="dropdown">
				<a class="dropdown-toggle" data-toggle="dropdown" href="#">
					<span class="caret" style="color:black">Settings</span>
				</a>
				<ul class="dropdown-menu">
					<li><a class="nav-link" style="color: black" href="#">Account</a></li>
					<li><a class="nav-link" style="color: black" href="../global/php/authenticate.php?logout=1">Log Out</a></li>
				</ul>
			</li>
		</ul>
	</nav> <!-- END OF TNAVIGATION BAR -->

	
<div class="container">
	<h2>Account Settings</h2>
  <div class="row">
  		<div class="col-md-2">
  			<div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
			  <a class="nav-link active" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-home" role="tab" aria-controls="v-pills-home" aria-selected="true">Profile</a>
			  <a class="nav-link" id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-profile" role="tab" aria-controls="v-pills-profile" aria-selected="false">Account</a>
			</div>

		</div>
		<div class="col-md-10">
			<div class="tab-content" id="v-pills-tabContent">
			  <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
			  	<h2>Personal Information</h2>
				    <form class="form-horizontal" method="post" enctype="multipart/form-data">

					    <div class="form-group">
					      <label class="control-label col-sm-2">First Name:</label>
					      <div class="col-sm-10">
					        <input type="text" class="form-control" id="fname" placeholder="first name" name="fname">
					      </div>
					    </div>
					    <div class="form-group">
					      <label class="control-label col-sm-2">Last Name:</label>
					      <div class="col-sm-10">          
					        <input type="text" class="form-control" id="lname" placeholder="last name" name="lname">
					      </div>
					    </div>
					    <div id="error_msg"></div>
					    <div class="form-group">        
					      <div class="col-sm-offset-2 col-sm-10">
					        <button class="btn btn-primary" id="profile" type="submit"
							onclick="return(update_profile());">Update</button>
					      </div>
					    </div>
  					</form>

			  </div>
			  
			  <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
				  <form action="/action_page.php">
				  	<h2>Account Settings</h2>
				    <div class="form-group">
				      <label for="email">Username:</label>
				      <input type="email" class="form-control" id="uname" placeholder="Enter Username" name="uname" disabled>
				    </div>
				    <div class="form-group">
				      <label for="pwd">Password:</label>
				      <input type="password" class="form-control" id="pass" placeholder="Enter password" name="pass">
				    </div>
					    <div id="error_msg_acc"></div>

				    <button type="submit" class="btn btn-primary" id="account" onclick="return(update_password());">Update Account</button>
				  </form>
				  <hr>
				  <h2>Deactivate Account</h2>

				  		<a class="deactivate_btn" data-toggle="collapse" href="#collapse3" name="deactivate_btn" id="deactivate_btn"><button class="btn btn-danger" style="margin-bottom: 20px;">Deactivate Account</button></a>
						<div id="collapse3" class="panel-collapse collapse">
							<ul class="list-group">
								<li class="list-group-item">Please Enter your Password to proceed</li>
								<label for="deac_pass1"> Password</label>
								<li class="list-group-item">
									<input type="password" name="deac_pass1" id="deac_pass1" class="form-control" />
								</li>
								<label for="deac_pass1">Re-enter Password</label>
								<li class="list-group-item">
									<input type="password" name="deac_pass2" id="deac_pass2" class="form-control" />
								</li>
								<div id="deactivate_error"></div>
								<li class="list-group-item">
									<input type="button" name="deactivate" id="deactivate" value="Deactivate Account" class="btn btn-danger" onclick="return(YNconfirm());">
								</li>
							</ul>
						</div>
			  </div>

			  <div class="tab-pane fade" id="v-pills-messages" role="tabpanel" aria-labelledby="v-pills-messages-tab">...</div>
			  
			  <div class="tab-pane fade" id="v-pills-settings" role="tabpanel" aria-labelledby="v-pills-settings-tab">...</div>
		</div>
		</div>
	</div>
</div>


</body>
</html>