<?php
	require ('../classes/user.php');
	$user = new User();
	$user->get('v');
	$user->definitions = $_POST['array']; 
	$user->update();
	header("Location: ../definitions.php");
?>
