<?php

function check_login(){
    if(session_status() == PHP_SESSION_NONE) {
        session_start();
        if(isset($_SESSION['acc_type_id']))
            return $_SESSION['acc_type_id'];
        else
            return 0;
    }   
    else{
        if(isset($_SESSION['acc_type_id']))
            return $_SESSION['acc_type_id'];
        else
            return 0;
    }
}
echo check_login();
?>