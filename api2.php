<?php
$status_header = 'HTTP/1.1 200 OK';  
    // set the status  
    header($status_header);  
    // set the content type  
header('Content-type: application/json');
		require ($_SERVER["DOCUMENT_ROOT"]."/classes/definition.php");
		require ($_SERVER["DOCUMENT_ROOT"]."/classes/user.php");
		require ($_SERVER["DOCUMENT_ROOT"]."/classes/task.php");
		$user = new User();
		$user->get($_GET['userId']);
		foreach ($user->definitions as $key=>$value) {
			$user->definitions[$key]['url'] = 'http://ec2-46-51-156-7.eu-west-1.compute.amazonaws.com/' . $user->userId . '/definitions/' . $key;
		}
		echo json_encode($user);
?>

