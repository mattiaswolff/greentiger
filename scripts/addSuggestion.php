<?php
/*------------------------------------------------------------------------------
** File:        polyExample.php
** Description: Demo's the capability of the polygon class. 
** Version:     1.6
** Author:      Brenor Brophy
** Email:       brenor dot brophy at gmail dot com
** Homepage:    www.brenorbrophy.com 
*/
	require ($_SERVER["DOCUMENT_ROOT"]."/classes/definition.php");
	require ($_SERVER["DOCUMENT_ROOT"]."/classes/task.php");
	require ($_SERVER["DOCUMENT_ROOT"]."/classes/user.php");
	session_start();
	$task = new Task();
	$definition = new Definition();
	$user = new User();
	if(isset($_POST['taskId'])) $task->get($_POST['taskId']);
	$task->definition = new Mongoid($_POST['definitionId']);
	$definition->get($_POST['definitionId']);
	
	if ($_POST['updateType'] == 'Save') {
		foreach ($definition->info as $value) {
			$task->info[$value['title']] = $_POST[(str_replace(' ', '_', $value['title']))];
		}
	}
	
	elseif ($_POST['updateType'] == 'Post Comment') {
		$date = new MongoDate();
		$task->comments[] = array("userId" => $_POST['userId'], "date" => $date, "comment" => $_POST['comment']) ;
	}
	$task->upsert();
	$user->get($_POST['userId']);
	echo new MongoId($task->_id) . "<br>";
	foreach ($user->definitions as $key => $value) {
		echo $value['name'] . " " . $value['tasks'] . "<br>";
		if (($key == $_POST['definitionId']) and (!in_array(new MongoId($task->_id), $value['tasks']))) $user->definitions[$key]['tasks'][] = new Mongoid($task->_id);
	}
	$user->update();
 	header ('location: /' . $_POST['userId'] . '/definitions/'. $_POST['definitionId']. '/tasks/' . $task->_id);
?>
