<?php

	require ('../classes/user.php');

	if($_POST['pass1'] != $_POST['pass2'])
	    header('Location: register_form.php');
	if(strlen($_POST['email']) > 30)
	    header('Location: register_form.php');
	
	$user = new User();
	$user->email = $_POST['email'];
	$user->password = $_POST['pass1'];
	$user->addUser();
	
	header('Location: ../index.php');
?>
