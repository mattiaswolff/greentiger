<?php

class Definition {

    //Properties
    public $_id;
    public $name;
    public $description;
    public $elements;
  
    //Constructor
    public function __construct($_id, $name, $description, $elements){  
        $this->setId($_id);
        $this->setName($name);  
        $this->setDescription($description);  
        $this->setElements($elements);
    }
    
    //Accessors
    public function getId() { return $this->_id; } 
    public function getName() { return $this->name; } 
    public function getDescription() { return $this->description; } 
    public function getElements() { return $this->elements; }  
    public function setId($x = null) {if ($x != null) {$this->_id = $x; }} 
    public function setName($x = null) {if ($x != null) {$this->name = $x; }} 
    public function setDescription($x = null) {if ($x != null) { $this->description = $x; }}     
    public function setElements($x = null) {if ($x != null) { $this->elements = $x; }} 
    
    //Get, Upsert and Delete functions
    public static function findAll($intObjectsPerPage = 10, $intPage = 1) {
        $m = new Mongo();
        $db = $m->projectcopperfield;
        $intSkip = (int)($intObjectsPerPage * ($intPage - 1));
        $intLimit = $intObjectsPerPage;
        $objResults = $db->definitions->find()->limit($intLimit)->skip($intSkip);
        foreach ($objResults as $key => $var) {
            $definitions[] = new Definition($var['_id'], $var['name'], $var['description'], $var['elements']);
        }
        return $definitions; 
    }
    
    public static function find($arrId) {
        $m = new Mongo();
        $db = $m->projectcopperfield;
        $objResults = $db->definitions->find(array("_id" => array('$in' => $arrId)));
        echo var_dump($objResults);
        foreach ($objResults as $key => $var) {
            $definitions[] = new Definition($var['_id'], $var['name'], $var['description'], $var['elements']);
        }
        return $definitions; 
    }
    
    public function upsert() {
        $m = new Mongo();
        $db = $m->projectcopperfield;
        $this->updatedDate = new MongoDate();
        $array = get_object_vars($this);
        $result = $db->command(array('findAndModify' => 'definitions', 
        'query' => array('_id' => $this->_id),
        'update' => $array,
        'new' => true,   
        'upsert' => true,
        'fields' => array( '_id' => 1 )));
        $this->_id = $result['value']['_id'];
    }
    /*
    function delete($arrObjectId) {
        $m = new Mongo();
        $db = $m->projectcopperfield;
        $arrQuery = array("_id" => array('$in' => $arrObjectId));
        $arrOptions = array("safe" => true);
        $arrResults = $db->definitions->remove($arrQuery, $arrOptions);
        $intStatus = ($arrResults['n'] == 1 ? 200 : 400);
        return $intStatus; 
    }
    
    //Other functions
    public function toArray() {
        $array = get_object_vars($this);
        return $array;
    }*/
}
?>