<?php
require "../classes/rest.php";
require "../classes/definition.php";
require "../classes/user.php";

$data = RestUtils::processRequest();  

switch($data->getMethod()) {  
    case 'get':
        $arrRequestVars = $data->getRequestVars();
        if (isset($arrRequestVars['definitionId'])) {
            $arrId[] = new MongoId($arrRequestVars['definitionId']);
        }
        else if (isset($arrRequestVars['userId'])) {
            $arrResults = User::get(1000, 1, $arrRequestVars['userId']);
            $arrId = $arrResults['users'][0]['definitions'];
        }
        else {
            $arrId = null;
        }
        $arrResults = Definition::get(10, 1, $arrId);
        RestUtils::sendResponse(200, $arrResults, 'application/json');
        break;
    case 'post':
        $arrRequestVars = $data->getRequestVars();
        if (isset($arrRequestVars['userId'])) {
            $objDefinition = new Definition();
            $objDefinition->setId();
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
        if (isset($arrRequestVars['definitionId'])) {
            $objDefinition = new Definition(new MongoId($arrRequestVars['definitionId']));
            $objDefinition->setName($arrRequestVars['name']);
            $objDefinition->setDescription($arrRequestVars['description']);
            $objDefinition->upsert();
            RestUtils::sendResponse(200, (array)$objDefinition->getId(), 'application/json');
        }
        else {
            RestUtils::sendResponse(400);
        }
        break;
    case 'delete':
        $arrRequestVars = $data->getRequestVars();
        if (isset($arrRequestVars['definitionId'])) {
            $arrDefinitionId[] = $arrRequestVars['definitionId'];
            $intStatus = Definition::delete($arrDefinitionId);
            RestUtils::sendResponse($intStatus, $arrRequestVars['definitionId'], 'application/json');
        }
        else {
            RestUtils::sendResponse(400);
        }
        break;
}
?>