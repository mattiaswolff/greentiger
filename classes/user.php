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
        $this->definitions = '';
    }
    
    //Accessors
    public function getEmail() {
        return $this->email;
    }
    public function setEmail($email) {
        if (preg_match("/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/", $email)) {
            $this->email = (string)$email;
        }
        else {
            $this->email = 'error';
        }
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
    
    public function save() {
        $m = new Mongo();
        $db = $m->projectcopperfield;
        $array = get_object_vars($this);
        $result = $db->command(array('findAndModify' => 'users', 
        'query' => array('email' => $this->email),
        'update' => $array,
        'new' => true,   
        'upsert' => true,
        'fields' => array( 'email' => 1 )));
        $this->email = $result['value']['email'];
    }
    
    public function toArray() {
        $array = get_object_vars($this);
        return $array;
    }
    
    function get($intObjectsPerPage = 10, $intPage = 1, $email = null) {
        $m = new Mongo();
        $db = $m->projectcopperfield;
        if ($email != null) {
            $objResults = $db->users->find(array("email" => $email));
        }
        else {
            $intSkip = (int)($intObjectsPerPage * ($intPage - 1));
            $intLimit = $intObjectsPerPage;
            $objResults = $db->users->find()->limit($intLimit)->skip($intSkip);
        }
        $arrResults['total'] = $db->users->find()->count();
        $arrResults['page'] = $intPage;
        $arrResults['pagesize'] = $intObjectsPerPage;
        foreach ($objResults as $var) {
            $arrResults['users'][] = $var;
        }
	    return $arrResults; 
    }
    
    function delete($strEmail) {
        $m = new Mongo();
        $db = $m->projectcopperfield;
	    $arrQuery = array("email" => $strEmail);
        $arrOptions = array("safe" => true);
	    $bolSuccess = $db->users->remove($arrQuery, $arrOptions);
        echo var_dump($bolSuccess);
        die();
        $intStatus = ($bolSuccess ? 201 : 400);
        return $intStatus; 
    }
}
?>