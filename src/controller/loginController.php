<?php
include_once("http://localhost/ApplicationWebMVC/src/services/database_access.php");
include_once("http://localhost/ApplicationWebMVC/src/model/TypeUser.php");
include_once("http://localhost/ApplicationWebMVC/src/model/User.php");

class LoginController{

	public function logIn(){
		$user = $_POST["User"];
    	$password = $_POST["Password"];
    	
    	$user = new User();
    	
    	
	}
	
	public function logOut(){
	
	}
	
	private function startSession(){
	
	}

}