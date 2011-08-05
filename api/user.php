<?php
require "../classes/rest.php";
require "../classes/user.php";

$data = RestUtils::processRequest();  

switch($data->getMethod()) {  

    case 'get':
        $arrRequestVars = $data->getRequestVars();
        
        $strUserId = (isset($arrRequestVars['userId']) ? $arrRequestVars['userId'] : '');
        
        if ($strUserId != '') {
            $objUser = new User($strUserId);
            if (isset($objUser)) {
                RestUtils::sendResponse(200, $objUser->toArray(), 'application/json');
            }
            else {
                RestUtils::sendResponse(400, array("error" => "User with id " . $strUserId . "not found."), 'application/json');
            }
        }
        else {
            RestUtils::sendResponse(400, array("error" => "No user Id given."), 'application/json');
        }
        
        break;
    case 'post':
        $arrRequestVars = $data->getRequestVars();
        if (isset($arrRequestVars['userId'])) {
            $user = new User();
            $user->setId($arrRequestVars["userId"]);
            $user->setEmail($arrRequestVars["email"]);
            $user->setName($arrRequestVars["name"]);
            $user->setClientId();
            $user->setRedirectUri($arrRequestVars["redirectUri"]);
            $user->upsert();
            RestUtils::sendResponse(200, (array)$user->getEmail(), 'application/json');
        }
        else {
            RestUtils::sendResponse(400);
        }
        break;
    case 'put':
        $arrRequestVars = $data->getRequestVars();
        if (isset($arrRequestVars['userId'])) {
            $objUser = new User($arrRequestVars['userId']);
            $objUser->setEmail($arrRequestVars["email"]);
            $objUser->setName($arrRequestVars["name"]);
            $objUser->setDefinitions($arrRequestVars["definitions"]);
            $objUser->setClientId();
            $objUser->setRedirectUri($arrRequestVars["redirect_uri"]);
            $objUser->upsert();
            RestUtils::sendResponse(200, (array)$objUser->getId(), 'application/json');
        }
        else {
            RestUtils::sendResponse(400);
        }
        break;
    case 'delete':
        $arrRequestVars = $data->getRequestVars();
        if (isset($arrRequestVars['userId'])) {
            $intStatus = User::delete($arrRequestVars['userId']);
            RestUtils::sendResponse($intStatus, $arrRequestVars['userId'], 'application/json');
        }
        else {
            RestUtils::sendResponse(400);
        }
        break;
}
?>
