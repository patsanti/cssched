<?php
  include_once 'php/connect.php';

  $get_prof = mysqli_query($connect, "SELECT * FROM professor ") or die("Error: ".mysqli_error());
  $get_profs = mysqli_query($connect, "SELECT * FROM professor ") or die("Error: ".mysqli_error());
  $get_subj = mysqli_query($connect, "SELECT * FROM subject ") or die("Error: ".mysqli_error());
  $get_rm = mysqli_query($connect, "SELECT * FROM room ") or die("Error: ".mysqli_error());
  $get_rms = mysqli_query($connect, "SELECT * FROM room ") or die("Error: ".mysqli_error());
  $get_day = mysqli_query($connect, "SELECT * FROM class_day ORDER BY no asc") or die("Error: ".mysqli_error());

  $scheds = mysqli_query($connect, "SELECT * FROM sched WHERE room = 'B2-101' ") or die("Error: ".mysqli_error());
?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.10/css/all.css" integrity="sha384-+d0P83n9kaQMCwj8F4RJB66tzIwOKmrdb46+porD/OvrJ+37WqIM7UoBtwHO6Nlg" crossorigin="anonymous">
<link href="css/main.css" rel="stylesheet" type="text/css"/>
<link rel="icon" href="bucs-logo.png">
<title>CSIT Schedule</title>
</head>
<body>

<div class="topnav"><center>
  <p><b> CSIT</b> Schedules</p>
</center></div>

<div class="sidenav">
  <a href="#workload" onclick="popWLoad()"><i class="fas fa-users"></i>&ensp;&ensp;Faculty Workload</a>
  <a href="#weekly" onclick="popWeekly()"><i class="far fa-calendar-alt"></i>&ensp;&ensp;Weekly Schedule</a>
  <a href="#rooms" onclick="popRooms()"><i class="fas fa-map-marker"></i>&ensp;&ensp;Room Designation</a>
  <a href="#addsched" onclick="popAddSched()"><i class="fas fa-plus"></i>&ensp;&ensp;Add Class Schedule</a> <br>

  <form class="schedform" id="adsched" action="php/add.php" method="POST"><br>
    <label>Select Course Code:
    <select name="subj">
      <option disabled selected value> - select an option - </option>
      <?php
      while($row = mysqli_fetch_array($get_subj)){
        echo"<option value='".$row['course_code']."'>".$row['course_code']."</option>";
     }?> </select></label> <br>
    <label>Select Professor: &ensp;&ensp;
    <select name="prof">
      <option disabled selected value> - select an option - </option>
      <?php
      while($row = mysqli_fetch_array($get_prof)){
        echo"<option value='".$row['prof_name']."' >".$row['prof_name']."</option>";
     }
      ?></select></label> <br>
    <label>Enter Class:&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;<input type="text" style="padding:2px 3px; width: 150px; margin-bottom: 10px;" name="course" placeholder="Course Yr-Block">
    </label><br>
    <center><label>Day:&ensp;&ensp;&ensp;Start Time:&ensp;&ensp;&ensp;&ensp;End Time:<br>
    &ensp;&ensp;<select name="day">
      <option disabled selected value>&nbsp;- </option>
      <?php
      while($row = mysqli_fetch_array($get_day)){
        echo"<option value='".$row['day']."' >".$row['day']."</option>";
     }
      ?></select>&ensp;<input type="time" name="start">&ensp;<input type="time" name="end"></label> </center>
    <label>Select Room: &ensp;&ensp;&ensp;&ensp;&ensp;
    <select name="rms">
      <option disabled selected value> - select an option - </option>
      <?php
      while($row = mysqli_fetch_array($get_rm)){
        echo"<option value='".$row['room']."'>".$row['room']."</option>";
     }
      ?></select></label>
    <center><input type="submit" name="submit"/>
  </center><br>
  </form>

