<?php
require "../classes/rest.php";
require "../classes/definition.php";
require "../classes/user.php";
require "../classes/element.php";

$data = RestUtils::processRequest();  
$arrResults = array();

switch($data->getMethod()) {  
    case 'get':
        $arrRequestVars = $data->getRequestVars();
        $strDefinitionId = (isset($arrRequestVars['definition_id']) ? $arrRequestVars['definition_id'] : '');
        $strElementId = (isset($arrRequestVars['element_id']) ? $arrRequestVars['element_id'] : '');
        
        if ($strDefinitionId != '') {
            $strDefinitionId = new MongoId($strDefinitionId);
        }
        else {
            RestUtils::sendResponse(400, 'error', 'application/json');
            break;
        }
        $arrResults = Element::get(10, 1, $strDefinitionId, $strElementId);
        if ($arrResults['type'] == 'error') {
            RestUtils::sendResponse($arrResults['code'], $arrResults['description'], 'application/json');
        }
        else {
            RestUtils::sendResponse(200, $arrResults, 'application/json');    
        }
        break;
    case 'post':
        $arrRequestVars = $data->getRequestVars();
        $strDefinitionId = (isset($arrRequestVars['definition_id']) ? $arrRequestVars['definition_id'] : '');
        if ($strDefinitionId != '') {
            $strDefinitionId = new MongoId($strDefinitionId);
        }
        else {
            RestUtils::sendResponse(400, 'error', 'application/json');
            break;
        }
        $objElement = new Element();
        $objElement->setId($arrRequestVars["id"]);
        $objElement->setDescription($arrRequestVars["description"]);        
        $objElement->setType($arrRequestVars["type"]);        
        $objElement->setConfig($arrRequestVars['config']);
        $arrResults = $objElement->insert($strDefinitionId);
        if ($arrResults['type'] == 'error') {
            RestUtils::sendResponse($arrResults['code'], $arrResults['description'], 'application/json');
        }
        else {
            RestUtils::sendResponse(200, (array)$objElement->getId(), 'application/json');    
        }
        
        break;
    case 'put':
        $arrRequestVars = $data->getRequestVars();
        $strDefinitionId = (isset($arrRequestVars['definition_id']) ? $arrRequestVars['definition_id'] : '');
        $strElementId = (isset($arrRequestVars['element_id']) ? $arrRequestVars['element_id'] : '');
        if ($strDefinitionId != '') {
            $strDefinitionId = new MongoId($strDefinitionId);
        }
        else {
            RestUtils::sendResponse(400, 'error', 'application/json');
            break;
        }
        $objElement = new Element($strDefinitionId, $strElementId);
        $objElement->setDescription($arrRequestVars["description"]);        
        $objElement->setType($arrRequestVars["type"]);        
        $objElement->setConfig($arrRequestVars['config']);
        $arrResults = $objElement->update($strDefinitionId);
        if ($arrResults['type'] == 'error') {
            RestUtils::sendResponse($arrResults['code'], $arrResults['description'], 'application/json');
        }
        else {
            RestUtils::sendResponse(200, (array)$objElement->getId(), 'application/json');    
        }
        break;
    case 'delete':
        $arrRequestVars = $data->getRequestVars();
        $strDefinitionId = (isset($arrRequestVars['definition_id']) ? $arrRequestVars['definition_id'] : '');
        $strElementId = (isset($arrRequestVars['element_id']) ? $arrRequestVars['element_id'] : '');
        if ($strDefinitionId != '') {
            $strDefinitionId = new MongoId($strDefinitionId);
            $intStatus = Definition::delete($strDefinitionId, $strElementId);
            RestUtils::sendResponse($intStatus, $intStatus, 'application/json');
        }
        else {
            RestUtils::sendResponse(400);
        }
        break;
}
?>