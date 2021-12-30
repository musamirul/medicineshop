<?php
session_start();
$_SESSION['id'] = "";
$_SESSION['username'] = "";
$_SESSION['role'] = "";
$_SESSION['cust_id'] = "";
session_unset();
//session_destroy();
$_SESSION['errmsg']="You have successfully logout";
header("location:login.php");

?>