<?php
include_once(dirname(__FILE__)."/../services/database_access.php");
include_once(dirname(__FILE__)."/../model/TypeUser.php");
include_once(dirname(__FILE__)."/../model/User.php");
include_once(dirname(__FILE__)."/../services/SessionService.php");


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
    		$user = new User();
    		$user->setId($resultArray["id"]);
    		$user->setEmail($resultArray["email"]);
    		$user->setLastName($resultArray["last_name"]);
    		$user->setName($resultArray["name"]);
    		$user->setPassword($resultArray["password"]);
    		$user->setStatus($resultArray["status"]);
    		
    		$typeUser = new TypeUser();
    		$typeUser->setId($resultArray["idTypeUser"]);
    		$typeUser->setName($resultArray["nameTypeUser"]);
    		
    		$user->setTypeUser($typeUser);
    		$user->setUsername($resultArray["username"]);
    		
			initSession($user);
			
			if($user->getTypeUser()->getId() == TypeUser::$typeUserArray["ADMINISTRADOR"]){
			header("Location:../view/Admin/index.html");
			}else if($user->getTypeUser()->getId() == TypeUser::$typeUserArray["EMPLEADO"]){
			header("Location:../view/Employee/index.html");
			}else{
			header("Location:../index.html");
			}
		}
		else{
			header("Location:../index.html");
		}
	}
	
	public function logOut(){
		closeSession();
		header("Location:../index.html");
	}

}