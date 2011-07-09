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
	
	$task = new Task();
	$definition = new Definition();
	$user = new User();
	if(isset($_POST['taskId'])) $task->get($_POST['taskId']);
	$task->definition = new Mongoid($_POST['definitionId']);
	$definition->get($_POST['definitionId']);
	
	if ($_POST['updateType'] == 'info') {
		foreach ($definition->info as $value) {
			$task->info[$value['title']] = $_POST[$value['title']];
		}
	}
	
	elseif ($_POST['updateType'] == 'comment') {
		$date = new MongoDate();
		$task->comments[] = array($_POST['email'], $date, $_POST['comment']) ;
	}
	$task->upsert();
	$user->get($_POST['email']);
	foreach ($user->definitions as $key => $value) {
		if (($key == $_POST['definitionId']) and (!in_array($task->_id, $user->definitions[$key]['tasks']))) $user->definitions[$key]['tasks'][] = new Mongoid($task->_id);
	}
	$user->update();
 	header ('location: /v/definitions/'. $_POST['definitionId']. '/tasks/' . $_POST['taskId']);
?>
