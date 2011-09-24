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
    $strUserId = $arrResults["_id"];
    $arrResults2 = $db->passwords->findOne(array("userId" => $strUserId, "password" => $strPassword));
    if ($arrResults2 != null) {
        $array = array("status" => "OK");
        session_start();
        $_SESSION["userId"] = $strUserId;
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