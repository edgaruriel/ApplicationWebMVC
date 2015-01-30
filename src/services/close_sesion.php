<?php    
session_start();

session_destroy();

$cdestino = "http://localhost/ApplicationWebMVC/src/view/login.php";
header("Location:".$cdestino);
exit();
?>