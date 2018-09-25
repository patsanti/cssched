<?php
class all{
	function all_data_func($id,$type){
		include "../../../global/php/connect.php";

		if($type == "prof"){
			$result = $conn->query("SELECT * FROM professor WHERE prof_id = '$id'");
			$row = $result->fetch_assoc();
			echo '
				<label>Professor Info</label>
				<input type="text" class="form-control" id="fname" value="'.$row['prof_fname'].'">

				<label>Subject Description</label>
				<input type="text" class="form-control" id="mname" value="'.$row['prof_mname'].'">

				<label>Lecture Unit</label>
				<input type="text" class="form-control" id="lname" value="'.$row['prof_lname'].'">
				<div id="msg" style="position:absolute"> </div>
				<button style="margin-top: 30px;" type="submit" class="btn btn-success" onclick="return(update());">Update </button>
				';
		}

		elseif($type == "class"){
			$result = $conn->query("SELECT * FROM class WHERE class_id = '$id'");
			$row = $result->fetch_assoc();
			echo '
				<label>Class Name</label>
				<input type="text" class="form-control" id="class_name" value="'.$row['class_yr_blk'].'">

				<div id="msg" style="position:absolute"> </div>
				<button style="margin-top: 30px;" type="submit" class="btn btn-success" onclick="return(update());">Update </button>
				';
		}
		elseif($type == "room"){
			$result = $conn->query("SELECT * FROM room WHERE room_id = '$id'");
			$row = $result->fetch_assoc();
			echo '
				<label>Class Name</label>
				<input type="text" class="form-control" id="room_name" value="'.$row['room_name'].'">

				<div id="msg" style="position:absolute"> </div>
				<button style="margin-top: 30px;" type="submit" class="btn btn-success" onclick="return(update());">Update </button>
				';
		}

		
	}

	function update_data($id,$type){
		include "../../../global/php/connect.php";
		if($type == "prof"){
			$result = $conn->query("UPDATE professor set prof_fname = '".$_POST['fname']."', prof_mname = '".$_POST['mname']."', prof_lname = '".$_POST['lname']."' WHERE prof_id = '$id'");
			echo 1;
		}
		elseif($type == "class"){
			$result = $conn->query("UPDATE class set class_yr_blk = '".$_POST['class_name']."' WHERE class_id = '$id'");
			echo 1;
		}
		elseif($type == "room"){
			$result = $conn->query("UPDATE room set room_name = '".$_POST['room_name']."' WHERE room_id = '$id'");
			echo 1;
		}

	}


	function delete_data($id){
		include "../../../global/php/connect.php";
		$result = $conn->query("DELETE FROM subject WHERE subject_id = '$id'");
		echo 1;
	}

}

$all = new all;

if(isset($_POST['fetch_all']))
	$all->all_data_func($_POST['id'],$_POST['type_data']);

elseif(isset($_POST['update']))
	$all->update_data($_POST['update'],$_POST['type_update']);
?>
