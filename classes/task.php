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
  
    //Constructorsd
    public function __construct($objId = null){
        if ($objId != null) {
            $m = new Mongo();
            $db = $m->projectcopperfield;
            $arrResults = $db->tasks->findOne(array("_id" => $objId));
            $this->_id = $arrResults['_id'];  
            $this->createdBy = $arrResults['createdBy'];  
            $this->updatedDate = $arrResults['updatedDate'];
            $this->keywords = $arrResults['keywords'];  
            $this->attachments = $arrResults['attachments'];  
            $this->comments = $arrResults['comments'];
            $this->likes = $arrResults['likes'];  
            $this->ratings = $arrResults['ratings'];  
            $this->tags = $arrResults['tags'];
            $this->definition = $arrResults['definition'];  
            $this->content = $arrResults['content'];
        }
        else {
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
    }
    
    //Accessors
    public function getId() { return $this->_id; } 
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
    public function setCreatedBy($x) {if ($x != null) { $this->createdBy = $x; }} 
    public function setUpdatedDate($x) {if ($x != null) { $this->updatedDate = $x; }} 
    public function setKeywords($x) {if ($x != null) { $this->keywords = $x; }} 
    public function setAttachments($x) {if ($x != null) { $this->attachments = $x; }} 
    public function setComments($x) {if ($x != null) { $this->comments[] = $x; }} 
    public function setLikes($x) {if ($x != null) { $this->likes = $x; }} 
    public function setRatings($x) {if ($x != null) { $this->ratings = $x; }} 
    public function setTags($x) {if ($x != null) { $this->tags = $x; }} 
    public function setDefinition($x) {if ($x != null) { $this->definition = $x; }} 
    public function setContent($x) {if ($x != null) { $this->content = $x; }}

    //Get, Upsert and Delete functions
    function get($intObjectsPerPage = 10, $intPage = 1, $arrObjectId = null, $strSearch) {
        
        $m = new Mongo();
        $db = $m->projectcopperfield;
        //Calulate offset and page size
        $intSkip = (int)($intObjectsPerPage * ($intPage - 1));
        $intLimit = $intObjectsPerPage;
        $strSearch = strtolower($strSearch);
        $arrSearch = explode(" ", $strSearch);
        //Get results from database
        if (!isset($arrObjectId[0])) {
            foreach($arrObjectId as $key => $var) {
                $objResults[$key] = $db->tasks->find(array("_id" => array('$in' => $var), "definition" => $key))->sort(array("_id" => -1))->limit($intLimit)->skip($intSkip);
            }
        }
        elseif ($arrObjectId != null) {
            if ($strSearch != '') {
                $objResults[0] = $db->tasks->find(array("_id" => array('$in' => $arrObjectId), array('$or' => array("keywords" => array('$in' => $arrSearch), "createdBy.name" => array('$in' => $arrSearch)))))->sort(array("_id" => -1))->limit($intLimit)->skip($intSkip);
            }
            else {
                $objResults[0] = $db->tasks->find(array("_id" => array('$in' => $arrObjectId)))->sort(array("_id" => -1))->limit($intLimit)->skip($intSkip);
            }
        }
        else {
            $objResults[0] = $db->tasks->find()->limit($intLimit)->skip($intSkip);
        }
        
        
        $arrResults['total'] = 0;
        $arrResults['page'] = $intPage;
        $arrResults['pagesize'] = $intObjectsPerPage;
        foreach ($objResults as $key => $var) {
            $arrResult = array();
            foreach($var as $key1 => $var1) {
                $arrResults['total'] = $arrResults['total'] + 1;
                $objId = new MongoId($var1['_id']);
                $var1['createdDate'] = $objId->getTimestamp();
                $var1['_id'] = (string)$var1['_id'];
                $arrResult[] = $var1;
            }
            
            $arrResults['results'][$key] = $arrResult;
        }
        return $arrResults; 
    }
    
    public function upsert() {
        $m = new Mongo();
        $db = $m->projectcopperfield;
        $this->updatedDate = date("c");
        
        $arrKeywords = array();
        foreach ($this->GetContent() as $value) {
                $arrKeywords = array_merge($arrKeywords,  explode(" ",preg_replace("/[^a-zåäöÅÄÖ \d]/i", "",$value)));   
            }
        foreach ($this->GetComments() as $value) {
                $arrKeywords = array_merge($arrKeywords,  explode(" ",preg_replace("/[^a-zåäöÅÄÖ \d]/i", "",$value["text"])));   
            }
        $arrKeywords = unserialize(strtolower(serialize($arrKeywords))); 
        $arrKeywordsSorted = array_count_values($arrKeywords);
        arsort($arrKeywordsSorted);
        $this->setKeywords(array_keys($arrKeywordsSorted));
        
        $array = get_object_vars($this);
        $result = $db->command(array('findAndModify' => 'tasks', 
        'query' => array('_id' => $this->_id),
        'update' => $array,
        'new' => true,   
        'upsert' => true,
        'fields' => array( '_id' => 1 )));
        $this->_id = $result['value']['_id'];
        
        require "../AWSSDKforPHP/sdk.class.php";
        $objUser = new User($this->createdBy['_id']);
        // Instantiate the class
        $email = new AmazonSES();
        $email->setRegion(AmazonSES::REGION_US_E1);
        $response = $email->send_email(
            'no-replay@zowgle.com', // Source (aka From)
            array('ToAddresses' => $objUser->getEmail()), // Destination (aka To)
            array( // Message (long form)
                'Subject' => array(
                    'Data' => 'Zowgle post has been updated',
                    'Charset' => 'UTF-8'
                ),
                'Body' => array(
                    'Text' => array(
                        'Data' => 'Thîs îs å plåîn téxt, ünîcødé tést méssåge ' . time(),
                        'Charset' => 'UTF-8'
                    ),
                    'Html' => array(
                        'Data' => '<p><strong>Zowgle post has been updated</strong></p>',
                        'Charset' => 'UTF-8'
                    )
                )
            )
        );    
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