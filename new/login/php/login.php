<?php

if(session_status() == PHP_SESSION_NONE) {
    session_start();
}

include $_SERVER['DOCUMENT_ROOT']."/cssched/php/functions.php";
$global_use = new global_use;
$conn = $global_use->connect_db();

if(isset($_POST['uname']) && isset($_POST['pass'])){
	$username = $global_use->encode($_POST['uname']);
	$password = $global_use->encrypt($global_use->encode($_POST['pass']));

	// check if entered username and password is in the database
	$result = mysqli_query($conn,"SELECT * FrOm bucs_class_schedule.account where bucs_class_schedule.account.username = '$username' AND bucs_class_schedule.account.password = '$password' ");
    if($row = mysqli_num_rows($result) == 1){
		$found = mysqli_fetch_array($result);

		if($found['state'] == 1){
			$account_id = $found['account_id'];
			setcookie("account_id", $account_id, time() + (86400 * 30), "/");
			$_SESSION['account_id'] = $account_id;
			mysqli_query($conn,"INSERT INTO augeo_application.user_logtime(user_id) VALUES ('$account_id') ");
			$_SESSION['log_id'] = mysqli_insert_id($conn);
			echo "sucess";
		}
		elseif ($found['state'] == 2) {
			echo "banned account";
		}
		else{
			$_SESSION['deactivated_id'] = $found['account_id'];
			echo "deactivated account";
		}
	}
    else{
		echo "Incorrect Username or Password";
	}
}

// create account
elseif(isset($_POST['crt_uname']) && isset($_POST['crt_pass'])){
	$username = $global_use->encode($_POST['crt_uname']);
	$password = $global_use->encrypt($global_use->encode($_POST['crt_pass']));
 	// $password = encrypt(encode($_POST['crt_pass']));
	if(mysqli_query($conn,"INSERT INTO bucs_class_schedule.account(account_id,username,password) VALUES ('','$username','$password') ")){
		echo "success";
	}
	else{
		echo "failed".mysqli_error($conn);
	}
}
else{
  $username = $global_use->encode($_POST['uname']);

	// check if entered username and password is in the database
	$result = mysqli_query($conn,"SELECT bucs_class_schedule.account.username FrOm bucs_class_schedule.account where bucs_class_schedule.account.username = '$username' ");
	if($row = mysqli_num_rows($result) != 0){
		echo "This Username is already taken";
	}
	else{
		echo "Username's Available";
	}
}
?>