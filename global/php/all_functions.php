<?php
// all functions in cs scheduler
session_start();

class global_use {
	function connect_db(){
		//connect to the database
		require_once 'connect.php';

		// Check connection
		if ($conn->connect_error) 
		    die("Connection failed: " . $conn->connect_error);
		else
			return $conn;
	}
}


// class for checking CSP
class check{
	function check_conflict($result,$start_time,$end_time,$subject,$professor,$class,$room,$day){

		if ($result->num_rows > 0) {
			$if_conflict = 0;
		    while($row = $result->fetch_assoc()) {
		    	$db_start_time = strtotime($row['start_time']);
				$db_end_time = strtotime($row['end_time']);
				$db_start_time = date("H:i",$db_start_time);
				$db_end_time = date("H:i",$db_end_time);
				
		    	if( 
		    		( (($end_time > $db_start_time) && ($db_end_time > $start_time)) && ($room == $row['room_id']) && ($day == $row['day']) ) 

		    		    ) {
   					$if_conflict = $if_conflict + 1;
				}
		    }
		    return $if_conflict;
		}

	}
	// convert days: ask austin why do this
	function convert_day($day){
		if($day == "3")
			return 7;
		else if($day == "4")
			return 1;
		else if($day == "5")
			return 2;
		else if($day == "6")
			return 3;
		else if($day == "7")
			return 4;
		else if($day == "8")
			return 5;
		else if($day == "9")
			return 6;

	}

	function check_password($pass){
		$global_use = new global_use;
		$conn = $global_use->connect_db();
		include "encrypt.php";

		$id = $_SESSION['account_id'];
		$pass = encrypt(encode($_POST['pass']));

		$result = $conn->query("SELECT account_pass FROM account WHERE account_id = '$id'");

		$row = mysqli_fetch_assoc($result);


		if($row['account_pass'] == $pass){
			echo 1;
		}
		else
			echo 0;
	}

}


// class for add, delete and update
class alter{
	// function to add data
	function alter_add($start_time,$end_time,$subject,$professor,$class,$room,$day){
  		$global_use = new global_use;
		$conn = $global_use->connect_db();

		$start_time = strtotime($start_time);
		$end_time = strtotime($end_time);
		$start_time = date("H:i:s",$start_time);
		$end_time = date("H:i:s",$end_time);


  		$sql = "SELECT * FROM schedule";
  		$id = $_SESSION['schedule_request'];
		$check = new check;
		$result = $conn->query("SELECT * FROM schedule WHERE sched_req_no = '$id'");
		$day = $check->convert_day($day);
		$check_if_conflict = $check->check_conflict($result,$start_time,$end_time,$subject,$professor,$class,$room,$day);



		if($check_if_conflict == 0){
			$sql = "INSERT INTO schedule(subject_id,prof_id,room_id,class_id,day,start_time,end_time,sched_req_no) VALUES ('$subject','$professor','$room','$class','$day','$start_time','$end_time','$id')";
			$result = $conn->query($sql);
			echo 1;
		}
		else
			echo 0;
		

	}

	// function to delete data
	function alter_delete($id){
		$global_use = new global_use;
		$conn = $global_use->connect_db();

		$result = $conn->query("DELETE FROM schedule WHERE sched_no = '$id'");
		echo 1;
	}

	function alter_update(){
		$global_use = new global_use;
		$conn = $global_use->connect_db();

		$id = $_SESSION['schedule_request'];

		if(isset($_POST['correction'])){
			$correction = $_POST['correction'];
			$update = $conn->query("UPDATE schedule_request set request_status = 4,correction = '$correction' WHERE sched_req_no = '$id'");
			echo "Sucess";
		}
		else{

		}

	}

}

class get_data{
	
	// function to get all data needed to add a schedule
	// in dropdown
	function get_data_professor(){
		$global_use = new global_use;
		$conn = $global_use->connect_db();

		$sql = "SELECT * FROM professor";
		$result = $conn->query($sql);

		if ($result->num_rows > 0) {
		    // output data of each row
		    $n = 0;
		    $professor = array();
		    while($row = $result->fetch_assoc()) {
		       $professor[$n] = $row['prof_id'];
		       $n++;
		       $professor[$n] = $row['prof_lname'].', '.$row['prof_fname'].' '.$row['prof_mname'];
		       $n++;
		    }
		    $array_return = json_encode($professor);
		    echo $array_return;
		   
		} else {
		    echo "no professor data";
		}

	}

