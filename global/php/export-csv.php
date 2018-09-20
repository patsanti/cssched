<?php
//include database configuration file
session_start();
include 'connect.php';
  $id = $_SESSION['export_download'];
//get records from database
$query = $conn->query("SELECT * FROM schedule WHERE sched_req_no = '$id' ");


$update = $conn->query("UPDATE schedule_request set request_status = 3 WHERE sched_req_no = '$id' ");



$get = $conn->query("SELECT * FROM schedule_request WHERE sched_req_no = '$id' ");
$get = mysqli_fetch_assoc($get);

if($get['semester'] == 1)
    $sem = "1st Semester";
elseif($get['semester'] == 2)
    $sem = "2nd Semester";
else
    $sem = "Summer";



if($query->num_rows > 0){
    $delimiter = ",";
    $filename = $get['school_year'].'-'.$sem.'.csv';
    
    //create a file pointer
    $f = fopen('php://memory', 'w');
    
    //set column headers
    $fields = array('subject_id', 'prof_id', 'room_id', 'class_id', 'day','start_time','end_time','sched_req_no');
    fputcsv($f, $fields, $delimiter);
    
    //output each row of the data, format line as csv and write to file pointer
    while($row = $query->fetch_assoc()){
        $status = ($row['status'] == '1')?'Active':'Inactive';
        $lineData = array($row['subject_id'], $row['prof_id'], $row['room_id'], $row['class_id'], $row['day'],$row['start_time'],$row['end_time'],$row['sched_req_no']);
        fputcsv($f, $lineData, $delimiter);
    }
    
    //move back to beginning of file
    fseek($f, 0);
    
    //set headers to download file rather than displayed
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="' . $filename . '";');
    
    //output all remaining data on a file pointer
    fpassthru($f);

$delete = $conn->query("DELETE FROM schedule WHERE sched_req_no = '$id' ");

}
exit;

?>