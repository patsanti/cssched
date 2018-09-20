<?php



function get_subject($id){
	include "../../../global/php/connect.php";

	echo $id;
	$result = $conn->query("SELECT * FROM subject WHERE subject_id = '$id'");
	$row = $result->fetch_assoc();
	echo '
		<label>Subject Code</label>
		<input type="text" class="form-control" id="sub_name" value="'.$row['subject_name'].'">

		<label>Subject Description</label>
		<input type="text" class="form-control" id="sub_des" value="'.$row['subject_description'].'">

		<label>Lecture Unit</label>
		<input type="number" min="0" class="form-control" id="lec_unit" value="'.$row['lecture_unit'].'">

		<label>Lab Unit</label>
		<input type="number" min="0" class="form-control" id="lab_unit" value="'.$row['lab_unit'].'">

		<label>Credit Unit</label>
		<input type="number" min="0" class="form-control" id="cre_unit" value="'.$row['lecture_unit'].'">
		<div id="msg" style="position:absolute"> </div>
		<button style="margin-top: 30px;" type="submit" class="btn btn-success" onclick="return(update());">Update </button>
		<button  style="margin-top: 30px;" class="btn btn-danger" onclick="return(delete_subject());">Delete Subject </button>

		';
}

function update_subject($id,$subject_name,$subject_description,$lec_unit,$lab_unit,$cre_unit){
	include "../../../global/php/connect.php";
	$result = $conn->query("UPDATE subject set subject_name = '$subject_name', subject_description = '$subject_description', lecture_unit = '$lec_unit', lab_unit = '$lab_unit', credit_unit = '$cre_unit' WHERE subject_id = '$id'");
	echo 1;
}


function delete_subject($id){
	include "../../../global/php/connect.php";
	$result = $conn->query("DELETE FROM subject WHERE subject_id = '$id'");
	echo 1;
}



if(isset($_POST['get_subject']))
	get_subject($_POST['get_subject']);

elseif(isset($_POST['update']))
	update_subject($_POST['update'],$_POST['sub_code'],$_POST['sub_des'],$_POST['lec_unit'],$_POST['lab_unit'],$_POST['cre_unit']);

elseif(isset($_POST['delete']))
	delete_subject($_POST['delete']);
?>
