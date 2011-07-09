<?php
		$status_header = 'HTTP/1.1 200 OK';
		header($status_header);    
		header('Content-type: application/json');
		date_default_timezone_set('Europe/Stockholm');
		require ($_SERVER["DOCUMENT_ROOT"] . "/scripts/connectMongoDb.php");
		require ($_SERVER["DOCUMENT_ROOT"]."/classes/user.php");
		require ($_SERVER["DOCUMENT_ROOT"]."/classes/task.php");
		
		$user = new User();
		$user->get($_GET['userId']);
		
		$query = array('_id' => array('$in' => $user->definitions[$_GET['definitionId']]['tasks']));
		$results = $db->tasks->find($query);
		$return = array();
		
		foreach ($results as $value) {
			//echo var_dump($value['createdDate']->sec);
			$value['createdDate'] = date("m/d/Y H:i:s", $value['createdDate']->sec); 
			$return[] = $value;
		}
		
		echo json_encode($return);
?>
