<?php

include "../../../global/php/encrypt.php";

class admin{
	function connect_db(){
		//connect to the database
		require_once '../../../global/php/connect.php';

		// Check connection
		if ($conn->connect_error) 
		    die("Connection failed: " . $conn->connect_error);
		else
			return $conn;
	}
	function add_user($uname,$pass,$type){
		$admin = new admin;
		$conn = $admin->connect_db();

		$username = encode($uname);
		$password = encrypt(encode($pass));

		$result = mysqli_query($conn,"SELECT * FROM account where account.account_usern = '$username' ");
    	
    	if($row = mysqli_num_rows($result) == 1)
    		echo 0;
    	else{
    		if(mysqli_query($conn,"INSERT INTO account (account_usern,account_pass,acc_fname,acc_lname,acc_type_id,acc_status) VALUES ('$username','$password','first name','last name', '$type',1) "))
    			echo 1;
    	}
		


		//echo $password;
	}	
	
	
	
}


$admin = new admin;

if(isset($_POST['uname']) && isset($_POST['pass']) && isset($_POST['type']))
	$admin->add_user($_POST['uname'],$_POST['pass'],$_POST['type']);
?>