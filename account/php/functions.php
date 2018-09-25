<?php
class account_update{
	function connect_db(){
		//connect to the database
		require_once '../../global/php/connect.php';

		// Check connection
		if ($conn->connect_error) 
		    die("Connection failed: " . $conn->connect_error);
		else
			return $conn;
	}

	function account_info($id){
		$account_update = new account_update;
		$conn = $account_update->connect_db();

		$sql="SELECT * FROM account WHERE account_id = '$id'";
		$result = $conn->query($sql);

		$row = $result->fetch_assoc();

		echo '{
        "fname": "'.$row['acc_fname'].'",
        "lname": "'.$row['acc_lname'].'",
        "username": "'.$row['account_usern'].'"
		}'; 
	}

	function profile_update($id,$fname,$lname){
		$account_update = new account_update;
		$conn = $account_update->connect_db();
		
		$update = $conn->query("UPDATE account set acc_fname = '$fname', acc_lname = '$lname' WHERE account_id = '$id' ");
		echo 1;
	}

	function profile_password($id,$pass){
		$account_update = new account_update;
		$conn = $account_update->connect_db();

		include "../../global/php/encrypt.php";
		$password = encrypt(encode($_POST['pass']));
		
		$update = $conn->query("UPDATE account set account_pass = '$password' WHERE account_id = '$id' ");
		echo 1;
	}
	
	
	
}

session_start();

$account_update = new account_update;

if(isset($_POST['info']))
	$account_update->account_info($_SESSION['account_id']);

else if(isset($_POST['profile']))
	$account_update->profile_update($_SESSION['account_id'],$_POST['fname'],$_POST['lname']);

else if(isset($_POST['pass']))
	$account_update->profile_password($_SESSION['account_id'],$_POST['pass']);
