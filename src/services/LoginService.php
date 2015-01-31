<?php
include_once(dirname(__FILE__)."/../controller/LoginController.php");

$clientController = new LoginController();

if(isset($_POST["logIn"]) || isset($_GET["logIn"])){
    $clientController->logIn();
}else if(isset($_POST["logOut"]) || isset($_GET["logOut"])){
   $clientController->logOut();
}else {
    header('Location: ../index.html');
}
   
 ?>

