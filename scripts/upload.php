<?php
/*------------------------------------------------------------------------------
** File:        polyExample.php
** Description: Demo's the capability of the polygon class. 
** Version:     1.6
** Author:      Brenor Brophy
** Email:       brenor dot brophy at gmail dot com
** Homepage:    www.brenorbrophy.com 
*/ 
	error_reporting(E_ALL);
	require ($_SERVER["DOCUMENT_ROOT"]."/scripts/connectMongoDb.php");
	require ($_SERVER["DOCUMENT_ROOT"]."/classes/task.php");
	
	$task = new Task();
	$task->get($_POST['taskId']);
	$grid = $db->getGridFS(); //use GridFS class for handling files  
	
	$name = $_FILES['Filedata']['name']; //Optional - capture the name of the uploaded file  
    $type = $_FILES['Filedata']['type'];        // Try to get file extension
    $id = $grid->storeUpload('Filedata',$name);    // Store uploaded file to GridFS
    $db->fs->files->update(array("_id" => new Mongoid($id)), array('$set' => array("contentType" => $type, "aliases" => null, "metadata" => null)));
	
	$task->attachments[] = array("id" => $id, "type" => $type);
	$task->upsert();
	
	// Find image to stream
	$image = $grid->findOne(array("_id" => new Mongoid($id)));
	
	// Stream image to browser
	
	header('Content-type:' . $image->file["contentType"]);
	echo $image->getBytes();
	

	//header ('location: /v/definitions/'. $_POST['definitionId']. '/tasks/' . $_POST['taskId']);
?>
