<?php
class Gender{
	
	public static $genderArray = Array('ACCIÓN'=>1,'COMEDIA'=>2,'TERROR'=>3,'SUSPENSO'=>4,'DRAMA'=>5,'INFANTIL'=>6);
	
	public $id;
	public $name;
	/**
	 * @return the $id
	 */
	public function getId() {
		return $this->id;
	}

	/**
	 * @return the $name
	 */
	public function getName() {
		return $this->name;
	}

	/**
	 * @param field_type $id
	 */
	public function setId($id) {
		$this->id = $id;
	}

	/**
	 * @param field_type $name
	 */
	public function setName($name) {
		$this->name = $name;
	}
	

}