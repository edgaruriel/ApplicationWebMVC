<?php
include_once(dirname(__FILE__)."/../controller/RentedMovieController.php");

$rentedMovieController = new RentedMovieControoler();
if(isset($_POST["newBtn"])){
   echo $rentedMovieController->add();
}else if(isset($_POST["editBtn"])){
    $rentedMovieController->edit();
}else if(isset($_POST["action"]) && $_POST["action"]=="returnMovie"){
	
	$rentedMovieController->returnMovie($_POST["idRented"]);
    //echo delete($_GET["idClient"]);
}