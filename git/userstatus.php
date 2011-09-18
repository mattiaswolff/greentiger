<?php
require "../classes/rest.php";
require "../classes/user.php";

$data = RestUtils::processRequest();
$array = array("registered" => false);
RestUtils::sendResponse(200, $array, 'application/json');
?>