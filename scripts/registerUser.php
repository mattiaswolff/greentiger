<?php

	require ($_SERVER["DOCUMENT_ROOT"]."/classes/user.php");

	if($_POST['pass1'] != $_POST['pass2'])
	    header('Location: register_form.php');
	if(strlen($_POST['userId']) > 30)
	    header('Location: register_form.php');
	
	$user = new User();
	$user->userId = $_POST['userId'];
	$user->password = $_POST['pass1'];
	$user->insert();
	
	header('Location: ../index.php');
?>
