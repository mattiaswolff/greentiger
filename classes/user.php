<?php
class User {
    //Properties
    private $_id;
    private $email;
    private $name;
    private $url;
    private $description;
    private $definitions;
    private $client_id;
    private $redirect_uri;
    private $accessTokens;
    private $imageId;
    
    //Constructor
    public function __construct($strUserId = null){
        if ($strUserId != null) {
            $m = new Mongo();
            $db = $m->projectcopperfield;
            $arrResults = $db->users->findOne(array('_id' => $strUserId));
            $this->_id = $arrResults['_id'];
            $this->name = $arrResults['name'];
            $this->url = $arrResults['url'];
            $this->email = $arrResults['email'];
            $this->description = $arrResults['description'];
            $this->definitions = $arrResults['definitions'];
            $this->client_id = $arrResults['client_id'];
            $this->redirect_uri = $arrResults['redirect_uri'];
            $this->accessTokens = $arrResults['accessTokens'];
            $this->imageId = $arrResults['imageId'];
        }
        else {
            $this->email = '';
            $this->name = '';
            $this->url = '';
            $this->description = '';
            $this->definitions = array();
            $this->accessTokens = array();
            $this->client_id = '';
            $this->redirect_uri = '';
            $this->imageId = '';
        }
    }
    
    //Accessors
    public function getId() { return $this->_id; } 
    public function getEmail() { return $this->email; } 
    public function getName() { return $this->name; }
    public function getUrl() { return $this->url; }
    public function getDescription() { return $this->description; }
    public function getDefinitions() { return $this->definitions; }
    public function getAccessTokens() { return $this->accessTokens; }
    public function getClientId() { return $this->client_id; }
    public function getRedirectUri() { return $this->redirect_uri; }
    public function getImageId() { return $this->imageId; }
    public function setId($x = null) { if ($x) { $this->_id = $x; } else { $this->_id = new MongoId(); }}
    public function setEmail($x) {if ($x != null) { $this->email = $x; }} 
    public function setName($x) {if ($x != null) { $this->name = $x; }}
    public function setUrl($x) {if ($x != null) { $this->url = $x; }}
    public function setDescription($x) {if ($x != null) { $this->description = $x; }}
    public function setDefinitions($x) {if ($x != null) { $this->definitions = $x; }} 
    public function setAccessTokens($x) {if (!is_null($x)) { $this->accessTokens = $x; }}
    public function setClientId() {if (!isset($this->client_id) || ((string)$this->client_id == '')) {$this->client_id = (string)new MongoId(); }}
    public function setRedirectUri($x) {if ($x != null) { $arrParsedUrl = parse_url($x); $strParsedUrl = $arrParsedUrl['scheme'] . '://' . $arrParsedUrl['host']; $this->redirect_uri = $strParsedUrl; }}
    public function setImageId($x) {if ($x != null) { $this->imageId = $x; }}
    
    //Get, Upsert and Delete functions
    function get($intObjectsPerPage = 10, $intPage = 1, $arrObjectId = null) {
        $m = new Mongo();
        $db = $m->projectcopperfield;
        if ($arrObjectId != null) {
            $objResults = $db->users->find(array("_id" => $arrObjectId));
        }
        else {
            $intSkip = (int)($intObjectsPerPage * ($intPage - 1));
            $intLimit = $intObjectsPerPage;
            $objResults = $db->users->find()->skip($intSkip)->limit($intLimit);
        }
        $arrResults['total'] = 0;
        $arrResults['page'] = $intPage;
        $arrResults['pagesize'] = $intObjectsPerPage;
        foreach ($objResults as $var) {
            $arrResults['total'] = $arrResults['total'] + 1;
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
        return $result['value']['_id'];
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
    
    function validateConsumer($strClientId, $strRedirectUri) {
        $m = new Mongo();
        $db = $m->projectcopperfield;
        $arrParsedUrl = parse_url($strRedirectUri);
        $strParsedUrl = $arrParsedUrl['scheme'] . '://' . $arrParsedUrl['host'];
        $arrResults = $db->users->findOne(array("client_id" => $strClientId, "redirect_uri" => $strParsedUrl));
        if ($arrResults != null) {
            return TRUE;
        }
        else {
            return FALSE;
        }
    }
    
    function validateAccessToken($strAccessToken) {
        date_default_timezone_set('Europe/London');
        $date = new DateTime();
        $intSec = $date->getTimestamp();
        $booReturn = FALSE;
        $arrAccessTokens = array();
        foreach ($this->getAccessTokens() as $key => $value) {
            $objMongoDate = $value['createdDate'];
            if (($objMongoDate->sec + 5000) > $intSec) {
                $arrAccessTokens[] = $value;
                if ($value['token'] == $strAccessToken) {
                    $booReturn = TRUE;
                }
            }
        }
        $this->setAccessTokens($arrAccessTokens);
        $this->upsert();
        return $booReturn;
    }
    
    function validateEmail($strEmail) {
        $m = new Mongo();
        $db = $m->projectcopperfield;   
        $arrResults = $db->users->findOne(array("email" => $strEmail));
        return $arrResults["_id"];
    }
}
?>