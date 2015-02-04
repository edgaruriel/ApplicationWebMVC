<?php
class Rented{
	public static $statusArray = Array("RENTED"=>1,"NO_RENTED"=>0);

	public $id;
	public $movie;
	public $amount;
	public $client;
	public $total;
	public $dateRented;
	public $dateDevolution;
	public $isRented;
	
	
	public function setIsRented($isRented) {
		$this->isRented = $isRented;
	}
	
	public function getIsRented() {
		return $this->isRented;
	}
	
	/**
	 * @return the $client
	 */
	public function getClient() {
		return $this->client;
	}

	/**
	 * @return the $total
	 */
	public function getTotal() {
		return $this->total;
	}

	/**
	 * @return the $dateRented
	 */
	public function getDateRented() {
		return $this->dateRented;
	}

	/**
	 * @return the $dateDevolution
	 */
	public function getDateDevolution() {
		return $this->dateDevolution;
	}

	/**
	 * @param field_type $client
	 */
	public function setClient($client) {
		$this->client = $client;
	}

	/**
	 * @param field_type $total
	 */
	public function setTotal($total) {
		$this->total = $total;
	}

	/**
	 * @param field_type $dateRented
	 */
	public function setDateRented($dateRented) {
		$this->dateRented = $dateRented;
	}

	/**
	 * @param field_type $dateDevolution
	 */
	public function setDateDevolution($dateDevolution) {
		$this->dateDevolution = $dateDevolution;
	}
	
	
	public function getId() {
		return $this->id;
	} 
	
	public function getMovie(){
		return $this->movie;
	}
	
	public function getAmount(){
		return $this->amount;
	}
	
	public function setId($id) {
		$this->id = $id;
	} 
	
	//Obj
	public function setMovie($movie){
		$this->movie = $movie;
	}
	
	public function setAmount($amount){
		$this->amount = $amount;
	}
}