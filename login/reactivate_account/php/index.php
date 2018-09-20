<<?php
include "../../../global/php/connect.php";
session_start();
$id = $_SESSION['deactivated_id'];
 mysqli_query($conn,"UPDATE account set acc_status = 1 where account_id = '$id'");
 session_destroy();
    header("location: ../../../?activated=1");

 ?>