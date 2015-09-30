<?php
class User{

	private $id = null;
	private $username;
	private $password;
	private $typeUser;
	private $email;
	private $name;
	private $lastName;
	private $status;
	
	public function getId()
    {
    	return $this->id;
    }
    
    public function setStatus($status){
    	$this->status = $status;
    }
    
    public function getStatus(){
    	return $this->status;
    }
    
	public function setLastName($lastName){
    	$this->lastName = $lastName;
    }
    
    public function getLastName(){
    	return $this->lastName;
    }
    
	public function setEmail($email){
    	$this->email = $email;
    }
    
    public function getEmail(){
    	return $this->email;
    }
    
    /**
     * 
     * Es el objeto typeUSer
     * @param unknown_type $typeUser
     */
	public function setTypeUser($typeUser){
    	$this->typeUser = $typeUser;
    }
    
    public function getTypeUser(){
    	return $this->typeUser;
    }
    
	public function setPassword($password){
    	$this->password = $password;
    }
    
    public function getPassword(){
    	return $this->password;
    }
    
    public function getUsername(){
    	return $this->username;
    }
    
	public function setUsername($userName){
    	$this->username = $userName;
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
