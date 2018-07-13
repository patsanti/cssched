<?php
// all functions in cs scheduler


// for those who want to Edit this Document please enter your changes below

// (CHANGES)

class check{
	function check_conflict($sql,$start_time,$end_time){
		include('test_connect.php');
		$result = $conn->query($sql);
		while($row = $result->fetch_assoc()) {
			if( ($row['room_id'] == $_POST['add_room']) && ($row['day'] == $_POST['select-day']) && ( (($row['start_time'] <= $start_time) && ($start_time <= $row['end_time'])) || (($row['start_time'] <= $end_time) && ($end_time <= $row['end_time'])) ) || (($row['course_id'] == $_POST['add_course']) && ($row['class_id'] == $_POST['add_class']))  ){
				$conflict = 1;
				break;
			}
			else{
				$conflict = 0;
			}
		}
		
		if( $conflict == 0 ){
			return 0;
		}
		else{
			return 1;
		}
	}

}



// class for add, delete and update
class alter{
	// function to add data
	function alter_add(){
  		include('test_connect.php');

  		$start_time = $_POST['select-start-time'];
  		$end_time = $_POST['select-end-time'];

  		$sql = "SELECT * FROM schedule";

		$check = new check;

		$check_if_conflict = $check->check_conflict($sql,$start_time,$end_time);

		if($check_if_conflict == 1 ){
			echo "Conflict Schedule or Course has been already offered to a same class";
		}
		else{
			echo "sucess";
		}

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
	function get_data_sched(){
		
	}

	// function to get all data needed to add a schedule
	function get_data_professor(){
		include('test_connect.php');
		$sql = "SELECT * FROM professors";
		$result = $conn->query($sql);

		if ($result->num_rows > 0) {
		    // output data of each row
		    echo '<select class="form-control" name="add_prof" id="add_prof">';
		    while($row = $result->fetch_assoc()) {
		       echo  '<option value="'.$row['prof_id'].'">'.$row['prof_fname'].'</option>' ;
		    }
		    echo "</select>";
		} else {
		    echo "no professor data";
		}

	} 

	function get_data_course(){
		include('test_connect.php');
		$sql = "SELECT * FROM course";
		$result = $conn->query($sql);

		if ($result->num_rows > 0) {
		    // output data of each row
		    echo '<select class="form-control" name="add_course">';
		    while($row = $result->fetch_assoc()) {
		       echo  '<option value="'.$row['course_id'].'">'.$row['course_code'].'</option>' ;
		    }
		    echo "</select>";
		} else {
		    echo "no Course data";
		}

	}


	function get_data_class(){
		include('test_connect.php');
		$sql = "SELECT * FROM class";
		$result = $conn->query($sql);

		if ($result->num_rows > 0) {
		    // output data of each row
		    echo '<select class="form-control" name="add_class">';
		    while($row = $result->fetch_assoc()) {
		       echo  '<option value="'.$row['class_id'].'">'.$row['class_yr_blk'].'</option>' ;
		    }
		    echo "</select>";
		} else {
		    echo "no Class data";
		}

	}
	function get_data_room(){
		include('test_connect.php');
		$sql = "SELECT * FROM room";
		$result = $conn->query($sql);

		if ($result->num_rows > 0) {
		    // output data of each row
		    echo '<select class="form-control" name="add_room">';
		    while($row = $result->fetch_assoc()) {
		       echo  '<option value="'.$row['room_id'].'">'.$row['room_name'].'</option>' ;
		    }
		    echo "</select>";
		} else {
		    echo "no room data";
		}

	}


}

// initialize classes
$alter = new alter;
$get_data = new get_data;
// get all prof list
if(isset($_POST['get_prof'])){
	$get_data->get_data_professor();
}
// get all course list
elseif (isset($_POST['get_course'])) {
	$get_data->get_data_course();
}
// get all class list
elseif (isset($_POST['get_class'])) {
	$get_data->get_data_class();
}
// get all room list
elseif (isset($_POST['get_room'])) {
	$get_data->get_data_room();
}
// add schedule
elseif (isset($_POST['add_schedule'])) {
	$alter->alter_add();
}

?>