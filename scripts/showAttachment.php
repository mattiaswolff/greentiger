<?php	
	require ($_SERVER["DOCUMENT_ROOT"]."/scripts/connectMongoDb.php");
	$grid = $db->getGridFS();
	$attachment = $grid->findOne(array("_id" => new Mongoid($_GET['attachmentId']))); 
	header('Content-type:' . $attachment->file["contentType"]);
	echo $attachment->getBytes();
?>
