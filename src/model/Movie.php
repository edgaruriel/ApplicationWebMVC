<?php
class Movie{
	public static $statusArray = Array('activo'=>1,'borrado'=>0);
	
	public $id;
	public $title;
	public $format;
	public $totalUnits;
	public $year;
	public $price;
	public $code;
	public $photo;
	public $gender;
	public $status;
	public $rentedUnits;
	/**
	 * @return the $id
	 */
	public function getId() {
		return $this->id;
	}

	/**
	 * @return the $title
	 */
	public function getTitle() {
		return $this->title;
	}

	/**
	 * @return the $format
	 */
	public function getFormat() {
		return $this->format;
	}

	/**
	 * @return the $totalUnits
	 */
	public function getTotalUnits() {
		return $this->totalUnits;
	}

	/**
	 * @return the $year
	 */
	public function getYear() {
		return $this->year;
	}

	/**
	 * @return the $price
	 */
	public function getPrice() {
		return $this->price;
	}

	/**
	 * @return the $code
	 */
	public function getCode() {
		return $this->code;
	}

	/**
	 * @return the $photo
	 */
	public function getPhoto() {
		return $this->photo;
	}

	/**
	 * @return the $gender
	 */
	public function getGender() {
		return $this->gender;
	}

	/**
	 * @return the $status
	 */
	public function getStatus() {
		return $this->status;
	}

	/**
	 * @return the $rentedUnits
	 */
	public function getRentedUnits() {
		return $this->rentedUnits;
	}

	/**
	 * @param field_type $id
	 */
	public function setId($id) {
		$this->id = $id;
	}

	/**
	 * @param field_type $title
	 */
	public function setTitle($title) {
		$this->title = $title;
	}

	/**
	 * @param field_type $format
	 */
	public function setFormat($format) {
		$this->format = $format;
	}

	/**
	 * @param field_type $totalUnits
	 */
	public function setTotalUnits($totalUnits) {
		$this->totalUnits = $totalUnits;
	}

	/**
	 * @param field_type $year
	 */
	public function setYear($year) {
		$this->year = $year;
	}

	/**
	 * @param field_type $price
	 */
	public function setPrice($price) {
		$this->price = $price;
	}

	/**
	 * @param field_type $code
	 */
	public function setCode($code) {
		$this->code = $code;
	}

	/**
	 * @param field_type $photo
	 */
	public function setPhoto($photo) {
		$this->photo = $photo;
	}

	/**
	 * @param field_type $gender
	 */
	public function setGender($gender) {
		$this->gender = $gender;
	}

	/**
	 * @param field_type $status
	 */
	public function setStatus($status) {
		$this->status = $status;
	}

	/**
	 * @param field_type $rentedUnits
	 */
	public function setRentedUnits($rentedUnits) {
		$this->rentedUnits = $rentedUnits;
	}
	
}