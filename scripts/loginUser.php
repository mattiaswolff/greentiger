<?php
	require ($_SERVER["DOCUMENT_ROOT"]."/scripts/connectMySQL.php");
	require ($_SERVER["DOCUMENT_ROOT"]."/scripts/functions/loginFunctions.php");
	session_start(); 

	$userId = $_POST['userId'];
	$password = $_POST['password'];

	$userId = mysql_real_escape_string($userId);
	$query = "SELECT password, salt FROM users WHERE email = '$userId';";

	$result = mysql_query($query);
	
	//no such user exists
	if(mysql_num_rows($result) < 1) {
	    header('Location: noUser.php');
	    die();
	}
	
	$userData = mysql_fetch_array($result, MYSQL_ASSOC);
	
	mysql_close();
	
	$hash = hash('sha256', $userData['salt'] . hash('sha256', $password) );
	
	//incorrect password
	if($hash != $userData['password']) {
	    header('Location: pwdError.php');
	    die();
	}
	
	else {
		validateUser(); //sets the session data for this user
		$_SESSION['userId'] = $userId; 
		header('Location: /' . $_SESSION['userId'] . '/definitions');
	}
?>
