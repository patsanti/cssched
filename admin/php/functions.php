<?php

include "../../global/php/encrypt.php";
session_start();
class admin{
	function connect_db(){
		//connect to the database
		require_once '../../global/php/connect.php';

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
	}
	function get_user(){
		$admin = new admin;
		$conn = $admin->connect_db();
		$current_id = $_SESSION['account_id'];
		$result = $conn->query("SELECT * FROM account,acc_type where account.acc_type_id = acc_type.acc_type_id AND account_id != '$current_id' ");
		echo '<table class="table">
				  		<thead>
				  			<tr>
				  				<th>Account Type</th>
				  				<th>Username</th>
				  				<th>Full name</th>
				  				<th>Action</th>
				  			</tr>
				  		</thead>
				  		<tbody>';
    	
    	if ($result->num_rows > 0) {
    		while($row = $result->fetch_assoc()) {
    			echo '
				  			<tr>
				  				<td>'.$row['acc_type_name'].'</td>
				  				<td>'.$row['account_usern'].'</td>
				  				<td>'.$row['acc_fname'].' '.$row['acc_lname'].'</td>
				  				';
				  				if($row['acc_status'] == 1)
				  					echo '<td><a href="php/functions.php?ban=1">BAN</a></td>';
				  				elseif($row['acc_status'] == 2)
				  					echo '<td><a href="php/functions.php?unban=1">UNBAN</a></td>';
				  				elseif($row['acc_status'] == 3)
				  					echo '<td><a class="deactivate_btn" data-toggle="collapse" href="#collapse3" name="deactivate_btn" id="deactivate_btn">Change Password</a></td>';


				  			echo '</tr>';
    		}
    		echo '</tbody></table>';
    	}

	}		
	
	
	
}


$admin = new admin;

if(isset($_POST['uname']) && isset($_POST['pass']) && isset($_POST['type']))
	$admin->add_user($_POST['uname'],$_POST['pass'],$_POST['type']);
elseif(isset($_POST['manage_user']))
	$admin->get_user();
?>