<?php
require "../classes/user.php";
session_start();
echo "test: " . print_r($_SESSION['userId']);

if (isset($_SESSION['userId'])) {
    $objUser = new User($_SESSION['userId']);
    echo "<script type='text/javascript'>var userData = {email: 'name@idp.com',displayName: 'User Name',photoUrl: 'http://website.com/img/user.png'};window.google.identitytoolkit.updateSavedAccount(userData);</script>";
}
?>