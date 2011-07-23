<?php

class User {
    //Properties
    private $email;
    private $name;
    private $definitions;
  
    //Constructor
    
    public function __construct($email){
        $m = new Mongo();
        $db = $m->projectcopperfield;
        $results = array("email" => $email);
        $this->email = $results['email'];  
        $this->name = $results['name'];  
        //$this->definitions = '';    
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