	// function to get all data needed to add a schedule
	// in dropdown
	function get_data_subject(){
		$global_use = new global_use;
		$conn = $global_use->connect_db();

		$sql = "SELECT * FROM subject";
		$result = $conn->query($sql);

		if ($result->num_rows > 0) {
		    // output data of each row
		    $n = 0;
		    $subject = array();
		    while($row = $result->fetch_assoc()) {
		       $subject[$n] = $row['subject_id'];
		       $n++;
		       $subject[$n] = $row['subject_name'];
		       $n++;
		    }
		    $array_return = json_encode($subject);
		    echo $array_return;
		    
		} else {
		    echo "no subject data";
		}

	}

	// function to get all data needed to add a schedule
	// in dropdown
	function get_data_class(){
		$global_use = new global_use;
		$conn = $global_use->connect_db();

		$sql = "SELECT * FROM class";
		$result = $conn->query($sql);

		if ($result->num_rows > 0) {
			$n = 0;
		    $class = array();
		    // output data of each row
		    while($row = $result->fetch_assoc()) {
		       $class[$n] = $row['class_id'];
		       $n++;
		       $class[$n] = $row['class_yr_blk'];
		       $n++;
		    }
		   	$array_return = json_encode($class);
		    echo $array_return;

		} else {
		    echo "no Class data";
		}

	}
	// function to get all data needed to add a schedule
	// in dropdown
	function get_data_room(){
		$global_use = new global_use;
		$conn = $global_use->connect_db();
		
		$sql = "SELECT * FROM room";
		$result = $conn->query($sql);

		if ($result->num_rows > 0) {
			$n = 0;
		    $room = array();
		    // output data of each row
		    while($row = $result->fetch_assoc()) {
		       $room[$n] = $row['room_id'];
		       $n++;
		       $room[$n] = $row['room_name'];
		       $n++;
		    }
		    $array_return = json_encode($room);
		    echo $array_return;

		} else {
		    echo "no room data";
		}

	}
	// get only ONE schedule data and display to calendar
	function get_schedule_data($subject,$professor,$class_id,$room){
		$global_use = new global_use;
		$conn = $global_use->connect_db();

		$sql = "SELECT * FROM subject,professor,class,room WHERE subject.subject_id = '$subject' AND professor.prof_id = '$professor' AND class.class_id = '$class_id' AND room.room_id = '$room'";
		$result = $conn->query($sql);
		$all_data = $result->fetch_assoc();

		echo $all_data['subject_name'].' - '.$all_data['subject_description'];
	}

	// get all schedule data and display
	function get_schedule_data_all($append){
		$global_use = new global_use;
		$conn = $global_use->connect_db();
		$id = $_SESSION['schedule_request'];
		$sql = "SELECT * FROM schedule WHERE sched_req_no = '$id'".$append;
		$result = $conn->query($sql);

		if ($result->num_rows > 0) {
		    // output data of each row
		    $n = 0;
		    $schedule = array();
		    while($row = $result->fetch_assoc()) {
		    	
		    	$sql2 = "SELECT * FROM subject WHERE subject_id = ".$row['subject_id']." ";
				$result2 = $conn->query($sql2);
				$subject = $result2->fetch_assoc();

				$sql3 = "SELECT * FROM class WHERE class_id = ".$row['class_id']." ";
				$result3 = $conn->query($sql3);
				$class = $result3->fetch_assoc();

				$prof = $conn->query("SELECT * FROM professor WHERE prof_id = ".$row['prof_id']." ");
				$prof = $prof->fetch_assoc();

				$start_time = strtotime($row['start_time']);
				$end_time = strtotime($row['end_time']);
				$start_time = date("H:i:s",$start_time);
				$end_time = date("H:i:s",$end_time);

				if($row['day'] == 7)
					$concat = "2013-03-03T";
				else if($row['day'] == 1)
					$concat = "2013-03-04T";
				else if ($row['day'] == 2)
					$concat = "2013-03-05T";
				else if($row['day'] == 3)
					$concat = "2013-03-06T";
				else if($row['day'] == 4)
					$concat = "2013-03-07T";
				else if($row['day'] == 5)
					$concat = "2013-03-08T";
				else if($row['day'] == 6)
					$concat = "2013-03-09T";


		       	$schedule[$n] = $row['sched_no'];
		       	$n++;
		       	$schedule[$n] = '<b><center>'.$subject['subject_name'].'<br>'.$class['class_yr_blk'].'<br><br>Prof. '.$prof['prof_fname'].' '.$prof['prof_mname'].'. '.$prof['prof_lname'].'</b></center>';
		       	$n++;
		       	$schedule[$n] = $concat.$start_time;
		       	$n++;
		       	$schedule[$n] = $concat.$end_time;
		       	$n++;
		    }
		    $array_return = json_encode($schedule);
		    echo $array_return;
		   
		} 	
	}

