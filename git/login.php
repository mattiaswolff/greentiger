<?php

require_once('handler/gitLoginHandler.php');

$action = isset($_POST['action']) ? $_POST['action'] : '';
$email = isset($_POST['email']) ? $_POST['email'] : '';
$password = isset($_POST['password']) ? $_POST['password'] : '';
$handler = new gitLoginHandler($action, $email, $password);
$handler->execute();
