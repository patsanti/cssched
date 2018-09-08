<?php


include("../../global/php/connect.php");
$send_to = $_POST['email'];

// check if entered email is in the database
$result = mysqli_query($conn,"SELECT * FROm account where account.account_usern = '$send_to' ");
    if($row=mysqli_num_rows($result) == 1){
            $found = mysqli_fetch_array($result);
            $account_id = $found['account_id'];
            mysqli_query($conn,"UPDATE account set acc_status = 3 where account.account_id = '$account_id'");
            echo 1;
        }
    else{
            echo 0;
    }

?>


