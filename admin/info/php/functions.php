<?php

session_start();
class fetch_data{
	function connect_db(){
		//connect to the database
		require_once '../../../global/php/connect.php';
		// Check connection
		if ($conn->connect_error) 
		    die("Connection failed: " . $conn->connect_error);
		else
			return $conn;
	}

	function get_user($id){
		$fetch_data = new fetch_data;
		$conn = $fetch_data->connect_db();

		$result = $conn->query("SELECT * FROM account,acc_type WHERE acc_type.acc_type_id = account.acc_type_id AND account.account_id = '$id'");

		$row = mysqli_fetch_assoc($result);
		if($row['acc_type_id'] == 2)
			$type = "Department Chair";
		elseif($row['acc_type_id'] == 3)
			$type = "College Dean";
		elseif($row['acc_type_id'] == 4)
			$type = "Administrator";
		if($row['acc_status'] == 1){
			$status = '<b style="color:green">Active</b>';
		}
		elseif($row['acc_status'] == 2){
			$status = '<b style="color:red">Deactivated</b>';

		}


		echo '<h3 style="margin-bottom: 30px;"> Account Information </h3>


		<p>Account Type: <b style="color:green"> '.$type.'</b> </p>
		<p>Account Status: <b style="color:green"> '.$status.'</b> </p>

		<label>Username</label>
		<input class="form-control" type="text" id="uname" value="'.$row['account_usern'].'" disabled>

		<label>Full Name</label>
		<input class="form-control" type="text" id="fname" value="'.$row['acc_fname'].' '.$row['acc_mname'].' '.$row['acc_lname'].'" disabled>
			
			';


	}

	function reset_pass($id){
		include "../../../global/php/encrypt.php";

		$fetch_data = new fetch_data;
		$conn = $fetch_data->connect_db();
		$password = encrypt(encode("password"));

		$result = $conn->query("UPDATE account set account_pass = '$password' WHERE account_id = '$id'");
		echo 1;
	}

	
	
}


$fetch_data = new fetch_data;

if(isset($_POST['user']))
	$fetch_data->get_user($_POST['user']);
elseif(isset($_POST['reset']))
	$fetch_data->reset_pass($_POST['reset']);
?>