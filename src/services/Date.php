<?php

class DateService {
	
	
	public static function getDate($dateTimeStamp){
		$days = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sábado");
		$months = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
		
		$year = date('Y',$dateTimeStamp);
		$month = date('n',$dateTimeStamp)-1;
		$day = date('d',$dateTimeStamp);
		$dayOfWeek = date('w',$dateTimeStamp);
		
		return $day." de ".$months[$month]. " del ".$year;
	}
	
	public static function getDateFormat($date){
		$m_names = Array("Enero", "Febrero", "Marzo",
				"Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre",
				"Octubre", "Noviembre", "Diciembre");
	
		$dateR = explode(" ", $date);
		list($yearR, $monthR, $dayR) = explode("-", $dateR[0]);
		$firstNumber = substr($monthR, 0, 1);
		if($firstNumber == 0){
			return $dayR."/".$m_names[substr($monthR, 1, 2)-1]."/".$yearR;
		}else{
			return $dayR."/".$m_names[$monthR -1]."/".$yearR;
		}
	}
	
	public static function getDateTime($dateTimeStamp){
	    
	    $dateTimeStamp = strtotime($dateTimeStamp);
		$days = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sábado");
		$months = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
	
		$year = date('Y',$dateTimeStamp);
		$month = date('n',$dateTimeStamp)-1;
		$day = date('d',$dateTimeStamp);
		
		$hour = date('h',$dateTimeStamp);
		$minut = date('i',$dateTimeStamp);
		$second = date('s',$dateTimeStamp);
		$meridiem = date('a',$dateTimeStamp);
		
		$dayOfWeek = date('w',$dateTimeStamp);
	
		return $day."/".$months[$month]. "/".$year." ".$hour.":".$minut." ".$meridiem;
	}
	
	public static function getNameOfDay($dateTimeStamp){
	    $days = array("Domingo"=>0,"Lunes"=>1,"Martes"=>2,"Miercoles"=>3,"Jueves"=>4,"Viernes"=>5,"Sábado"=>6);
		$dayOfWeek = date('w',$dateTimeStamp);
		return array_search($dayOfWeek,$days);
	}
}

?>