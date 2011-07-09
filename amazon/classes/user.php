<?php
/*------------------------------------------------------------------------------
** File:        task.php
** Description: Handles the task 
** Version:     1.0
** Author:      Mattias Wolff
** Email:       mattias dot wolff at gmail dot com
** Homepage:    www.brenorbrophy.com 
*/

class User {
  
  public $email;
  public $password;
  public $definitions 	= array();
  
  public function addUser () {
    require ($_SERVER["DOCUMENT_ROOT"]."/scripts/connectMongoDb.php");
    require ($_SERVER["DOCUMENT_ROOT"]."/scripts/connectMySQL.php");
	
	$email = mysql_real_escape_string($this->email);
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
	        VALUES ( '$email' , '$hash' , '$salt' );";
	
	mysql_query($query);
	
	mysql_close();
	
	$mongoDbObj = array('email' => $email); 
	$db->users->insert($mongoDbObj);
	
	header('Location: ../index.php');
  }
  
  public function update () {
    require ($_SERVER["DOCUMENT_ROOT"] . "/scripts/connectMongoDb.php");
	$email = mysql_real_escape_string($this->email);
	$db->users->update(array('email' => $this->email), array('$set' => array('definitions'=> $this->definitions)));
  }
  
  public function get ($email) {

    require ($_SERVER["DOCUMENT_ROOT"] . "/scripts/connectMongoDb.php");

    $results = $db->users->findOne(array('email' => $email));
	$this->email = $results['email'];
	$this->definitions = $results['definitions'];
  }
}

?>
