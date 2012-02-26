<?php

class Element {

    //Properties
    private $id;
    private $description;
    private $type;
    private $config;
  
    //Constructor
    public function __construct($strDefinitionId = null, $strElementId = null){  
        if (!is_null($strDefinitionId) and !is_null($strElementId)) {
            $arrResults = $this->get(10,1,$strDefinitionId,$strElementId);
            $this->id = $arrResults['elements'][0]['id'];
            $this->description = $arrResults['elements'][0]['description'];
            $this->type = $arrResults['elements'][0]['type'];            
            $this->config = $arrResults['elements'][0]['config'];
        }
        else {
            $this->id = '';
            $this->description = '';
            $this->type = '';            
            $this->config = '';
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
    function get($intObjectsPerPage = 10, $intPage = 1, $strDefinitionId = null, $strElementId = '') {
        $m = new Mongo();
        $db = $m->projectcopperfield;
        $intSkip = (int)($intObjectsPerPage * ($intPage - 1));
        $intLimit = $intObjectsPerPage;
        $arrResults = array();    
        $objResults = $db->definitions->findOne(array("_id" => $strDefinitionId));
        if (is_null($objResults)) {
            $arrResults = array("type" => "error", "code"=> 404, "description" => "problem");
            return $arrResults;
        }
        //report error if not found.        
        $arrResults['page'] = $intPage;
        $arrResults['page_size'] = $intObjectsPerPage;        
        if ($strElementId != '') {
            $arrResults['total'] = 1;
            foreach ($objResults['elements'] as $key => $var) {
                if ($var['id'] == $strElementId) {
                    $arrResults['elements'][] = $var;
                    break;
                }
            }
            //report error if element is not found.
        }
        else {
            $arrResults['total'] = 0;
            foreach ($objResults['elements'] as $key => $var) {
                //This loop should needs to be limited by page_size
                $arrResults['total'] = $arrResults['total'] + 1;
                $arrResults['elements'][] = $var;
            }
        }
        return $arrResults; 
    }
    
    public function update($intDefinitionId) {
        $m = new Mongo();
        $db = $m->projectcopperfield;
        $db->definitions->update(array('_id' => $intDefinitionId,
                                        'elements.id' => $this->getId()),
                                array('$set' =>
                                        array('elements.$.description' => $this->getDescription(),
                                            'elements.$.type' => $this->getType(),
                                            'elements.$.config' => $this->getConfig())));
    }
    
    public function insert($intDefinitionId) {
        $m = new Mongo();
        $db = $m->projectcopperfield;
        $db->definitions->update(array('_id' => $intDefinitionId),
                                array('$push' =>
                                    array( 'elements' =>
                                        array('id' => $this->getId(),
                                                'description' => $this->getDescription(),
                                                'type' => $this->getType(),
                                                'config' => $this->getConfig()))));
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