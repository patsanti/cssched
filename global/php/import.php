<?php
include "connect.php";



 if(isset($_POST["Import"])){
    
    $filename=$_FILES["file"]["tmp_name"];    


     if($_FILES["file"]["size"] > 0){
        $file = fopen($filename, "r");
          while (($getData = fgetcsv($file, 10000, ",")) !== FALSE){
            $sql = "INSERT into schedule (subject_id,prof_id,room_id,class_id,day,start_time,end_time,sched_req_no) 
                   values ('".$getData[0]."','".$getData[1]."','".$getData[2]."','".$getData[3]."','".$getData[4]."','".$getData[5]."','".$getData[6]."','".$getData[7]."')";
                   $result = mysqli_query($conn, $sql);
            if(!isset($result)){
              echo "<script type=\"text/javascript\">
                  alert(\"Invalid File:Please Upload CSV File.\");
                  window.location = \"index.php\"
                  </script>";   
            }
            else {
                echo "<script type=\"text/javascript\">
                alert(\"CSV File has been successfully Imported.\");
                window.location = \"index.php\"
              </script>";
            }
            $id = $getData[7];
          }
          $update = $conn->query("UPDATE schedule_request set request_status = 2 WHERE sched_req_no = '$id' ");
      
           fclose($file); 
     }
  }  
header("Location: ../../");
?>