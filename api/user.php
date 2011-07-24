<?php
require "../classes/rest.php";
require "../classes/user.php";

$data = RestUtils::processRequest();  

switch($data->getMethod()) {  

    case 'get':
        $arrRequestVars = $data->getRequestVars();
        $strEmail = (isset($arrRequestVars['email']) ? $arrRequestVars['email'] : null);
        $arrResults = User::get(10, 1, $strEmail);
        RestUtils::sendResponse(200, $arrResults, 'json');
        break;
    case 'post':
        $arrRequestVars = $data->getRequestVars();
        if (isset($arrRequestVars['email'])) {
            $user = new User();
            $user->setEmail($arrRequestVars["email"]);
            $user->setName($arrRequestVars["name"]);
            $user->save();
            RestUtils::sendResponse(200, (array)$user->getEmail(), 'json');
        }
        else {
            RestUtils::sendResponse(405);
        }
        break;
    case 'put':
        $arrRequestVars = $data->getRequestVars();
        if (isset($arrRequestVars['email'])) {
            $objUser = new User($arrRequestVars['email']);
            $objUser->save();
            RestUtils::sendResponse(200, (array)$objUser->getEmail(), 'json');
        }
        else {
            RestUtils::sendResponse(405);
        }
        break;
    case 'delete':
        $arrRequestVars = $data->getRequestVars();
        if (isset($arrRequestVars['email'])) {
            User::delete($arrRequestVars['email']);
            RestUtils::sendResponse(200, $arrRequestVars['email'], 'json');
        }
        else {
            RestUtils::sendResponse(405);
        }
        break;
}
?>
