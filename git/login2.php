<?php
require "../classes/rest.php";
require "../classes/user.php";

$data = RestUtils::processRequest();
$arrRequestVars = $data->getRequestVars();
$strEmail = $arrRequestVars["email"];
$strPassword = $arrRequestVars["password"];
$m = new Mongo();
$db = $m->projectcopperfield;
$arrResults = $db->users->findOne(array("email" => $strEmail));
if ($arrResults != null) {
    $strId = $arrResults["_id"];
    $arrResults2 = $db->passwords->findOne(array("userId" => $strEmail, "password" => $strPassword));
    if ($arrResults2 != null) {
        $array = array("status" => "tpasswordError");
    }
    else {
        $array = array("status" => "passwordError");
    }
}
else {
    $array = array("status" => "passwordError");
}
RestUtils::sendResponse(200, $array, 'application/json');
?>