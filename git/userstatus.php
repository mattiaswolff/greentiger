<?php
require "../classes/rest.php";
require "../classes/user.php";

$data = RestUtils::processRequest();
$arrRequestVars = $data->getRequestVars();
$strEmail = $arrRequestVars["email"];
$m = new Mongo();
$db = $m->projectcopperfield;
$arrResults = $db->users->findOne(array("email" => $strEmail);
if ($arrResults != null) {
    $array = array("registered" => true);
}
else {
    $array = array("registered" => false);
}
RestUtils::sendResponse(200, $array, 'application/json');
?>