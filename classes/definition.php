<?php

class Definition {

  //Properties
  private $_id;
  private $name;
  private $description;
  private $updatedDate;
  private $content;
  
  //Constructor
  public function __construct(){  
    $this->name = '';  
    $this->description = '';  
    $this->content = array();    
    }
    
  //Accessors
  public function getId() {
    return $this->_id;
    }
  public function setId($id) {
    $this->_id = (string)$id;
    }
  public function getName() {
    return $this->name;
    }
  public function setName($name) {
    $this->name = (string)$name;
    }
  public function getDescription() {
    return $this->description;
    }
  public function setDescription($description) {
    $this->description = (string)$description;
    }
  public function getContent() {
    return $this->name;
    }
  public function setContent($content) {
    $this->content = $content;
    }
    
    //Get, Upsert and Delete functions
    function get($intObjectsPerPage = 10, $intPage = 1, $arrDefinitionId = null) {
        $m = new Mongo();
        $db = $m->projectcopperfield;
        $intSkip = (int)($intObjectsPerPage * ($intPage - 1));
        $intLimit = $intObjectsPerPage;
        if ($arrDefinitionId != null) {
            $objResults = $db->definitions->find(array("_id" => array('$in' => $arrDefinitionId)))->limit($intLimit)->skip($intSkip);
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
            $arrResults['definitions'][] = $var;
        }
        return $arrResults; 
    }
    
    public function upsert() {
        $m = new Mongo();
        $db = $m->projectcopperfield;
        $array = get_object_vars($this);
        $result = $db->command(array('findAndModify' => 'definitions', 
        'query' => array('_id' => $this->_id),
        'update' => $array,
        'new' => true,   
        'upsert' => true,
        'fields' => array( '_id' => 1 )));
        $this->_id = $result['value']['_id'];
    }
    
    function delete($arrId) {
        $m = new Mongo();
        $db = $m->projectcopperfield;
        $arrQuery = array("_id" => array("$in" => $arrId));
        $arrOptions = array("safe" => true);
        $arrResults = $db->users->remove($arrQuery, $arrOptions);
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