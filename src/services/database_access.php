<?php
function abrirConexion(){
  //Abre una conexi�n con la base de datos
  $pconector = mysqli_connect('localhost','root','') or die(mysqli_connect_error());
  return $pconector;
}
//--------------------------------
function seleccionarBaseDatos($pconector){
 //Permite seleccionar una base de datos
 mysqli_select_db($pconector, 'mvc') or die(mysqli_connect_error($pconector));
}
//--------------------------------
function cerrarConexion($pconector){
 //Cierra una conexi�n con la base de datos
 mysqli_close($pconector);
}

//--------------------------------
function existeRegistro($pconector, $cquery){

 //Verifica la existencia de la informaci�n solicitada (a trav�s de una sentencia SQL) en la base de datos
 $lexiste_referencia = true;
 $lresult = mysqli_query($pconector, $cquery);
 
 if (!$lresult){
   $cerror = "No fue posible recuperar la información de la base de datos.<br>";
   $cerror .= "SQL: $cquery <br>";
   $cerror .= "Descripción: ".mysqli_connect_error($pconector);
   die($cerror);   
 }
 else{
   //Verifica que no exista un registro igual al que se va a insertar
   if ( mysqli_num_rows($lresult) == 0 ){
     $lexiste_referencia = false;   
   }   
 }
 
 mysqli_free_result($lresult);
    
 return $lexiste_referencia;
 
}
//--------------------------------
function insertarDatos($pconector, $cquery){

 //Inserta un registro en la base de datos
 $lentrada_creada = false;
 $lresult = mysqli_query($pconector, $cquery);
 if (!$lresult){   
   $cerror = "Ocurrió un error al acceder a la base de datos.<br>";
   $cerror .= "SQL: $cquery <br>";
   $cerror .= "Descripción: ".mysqli_connect_error($pconector);
   die($cerror);
 }
 else{
   if (mysqli_affected_rows($pconector) > 0){
     $lentrada_creada = true;
   }
 }
     
 return $lentrada_creada;
}
//--------------------------------
function extraerRegistro($pconector, $cquery){

//Lee informaci�n solicitada (a trav�s de una sentencia SQL) de la base de datos y la almacena
//en un arreglo que devuelve como par�metro de salida
//Advertencia: utilizar esta funci�n �nicamente cuando se espere un s�lo registro como resultado

$aregistro = array();
$lresult = mysqli_query($pconector, $cquery);
 if (!$lresult){ 
   $cerror = "No fue posible recuperar la información de la base de
datos.<br>";
   $cerror .= "SQL: $cquery <br>";
   $cerror .= "Descripción: ".mysqli_connect_error($pconector);
   die($cerror);    
 }
 else{
   if (mysqli_num_rows($lresult) == 1){          
     $aregistro = mysqli_fetch_array($lresult);    
   }
 } 
 reset($aregistro);
 return $aregistro; 
}

function findAllRecord($pconector, $cquery){
	$arrayRecord = Array();
	$lresult = mysqli_query($pconector, $cquery);
	if (!$lresult) {
        $cerror = "No fue posible recuperar la informacion de la base de datos.<br>";
        $cerror .= "SQL: $cquery <br>";
        $cerror .= "Descripcion: ".mysqli_connect_error($pconexion);
        die($cerror);
    }if (mysqli_num_rows($lresult) > 0){
            while ($adatos = mysqli_fetch_array($lresult, MYSQLI_BOTH)){
            	array_push($arrayRecord, $adatos);
            }
    }
    mysqli_free_result($lresult);
    cerrarConexion($pconector);
    
	return $arrayRecord;
}
//--------------------------------
function editarDatos($pconector, $cquery){

 //Modifica, edita o actualiza uno o m�s registros de la base de datos
  $ledicion_completada = false; 
 $lresult = mysqli_query($pconector, $cquery);
 if (!$lresult){
   $cerror = "Ocurrió un error al acceder a la base de datos.<br>";
   $cerror .= "SQL: $cquery <br>";
   $cerror .= "Descripción: ". mysqli_connect_error($pconector);
   die($cerror);
 }
 else 
   $ledicion_completada = true; 
     
 return $ledicion_completada;

}
//--------------------------------

function eliminarDatos($pconector, $cquery){

$leliminacion_completada=false;
	$lresult = mysqli_query($pconector, $cquery);
 if (!$lresult){
   $cerror = "Ocurrió un error al acceder a la base de datos.<br>";
   $cerror .= "SQL: $cquery <br>";
   $cerror .= "Descripción: ". mysqli_connect_error($pconector);
   die($cerror);
 }
 else{
	 $leliminacion_completada = true;
	 }
	 return $leliminacion_completada;
}

?>