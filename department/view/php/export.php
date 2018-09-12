<?php
session_start();

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

  $global_use = new global_use;
  $conn = $global_use->connect_db();


  $id = $_SESSION['export_download'];
  $data_type = $_SESSION['export_download_name'];

  $file= $data_type.'-'.$id.'.xls';
  $sched_req_no = $_SESSION['schedule_request'];

    if($data_type == "professor")
      $concat = "prof_id =".$id;
    else if($data_type == "class")
      $concat = "class_id=".$id;
    else if($data_type == "room")
      $concat = "room_id=".$id;
    
    $excel = '
            <tr>
              <th>COURSE CODE</th>
              <th>DESCRIPTIVE TITLE</th>
              <th>COURSE YR. & BLOCK</th>
              <th>TIME</th>
              <th>DAY</th>
              <th>ROOM</th>
            </tr>';
    $result1 = $conn->query("SELECT * FROM schedule WHERE sched_req_no = '$sched_req_no' AND ".$concat);
    while($row = $result1->fetch_assoc()) {
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
      
        $c = '<tr>
            <td>'.$all_data['subject_name'].'</td>
            <td>'.$all_data['subject_description'].'</td>
            <td>'.$all_data['class_yr_blk'].'</td>
            <td>'.$start_time.' - '.$end_time.'</td>
            <td>'.$day.'</td>
            <td>'.$all_data['room_name'].'</td>
          </tr>';

         $excel = $excel.$c;
    }
    $excel = '<table border="3"><caption>Weekly Schedule of '.$all_data['prof_fname'].' '.$all_data['prof_lname'].'</caption>'.$excel.'</table>';
    header("Content-type: application/vnd.ms-excel");
    header("Content-Disposition: attachment; filename=$file");
    echo $excel;
?>