	// show schedule info in modal
	function show_schedule($id){
		$global_use = new global_use;
		$conn = $global_use->connect_db();

		$sql = "SELECT * FROM schedule WHERE sched_no = '$id'";
		$result = $conn->query($sql);
		$row = $result->fetch_assoc();

		$start_time = strtotime($row['start_time']);
		$end_time = strtotime($row['end_time']);
		$start_time = date("h:i",$start_time);
		$end_time = date("h:i",$end_time);

		if($row['day'] == 1)
			$day = "Monday";
		else if($row['day'] == 2)
			$day = "Tuesday";
		else if ($row['day'] == 3)
			$day = "Wednesday";
		else if($row['day'] == 4)
			$day = "Thursday";
		else if($row['day'] == 5)
			$day = "Friday";
		else if($row['day'] == 6)
			$day = "Saturday";
		else if($row['day'] == 7)
			$day = "Sunday";

		$subject = $row['subject_id'];
		$professor = $row['prof_id'];
		$class_id = $row['class_id'];
		$room = $row['room_id'];

		$sql2 = "SELECT * FROM subject,professor,class,room WHERE subject.subject_id = '$subject' AND professor.prof_id = '$professor' AND class.class_id = '$class_id' AND room.room_id = '$room'";
		
		$data = $conn->query($sql2);
		$all_data = $data->fetch_assoc();
		
		$schedule = array();
		$schedule[0] = $all_data['subject_name'];
		$schedule[1] = $all_data['subject_description'];
		$schedule[2] = $all_data['prof_lname'].', '.$all_data['prof_fname']. ' '.$all_data['prof_mname'] ;
		$schedule[3] = $all_data['class_yr_blk'];
		$schedule[4] = $all_data['room_name'];
		$schedule[5] = $start_time.' - '.$end_time. ' '.$day;

		$array_return = json_encode($schedule);
		echo $array_return;
	}

