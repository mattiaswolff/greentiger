<?php
require "../classes/rest.php";
require "../classes/definition.php";
require "../classes/user.php";

$data = RestUtils::processRequest();  

switch($data->getMethod()) {  
    case 'get':
        $arrRequestVars = $data->getRequestVars();
        if (isset($arrRequestVars['definitionId'])) {
            $arrId = $arrRequestVars['definitionId'];
        }
        else if (isset($arrRequestVars['userId'])) {
            $arrResults = User::get($data->getRequestVars($arrRequestVars['userId']));
            $arrId = $arrResults['definitions'];
        }
        $arrResults = Definitions::get(10, 1, $arrId);
        RestUtils::sendResponse(200, $arrResults, 'application/json');
        break;
    case 'post':
        $arrRequestVars = $data->getRequestVars();
        echo "test";
            die();
        if (isset($arrRequestVars['userId'])) {
            $objDefinition = new Definition();
            $objDefinition->setId('test');
            $objDefinition->setName($arrRequestVars["name"]);
            echo "test";
            die();
            $objDefinition->setDescription($arrRequestVars["description"]);
            $objDefinition->upsert();
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
