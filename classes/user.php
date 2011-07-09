<?php
/*------------------------------------------------------------------------------
** File:        user.php
** Description: the user class 
** Version:     1.0
** Author:      Mattias Wolff
** Email:       mattias dot wolff at gmail dot com 
*/

class User {
  
  public $email;
  public $userId;
  public $password;
  public $description;
  public $image;
  public $definitions 	= array();
  public $connections 	= array();
  
  public function insert () {
    require ($_SERVER["DOCUMENT_ROOT"]."/scripts/connectMongoDb.php");
    require ($_SERVER["DOCUMENT_ROOT"]."/scripts/connectMySQL.php");
	
	$userId = mysql_real_escape_string($this->userId);
	$hash = hash('sha256', $this->password);
	
	//creates a 3 character sequence
	function createSalt()
	{
	    $string = md5(uniqid(rand(), true));
	    return substr($string, 0, 3);
	}
	
	$salt = createSalt();
	$hash = hash('sha256', $salt . $hash);

	$query = "INSERT INTO users ( email, password, salt )
	        VALUES ( '$userId' , '$hash' , '$salt' );";
	
	mysql_query($query);
	
	mysql_close();
	
	$mongoDbObj = array('userId' => $userId); 
	$db->users->insert($mongoDbObj);
	
	header('Location: ../index.php');
  }
  
  public function update () {
    require ($_SERVER["DOCUMENT_ROOT"] . "/scripts/connectMongoDb.php");
	$db->users->update(array('userId' => $this->userId), array('$set' => array('description'=> $this->description, 'email'=> $this->email, 'url'=> $this->url, 'definitions'=> $this->definitions, 'connections'=> $this->connections)));
  }
  
  public function get ($userId) {
    require ($_SERVER["DOCUMENT_ROOT"] . "/scripts/connectMongoDb.php");
	        
    $results = $db->users->findOne(array('userId' => $userId));
	
	$this->userId = $results['userId'];
	$this->email = $results['email'];
	$this->url = $results['url'];
	$this->definitions = $results['definitions'];
	$this->description = $results['description'];
	$this->connections = $results['connections'];
  }
}
?>
