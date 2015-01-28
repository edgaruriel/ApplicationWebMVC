<?php
include_once("../controller/ClientController.php");

if(isset($_POST["newBtn"])){
    echo add();
}else if(isset($_POST["editBtn"])){
    echo edit();
}else if(isset($_GET["action"]) && $_GET["action"]=="delete"){
    echo delete($_GET["idClient"]);
}