<?php
include_once("../services/database_access.php");
class ClientController{

    public function _init(){
        if(isset($_POST["newBtn"])){
            add();
        }
    }

    public function getAll(){

    }

    public function add(){
        echo "add";
    }

    public function update(){

    }

    public function delete(){

    }

}