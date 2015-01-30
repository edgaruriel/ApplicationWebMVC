<?php
include_once("database_access.php");

function validarSesion(){
    session_start();
if(!isset($_SESSION["cidusuario"])){
	$cdestino = "http://localhost/ApplicationWebMVC/src/view/login.php";
	header("Location:".$cdestino);
	exit();	
	} 
}

function iniciarSesion($cidlogin){

session_start();
$_SESSION["cidusuario"]= $cidlogin;
}

function obtenerInfoSesion(){

	$pconexion = abrirConexion();
   	seleccionarBaseDatos($pconexion);
	$idusuario = $_SESSION["cidusuario"];
	
	$dquery="SELECT user.type_user_id, user.username, user.id, user.name, user.last_name FROM user WHERE user.id = '$idusuario'";
	$rolArray=extraerRegistro($pconexion,$dquery);
	
	return $rolArray;		
	
	}
?>
