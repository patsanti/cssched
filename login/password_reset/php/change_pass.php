<?php
include($_SERVER['DOCUMENT_ROOT']."/augeo/global/php/connection.php");
include($_SERVER['DOCUMENT_ROOT']."/augeo/global/php/encrypt.php");

// change password
if(isset($_POST['n_pass'])  && isset($_POST['hidden']) ){
   $password = encrypt(encode($_POST['n_pass']));
    $id = $_POST['hidden'];
if(mysqli_query($conn,"UPDATE augeo_user_end.user_account set  augeo_user_end.user_account.password = '$password' where augeo_user_end.user_account.account_id = '$id'")){
    echo "sucess";
    }
    else{
        echo "failed";
    }
}


// check user and validate
elseif(isset($_POST['hidden'])) {
$id = $_POST['hidden'];

$result = mysqli_query($conn,"SELECT augeo_user_end.user_account.username,augeo_user_end.user_account.account_id FrOm augeo_user_end.user_account where augeo_user_end.user_account.account_id = '$id' ");
    if($row=mysqli_num_rows($result) == 1){
          $found = mysqli_fetch_array($result);
           $username =  $found['username'];
           echo "Hello ".$username.", Enter your New Password to Recover your account";
        }
    else{
           echo "failed";
}


}


?>