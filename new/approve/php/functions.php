<?php
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
						      			<th>'.$row['prof_fname'].' '.$row['prof_mname'].' '.$row['prof_mlame'].'</th>
						      		</tr>
						      		<tr class="thead-light">
							    		<th>Course Code</th>
								        <th>Descriptive Title</th>
								        <th>Course Yr. & Block</th>
								        <th>Time</th>
								        <th>Day</th>
								        <th>Room</th>
							    	</tr>
							    </thead>
							    <tbody id="workload_table_body">';
				$sql1 = "SELECT * FROM schedule WHERE prof_id = ".$row['prof_id']." AND status = 0  ";
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

						// for the course data schedule
						$sql2 = "SELECT * FROM course WHERE course_id = ".$row1['course_id']." ";
						$result2 = $conn->query($sql2);
						$row2 = $result2->fetch_assoc();
						// for the class data in schedule
						$sql3 = "SELECT * FROM class WHERE class_id = ".$row1['class_id']." ";
						$result3 = $conn->query($sql3);
						$course_yr = $result3->fetch_assoc();
						// for the room data in schedule
						$sql4 = "SELECT * FROM room WHERE room_id = ".$row1['room_id']." ";
						$result4 = $conn->query($sql4);
						$room_data = $result4->fetch_assoc();
						echo '<tr>
								        <td>'.$row2['course_code'].'</td>
								        <td>'.$row2['course_title'].'</td>
								        <td>'.$course_yr['class_yr_blk'].'</td>
								        <td>'.$row1['start_time'].' - '.$row1['end_time'].'</td>
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
}