<?php

class User {
    //Properties
    private $email;
    private $name;
    private $definitions;
  
    //Constructor
    
    public function __construct($email = null){
        if ($email != null) {
            $m = new Mongo();
            $db = $m->projectcopperfield;
            $array = array("email" => $email);
            $arrResults = $db->users->findOne($array);
            $this->email = $arrResults['email']; 
            $this->name = $arrResults['name'];
            $this->definitions = '';
        }
        else {
            $this->email = '';
            $this->name = '';
            $this->definitions = '';
        }
    }
    
    //Destructor -- Move save procedure out of destructur (not needed when get)
    public function __destruct(){
        $m = new Mongo();
        $db = $m->projectcopperfield;
        $array = get_object_vars($this);
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