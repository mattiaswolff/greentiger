<?php	
	require ($_SERVER["DOCUMENT_ROOT"]."/classes/user.php");
	session_start();
	$user = new User();
	$user->get($_SESSION['userId']);
	if (isset($_POST['permissions'])) {	
		foreach ($_POST['array'] as $key => $value) {
			$user->definitions[$key]['permissions'] = $value;
		}
	}
	elseif (isset($_POST['userInfo'])) {
		$user->email = $_POST['email'];
		$user->url = $_POST['url'];
		$user->description = $_POST['description'];
	}
	
	$user->update();
	header('Location: /' . $_SESSION['userId']. '/definitions');
?>
