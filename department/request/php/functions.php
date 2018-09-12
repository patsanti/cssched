<?php
// all functions in cs scheduler

session_start();
// for those who want to Edit this Document please enter your changes below

// (CHANGES)
class global_use {
	function connect_db(){
		//connect to the database
		require_once '../../../global/php/connect.php';

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
	function alter_delete(){
		// add code here for delete
	}

	// function to update data
	function alter_update(){
		// add code here for update
	}
}

class get_data{
	
	// function to get all data of scheadule
	// TODO
	

	// function to get all data needed to add a schedule
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
		       	$schedule[$n] = $subject['subject_name'].' - '.$subject['subject_description'];
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

	function get_title($sql,$name,$id,$type){
		$global_use = new global_use;
		$conn = $global_use->connect_db();
		$_SESSION['export_download'] = $id;

		$result = $conn->query($sql);
		$row = $result->fetch_assoc();
		$_SESSION['export_download_name'] = $type;
		echo $row[$name];
	}

	function submit_schedule(){
		$global_use = new global_use;
		$conn = $global_use->connect_db();
		$id =  $_SESSION['schedule_request'];

		$result = $conn->query("UPDATE schedule_request set request_status = 1 WHERE sched_req_no = '$id'");
		echo "Schedule Request Submitted!";
	}

}

// initialize classes
$alter = new alter;
$get_data = new get_data;
// get all prof list
if(isset($_POST['get_prof'])){
	$get_data->get_data_professor();
}
// get all subject list
elseif (isset($_POST['get_subject'])) {
	$get_data->get_data_subject();
}
// get all class list
elseif (isset($_POST['get_class'])) {
	$get_data->get_data_class();
}
// get all room list
elseif (isset($_POST['get_room'])) {
	$get_data->get_data_room();
}

else if(isset($_POST['get_schedule_data']))
	$get_data->get_schedule_data($_POST['get_subject_1'],$_POST['get_professor_1'],$_POST['get_class_1'],$_POST['get_room_1']);
else if(isset($_POST['get_schedule_data_all']))
	$get_data->get_schedule_data_all($_POST['query']);

else if(isset($_POST['show_schedule']))
	$get_data->show_schedule($_POST['show_schedule']);

// add schedule
elseif (isset($_POST['add_schedule'])) {
	$alter->alter_add($_POST['start_time'],$_POST['end_time'],$_POST['subject'],$_POST['professor'],$_POST['class_1'],$_POST['room'],$_POST['day']);
}
elseif(isset($_POST['get_name_schedule']))
	$get_data->get_title($_POST['sql'],$_POST['data'],$_POST['session_id'],$_POST['type_data']);

elseif(isset($_POST['submit_schedule']))
	$get_data->submit_schedule();


?>