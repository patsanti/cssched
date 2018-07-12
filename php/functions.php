<?php
// all functions

// class for add, delete and update
class alter{
	// function to add data
	function alter_add(){
  		//add code here for add
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
		    echo '<select class="form-control">';
		    while($row = $result->fetch_assoc()) {
		       echo  '<option>'.$row['prof_fname'].'</option>' ;
		    }
		    echo "</select>";
		} else {
		    echo "no professor data";
		}

	} 

	function get_data_course(){
		include('test_connect.php');
		$sql = "SELECT course_code FROM course";
		$result = $conn->query($sql);

		if ($result->num_rows > 0) {
		    // output data of each row
		    echo '<select class="form-control">';
		    while($row = $result->fetch_assoc()) {
		       echo  '<option>'.$row['course_code'].'</option>' ;
		    }
		    echo "</select>";
		} else {
		    echo "no Course data";
		}

	}


	function get_data_class(){
		include('test_connect.php');
		$sql = "SELECT class_yr_blk FROM class";
		$result = $conn->query($sql);

		if ($result->num_rows > 0) {
		    // output data of each row
		    echo '<select class="form-control">';
		    while($row = $result->fetch_assoc()) {
		       echo  '<option>'.$row['class_yr_blk'].'</option>' ;
		    }
		    echo "</select>";
		} else {
		    echo "no Class data";
		}

	}
	function get_data_room(){
		include('test_connect.php');
		$sql = "SELECT room_name FROM room";
		$result = $conn->query($sql);

		if ($result->num_rows > 0) {
		    // output data of each row
		    echo '<select class="form-control">';
		    while($row = $result->fetch_assoc()) {
		       echo  '<option>'.$row['room_name'].'</option>' ;
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

if(isset($_POST['get_prof'])){
	$get_data->get_data_professor();
}

elseif (isset($_POST['get_course'])) {
	$get_data->get_data_course();
}

elseif (isset($_POST['get_class'])) {
	$get_data->get_data_class();
}

elseif (isset($_POST['get_room'])) {
	$get_data->get_data_room();
}

?>