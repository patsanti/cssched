<?php

include "../../global/php/encrypt.php";
require_once '../../global/php/connect.php';
session_start();
		// Check connection
if ($conn->connect_error) 
	die("Connection failed: " . $conn->connect_error);


if(isset($_POST['uname']) && isset($_POST['pass'])){
	$username = encode($_POST['uname']);
	$password = encrypt(encode($_POST['pass']));

	// check if entered username and password is in the database
	$result = mysqli_query($conn,"SELECT * FROM account where account.account_usern = '$username' AND account.account_pass = '$password' ");
    if($row = mysqli_num_rows($result) == 1){
		$found = mysqli_fetch_array($result);

		if($found['acc_status'] == 1 || $found['acc_status'] == 3){
			$account_id = $found['account_id'];
			setcookie("account_id", $account_id, time() + (86400 * 30), "/");
			$_SESSION['account_id'] = $account_id;
			$_SESSION['acc_type_id'] = $found['acc_type_id'];
			//mysqli_query($conn,"INSERT INTO augeo_application.user_logtime(user_id) VALUES ('$account_id') ");
			//$_SESSION['log_id'] = mysqli_insert_id($conn)
			echo 1;
		}
		elseif ($found['acc_status'] == 2) {
			echo "banned account";
		}
		else{
			$_SESSION['deactivated_id'] = $found['account_id'];
			echo 0;
		}
	}
    else{
		echo "Incorrect Username or Password";
	}
}

?>