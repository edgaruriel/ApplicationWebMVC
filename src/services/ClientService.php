<?php
include_once("../controller/ClientController.php");
$controller = new ClientController();

if(isset($_POST["newBtn"])){
    echo $controller->add();
}else if(isset($_POST["editBtn"])){
    echo $controller->edit();
}else if(isset($_GET["action"]) && $_GET["action"]=="delete"){
    echo $controller->delete($_GET["idClient"]);
}