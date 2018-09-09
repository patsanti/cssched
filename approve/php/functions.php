<?php


class approve{
	function connect_db(){
		//connect to the database
		require_once '../../global/php/connect.php';

		// Check connection
		if ($conn->connect_error) 
		    die("Connection failed: " . $conn->connect_error);
		else
			return $conn;
	}
	
	// function to get all data of scheadule
	// TODO
	function get_data_sched($value){

		if($value == 0)
			$title = "Pending Schedule Request";
		else if($value == 1)
			$title = "Approved Schedule Request";
		else
			$title = "Denied Schedule Request";

		

		$approve = new approve;
		$conn = $approve->connect_db();

		$sql = 'SELECT * FROM schedule where status = '.$value.' ';
		$result = $conn->query($sql);

		if ($result->num_rows > 0) {
			echo ' <div class="tab-content">
		    <div id="home" class="container tab-pane active"><br>
		    	<hr>
		      <h4>'.$title.'</h4>
		     <table class="table">
			    <thead>
			      <tr>
			        <th>Subject</th>
			        <th>Section</th>
			        <th>Schedule/Room</th>
			        <th>Faculty</th>
			        <th>Action</th>
			      </tr>
			    </thead>
			    <tbody>';
			while($row = $result->fetch_assoc()) {
						if($row['day'] == 1){
							$day = "Mon";
						} else if($row['day'] == 2){
							$day = "Tue";
						}else if($row['day'] == 3){
							$day = "Wed";
						}else if($row['day'] == 4){
							$day = "Thu";
						}else if($row['day'] == 5){
							$day = "Fri";
						}else if($row['day'] == 6){
							$day = "Sat";
						}

						$start_time = strtotime($row['start_time']);
						$end_time = strtotime($row['end_time']);
						$start_time = date("h:i",$start_time);
						$end_time = date("h:i",$end_time);

						// for the subject data schedule
						$sql2 = "SELECT * FROM subject WHERE subject_id = ".$row['subject_id']." ";
						$result2 = $conn->query($sql2);
						$row2 = $result2->fetch_assoc();
						// for the faculty data
						$sql5 = "SELECT * FROM professor WHERE prof_id = ".$row['prof_id']." ";
						$result5 = $conn->query($sql5);
						$professor = $result5->fetch_assoc();
						// for the class data in schedule
						$sql3 = "SELECT * FROM class WHERE class_id = ".$row['class_id']." ";
						$result3 = $conn->query($sql3);
						$subject_yr = $result3->fetch_assoc();
						// for the room data in schedule
						$sql4 = "SELECT * FROM room WHERE room_id = ".$row['room_id']." ";
						$result4 = $conn->query($sql4);
						$room_data = $result4->fetch_assoc();
						//for action
						if($value == 0)
							$action = '<a href="php/functions.php?sched_id='.$row['sched_no'].'&operation=1"> APPROVE </a> |	<a href="php/functions.php?sched_id='.$row['sched_no'].'&operation=2"> DENY </a>';
						else
							$action = '<a href="php/functions.php?sched_id='.$row['sched_no'].'&operation=0"> CANCEL </a> ';
						
						echo '
					      <tr>
					        <td>'.$row2['subject_name'].' - '.$row2['subject_description'].'</td>
					        <td>'.$subject_yr['class_yr_blk'].'</td>
					        <td>'.$start_time.' - '.$end_time.' '.$day.' '.$room_data['room_name'].'</td>
					        <td>'.$professor['prof_lname'].', '.$professor['prof_fname'].' '.$professor['prof_mname'].'</td>
					        <td>'.$action.'</td>
					      </tr>';
			}
			echo '</tbody></table></div></div>';
		}
		else{
			echo '<div class="tab-content">
		    <div id="home" class="container tab-pane active"><br>
		    	<hr>
		      <h4>'.$title.'</h4><h3 align="center"><br><br><br>	 NO SCHEDULE AVAILABLE</h3></div></div>';
		}	
	}

	function operation($operation,$sched_id){
		$approve = new approve;
		$conn = $approve->connect_db();

		if(mysqli_query($conn,"UPDATE schedule set status = '$operation' where sched_no = '$sched_id' ")){
    		header("Location: ../");
    	}
	    else{
	       	header("Location: ../");
	    }
	}
}


$approve = new approve;

if(isset($_POST['get_data_schedule'])){
	if($_POST['get_data_schedule'] == 0)
		$approve->get_data_sched("0");
	else if($_POST['get_data_schedule'] == 1)
		$approve->get_data_sched("1");
	else if($_POST['get_data_schedule'] == 2)
		$approve->get_data_sched("2");
}


else if(isset($_GET['operation']) && isset($_GET['sched_id'])){
	if($_GET['operation'] == 1)
		$approve->operation("1",$_GET['sched_id']);
	else if($_GET['operation'] == 0)
		$approve->operation("0",$_GET['sched_id']);
	else
		$approve->operation("2",$_GET['sched_id']);
}