</div>
<br><br><br><br>
<div id='work-load' style='display: block;''>
<?php
  while($row = mysqli_fetch_array($get_profs)){ 
    $prof = $row['prof_name'];
    $get_sched = mysqli_query($connect, "(SELECT * FROM sched WHERE prof_name = '".$prof."' ORDER BY course_code asc) ORDER BY day asc") or die("Error: ".mysqli_error());
    echo"
<div class='wrk'>
  <h3> $prof </h3> <center>
  <table>
  <thead>
    <tr>
      <th scope='col'>Course Code</th>
      <th scope='col'>Descriptive Title</th>
      <th scope='col'>Course Yr. & Block</th>
      <th scope='col'>Time</th>
      <th scope='col'>Day</th>
      <th scope='col'>Room</th>
    </tr>
  </thead>";
    while($row = mysqli_fetch_array($get_sched)){
      $day = $row['day'];
    if ($day == '1'){
      $day = 'M';
    }elseif ($day == '2'){
      $day = 'T';
    }elseif ($day == '3'){
      $day = 'W';
    }elseif ($day == '4'){
      $day = 'Th';
    }elseif ($day == '5'){
      $day = 'F';
    } 

    $subj = $row['course_code'];
    $get_s = mysqli_query($connect, "SELECT * FROM subject WHERE course_code = '".$subj."' ORDER BY course_code asc") or die("Error: ".mysqli_error());
    $get = mysqli_fetch_array($get_s);
      echo"
      <tbody>
      <a href='#addsched' onclick='popAddSched()' class='schedbtn'><tr>
      <td>$subj</td>
      <td>".$get['desc_title']."</td>
      <td>".$row['class']."</td>
      <td>"; echo  date('h:i a ', strtotime($row['start_time'])); echo" - "; echo date('h:i a ', strtotime($row['end_time'])); echo"</td>
      <td>".$day."</td>
      <td>".$row['room']."</td>
      </tr> </a> </tbody>
    ";}
  echo"</table> </center>    
</div> 
";}
      ?></div>


<div class="main" style="padding-bottom: 20px;" id="wsched">
<?php 
echo"
<h3> B2-101 </h3>
<center>
<canvas id='timetable'></canvas>
<script type='text/javascript' src='js/scheda.js'></script>
<script>
    scheda.init('timetable');

    scheda.init('timetable', {
        bgColor : '#FFF',
        sched : {
            color : '#000',
            style : 'bold',
            font : 'Verdana',
            size : 13
        }
    });
</script> <br>
";
  while ($row = mysqli_fetch_array($scheds)) {
    $day = $row['day'];
    if ($day == '1'){
      $day = 'M';
    }elseif ($day == '2'){
      $day = 'T';
    }elseif ($day == '3'){
      $day = 'W';
    }elseif ($day == '4'){
      $day = 'Th';
    }elseif ($day == '5'){
      $day = 'F';
    }

    $ccode = $row['course_code'];
    $class = $row['class'];
    $croom = $row['room'];

    echo"<script>scheda.drawCourse(";
    echo "'$day', ";
    echo "'";echo date('h:i', strtotime($row['start_time'])); echo"-"; echo date('h:i', strtotime($row['end_time'])); echo"', ";
    echo "'$ccode', ";
    echo "'$class', ";
    echo "'$croom'";
    echo ");</script>";
    //echo "scheda.drawCourse('$day',"; echo"'";echo date('h:i a ', strtotime($row['start_time'])); echo"-"; echo date('h:i a ', strtotime($row['end_time'])); echo"'"; echo" '$ccode', '$class', '$croom');";
  } ?>
</center>
</div>

<div id="rm" style="display: none;">
  <?php
  while($row = mysqli_fetch_array($get_rms)){ 
    $room = $row['room'];
    $get_sched = mysqli_query($connect, "(SELECT * FROM sched WHERE room = '".$room."' ORDER BY day asc) ORDER BY  start_time asc ") or die("Error: ".mysqli_error());
    echo"
<div class='wrk'>
  <h3> $room </h3><center>
  <table>
  <thead>
    <tr>
      <th scope='col'>Course Code</th>
      <th scope='col'>Descriptive Title</th>
      <th scope='col'>Course Yr. & Block</th>
      <th scope='col'>Time</th>
      <th scope='col'>Day</th>
      <th scope='col'>Professor</th>
    </tr>
  </thead>";
    while($row = mysqli_fetch_array($get_sched)){
      $day = $row['day'];
    if ($day == '1'){
      $day = 'M';
    }elseif ($day == '2'){
      $day = 'T';
    }elseif ($day == '3'){
      $day = 'W';
    }elseif ($day == '4'){
      $day = 'Th';
    }elseif ($day == '5'){
      $day = 'F';
    } 

    $subj = $row['course_code'];
    $get_s = mysqli_query($connect, "SELECT * FROM subject WHERE course_code = '".$subj."' ORDER BY course_code asc") or die("Error: ".mysqli_error());
    $get = mysqli_fetch_array($get_s);
      echo"
      <tbody><tr>
      <td>$subj</td>
      <td>".$get['desc_title']."</td>
      <td>".$row['class']."</td>
      <td>"; echo  date('h:i a ', strtotime($row['start_time'])); echo" - "; echo date('h:i a ', strtotime($row['end_time'])); echo"</td>
      <td>".$day."</td>
      <td>".$row['prof_name']."</td>
      </tbody></tr>
    ";}
  echo"</table> </center>    
</div> 
";}
?></div>

<script>
function popWLoad() {
    var a = document.getElementById("work-load");
    var b = document.getElementById("wsched");
    var c = document.getElementById("rm");
    if (a.style.display === "none") {
        a.style.display = "block";
        b.style.display = "none";
        c.style.display = "none";

    } else {
        a.style.display = "none";
    }
}
function popWeekly() {
    var a = document.getElementById("work-load");
    var b = document.getElementById("wsched");
    var c = document.getElementById("rm");
    if (b.style.display === "none") {
        b.style.display = "block";
        a.style.display = "none";
        c.style.display = "none";

    } else {
        b.style.display = "none";
    }
}
function popRooms() {
    var a = document.getElementById("work-load");
    var b = document.getElementById("wsched");
    var c = document.getElementById("rm");
    if (c.style.display === "none") {
        c.style.display = "block";
        a.style.display = "none";
        b.style.display = "none";

    } else {
        c.style.display = "none";
    }
}
function popAddSched() {
var a = document.getElementById("adsched");
if (a.style.display === "none") {
      a.style.display = "block";
  } else {
      a.style.display = "none";
    }
}
</script>
</body>
</html> 
