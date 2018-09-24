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
	function professor(){
		$global_use = new global_use;
		$conn = $global_use->connect_db();

		echo '<table class="table table-striped">
			    <thead>
			      <tr>
			        <th>First Name</th>
			        <th>Middle Name</th>
			        <th>Last Name</th>
			      </tr>
			    </thead>
			    <tbody>';
		$result = $conn->query("SELECT * FROM professor ORDER BY prof_fname ASC");
		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				echo '
			      <tr>
			        <td><a href="manage/index.php?id='.$row['prof_id'].'&type=prof">'.$row['prof_fname'].'</a></td>
			        <td>'.$row['prof_mname'].'</td>
			        <td>'.$row['prof_lname'].'</td>
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

	function class(){
		$global_use = new global_use;
		$conn = $global_use->connect_db();

		echo '<table class="table table-striped">
			    <thead>
			      <tr>
			      	<th>ID</th>
			        <th>Class Name</th>
			      </tr>
			    </thead>
			    <tbody>';
		$result = $conn->query("SELECT * FROM class ORDER BY class_yr_blk ASC");
		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				echo '
			      <tr>
			        <td><a href="manage/index.php?id='.$row['class_id'].'&type=class">'.$row['class_id'].'</a></td>
			        <td>'.$row['class_yr_blk'].'</td>
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

	function room(){
		$global_use = new global_use;
		$conn = $global_use->connect_db();

		echo '<table class="table table-striped">
			    <thead>
			      <tr>
			      	<th>ID</th>
			        <th>Room Name</th>
			      </tr>
			    </thead>
			    <tbody>';
		$result = $conn->query("SELECT * FROM room ORDER BY room_name ASC");
		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				echo '
			      <tr>
			        <td><a href="manage/index.php?id='.$row['room_id'].'&type=room">'.$row['room_id'].'</a></td>
			        <td>'.$row['room_name'].'</td>
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

	function add_data($type){
		$global_use = new global_use;
		$conn = $global_use->connect_db();

		if($type == "prof"){
			$result = $conn->query("INSERT INTO professor (prof_fname,prof_mname,prof_lname) VALUES ('".$_POST['fname']."','".$_POST['mname']."','".$_POST['lname']."')");
			echo 1;
		}
		elseif($type == "class") {
			$result = $conn->query("INSERT INTO class (class_yr_blk) VALUES ('".$_POST['class_name']."')");
			echo 1;
		}
		elseif($type == "room") {
			$result = $conn->query("INSERT INTO room (room_name) VALUES ('".$_POST['room_name']."')");
			echo 1;
		}

	}


}


$request = new request;

if(isset($_POST['create']))
	$request->create_request($_POST['year'],$_POST['semester']);

else if(isset($_POST['schedule_name']))
	$request->schedule_name($_POST['status']);

else if(isset($_POST['open']))
	$_SESSION['schedule_request'] = $_POST['open_schedule_id'];

else if(isset($_POST['professor']))
	$request->professor();
else if(isset($_POST['class']))
	$request->class();
else if(isset($_POST['room']))
	$request->room();
else if(isset($_POST['type_add']))
	$request->add_data($_POST['type_add']);
?>