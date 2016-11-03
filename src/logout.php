<?php
session_start();
$_SESSION["login_user"] = null;
header("Location: index.php");
exit;
?>
