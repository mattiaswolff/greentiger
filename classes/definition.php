<?php

class Definition {

    //Properties
    private $_id;
    private $name;
    private $description;
    private $updatedDate;
    private $elements;
  
    //Constructor
    public function __construct($objId = null){  
        if ($objId != null) {
            $m = new Mongo();
            $db = $m->projectcopperfield;
            $arrResults = $db->definitions->findOne(array("_id" => $objId));
            $this->_id = $arrResults['_id'];
            $this->name = $arrResults['name'];
            $this->description = $arrResults['description'];
            $this->updatedDate = $arrResults['updatedDate'];
            $this->elements = $arrResults['elements'];
        }
        else {
            $this->_id = '';
            $this->name = '';  
            $this->description = '';  
            $this->elements = array();
            $this->updatedDate = '';
        }
    }
    
    //Accessors
    public function getId() { return $this->_id; } 
    public function getName() { return $this->name; } 
    public function getDescription() { return $this->description; } 
    public function getUpdatedDate() { return $this->updatedDate; } 
    public function getElements() { return $this->elements; }  
    public function setId() { $this->_id = new MongoId(); } 
    public function setName($x = null) {if ($x != null) {$this->name = $x; }} 
    public function setDescription($x = null) {if ($x != null) { $this->description = $x; }}     
    public function setElements($x = null) {if ($x != null) { $this->elements = $x; }} 
    
    //Get, Upsert and Delete functions
    function get($intObjectsPerPage = 10, $intPage = 1, $arrObjectId = null) {
        $m = new Mongo();
        $db = $m->projectcopperfield;
        $intSkip = (int)($intObjectsPerPage * ($intPage - 1));
        $intLimit = $intObjectsPerPage;
        if ($arrObjectId != null) {
            $objResults = $db->definitions->find(array("_id" => array('$in' => $arrObjectId)))->limit($intLimit)->skip($intSkip);
        }
        else {
            $objResults = $db->definitions->find()->limit($intLimit)->skip($intSkip);
        }
        foreach ($objResults as $key => $var) {
            $objId = new MongoId($var['_id']);
            $var['createdDate'] = $objId->getTimestamp();
            $var['_id'] = (string)$var['_id'];
            $arrResults[] = $var;
        }
        return $arrResults; 
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
    }
}
?>