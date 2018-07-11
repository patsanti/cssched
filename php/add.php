<?php
	include_once 'connect.php';
  if(isset($_POST['submit'])){
    $subj = $_POST['subj'];
    $prof = $_POST['prof'];
    $blk = $_POST['course'];
    $day = $_POST['day'];
    $start = $_POST['start'];
    $end = $_POST['end'];
    $rms = $_POST['rms'];

    $check = mysqli_query($connect, "SELECT * FROM sched WHERE 
    ((start_time <= '".$start."' AND end_time > '".$start."') OR
    (start_time < '".$end."' AND end_time >= '".$end."')) AND
    room = '".$rms."' AND day = '".$day."' ") or die("Failed to query database ".mysqli_error($conn));
    $overlap = mysqli_fetch_row($check);

    if ($day == 'M'){
      $day = '1';
    }elseif ($day == 'T'){
      $day = '2';
    }elseif ($day == 'W'){
      $day = '3';
    }elseif ($day == 'Th'){
      $day = '4';
    }elseif ($day == 'F'){
      $day = '5';
    }

    if ($overlap>0){
      echo "<script>alert('Overlapping Schedules!');
      window.location.href='../index.php';     
      </script>";
    } else{
    	$sql = "INSERT INTO `cs_classsched`.`sched` (`sched_no`, `course_code`, `start_time`, `end_time`, `prof_name`, `class`, `day`, `room`) VALUES (NULL, '".$subj."', '".$start."', '".$end."', '".$prof."', '".$blk."', '".$day."', '".$rms."')"  or die('Error: ' . mysqli_error($conn));

    	if(mysqli_query($conn, $sql)){
            echo '<script>
            alert("Successfully added schedule!");
      		window.location.href="../index.php";
            </script>';
     } else {
        echo '<script>
            alert("Cannot add schedule!");"
            window.location.href="../index.php";
            </script>';
    }

    }
    
  }
?>