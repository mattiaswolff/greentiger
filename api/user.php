<?php
require "../classes/rest.php";
require "../classes/user.php";

$data = RestUtils::processRequest();  

switch($data->getMethod()) {  

    case 'get':
        $arrRequestVars = $data->getRequestVars();
        $objUser = new User($arrRequestVars['userId']);
        if ($objUser->validateAccessToken($arrRequestVars['access_token'])) {
            RestUtils::sendResponse(200, var_dump($objUser), 'application/json');
        }
        else {
            RestUtils::sendResponse(400, "error", 'application/json');
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
            $objUser->setRedirectUri($arrRequestVars["redirectUri"]);
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
