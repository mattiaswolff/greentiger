<?php

class Element {

    //Properties
    private $id;
    private $description;
    private $type;
    private $config;
  
    //Constructor
    public function __construct($objId = null){  
        if ($objId != null) {
            $m = new Mongo();
            $db = $m->projectcopperfield;
            $arrResults = $db->definitions->findOne(array("_id" => $objId));
            $this->id = $arrResults['id'];
            $this->description = $arrResults['description'];
            $this->type = $arrResults['type'];            
            $this->config = $arrResults['config'];
        }
        else {
            $this->id = '';
            $this->name = '';  
            $this->description = '';  
            $this->content = array();
            $this->updatedDate = '';
        }
    }
    
    //Accessors
    public function getId() { return $this->id; } 
    public function getDescription() { return $this->description; }    
    public function getType() { return $this->type; } 
    public function getConfig() { return $this->config; }  
    public function setId($x = null) {if ($x != null) { $this->id = $x; }}
    public function setDescription($x = null) {if ($x != null) { $this->description = $x; }}
    public function setType($x = null) {if ($x != null) {$this->type = $x; }} 
    public function setConfig($x = null) {if ($x != null) { $this->config = $x; }} 
    
    //Get, Upsert and Delete functions
    function get($intObjectsPerPage = 10, $intPage = 1, $strDefinitionId = null, $arrElementId = null) {
        $m = new Mongo();
        $db = $m->projectcopperfield;
        $intSkip = (int)($intObjectsPerPage * ($intPage - 1));
        $intLimit = $intObjectsPerPage;
        $objResults = $db->definitions->findOne(array("_id" => $strDefinitionId));
        if (is_null($objResults)) {
            $arrResults = array("type" => "error", "code"=> 404, "description" => "problem");
            return $arrResults;
        }
        //report error if not found.        
        $arrResults['page'] = $intPage;
        $arrResults['page_size'] = $intObjectsPerPage;        
        if !(is_null($arrElementId)) {
            $arrResults['total'] = 1;
            $arrResults['elements'][] = $objResults['elements'][$arrElementId];
            //report error if element is not found.
        }
        else {
            echo "multiple";
            $arrResults['total'] = 0;
            foreach ($objResults['elements'] as $key => $var) {
                //This loop should needs to be limited by page_size
                echo var_dump($var);
                $arrResults['total'] = $arrResults['total'] + 1;
                $arrResults['elements'][] = $var;
            }
        }
        return $arrResults; 
    }
    
    public function upsert($intDefinitionId) {
        $m = new Mongo();
        $db = $m->projectcopperfield;
        $db->definitions->update(array('id' => $intDefinitionId,
                                        'elements.id' => $this->getId()),
                                array('$set' =>
                                        array('elements.$.description' => $this->getDescription(),
                                            'elements.$.type' => $this->getType(),
                                            'elements.$.config' => $this->getConfig())));
        
        $result =
            $db->runCommand(array('getlasterror' => 1));
        
        echo $result;
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