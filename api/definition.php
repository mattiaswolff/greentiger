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
            $arrResults = User::get(1000, 1, $arrRequestVars['userId']);
            echo var_dump($arrResults); 
            $arrId = $arrResults['definitions'];
        }
        $arrResults = Definition::get(10, 1, $arrId);
        RestUtils::sendResponse(200, $arrResults, 'application/json');
        break;
    case 'post':
        $arrRequestVars = $data->getRequestVars();
        if (isset($arrRequestVars['userId'])) {
            $objDefinition = new Definition();
            $objDefinition->setId($arrRequestVars["name"]);
            $objDefinition->setName($arrRequestVars["name"]);
            $objDefinition->setDescription($arrRequestVars["description"]);
            $objDefinition->upsert();
            $objUser = new User($arrRequestVars['userId']);
            $arrDefinitions = $objUser->getDefinitions();
            $arrDefinitions[] = $objDefinition->getId();
            $objUser->setDefinitions($arrDefinitions);
            $objUser->upsert();
            RestUtils::sendResponse(200, (array)$objDefinition->getId(), 'application/json');
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
