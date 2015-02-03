<?php
include_once(dirname(__FILE__)."/../services/database_access.php");
include_once(dirname(__FILE__)."/../services/SessionService.php");
include_once(dirname(__FILE__)."/../model/Movie.php");
include_once(dirname(__FILE__)."/../model/Gender.php");


class MovieController{
	
	public function add(){
		
		$title = $_POST["title"];
    	$format = $_POST["format"];
    	$totalUnits = $_POST["totalUnits"];
    	$year = $_POST["year"];
    	$price = $_POST["price"];
    	$code = $_POST["code"];
    	$Idgender = $_POST["gender"];
    	$rentedUnits = 0;		
		
    	$filename = $_FILES['file_img']['name'];
    	
    	$movie = new Movie();
    	$gender = new Gender();
    	$gender->setId($Idgender);
    	
		$movie->setGender($gender);
		$movie->setTitle($title);
		$movie->setCode($code);
		$movie->setFormat($format);
		$movie->setPhoto($filename);
		$movie->setPrice($price);
		$movie->setTotalUnits($totalUnits);
		$movie->setYear($year);
		$movie->setStatus(Movie::$statusArray["activo"]);
		$movie->setRentedUnits($rentedUnits);
		
		 $apermitidos = array("image/jpg","image/jpeg","image/gif","image/png");
		 if($_FILES["file_img"]["error"]>0){
		 	echo "<h1>Tenemos un problema al subir la foto".$_FILES["file_img"]["error"]."</h1>";	
		 }else{
		  if(in_array($_FILES['file_img']['type'],$apermitidos)){
		  	$info = pathinfo($_FILES['file_img']['name']);
               $temp = $_FILES['file_img']['tmp_name'];
               $dirImg = "img/" . $_FILES['file_img']['name'];
              if(file_exists(dirname(__FILE__)."/../../public/img/".basename($_FILES['file_img']['name']))){
                  echo "<h1>Error: El archivo ya existe!</h1>";
              }else {
                  $result = move_uploaded_file($temp, dirname(__FILE__)."/../../public/img/".basename($_FILES['file_img']['name']));
                  if($result){
                      //se guardo la imagen
                      $pconexion = abrirConexion();
                      seleccionarBaseDatos($pconexion);
                      $cquery = "INSERT INTO movie";
                      $cquery .= " (title, format, total_units, year, price, code, photo, gender_id, status, rented_units)";
                      $cquery .= " VALUES ('".$movie->getTitle()."', '".$movie->getFormat()."', ".$movie->getTotalUnits().", ".$movie->getYear().", ".$movie->getPrice().", '".$movie->getCode()."', '".$movie->getPhoto()."', ".$movie->getGender()->getId().", ".$movie->getStatus().", ".$movie->getRentedUnits().")";
                      if (insertarDatos($pconexion, $cquery) ){
                          header('Location: index.php');
                      }else{
                          echo "<h1>Error: No se pudo agregar a la BD</h1>";
                      }

                  }else{
                      echo "<h1>Error: Al mover la imagen de carpeta</h1>";
                  }
              }
		  }else{
            	echo "<h1>Error: Las fotos permitidas son .jpg,.jpeg,.gif,.png</h1>";
            }
		 }
		//print_r($filesize);
		//exit();
         
	}
	
	public function getAllGender(){
		$array = array();
    //Conexion con el servidor de base de datos
    $pconexion = abrirConexion();
    //Seleccion de la base de datos
    seleccionarBaseDatos($pconexion);
    //Construccion de la sentencia SQL
    $cquery = "SELECT * FROM gender";
    $lresult = findAllRecord($pconexion, $cquery);
    if (count($lresult)>0) {
    	foreach ($lresult as $record){
    		$gender = new Gender();
    		$gender->setId($record["id"]);
    		$gender->setName($record["name"]);
    		array_push($array, $gender);
    	}
    }
    return $array;
	}
	
	public function getAll(){
	$array = array();
    //Conexion con el servidor de base de datos
    $pconexion = abrirConexion();
    //Seleccion de la base de datos
    seleccionarBaseDatos($pconexion);
    //Construccion de la sentencia SQL
    $cquery = "SELECT movie.*, gender.id as idGender, gender.name as nameGender ";
    $cquery .= "FROM movie ";
    $cquery .= " INNER JOIN gender ON movie.gender_id = gender.id ";
     $cquery .= "WHERE movie.status = ".Movie::$statusArray["activo"];
    //Se ejecuta la sentencia SQL
    $lresult = findAllRecord($pconexion, $cquery);
    if (count($lresult)>0) {
    	foreach ($lresult as $record){
    		$movie = new Movie;
    		$gender = new Gender(); 
    		$gender->setId($record["idGender"]);
    		$gender->setName($record["nameGender"]);
    		
    		$movie->setId($record["id"]);
    		$movie->setCode($record["code"]);
    		$movie->setFormat($record["format"]);
    		$movie->setGender($gender);
    		$movie->setPhoto($record["photo"]);
    		$movie->setPrice($record["price"]);
    		$movie->setRentedUnits($record["rented_units"]);
    		$movie->setStatus($record["status"]);
    		$movie->setTitle($record["title"]);
    		$movie->setTotalUnits($record["total_units"]);
    		$movie->setYear($record["year"]);
    		array_push($array, $movie);
    	}
    }
    return $array;
	}
	
