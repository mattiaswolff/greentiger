<?php
require "../classes/rest.php";
require "../classes/user.php";

$data = RestUtils::processRequest();  

switch($data->getMethod()) {  
    // this is a request for all users, not one in particular  
    case 'get':
        $arrRequestVars = $data->getRequestVars();
        if (isset($arrRequestVars['email'])) {
            $objUser = new User($arrRequestVars['email']);
            $arrUser = $objUser->toArray();
            RestUtils::sendResponse(200, $arrUser, 'json');
        }
        else {
            $arrResults = User::get();
            RestUtils::sendResponse(200, $arrResults, 'json');
        }
        break;
    case 'post':
        $arrRequestVars = $data->getRequestVars();
        $user = new User();
        $user->setEmail($arrRequestVars["email"]);
        $user->setName($arrRequestVars["name"]);
        $user->save();
        RestUtils::sendResponse(200, (array)$user->getEmail(), 'json');
        break;
    case 'put':
        $arrRequestVars = $data->getRequestVars();
        if (isset($arrRequestVars['email'])) {
            $objUser = new User($arrRequestVars['email']);
            $objUser->save();
            RestUtils::sendResponse(200, (array)$objUser->getEmail(), 'json');
        }
        else {
            echo 'error';
        }
        break;
    case 'delete':
        $arrRequestVars = $data->getRequestVars();
        if (isset($arrRequestVars['email'])) {
            User::delete($arrRequestVars['email']);
        }
        else {
            echo 'error';
        }
        break;
}
?>
