<?php
require "../classes/rest.php";
require "../classes/definition.php";
require "../classes/user.php";

$data = RestUtils::processRequest();  

switch($data->getMethod()) {  
    case 'get':
        
        $arrRequestVars = $data->getRequestVars();
        
        $strDefinitionId = (isset($arrRequestVars['definitionId']) ? $arrRequestVars['definitionId'] : '';
        $strUserId = (isset($arrRequestVars['userId']) ? $arrRequestVars['userId'] : '';
        
        if ($strDefinitionId != '') {
            $arrId[] = new MongoId($strDefinitionId);
        }
        else if ($strUserId != '') {
            $arrResults = User::get(1000, 1, $strUserId);
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

        $strDefinitionId = (isset($arrRequestVars['definitionId']) ? $arrRequestVars['definitionId'] : '';
        $strUserId = (isset($arrRequestVars['userId']) ? $arrRequestVars['userId'] : '';
        
        if ($strUserId != '') {
            $objDefinition = new Definition();
            $objDefinition->setId();
            $objDefinition->setName($arrRequestVars["name"]);
            $objDefinition->setDescription($arrRequestVars["description"]);
            $objDefinition->setContent($arrRequestVars['content']);
            $objDefinition->upsert();
            $objUser = new User($strUserId);
            $arrDefinitions = $objUser->getDefinitions();
            $arrDefinition['_id'] = $objDefinition->getId();;
            $arrDefinition['name'] = $objDefinition->getName();
            $arrDefinition['description'] = $objDefinition->getDescription();
            $arrDefinitions[] = $arrDefinition;
            $objUser->setDefinitions($arrDefinitions);
            $objUser->upsert();
            RestUtils::sendResponse(200, (array)$objDefinition->getId(), 'application/json');
        }
        else {
            $objDefinition = new Definition();
            $objDefinition->setId();
            $objDefinition->setName($arrRequestVars["name"]);
            $objDefinition->setDescription($arrRequestVars["description"]);
            $objDefinition->setContent($arrRequestVars['content']);
            $objDefinition->upsert();
            RestUtils::sendResponse(200, (array)$objDefinition->getId(), 'application/json');
        }
        break;
    case 'put':
        $arrRequestVars = $data->getRequestVars();
        
        $strDefinitionId = (isset($arrRequestVars['definitionId']) ? $arrRequestVars['definitionId'] : '';
        $strUserId = (isset($arrRequestVars['userId']) ? $arrRequestVars['userId'] : '';
        
        if ($strDefinitionId != '') {
            $objDefinition = new Definition(new MongoId($strDefinitionId));
            $objDefinition->setName($arrRequestVars['name']);
            $objDefinition->setDescription($arrRequestVars['description']);
            $objDefinition->setContent($arrRequestVars['content']);
            $objDefinition->upsert();
            RestUtils::sendResponse(200, (array)$objDefinition->getId(), 'application/json');
        }
        else {
            RestUtils::sendResponse(400);
        }
        break;
    case 'delete':
        $arrRequestVars = $data->getRequestVars();
        
        $strDefinitionId = (isset($arrRequestVars['definitionId']) ? $arrRequestVars['definitionId'] : '';
        $strUserId = (isset($arrRequestVars['userId']) ? $arrRequestVars['userId'] : '';
        
        if ($strDefinitionId != '') {
            $arrDefinitionId[] = $strDefinitionId;
            $intStatus = Definition::delete($arrDefinitionId);
            RestUtils::sendResponse($intStatus, $intStatus, 'application/json');
        }
        else {
            RestUtils::sendResponse(400);
        }
        break;
}
?>