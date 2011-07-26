<?php

class Task {

  //Properties
    private $_id;
    private $createdBy;
    private $updatedDate;
    private $keywords;
    private $attachments;
    private $comments;
    private $likes;
    private $ratings;
    private $tags;
    private $definition;
    private $content;
  
    //Constructor
    public function __construct(){  
        $this->_id = '';  
        $this->createdBy = '';  
        $this->updatedDate = '';
        $this->keywords = array();  
        $this->attachments = array();  
        $this->comments = array();
        $this->likes = array();  
        $this->ratings = array();  
        $this->tags = array();
        $this->definition = '';  
        $this->content = array();
    }
    
    //Accessors
    public function getId() { return (string)$this->_id; } 
    public function getCreatedBy() { return $this->createdBy; } 
    public function getUpdatedDate() { return $this->updatedDate; } 
    public function getKeywords() { return $this->keywords; } 
    public function getAttachments() { return $this->attachments; } 
    public function getComments() { return $this->comments; } 
    public function getLikes() { return $this->likes; } 
    public function getRatings() { return $this->ratings; } 
    public function getTags() { return $this->tags; } 
    public function getDefinition() { return $this->definition; } 
    public function getContent() { return $this->content; } 
    public function setId() { $this->_id = new MongoId(); } 
    public function setCreatedBy($x) { $this->createdBy = $x; } 
    public function setUpdatedDate($x) { $this->updatedDate = $x; } 
    public function setKeywords($x) { $this->keywords = $x; } 
    public function setAttachments($x) { $this->attachments = $x; } 
    public function setComments($x) { $this->comments = $x; } 
    public function setLikes($x) { $this->likes = $x; } 
    public function setRatings($x) { $this->ratings = $x; } 
    public function setTags($x) { $this->tags = $x; } 
    public function setDefinition($x) { $this->definition = $x; } 
    public function setContent($x) { $this->content = $x; }

    //Get, Upsert and Delete functions
    function get($intObjectsPerPage = 10, $intPage = 1, $arrObjectId = null) {
        $m = new Mongo();
        $db = $m->projectcopperfield;
        $intSkip = (int)($intObjectsPerPage * ($intPage - 1));
        $intLimit = $intObjectsPerPage;
        if ($arrObjectId != null) {
            $objResults = $db->tasks->find(array("_id" => array('$in' => $arrObjectId)))->limit($intLimit)->skip($intSkip);
        }
        else {
            $objResults = $db->tasks->find()->limit($intLimit)->skip($intSkip);
        }
        $arrResults['total'] = 0;
        $arrResults['page'] = $intPage;
        $arrResults['pagesize'] = $intObjectsPerPage;
        foreach ($objResults as $key => $var) {
            $arrResults['total'] = $arrResults['total'] + 1;
            $objId = new MongoId($var['_id']);
            $var['createdDate'] = $objId->getTimestamp();
            $var['_id'] = (string)$var['_id'];
            $arrResults['tasks'][] = $var;
        }
        return $arrResults; 
    }
    
    public function upsert() {
        $m = new Mongo();
        $db = $m->projectcopperfield;
        $this->updatedDate = new MongoDate();
        $array = get_object_vars($this);
        $result = $db->command(array('findAndModify' => 'tasks', 
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