<?php
	require ('../classes/user.php');
	
	$user = new User();
	$user->get('v');
	foreach ($user->definitions as $key => $value) {
		if ($value['id'] == $_GET['definitionId']) unset($user->definitions[$key]); 
	}
	$user->update();
		
	header("Location: ../definitions.php");
?>
