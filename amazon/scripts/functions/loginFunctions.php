<?php
function validateUser()
{
    session_regenerate_id (); //this is a security measure
    $_SESSION['valid'] = 1;
}

function isLoggedIn()
{
    session_start();
    if($_SESSION['valid']) {
        return true; }
    return false;
}

function logout()
{
	session_start();
    	session_destroy();    	
	header('Location: ../index.php');
}
?>
