<?php
	require ($_SERVER["DOCUMENT_ROOT"] . "/classes/definition.php");
	require ($_SERVER["DOCUMENT_ROOT"] . "/classes/user.php");
	session_start();
	echo var_dump($_POST);
	$definition = new Definition();
	$definition->_id = $_POST['_id'];
	$definition->name = $_POST['name'];
	$definition->description = $_POST['description'];
	//$definition->description = $_POST['description'];
	$definition->info = $_POST['array'];
	$definition->update();
	$user = new User();
	$user->get($_SESSION['userId']);
	if (!in_array($definition->_id, array_keys($user->definitions))) {
		$user->definitions[(string)$definition->_id] = array('name' => $definition->name, 'permissions' => array('All' => array()));
		$user->update();
	}
	header('Location: /' . $_SESSION['userId'] .'/definitions/'. $definition->_id);
?>
