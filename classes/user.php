<?php

class User {
    //Properties
    private $email;
    private $name;
    private $definitions;
  
    //Constructor
    public function __construct(){
        $this->email = '';  
        $this->name = '';  
        $this->definitions = array();    
    }
    
    //Destructor
    public function __destruct(){
        $m = new Mongo();
        $db = $m->projectcopperfield;
        $db->users->insert((array)$this); 
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