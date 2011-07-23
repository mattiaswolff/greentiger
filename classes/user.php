<?php

class User {
    //Properties
    private $email;
    private $name;
    private $definitions;
  
    //Constructor
    public function __construct(){
        $this->email = 'test';  
        $this->name = 'test';  
        $this->definitions = 'test';    
    }
    
    //Destructor
    public function __destruct(){
        $m = new Mongo();
        $db = $m->projectcopperfield;
        $array = array("email" => $this->email, "name" => $this->name);
        echo var_dump($array);
        $db->users->insert($array); 
    }
    
    //Accessors
    public function getEmail() {
        return $this->email;
    }
    public function setEmail($email) {
        $this->email = $email;
    }
    public function getName() {
        return $this->name;
    }
    public function setName($name) {
        $this->name = $name;
    }
    public function getDefinitions() {
        return $this->definitions;
    }
    public function setDefinitions($definitions) {
        $this->definitions = $definitions;
    }
}
?>