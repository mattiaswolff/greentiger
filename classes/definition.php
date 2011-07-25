<?php

class Definition {

  //Properties
  private $name;
  private $description;
  private $createdDate;
  private $updatedDate;
  private $content;
  
  //Constructor
  public function __construct(){  
    $this->name = '';  
    $this->description = '';  
    $this->content = array();    
    }
    
  //Accessors
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
        if ($strDefinitionId != null) {
            $objResults = $db->defintitions->find(array("definitionId" => array("$in" => $strDefinitionId)))->limit($intLimit)->skip($intSkip;
            $arrResults['total'] = $db->users->find(array("definitionId" => array("$in" => $strDefinitionId)))->count();
        }
        else {
            $objResults = $db->defintitions->find()->limit($intLimit)->skip($intSkip);
            $arrResults['total'] = $db->users->find()->count();
        }
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
        $result = $db->command(array('findAndModify' => 'definitions', 
        'query' => array('definitionId' => $this->definitionId),
        'update' => $array,
        'new' => true,   
        'upsert' => true,
        'fields' => array( 'definitionId' => 1 )));
        $this->definitionId = $result['value']['definitionId'];
    }
    
    function delete($arrDefinitionId) {
        $m = new Mongo();
        $db = $m->projectcopperfield;
        $arrQuery = array("email" => array("$in" => $arrDefinitionId));
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