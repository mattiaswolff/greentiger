<?php
	require ($_SERVER["DOCUMENT_ROOT"] . "/classes/definition.php");
	require ($_SERVER["DOCUMENT_ROOT"] . "/classes/user.php");
	
	$definition = new Definition();
	$definition->_id = $_POST['_id'];
	$definition->name = $_POST['name'];
	$definition->description = $_POST['description'];
	$definition->info = $_POST['array'];
	$definition->update();
	$user = new User();
	$user->get('v');
	 
	if (!in_array($definition->_id, array_keys($user->definitions))) {
		$user->definitions[(string)$definition->_id] = array('name' => $definition->name, 'share' => 'private');
		$user->update();
	}
	
	header('Location: /v/definitions/'. $definition->_id);
?>
