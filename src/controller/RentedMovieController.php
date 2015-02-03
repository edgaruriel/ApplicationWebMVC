<?php
include_once(dirname(__FILE__)."/../services/database_access.php");
include_once(dirname(__FILE__)."/../controller/MovieController.php");
include_once(dirname(__FILE__)."/../controller/ClientController.php");
include_once(dirname(__FILE__)."/../services/SessionService.php");
include_once(dirname(__FILE__)."/../model/Movie.php");
include_once(dirname(__FILE__)."/../model/Gender.php");
include_once(dirname(__FILE__)."/../model/Rented.php");

class RentedMovieControoler{

	public function add(){
		$rentedArray = Array();
		$movieController = new MovieController();
		$movies = json_decode($_POST["movies"],true);
		foreach ($movies as $movieAux){
			$rented = new Rented();
			$movie = $movieController->findOne($movieAux["id"]);
			$rented->setMovie($movie);
			$rented->setAmount($movieAux["numberMovie"]);
			array_push($rentedArray, $rented);
		}
		
		$idClient = $_POST["idClient"];
		$devolutionDate = $_POST["date"];
		$today = date('Y-m-d');
		
		foreach ($rentedArray as $rented){
			$movie = $rented->getMovie();
			$rentedUnits = $rented->getAmount();
			$total = $movie->getPrice() * $rentedUnits;
			$pconexion = abrirConexion();
                      seleccionarBaseDatos($pconexion);
                      $cquery = "INSERT INTO client_has_movie";
                      $cquery .= " (client_id, movie_id, rented_units, total, date, devolution_date, is_rented)";
                      $cquery .= " VALUES (".$idClient.", ".$movie->getId().",".$rentedUnits.",".$total.",'".$today."','".$devolutionDate."' ,".Rented::$statusArray["RENTED"].")";
			$movieController->addRentedUnit($movie->getId(), $rentedUnits);
            insertarDatos($pconexion, $cquery);          
            cerrarConexion($pconexion);
		}
		return "1";
	}
	
	public function getAll(){
	$movieController = new MovieController();
	$clientController = new ClientController();
	$array = array();
    //Conexion con el servidor de base de datos
    $pconexion = abrirConexion();
    //Seleccion de la base de datos
    seleccionarBaseDatos($pconexion);
    //Construccion de la sentencia SQL
    $cquery = "SELECT * FROM client_has_movie";
    //Se ejecuta la sentencia SQL
    $lresult = findAllRecord($pconexion, $cquery);
    if (count($lresult)>0) {
    	foreach ($lresult as $record){
    		$rented = new Rented();
    		$client = $clientController->findOne($record["client_id"]);
    		$rented->setClient($client);
    		$movie = $movieController->findOne($record["movie_id"]);
    		$rented->setMovie($movie);
    		$rented->setId($record["id"]);
    		$rented->setAmount($record["rented_units"]);
    		$rented->setDateDevolution($record["devolution_date"]);
    		$rented->setDateRented($record["date"]);
    		$rented->setTotal($record["total"]);
    		$rented->setIsRented($record["is_rented"]);
    		array_push($array, $rented);
    	}
    }
    //cerrarConexion($pconexion);
    return $array;
	}
	
	public function finOneBy($id){
	$movieController = new MovieController();
	$clientController = new ClientController();
	$pconexion = abrirConexion();
    //Seleccion de la base de datos
    seleccionarBaseDatos($pconexion);
    //Construccion de la sentencia SQL
    $cquery = "SELECT * FROM client_has_movie WHERE id =".$id;
    $resultArray = extraerRegistro($pconexion, $cquery);
    $result = existeRegistro($pconexion,$cquery);
    if($result){
    		$rented = new Rented();
    		$client = $clientController->findOne($resultArray["client_id"]);
    		$rented->setClient($client);
    		$movie = $movieController->findOne($resultArray["movie_id"]);
    		$rented->setMovie($movie);
    		$rented->setId($resultArray["id"]);
    		$rented->setAmount($resultArray["rented_units"]);
    		$rented->setDateDevolution($resultArray["devolution_date"]);
    		$rented->setDateRented($resultArray["date"]);
    		$rented->setTotal($resultArray["total"]);
    		$rented->setIsRented($resultArray["is_rented"]);
    		return $rented;
    }else{
    	return null;
    }
    
	}
	
	public function returnMovie($idRented){
		$rented = $this->finOneBy($idRented);
		
		 $pconexion = abrirConexion();
    	seleccionarBaseDatos($pconexion);

        $cquery = "UPDATE client_has_movie";
        $cquery .= " SET is_rented = ".Rented::$statusArray["NO_RENTED"];
        $cquery .= " WHERE client_has_movie.id = ".$idRented;
        if (editarDatos($pconexion, $cquery) ){
        	
        	$newRentedUnit = $rented->getMovie()->getRentedUnits() - $rented->getAmount();
        	if($newRentedUnit >= 0){
        	$cquery2 = "UPDATE movie";
        	$cquery2 .= " SET rented_units = ".$newRentedUnit;
        	$cquery2 .= " WHERE movie.id = ".$rented->getMovie()->getId();
        	editarDatos($pconexion, $cquery2);
        	}
        }
        //cerrarConexion($pconexion);
		header('Location: ../view/Employee/rentedMovie/index.php');
	}

}