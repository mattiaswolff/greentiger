<?php

class User {
    //Properties
    private $_id;
    private $email;
    private $name;
    private $definitions;
  
    //Constructor
    public function __construct($strUserId = null){
        if ($strUserId != null) {
            $m = new Mongo();
            $db = $m->projectcopperfield;
            $arrResults = $db->users->findOne(array("_id" => $strUserId));
            $this->_id = $arrResults['_id'];
            $this->name = $arrResults['name'];
            $this->email = $arrResults['email'];
            $this->definitions = $arrResults['definitions'];
        }
        else {
            $this->email = '';
            $this->name = '';
            $this->definitions = array();
        }
    }
    
    //Accessors
    
    public function getId() {
        return $this->_id;
    }
    public function setId($id) {
            $this->_id = (string)$id;
    }
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
            $this->name = (string)$name;
    }
    public function getDefinitions() {
        return $this->definitions;
    }
    public function setDefinitions($definitions) {
        $this->definitions = $definitions;
    }
    
    //Get, Upsert and Delete functions
    function get($intObjectsPerPage = 10, $intPage = 1, $strUserId = null) {
        $m = new Mongo();
        $db = $m->projectcopperfield;
        if ($strUserId != null) {
            $objResults = $db->users->find(array("_id" => $strUserId));
        }
        else {
            $intSkip = 0;
            $intLimit = $intObjectsPerPage;
            $objResults = $db->users->find()->skip($intSkip)->limit($intLimit);
        }
        $arrResults['total'] = $db->users->find()->count();
        $arrResults['page'] = $intPage;
        $arrResults['pagesize'] = $intObjectsPerPage;
        foreach ($objResults as $var) {
            $arrResults['users'][] = $var;
        }
        return $arrResults; 
    }
    
    public function upsert() {
        $m = new Mongo();
        $db = $m->projectcopperfield;
        $array = get_object_vars($this);
        $result = $db->command(array('findAndModify' => 'users', 
        'query' => array('_id' => $this->_id),
        'update' => $array,
        'new' => true,   
        'upsert' => true,
        'fields' => array( '_id' => 1 )));
        $this->email = $result['value']['_id'];
    }
    
    function delete($strUserId) {
        $m = new Mongo();
        $db = $m->projectcopperfield;
        $arrQuery = array("_id" => $strUserId);
        $arrOptions = array("safe" => true);
	    $arrResults = $db->users->remove($arrQuery, $arrOptions);
        $intStatus = ($arrResults['n'] == 1 ? 200 : 400);
        return $intStatus; 
    }
    
    public function toArray() {
        $array = get_object_vars($this);
        return $array;
    }
}
?>