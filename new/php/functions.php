<?php
// all functions in cs scheduler


// for those who want to Edit this Document please enter your changes below

// (CHANGES)
class global_use {
	function connect_db(){
		$servername = "localhost";
		$username = "root";
		$password = "password";

		// Create connection
		$conn = new mysqli($servername, $username, $password,'csit_advising_scheduler');

		// Check connection
		if ($conn->connect_error) 
		    die("Connection failed: " . $conn->connect_error);
		else
			return $conn;
	}
	function shift($ch, $key) {
    if (!ctype_alpha($ch))
        return $ch;

    $offset = ord(ctype_upper($ch) ? 'A' : 'a');
    return chr(fmod(((ord($ch) + $key) - $offset), 26) + $offset);
	}

	function ceasarian_cipher($input, $key) {
	    $output = "";
	    $inputArr = str_split($input);
	    foreach ($inputArr as $ch)
	        $output .= shift($ch, $key);

	    return $output;
	}

	function encrypt($password) {
	    $c_pass = ceasarian_cipher($password, 1);
	    $salt = md5($c_pass);
	    $sha = sha1($salt.$c_pass.$salt);
	    $encrypt_password = md5($sha.$salt);
	    return $encrypt_password;
	}

	function encode($string) {
	    return htmlspecialchars($string, ENT_HTML5 | ENT_QUOTES);
	}

	//after retrieving encoded data from database
	function decode($string) {
	    return htmlspecialchars_decode($string, ENT_HTML5 | ENT_QUOTES);
	}


}




// class for checking CSP
class check{
	function check_conflict($sql,$start_time,$end_time){
		$global_use = new global_use;
		$conn = $global_use->connect_db();
		$result = $conn->query($sql);
		while($row = $result->fetch_assoc()) {
			if( ($row['room_id'] == $_POST['add_room']) && ($row['day'] == $_POST['select-day']) && ( (($row['start_time'] <= $start_time) && ($start_time <= $row['end_time'])) || (($row['start_time'] <= $end_time) && ($end_time <= $row['end_time'])) ) || (($row['subject_id'] == $_POST['add_subject']) && ($row['class_id'] == $_POST['add_class']))  ){
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
  		$global_use = new global_use;
		$conn = $global_use->connect_db();

  		$start_time = $_POST['select-start-time'];
  		$end_time = $_POST['select-end-time'];

  		$sql = "SELECT * FROM schedule";

		$check = new check;

		$check_if_conflict = $check->check_conflict($sql,$start_time,$end_time);

		if($check_if_conflict == 1 ){
			echo 0;
		}
		else{
			echo 1;
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
	// TODO
	function get_data_sched(){
		$global_use = new global_use;
		$conn = $global_use->connect_db();

		$sql = "SELECT * FROM professor";
		$result = $conn->query($sql);

		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				echo '
							<table class="table table-sm text-center">
							    <thead  class="thead-dark">
						      		<tr>
						      			<th>'.$row['prof_fname'].' '.$row['prof_mname'].' '.$row['prof_lname'].'</th>
						      		</tr>
						      		<tr class="thead-light">
							    		<th>subject Code</th>
								        <th>Descriptive Title</th>
								        <th>subject Yr. & Block</th>
								        <th>Time</th>
								        <th>Day</th>
								        <th>Room</th>
							    	</tr>
							    </thead>
							    <tbody id="workload_table_body">';
				$sql1 = "SELECT * FROM schedule WHERE prof_id = ".$row['prof_id']." ";
				$result1 = $conn->query($sql1);
				if ($result1->num_rows > 0) {
					while($row1 = $result1->fetch_assoc()) {
						// converting day no. to a string
						if($row1['day'] == 1){
							$day = "Mon";
						} else if($row1['day'] == 2){
							$day = "Tue";
						}else if($row1['day'] == 3){
							$day = "Wed";
						}else if($row1['day'] == 4){
							$day = "Thu";
						}else if($row1['day'] == 5){
							$day = "Fri";
						}else if($row1['day'] == 6){
							$day = "Sat";
						}

						$start_time = strtotime($row1['start_time']);
						$end_time = strtotime($row1['end_time']);
						$start_time = date("h:i",$start_time);
						$end_time = date("h:i",$end_time);

						// for the subject data schedule
						$sql2 = "SELECT * FROM subject WHERE subject_id = ".$row1['subject_id']." ";
						$result2 = $conn->query($sql2);
						$row2 = $result2->fetch_assoc();
						// for the class data in schedule
						$sql3 = "SELECT * FROM class WHERE class_id = ".$row1['class_id']." ";
						$result3 = $conn->query($sql3);
						$subject_yr = $result3->fetch_assoc();
						// for the room data in schedule
						$sql4 = "SELECT * FROM room WHERE room_id = ".$row1['room_id']." ";
						$result4 = $conn->query($sql4);
						$room_data = $result4->fetch_assoc();
						echo '<tr>
								        <td>'.$row2['subject_name'].'</td>
								        <td>'.$row2['subject_description'].'</td>
								        <td>'.$subject_yr['class_yr_blk'].'</td>
								        <td>'.$start_time.' - '.$end_time.'</td>
								        <td>'.$day.'</td>
								        <td>'.$room_data['room_name'].'</td>
							      	</tr>';
					}
				}
				else{
					echo "<tr><td>no schedule available</td></tr>";
				}
				echo ' </tbody></table>';
			}
		    
			
		   
		} else {
		    echo "no schedule data";
		}
		
		
	}

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
//get all schedule
elseif (isset($_POST['get_data_schedule'])) {
	$get_data->get_data_sched();
}
// add schedule
elseif (isset($_POST['add_schedule'])) {
	$alter->alter_add();
}


?>