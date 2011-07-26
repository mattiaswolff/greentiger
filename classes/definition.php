<?php

class Definition {

  //Properties
  private $_id;
  private $name;
  private $description;
  private $updatedDate;
  private $content;
  private $tasks;
  
    //Constructor
    public function __construct($objId = null){  
        if ($objId != null) {
            $m = new Mongo();
            $db = $m->projectcopperfield;
            $arrResults = $db->definitions->findOne(array("_id" => $objId));
            $this->_id = $arrResults['_id'];
            $this->name = $arrResults['name'];
            $this->description = $arrResults['email'];
            $this->updatedDate = $arrResults['updatedDate'];
            $this->content = $arrResults['content'];
            $this->tasks = $arrResults['tasks'];
        }
        else {
            $this->_id = '';
            $this->name = '';  
            $this->description = '';  
            $this->content = array();
            $this->tasks = array();
            $this->updatedDate = '';
        }
    }
    
    //Accessors
    public function getId() { return $this->_id; } 
    public function getName() { return $this->name; } 
    public function getDescription() { return $this->description; } 
    public function getUpdatedDate() { return $this->updatedDate; } 
    public function getContent() { return $this->content; } 
    public function getTasks() { return $this->tasks; } 
    public function setId() { $this->_id = new MongoId(); } 
    public function setName($x) { $this->name = $x; } 
    public function setDescription($x) { $this->description = $x; } 
    public function setUpdatedDate($x) { $this->updatedDate = $x; }     
    public function setContent($x) { $this->content = $x; } 
    public function setTasks($x) { $this->tasks = $x; } 
    
    //Get, Upsert and Delete functions
    function get($intObjectsPerPage = 10, $intPage = 1, $arrObjectId = null) {
        $m = new Mongo();
        $db = $m->projectcopperfield;
        $intSkip = (int)($intObjectsPerPage * ($intPage - 1));
        $intLimit = $intObjectsPerPage;
        if ($arrObjectId != null) {
            echo var_dump($arrObjectId);
            $objResults = $db->definitions->find(array("_id" => array('$in' => $arrObjectId)))->limit($intLimit)->skip($intSkip);
        }
        else {
            $objResults = $db->definitions->find()->limit($intLimit)->skip($intSkip);
        }
        $arrResults['total'] = 0;
        $arrResults['page'] = $intPage;
        $arrResults['pagesize'] = $intObjectsPerPage;
        foreach ($objResults as $key => $var) {
            $arrResults['total'] = $arrResults['total'] + 1;
            $objId = new MongoId($var['_id']);
            $var['createdDate'] = $objId->getTimestamp();
            $var['_id'] = (string)$var['_id'];
            $arrResults['definitions'][] = $var;
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
        $arrResults = $db->tasks->remove($arrQuery, $arrOptions);
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