	public function findOne($id){
		//Conexion con el servidor de base de datos
    $pconexion = abrirConexion();
    //Seleccion de la base de datos
    seleccionarBaseDatos($pconexion);
    //Construccion de la sentencia SQL
	$cquery = "SELECT movie.*, gender.id as idGender, gender.name as nameGender ";
    $cquery .= "FROM movie ";
    $cquery .= " INNER JOIN gender ON movie.gender_id = gender.id ";
     $cquery .= "WHERE movie.id = ".$id;
     
     	$resultArray = extraerRegistro($pconexion,$cquery);
    	$result = existeRegistro($pconexion,$cquery);
	     if($result){
	     		$movie = new Movie();
				$gender = new Gender();
				
	     		$gender->setId($resultArray["idGender"]);
	    		$gender->setName($resultArray["nameGender"]);
	    		
	    		$movie->setId($resultArray["id"]);
	    		$movie->setCode($resultArray["code"]);
	    		$movie->setFormat($resultArray["format"]);
	    		$movie->setGender($gender);
	    		$movie->setPhoto($resultArray["photo"]);
	    		$movie->setPrice($resultArray["price"]);
	    		$movie->setRentedUnits($resultArray["rented_units"]);
	    		$movie->setStatus($resultArray["status"]);
	    		$movie->setTitle($resultArray["title"]);
	    		$movie->setTotalUnits($resultArray["total_units"]);
	    		$movie->setYear($resultArray["year"]);
	    		
	    		return $movie;
	     }else{
	     	return null;
	     }
     
	}
	
	public function deleteOneById($id){
	 $pconexion = abrirConexion();
    seleccionarBaseDatos($pconexion);

        $cquery = "UPDATE movie";
        $cquery .= " SET status = ".Movie::$statusArray["borrado"];
        $cquery .= " WHERE movie.id = ".$id;
        if (editarDatos($pconexion, $cquery) ){
            header('Location: ../view/Admin/movie/index.php');
        }
        else{
            echo "<h1>Error: No se pudo borrar la pelicula</h1>";
        }
	}

	public function edit(){
	$title = $_POST["title"];
    	$format = $_POST["format"];
    	$totalUnits = $_POST["totalUnits"];
    	$year = $_POST["year"];
    	$price = $_POST["price"];
    	$code = $_POST["code"];
    	$Idgender = $_POST["gender"];
    	$rentedUnits = $_POST["rentedUnits"];		
		$id = $_POST["idMovie"];	
    	$filename = $_FILES['file_img']['name'];
    	
    	$movie = new Movie();
    	$gender = new Gender();
    	$gender->setId($Idgender);
    	$movie->setId($id);
		$movie->setGender($gender);
		$movie->setTitle($title);
		$movie->setCode($code);
		$movie->setFormat($format);
		$movie->setPhoto($filename);
		$movie->setPrice($price);
		$movie->setTotalUnits($totalUnits);
		$movie->setYear($year);
		$movie->setStatus(Movie::$statusArray["activo"]);
		$movie->setRentedUnits($rentedUnits);
		
		 $apermitidos = array("image/jpg","image/jpeg","image/gif","image/png");
		 if($_FILES["file_img"]["error"]>0){
		 	echo "<h1>Tenemos un problema al subir la foto".$_FILES["file_img"]["error"]."</h1>";	
		 }else{
		  if(in_array($_FILES['file_img']['type'],$apermitidos)){
		  	$info = pathinfo($_FILES['file_img']['name']);
               $temp = $_FILES['file_img']['tmp_name'];
               $dirImg = "img/" . $_FILES['file_img']['name'];
               $result = move_uploaded_file($temp, dirname(__FILE__)."/../../public/img/".basename($_FILES['file_img']['name']));
                if($result){
                	//se guardo la imagen
                	$pconexion = abrirConexion();
    				seleccionarBaseDatos($pconexion);
    				$cquery = "UPDATE movie";
        $cquery .= " SET title ='".$movie->getTitle()."', format = '".$movie->getFormat()."', total_units=".$movie->getTotalUnits().", year=".$movie->getYear().", price=".$movie->getPrice().", code='".$movie->getCode()."', photo='".$movie->getPhoto()."', gender_id=".$movie->getGender()->getId().", status=".$movie->getStatus().", rented_units=".$movie->getRentedUnits();
        $cquery .= " WHERE movie.id = ".$movie->getId();
			         if (editarDatos($pconexion, $cquery) ){
			         	 header('Location: index.php');
			         }else{
			         	echo "<h1>Error: No se pudo agregar a la BD</h1>";
			         }
                	
                }else{
                	echo "<h1>Error: Al mover la imagen de carpeta</h1>";
                }
		  }else{
            	echo "<h1>Error: Las fotos permitidas son .jpg,.jpeg,.gif,.png</h1>";
            }
		 }
	}
	
	public function addRentedUnit($idMovie, $rentedUnit){
		$movieAux = $this->findOne($idMovie);
		$pconexion = abrirConexion();
    	seleccionarBaseDatos($pconexion);

    	$newRentedUnit = $movieAux->getRentedUnits() + $rentedUnit;
		$cquery = "UPDATE movie";
        $cquery .= " SET rented_units =".$newRentedUnit;
        $cquery .= " WHERE movie.id = ".$idMovie;
        editarDatos($pconexion, $cquery);
        cerrarConexion($pconexion);
	}
}