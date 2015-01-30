<?php
include_once("SessionService.php");
include_once("database_access.php");
     
 $cdestino = "http://localhost/ApplicationWebMVC/src/view/login.php";
 if ( (isset($_POST["btn_ingresar"])) && ($_POST["btn_ingresar"]=="Aceptar") ){
	$pconexion = abrirConexion();
   	seleccionarBaseDatos($pconexion);
	
	$cusuario = $_POST["txt_usuario"];
 	$ccontrasena = $_POST["pass_usuario"];
	
	$cquery = "SELECT user.username, user.password FROM user";
   $cquery .= " WHERE user.username = '$cusuario'";
   $cquery .= " AND user.password = '$ccontrasena'";
   
   
   $usuarioArray = extraerRegistro($pconexion,$cquery);
   
   $result = existeRegistro($pconexion,$cquery);
	if( $result == true){
		echo "Result es valido";
		if(($usuarioArray[0]==$cusuario) && ($usuarioArray[1]==$ccontrasena)){
			echo "Entrando a la validacion de usuario y contraseña";
			$dquery="SELECT user.type_user_id, user.id FROM user WHERE user.username = '$cusuario'";
			$rolArray=extraerRegistro($pconexion,$dquery);
			if($rolArray[0]==1){
	   			//admin
				echo "Entro en admin";
	  		 	iniciarSesion($rolArray[1]);
	   			$cdestino = "http://localhost/ApplicationWebMVC/src/view/index.php";
				
	   		}
			elseif($rolArray[0]==2){
				//usuario registrado
	   			echo "Entro en cliente registrado";
				iniciarSesion($rolArray[1]);
	    
	    		$cdestino = "http://localhost/ApplicationWebMVC/src/view/index.php";
				
				}
		}
		else{
			$cdestino = "http://localhost/ApplicationWebMVC/src/view/login.php";
			}
	}
	else{$cdestino = "http://localhost/ApplicationWebMVC/src/view/login.php";}
 }

 header("Location:".$cdestino);
 exit();
 ?>