<?php
/*------------------------------------------------------------------------------
** File:        task.php
** Description: Handles the task 
** Version:     1.0
** Author:      Mattias Wolff
** Email:       mattias dot wolff at gmail dot com
** Homepage:    www.brenorbrophy.com 
*/

class Definition {
  public $name;
  public $description;
  public $info 	= array();
  
  public function insert () {
    require ($_SERVER["DOCUMENT_ROOT"]."/scripts/connectMongoDb.php");   
	$db->definitions->insert($this);
  }
  
  public function update () {
    require ($_SERVER["DOCUMENT_ROOT"]."/scripts/connectMongoDb.php");
    echo "obj " . $this->_id;
	$result = $db->command(array('findAndModify' => 'definitions', 
	'query' => array('_id' => new MongoId($this->_id)),
    'update' => array('name' => $this->name, 'description' => $this->description, 'info' => $this->info),
    'new' => true,        # To get back the document after the upsert
    'upsert' => true,
    'fields' => array( '_id' => 1 )   # Only return _id field
) );

	$this->_id = $result['value']['_id'];
  }
  
  public function get ($id) {
    require ($_SERVER["DOCUMENT_ROOT"]."/scripts/connectMongoDb.php");
	$results = $db->definitions->findOne(array('_id' => new MongoId($id)));
	$this->name = $results['name'];
	$this->description = $results['description'];
	$this->info = $results['info'];
  }
  
  public function delete ($id) {
    require ($_SERVER["DOCUMENT_ROOT"]."/scripts/connectMongoDb.php");
	$results = $db->definitions->delete(array('_id' => new MongoId($id)));
  }
}
?>
