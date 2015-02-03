<?php
class TypeUser{
	public static $typeUserArray = Array('ADMINISTRADOR'=>1, 'EMPLEADO'=>2);

	public $id;
	public $name;

	public function getId()
    {
    	return $this->id;
    	
    }
    
    public function getName()
    {
    	return $this->name;
    }

    public function setId($id)
    {
    	$this->id = $id;
    }
    
    public function setName($name)
    {
    	$this->name = $name;
    }
    
}