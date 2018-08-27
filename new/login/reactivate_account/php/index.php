<<?php
include($_SERVER['DOCUMENT_ROOT']."/augeo/global/php/connection.php");
session_start();
$id = $_SESSION['deactivated_id'];
 mysqli_query($conn,"UPDATE augeo_user_end.user_account set  augeo_user_end.user_account.state = 1 where augeo_user_end.user_account.account_id = '$id'");
 session_destroy();
    header("location: ../../?activated=1");

 ?>