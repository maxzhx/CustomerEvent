<?php
session_start();
if($_POST['username'] == 'admin' && $_POST['password'] == 'admin'){
    // echo 'success';
    $_SESSION["login_user"] = $_POST['username'];
    header("Location: index.php");
    exit;
} else {
    header("Location: index.php");
    exit;
}
?>