	// shows current schedule name example "schedule of BSCS 1A"
	function get_title($sql,$name,$id,$type){
		$global_use = new global_use;
		$conn = $global_use->connect_db();
		$_SESSION['export_download'] = $id;

		$result = $conn->query($sql);
		$row = $result->fetch_assoc();
		$_SESSION['export_download_name'] = $type;
		echo $row[$name];
	}
	//returns the status of schedule
	function get_status(){
		$global_use = new global_use;
		$conn = $global_use->connect_db();
		$id = $_SESSION['schedule_request'];

		$result = $conn->query("SELECT * FROM schedule_request WHERE sched_req_no = '$id'");
		$row = $result->fetch_assoc();

		if($row['semester'] == 1)
			$semester = "1st Semester";
		elseif($row['semester'] == 2)
			$semester = "2nd Semester";
		else
			$semester = "Summer";
		$arr = array();

		if($row['request_status'] == 1){
			$arr[0] = 1;
			$arr[1] = '<p> <b>'.$row['school_year'].' - '.$semester.'</b> status: <b style="color:red;">PENDING</b></p>';
		}
		elseif($row['request_status'] == 2){
			$arr[0] = 2;
			$arr[1] = '<p><b> '.$row['school_year'].' - '.$semester.'</b> status:  <b style="color:green;">APPOVED</b></p>';
		}
		elseif($row['request_status'] == 4){
			$arr[0] = 4;
			$arr[1] = '<p><b> '.$row['school_year'].' - '.$semester.'</b> status:  <b style="color:red;">REJECTED</b></p>';
		}
		$arr[2]= '		<a class="deactivate_btn" data-toggle="collapse" href="#collapse3" name="deactivate_btn" id="deactivate_btn"><button id="export-csv" class="btn btn-danger">Export This Schedule and delete</button></a>
				<div id="collapse3" class="panel-collapse collapse jumbotron">
					<ul class="list-group">
						<li class="list-group-item">
							<b style="color: red;">note: Make sure you download the CSV file!
								Failure will lose the Schedule data!
							</b><br>
						Please Enter your Password to proceed</li>
						<label for="deac_pass1"> Password</label>
						<li class="list-group-item">
							<input type="password" id="pass" class="form-control" />
						</li>
						<label for="deac_pass1">Re-enter Password</label>
						<li class="list-group-item">
							<input type="password" id="pass2" class="form-control" />
						</li>
						<div id="delete_error"></div>
						<li class="list-group-item">
							<input type="button" name="deactivate" id="deactivate" value="Export This Schedule and delete" class="btn btn-danger" onclick="return(check_password());">
						</li>
					</ul>
				</div>';
		$array_return = json_encode($arr);
		echo $array_return;
	}
	// submitting schedule
	function submit_schedule($stat){
		$global_use = new global_use;
		$conn = $global_use->connect_db();
		$id =  $_SESSION['schedule_request'];
		$revision_text = $_POST['revision_text'];
		$result = $conn->query("UPDATE schedule_request set request_status = '$stat',correction = '$revision_text' WHERE sched_req_no = '$id'");
		echo "Schedule Request Submitted!";
	}
	// returns the schedule name
	function get_name(){
		$global_use = new global_use;
		$conn = $global_use->connect_db();
		$id = $_SESSION['schedule_request'];

		$result = $conn->query("SELECT * FROM schedule_request WHERE sched_req_no = '$id'");
		$row = $result->fetch_assoc();

		if($row['semester'] == 1)
			$semester = "1st Semester";
		elseif($row['semester'] == 2)
			$semester = "2nd Semester";
		else
			$semester = "Summer";

		if($row['request_status'] == 4)
			$status = '<b style="color:red" > REJECTED</b> <a href="#correction">(Click here for more Info)</a>';
		elseif($row['request_status'] == 1)
			$status = '<b style="color:red" > Pending</b>';
		echo '<p>Schedule: <b>'.$row['school_year'].' - '.$semester.': '.$status.'</b></p>';

	}
	function get_reasons(){
		$global_use = new global_use;
		$conn = $global_use->connect_db();
		$id = $_SESSION['schedule_request'];

		$result = $conn->query("SELECT * FROM schedule_request WHERE sched_req_no = '$id'");
		$row = $result->fetch_assoc();

		if($row['request_status'] == 4){
		echo '<div class="card">
                    <div class="card-header bg-danger text-white">Recommendation/Correction of College Dean</div>
                    <div class="card-body" id="reasons">'.$row['correction'].'</div>
                </div>';
		}
		elseif($row['request_status'] == 1){
		echo '<div class="card">
                    <div class="card-header bg-danger text-white">Revision/Past Recommendation</div>
                    <div class="card-body" id="reasons">'.$row['correction'].'</div>
                </div>';
		}

	}

}

// initialize classes
$alter = new alter;
$get_data = new get_data;
$check = new check;

// get all prof list
if(isset($_POST['get_prof']))
	$get_data->get_data_professor();

// get all subject list
elseif (isset($_POST['get_subject'])) 
	$get_data->get_data_subject();

// get all class list
elseif (isset($_POST['get_class'])) 
	$get_data->get_data_class();

// get all room list
elseif (isset($_POST['get_room'])) 
	$get_data->get_data_room();

else if(isset($_POST['get_schedule_data']))
	$get_data->get_schedule_data($_POST['get_subject_1'],$_POST['get_professor_1'],$_POST['get_class_1'],$_POST['get_room_1']);
else if(isset($_POST['get_schedule_data_all']))
	$get_data->get_schedule_data_all($_POST['query']);

else if(isset($_POST['show_schedule']))
	$get_data->show_schedule($_POST['show_schedule']);

// add schedule
elseif (isset($_POST['add_schedule'])) 
	$alter->alter_add($_POST['start_time'],$_POST['end_time'],$_POST['subject'],$_POST['professor'],$_POST['class_1'],$_POST['room'],$_POST['day']);

elseif(isset($_POST['get_name_schedule']))
	$get_data->get_title($_POST['sql'],$_POST['data'],$_POST['session_id'],$_POST['type_data']);
elseif(isset($_POST['submit_schedule']))
	$get_data->submit_schedule($_POST['status']);

elseif(isset($_POST['get_name']))
	$get_data->get_name();

elseif(isset($_POST['get_status']))
	$get_data->get_status();
elseif(isset($_POST['check_password']))
	$check->check_password($_POST['pass']);
elseif(isset($_POST['delete_schedule']))
	$alter->alter_delete($_POST['delete_schedule']);
elseif(isset($_POST['change_schedule_request']))
	$alter->alter_update();
elseif(isset($_POST['reasons']))
	$get_data->get_reasons();


?>