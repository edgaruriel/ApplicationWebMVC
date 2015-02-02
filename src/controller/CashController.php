<?php
include_once(dirname(__FILE__)."/MovieController.php");

class CashController {

    function getMoviesRented()
    {
        $arrayIdMovies = array();
        //Conexion con el servidor de base de datos
        $pconexion = abrirConexion();
        //Seleccion de la base de datos
        seleccionarBaseDatos($pconexion);
        //Construccion de la sentencia SQL
        $date = Date("Y-m-d");
        $cquery = "SELECT client_has_movie.movie_id AS idMovie";
        $cquery .= " FROM client_has_movie";
        $cquery .= " WHERE DATE_FORMAT(date, '%Y-%m-%d') = '".$date."'";
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
                    if(!in_array($adatos["idMovie"],$arrayIdMovies)){
                        array_push($arrayIdMovies,$adatos["idMovie"]);
                    }
                }
            }
        }
        mysqli_free_result($lresult);

        cerrarConexion($pconexion);
        $array = $this->getMoviesAndRentedUnits($arrayIdMovies);
        return $array;
    }

    function getMoviesAndRentedUnits($idsMovies){

        $controller = new MovieController();
        $array = array();
        //Conexion con el servidor de base de datos
        $pconexion = abrirConexion();
        //Seleccion de la base de datos
        seleccionarBaseDatos($pconexion);
        //Construccion de la sentencia SQL

        foreach($idsMovies as $idMovie) {
            $date = Date("Y-m-d");
            $cquery = "SELECT SUM(client_has_movie.rented_units) AS total FROM client_has_movie WHERE movie_id=".$idMovie;
            $cquery .= " AND DATE_FORMAT(date, '%Y-%m-%d') = '".$date."'";
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
                            array_push($array,array("units"=>$adatos["total"],"movie"=>$controller->findOne($idMovie)));
                    }
                }
            }
            mysqli_free_result($lresult);
        }

        cerrarConexion($pconexion);
        return $array;
    }
} 