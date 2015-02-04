<?php
include_once(dirname(__FILE__)."/../controller/EmployeeController.php");
$controller = new EmployeeController();

if(isset($_POST["newBtn"])){
	$controller->add();
}else if(isset($_POST["editBtn"])){
	$controller->edit();
}else if(isset($_GET["action"]) && $_GET["action"]=="delete"){
	$controller->delete($_GET["idEmployee"]);
}