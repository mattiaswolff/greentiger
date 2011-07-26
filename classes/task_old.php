<?php
/*------------------------------------------------------------------------------
** File:        task.php
** Description: Handles the task 
** Version:     1.0
** Author:      Mattias Wolff
** Email:       mattias dot wolff at gmail dot com
** Homepage:    www.brenorbrophy.com 
*/
  
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

  public function upsert () {
    //set static info
    $this->createdDate 	= new MongoDate();
	$this->createdBy 	= 'v';
	
	//set keywords    
	foreach (split(" ", strtolower($this->createdBy)) as $var) {
		$this->keywords[] = $var;
	}
	foreach ($this->info as $field) {
		foreach (split(" ", strtolower($field)) as $var) {
			$this->keywords[] = $var;
		}
	}
    
    require ($_SERVER["DOCUMENT_ROOT"] . "/scripts/connectMongoDb.php");
    
    $result = $db->command(array('findAndModify' => 'tasks', 
	'query' => array('_id' => new MongoId($this->_id)),
    'update' => array('createdBy' => $this->createdBy, 'createdDate' => $this->createdDate, 'keywords' => $this->keywords, 'definition' => $this->definition, 'attachments' => $this->attachments, 'comments' => $this->comments, 'likes'=> $this->likes, 'dislikes'=> $this->dislikes, 'rating'=> $this->rating, 'tags' => $this->tags, 'info'=> $this->info),
    'new' => true,   
    'upsert' => true,
    'fields' => array( '_id' => 1 )));
    $this->_id = $result['value']['_id'];
  }

	public function likeTask ($id, $email) {
    	
	//add user to like
	$query = array('_id' => new MongoId($id));
	$value = array('$addToSet' => array('likes' => $email));

	//update like arrat
    require ($_SERVER["DOCUMENT_ROOT"] . "/scripts/connectMongoDb.php");
    
    $db->tasks->update($query, $value);
  }

	public function commentTask ($id, $email, $comment) {
    
    require ($_SERVER["DOCUMENT_ROOT"] . "/scripts/connectMongoDb.php");
    	
	$query = array('_id' => new MongoId($id));
	$value = array('$push' => array('comments' => array(new MongoDate(), $email, $comment)));
    	
    $db->tasks->update($query, $value);
  }

	public function get ($id) {

    require ($_SERVER["DOCUMENT_ROOT"] . "/scripts/connectMongoDb.php");
	
	$query = array('_id' => new MongoId($id));
    $results = $db->tasks->findOne($query);

    $this->_id = new MongoId($id);
    $this->createdBy = $results['createdBy'];
    $this->createdDate = $results['createdDate'];
    $this->keywords = $results['keywords'];
    $this->definition = $results['definition'];
    $this->attachments = $results['attachments'];
	$this->comments = $results['comments'];
    $this->likes = $results['likes'];
    $this->dislikes = $results['dislikes'];
    $this->rating = $results['rating'];
	$this->tags = $results['tags'];
	$this->info = $results['info'];
  }
}

function getTask($str, $docs_per_page, $page, $email) { 
	  	
	require ($_SERVER["DOCUMENT_ROOT"] . "/scripts/connectMongoDb.php");
	
	$skip = (int)($docs_per_page * ($page - 1));
	$limit = $docs_per_page;

	if ($str == "search...") {
		$query = array('user' => strtolower($email));
	}
	elseif ($str == "favourite") {

		$query = array('email' => $email);
		$value = array('favouriteTasks' => 1);
		$results = $db->user->find($query, $value)->limit($limit)->skip($skip); 
		foreach ($results as $result) {
			foreach ($result['favouriteTasks'] as $res){
				$id = new MongoId($res['_id']);
			}
		}			
		$query = array('_id' => array('$in' => array($id)), 'user' => strtolower($email));
	}
	else {
		$query = array('keywords' => strtolower($str), 'user' => strtolower($email));
	}
	
	$results = $db->tasks->find($query)->limit($limit)->skip($skip);
	
	return $results; 
}

function deleteTask ($id) {
    
    require ($_SERVER["DOCUMENT_ROOT"] . "/scripts/connectMongoDb.php");

	$query = array('_id' => new MongoId($id));
	
	$db->tasks->remove($query);
  }
?>
