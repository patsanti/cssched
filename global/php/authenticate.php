<?php
if(session_status() == PHP_SESSION_NONE) {
    session_start();
}

if(isset($_GET['logout'])) {
    $id = $_SESSION['account_id'];
    setcookie("account_id", $id, time() - (86400 * 30), "/");
    unset($_SESSION['account_id']);
    session_destroy();
    header("Location: http://localhost/cssched/");
    exit();
}


?>