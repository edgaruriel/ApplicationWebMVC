<?php
include_once(dirname(__FILE__)."/database_access.php");

function validateSession(){
    session_start();
if(!isset($_SESSION["cidusuario"])){
	//$cdestino = "http://localhost/ApplicationWebMVC/src/view/login.php";
	header("Location:../index.html");
	//exit();	
	} 
}

function initSession($cidlogin){

session_start();
$_SESSION["cidusuario"]= $cidlogin;
}

function closeSession(){
	session_start();
	session_destroy();
}

function getInfoSession(){
	$pconexion = abrirConexion();
   	seleccionarBaseDatos($pconexion);
	$idusuario = $_SESSION["cidusuario"];
	
	$dquery="SELECT user.type_user_id, user.username, user.id, user.name, user.last_name FROM user WHERE user.id = '$idusuario'";
	$rolArray=extraerRegistro($pconexion,$dquery);
	
	return $rolArray;		
	
	}
?>
