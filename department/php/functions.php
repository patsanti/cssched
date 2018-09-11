<?php
session_start();

class global_use {
	function connect_db(){
		//connect to the database
		require_once '../../global/php/connect.php';

		// Check connection
		if ($conn->connect_error) 
		    die("Connection failed: " . $conn->connect_error);
		else
			return $conn;
	}
}


class request{
	function create_request($year,$semester){
		$global_use = new global_use;
		$conn = $global_use->connect_db();

		$result = $conn->query("SELECT * FROM schedule_request");
		$check = 0;
		while($row = $result->fetch_assoc()) {
			if($row['school_year'] == $year && $row['semester'] == $semester)
				$check = $check + 1;
		}
		$id = $_SESSION['account_id'];

		if($check == 0){
			$update = $conn->query("INSERT INTO schedule_request (account_id,school_year,semester,request_status) VALUES ('$id','$year','$semester',0) ");
			$_SESSION['schedule_request'] = $conn->insert_id;
			echo 1;
		}
		else
			echo 0;
	}

	function schedule_name(){
		$global_use = new global_use;
		$conn = $global_use->connect_db();

		$result = $conn->query("SELECT * FROM schedule_request WHERE request_status = 0");
		$data = array();
		$n=0;
		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				if($row['semester'] == 1)
					$semester = "1st Semester";
				else if ($row['semester'] == 2)
					$semester = "2nd Semester";
				else
					$semester = "Summer";

				$data[$n] = $row['sched_req_no'];
				$data[$n+1] = $row['school_year'].' - '.$semester;
				$n = $n + 2;
			}
			$array_return = json_encode($data);
		    echo $array_return;
		}
		else{
			$data[0] = "0";
			$data[1] = "None";
			$array_return = json_encode($data);
		    echo $array_return;
		}
	}
}


$request = new request;

if(isset($_POST['create']))
	$request->create_request($_POST['year'],$_POST['semester']);
else if(isset($_POST['schedule_name']))
	$request->schedule_name();
else if(isset($_POST['open'])){
	$_SESSION['schedule_request'] = $_POST['open_schedule_id'];
}



?>