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

	function schedule_name($status){
		$global_use = new global_use;
		$conn = $global_use->connect_db();

		$result = $conn->query("SELECT * FROM schedule_request WHERE request_status = '$status'");
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

	function all_subjects(){
		$global_use = new global_use;
		$conn = $global_use->connect_db();

		echo '<table class="table table-striped">
			    <thead>
			      <tr>
			        <th>Subject Code</th>
			        <th>Subject Description</th>
			        <th>Lecture Unit</th>
			        <th>Lab Unit</th>
			        <th>Credit</th>
			      </tr>
			    </thead>
			    <tbody>';
		$result = $conn->query("SELECT * FROM subject ORDER BY subject_name ASC");
		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				echo '
			      <tr>
			        <td><a href="manage/index.php?id='.$row['subject_id'].'">'.$row['subject_name'].'</a></td>
			        <td>'.$row['subject_description'].'</td>
			        <td>'.$row['lecture_unit'].'</td>
			        <td>'.$row['lab_unit'].'</td>
			        <td>'.$row['credit_unit'].'</td>
			      </tr>
					';
			}
			echo '</tbody></table>';
		
		}
		else{
			echo '<tr>
					<td>No subject data</td>
			      </tr></tbody></table>';
		}
	}
	function add_subject($sub_code,$sub_des,$lec_unit,$lab_unit,$cre_unit){
		$global_use = new global_use;
		$conn = $global_use->connect_db();

		$result = $conn->query("INSERT INTO subject (subject_name,subject_description,lecture_unit,lab_unit,credit_unit) VALUES ('$sub_code','$sub_des','$lec_unit','$lab_unit','$cre_unit')");
		echo 1;
	}
}


$request = new request;

if(isset($_POST['create']))
	$request->create_request($_POST['year'],$_POST['semester']);

else if(isset($_POST['schedule_name']))
	$request->schedule_name($_POST['status']);

else if(isset($_POST['open']))
	$_SESSION['schedule_request'] = $_POST['open_schedule_id'];

else if(isset($_POST['subjects']))
	$request->all_subjects();

else if(isset($_POST['addsubject']))
	$request->add_subject($_POST['subcode'],$_POST['subdes'],$_POST['lecunit'],$_POST['labunit'],$_POST['creunit']);	





?>