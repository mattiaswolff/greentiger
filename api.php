<?php
$status_header = 'HTTP/1.1 200 OK';  
    // set the status  
    header($status_header);  
    // set the content type  
header('Content-type: application/json');
		require ($_SERVER["DOCUMENT_ROOT"]."/classes/definition.php");
		require ($_SERVER["DOCUMENT_ROOT"]."/classes/user.php");
		require ($_SERVER["DOCUMENT_ROOT"]."/classes/task.php");
		$definition = new Definition();
		$definition->get($_GET['definitionId']);
echo json_encode($definition);  
?>

