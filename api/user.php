<?php
require "../classes/rest.php";
require "../classes/user.php";

$data = RestUtils::processRequest();  

switch($data->getMethod()) {  

    case 'get':
        $arrRequestVars = $data->getRequestVars();
        $strUserId = (isset($arrRequestVars['userId']) ? $arrRequestVars['userId'] : null);
        $arrResults = User::get(10, 1, $strUserId);
        RestUtils::sendResponse(200, $arrResults, 'application/json');
        break;
    case 'post':
        $arrRequestVars = $data->getRequestVars();
        if (isset($arrRequestVars['userId'])) {
            $user = new User();
            $user->setId($arrRequestVars["userId"]);
            $user->setEmail($arrRequestVars["email"]);
            $user->setName($arrRequestVars["name"]);
            $user->upsert();
            RestUtils::sendResponse(200, (array)$user->getEmail(), 'application/json');
        }
        else {
            RestUtils::sendResponse(400);
        }
        break;
    case 'put':
        $arrRequestVars = $data->getRequestVars();
        if (isset($arrRequestVars['email'])) {
            $arrResults = User::get(10, 1, $strEmail);
            $objUser = new User();
            //$objUser->setName((isset($arrRequestVars['name']) ? $arrRequestVars['name'] : $arrResults['name']);
            //$objUser->setEmail((isset($arrRequestVars['email']) ? $arrRequestVars['email'] : $arrResults['email']);
            //$objUser->setDefinitions((isset($arrRequestVars['name']) ? $arrRequestVars['name'] : $arrResults['name']);
            $objUser->upsert();
            RestUtils::sendResponse(200, (array)$objUser->getEmail(), 'application/json');
        }
        else {
            RestUtils::sendResponse(400);
        }
        break;
    case 'delete':
        $arrRequestVars = $data->getRequestVars();
        if (isset($arrRequestVars['email'])) {
            $intStatus = User::delete($arrRequestVars['email']);
            RestUtils::sendResponse($intStatus, $arrRequestVars['email'], 'application/json');
        }
        else {
            RestUtils::sendResponse(400);
        }
        break;
}
?>
