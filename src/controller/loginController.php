<?php

//print_r(dirname('/algo'));
//echo 'eedas';
//exit();
include_once("../services/database_access.php");
include_once("../model/TypeUser.php");
include_once("../model/User.php");
include_once("../services/SessionService.php");


class LoginController{

	public function logIn(){
		$userName = $_POST["User"];
    	$password = $_POST["Password"];
    	
    	
		$pconexion = abrirConexion();
	   	seleccionarBaseDatos($pconexion);
	
	   $cquery = "SELECT `user`.*, type_user.id as idTypeUser, type_user.name as nameTypeUser FROM user";
	   $cquery .= " INNER JOIN type_user ON user.type_user_id = type_user.id";
	   $cquery .= " WHERE user.username = '$userName'";
	   $cquery .= " AND user.password = '$password'";
   
	    $resultArray = extraerRegistro($pconexion,$cquery);
    	$result = existeRegistro($pconexion,$cquery);
    	
    	if( $result == true){
		if(($resultArray['username']==$user) && ($resultArray['password']==$password)){
		}
		else{
			$cdestino = "http://localhost/ApplicationWebMVC/src/view/login.php";
			}
	}
	else{
		header("Location:../index.html ");
		//$cdestino = "http://localhost/ApplicationWebMVC/src/view/login.php";
	}

 	//header("Location:".$cdestino);
    	
	}
	
	public function logOut(){
	
	}
	
	private function startSession(){
	
	}

}