<?php
include_once("../controller/LoginController.php");

$clientController = new LoginController();

if(isset($_POST["logIn"])){
    $clientController->logIn();
}else if(isset($_POST["logOut"])){
   $clientController->logOut();
}else {
    header('Location: ../index.html');
}