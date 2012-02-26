<?php
require "../classes/rest.php";
require "../classes/definition.php";
require "../classes/user.php";
require "../classes/element.php";

$data = RestUtils::processRequest();  

switch($data->getMethod()) {  
    case 'get':
        
        $arrRequestVars = $data->getRequestVars();
        $strDefinitionId = (isset($arrRequestVars['definition_id']) ? $arrRequestVars['definition_id'] : '');
        
        if ($strDefinitionId != '') {
            $strDefinitionId = new MongoId($strDefinitionId);
        }
        else {
            RestUtils::sendResponse(400, 'error', 'application/json');
            break;
        }
        $arrResults = Element::get(10, 1, $strDefinitionId);
        RestUtils::sendResponse(200, $arrResults, 'application/json');
        break;
    case 'post':
        $arrRequestVars = $data->getRequestVars();
        $strDefinitionId = (isset($arrRequestVars['definitionId']) ? $arrRequestVars['definitionId'] : '');
        $strUserId = (isset($arrRequestVars['userId']) ? $arrRequestVars['userId'] : '');
        
        if ($strUserId != '') {
            $objDefinition = new Definition();
            $objDefinition->setId();
            $objDefinition->setName($arrRequestVars["name"]);
            $objDefinition->setDescription($arrRequestVars["description"]);
            $objDefinition->setContent($arrRequestVars['content']);
            $objDefinition->upsert();
            $objUser = new User(new MongoId($strUserId));
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
        
        $strDefinitionId = (isset($arrRequestVars['definitionId']) ? $arrRequestVars['definitionId'] : '');
        $strUserId = (isset($arrRequestVars['userId']) ? $arrRequestVars['userId'] : '');
        
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
        $strDefinitionId = (isset($arrRequestVars['definitionId']) ? $arrRequestVars['definitionId'] : '');
        $strUserId = (isset($arrRequestVars['userId']) ? $arrRequestVars['userId'] : '');
        if ($strDefinitionId != '') {
            $arrObjectId[] = new MongoId($strDefinitionId);
            $intStatus = Definition::delete($arrObjectId);
            RestUtils::sendResponse($intStatus, $intStatus, 'application/json');
        }
        else {
            RestUtils::sendResponse(400);
        }
        break;
}
?>