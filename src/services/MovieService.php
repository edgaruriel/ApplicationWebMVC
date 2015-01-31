<?php
include_once(dirname(__FILE__)."/../controller/MovieController.php");

$movieController = new MovieController();

if(isset($_POST["newBtn"])){
    $movieController->add();
}else if(isset($_POST["editBtn"])){
    $movieController->edit();
}else if(isset($_GET["action"]) && $_GET["action"]=="delete"){
	$movieController->deleteOneById($_GET["idMovie"]);
    //echo delete($_GET["idClient"]);
}