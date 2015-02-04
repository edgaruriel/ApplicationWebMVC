<?php
include_once (dirname ( __FILE__ ) . "/../services/database_access.php");
include_once (dirname ( __FILE__ ) . "/../services/SessionService.php");
include_once (dirname ( __FILE__ ) . "/../model/User.php");
include_once (dirname ( __FILE__ ) . "/../model/TypeUser.php");

class EmployeeController {
	function getAll() {
		$array = array ();
		// Conexion con el servidor de base de datos
		$pconexion = abrirConexion ();
		// Seleccion de la base de datos
		seleccionarBaseDatos ( $pconexion );
		// Construccion de la sentencia SQL
		$cquery = "SELECT user.id AS id_user, user.username AS username, ";
		$cquery .= "user.name AS name, ";
		$cquery .= "user.last_name AS last_name, ";
		$cquery .= "user.email AS email, ";
		$cquery .= "user.type_user_id AS type ";
		$cquery .= "FROM user ";
		$cquery .= "WHERE user.status = 1";
		// Se ejecuta la sentencia SQL
		$lresult = mysqli_query ( $pconexion, $cquery );
		
		if (! $lresult) {
			$cerror = "No fue posible recuperar la informacion de la base de datos.<br>";
			$cerror .= "SQL: $cquery <br>";
			$cerror .= "Descripcion: " . mysqli_connect_error ( $pconexion );
			die ( $cerror );
		} else {
			// Verifica que la consulta haya devuelto por lo menos un registro
			if (mysqli_num_rows ( $lresult ) > 0) {
				while ( $adatos = mysqli_fetch_array ( $lresult, MYSQLI_BOTH ) ) {
					$user = new User ();
					$user->setId ( $adatos ["id_user"] );
					$user->setUsername ( $adatos ["username"] );
					$user->setName ( $adatos ["name"] );
					$user->setLastName ( $adatos ["last_name"] );
					$user->setEmail ( $adatos ["email"] );
					$user->setTypeUser ( $adatos ["type"] );
					array_push ( $array, $user );
				}
			}
		}
		mysqli_free_result ( $lresult );
		
		cerrarConexion ( $pconexion );
		return $array;
	}
	function findOne($id) {
		$user = new User ();
		// Conexion con el servidor de base de datos
		$pconexion = abrirConexion ();
		// Seleccion de la base de datos
		seleccionarBaseDatos ( $pconexion );
		// Construccion de la sentencia SQL
		$cquery = "SELECT user.id AS id_user, user.username AS username, ";
		$cquery .= "user.name AS name, ";
		$cquery .= "user.last_name AS last_name, ";
		$cquery .= "user.email AS email, ";
		$cquery .= "user.type_user_id AS type ";
		$cquery .= "FROM user ";
		$cquery .= "WHERE user.id = " . $id;
		// Se ejecuta la sentencia SQL
		$lresult = mysqli_query ( $pconexion, $cquery );
		
		if (! $lresult) {
			$cerror = "No fue posible recuperar la informacion de la base de datos.<br>";
			$cerror .= "SQL: $cquery <br>";
			$cerror .= "Descripcion: " . mysqli_connect_error ( $pconexion );
			die ( $cerror );
		} else {
			// Verifica que la consulta haya devuelto por lo menos un registro
			if (mysqli_num_rows ( $lresult ) > 0) {
				while ( $adatos = mysqli_fetch_array ( $lresult, MYSQLI_BOTH ) ) {
					
					$user->setId ( $adatos ["id_user"] );
					$user->setUsername ( $adatos ["username"] );
					$user->setName ( $adatos ["name"] );
					$user->setLastName ( $adatos ["last_name"] );
					$user->setEmail ( $adatos ["email"] );
					$user->setTypeUser ( $adatos ["type"] );
				}
			}
		}
		mysqli_free_result ( $lresult );
		
		cerrarConexion ( $pconexion );
		return $user;
	}
	
	function add() {
		$username = $_POST ["username"];
		$password = sha1($_POST ["password"]);
		$type = $_POST ["tipo"];
		$name = $_POST ["name"];
		$last_name = $_POST ["last_name"];
		$email = $_POST ["email"];
		
		$pconexion = abrirConexion ();
		seleccionarBaseDatos ( $pconexion );
		$cquery = "SELECT email FROM user";
		$cquery .= " WHERE email = '$email'";
		
		if (! existeRegistro ( $pconexion, $cquery )) {
			$cquery = "INSERT INTO user";
			$cquery .= " (username, password, type_user_id, email, name, last_name, status)";
			$cquery .= " VALUES ('$username', '$password', '$type', '$email', '$name', '$last_name', 1)";
			if (insertarDatos ( $pconexion, $cquery )) {
				header ( 'Location: index.php' );
			} else {
				echo "<h1>No fue posible registrar el empleado en el catálogo</h1>";
			}
		} else {
			echo "<h1>Ya existe un empleado con el correo: $email</h1>";
		}
		cerrarConexion ( $pconexion );
	}
	
	function edit() {
		$username = $_POST ["username"];
		$password = $_POST ["password"];
		$name = $_POST ["name"];
		$last_name = $_POST ["last_name"];
		$email = $_POST ["email"];
		$type = $_POST ["tipo"];
		$id = $_POST ["idEmployee"];
		
		$pconexion = abrirConexion ();
		seleccionarBaseDatos ( $pconexion );
		
		$cquery = "UPDATE user";
		$cquery .= " SET username = '$username', password = '$password' , name = '$name', last_name='$last_name', email='$email', type_user_id='$type'";
		$cquery .= " WHERE user.id = " . $id;
		if (editarDatos ( $pconexion, $cquery )) {
			header ( 'Location: index.php' );
		} else {
			echo "<h1>No fue posible actualizar el empleado en el catálogo</h1>";
		}
		cerrarConexion ( $pconexion );
		// return $cmensaje;
	}
	
	function delete($id) {
		$pconexion = abrirConexion ();
		seleccionarBaseDatos ( $pconexion );
		
		$cquery = "UPDATE user";
		$cquery .= " SET status = 0";
		$cquery .= " WHERE user.id = " . $id;
		if (editarDatos ( $pconexion, $cquery )) {
			header ( 'Location: ../view/Admin/employee/index.php' );
		} else {
			echo "<h1>No fue posible eliminar el empleado del catálogo</h1>";
		}
		
		cerrarConexion ( $pconexion );
	}
	
	function getTypes()
	{
		$array = array();
		//Conexion con el servidor de base de datos
		$pconexion = abrirConexion();
		//Seleccion de la base de datos
		seleccionarBaseDatos($pconexion);
		//Construccion de la sentencia SQL
		$cquery = "SELECT type_user.id AS id_type, type_user.name AS name ";
		$cquery .= "FROM type_user ";
		//Se ejecuta la sentencia SQL
		$lresult = mysqli_query($pconexion, $cquery);
	
		if (!$lresult) {
			$cerror = "No fue posible recuperar la informacion de la base de datos.<br>";
			$cerror .= "SQL: $cquery <br>";
			$cerror .= "Descripcion: " . mysqli_connect_error($pconexion);
			die($cerror);
		} else {
			//Verifica que la consulta haya devuelto por lo menos un registro
			if (mysqli_num_rows($lresult) > 0) {
				while ($adatos = mysqli_fetch_array($lresult, MYSQLI_BOTH)) {
					$type = new TypeUser();
					$type->setId($adatos["id_type"]);
					$type->setName($adatos["name"]);
					array_push($array, $type);
				}
			}
		}
		mysqli_free_result($lresult);
	
		cerrarConexion($pconexion);
		return $array;
	}
	
}