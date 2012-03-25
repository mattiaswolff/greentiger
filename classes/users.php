<?php
class User {
    //Properties
    private $id;
    private $email;
    private $name;
    private $definitions;
    
    //Constructor
    public function __construct($id, $name, $email, $definitions){
            $this->id = $id;
            $this->name = $name;
            $this->email = $email;
            $this->definitions = $definitions;
    }
    
    //Accessors
    public function getId() { return $this->id; } 
    public function getEmail() { return $this->email; } 
    public function getName() { return $this->name; }
    public function getDefinitions() { return $this->definitions; }
    public function setId($x) {if ($x != null) { $this->id = $x; }}
    public function setEmail($x) {if ($x != null) { $this->email = $x; }} 
    public function setName($x) {if ($x != null) { $this->name = $x; }}
    public function setDefinitions($x) {if ($x != null) { $this->definitions = $x; }}
    
    //Get, Upsert and Delete functions
    public static function findAll($intObjectsPerPage = 10, $intPage = 1) {
        $m = new Mongo();
        $db = $m->projectcopperfield;
        $intSkip = (int)($intObjectsPerPage * ($intPage - 1));
        $intLimit = $intObjectsPerPage;
        $objResults = $db->users->find()->skip($intSkip)->limit($intLimit);
        foreach ($objResults as $var) {
            $users[] = new User ($var['id'], $var['name'], $var['email'], $var['definitions']);
        }
        return $users; 
    }
    
    public static function find($id) {
        $m = new Mongo();
        $db = $m->projectcopperfield;
        $objResults = $db->users->find(array('id' => $id));
        foreach ($objResults as $var) {
            $users[] = new User ($var['id'], $var['name'], $var['email'], $var['definitions']);
        }
        return $users; 
    }
    /*
    public function upsert() {
        $m = new Mongo();
        $db = $m->projectcopperfield;
        if ($this->getEmail()) {$this->setGravatar();}
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
    
    function getCorrectId($strUserId) {
        $m = new Mongo();
        $db = $m->projectcopperfield;   
        $arrResults = $db->users->findOne(array('$or' => array(array('_id' => new MongoId($strUserId)), array('urlName' => $strUserId))));
        $objResult = new MongoId($arrResults["_id"]);
        return $objResult;
    }
    
     function setGravatar($s = 80, $d = 'mm', $r = 'pg', $img = false, $atts = array() ) {
    $url = 'http://www.gravatar.com/avatar/';
    $url .= md5( strtolower( trim( $this->getEmail() ) ) );
    $url .= "?s=$s&d=$d&r=$r";
    $this->setImgUrl($url);
    }*/
}
?>