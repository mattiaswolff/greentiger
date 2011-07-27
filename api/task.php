<?php
require "../classes/rest.php";
require "../classes/definition.php";
require "../classes/user.php";
require "../classes/task.php";

$data = RestUtils::processRequest();  
//test
switch($data->getMethod()) {  
    case 'get':
        $arrRequestVars = $data->getRequestVars();
        if (isset($arrRequestVars['taskId'])) {
            $arrId[] = $arrRequestVars['taskId'];
        }
        else if (isset($arrRequestVars['definitionId'])) {
            $objId[] = new MongoId($arrRequestVars['definitionId']);
            $arrResults = Definition::get(1000, 1, $objId);
            $arrId = $arrResults['definitions'][0]['tasks'];
        }
        else if (isset($arrRequestVars['userId'])) {
            $arrResults = User::get(1000, 1, $arrRequestVars['userId']);
            $arrId = $arrResults['users'][0]['definitions'];
            $arrResults = Definition::get(1000, 1, $arrId);
            $arrId = $arrResults['definitions'][0]['tasks'];
        }
        else {
            $arrId = null;
        }
        $arrResults = Task::get(10, 1, $arrId);
        RestUtils::sendResponse(200, $arrResults, 'application/json');
        break;
    case 'post':
        $arrRequestVars = $data->getRequestVars();
        if (isset($arrRequestVars['definitionId'])) {
            $objTask = new Task();
            $objTask->setId();
            $objTask->setCreatedBy("CreateFunction");
            $objTask->setKeywords($arrRequestVars["keywords"]);
            $objTask->setAttachments("attachment");
            $objTask->setComments($arrRequestVars["comments"]);
            $objTask->setLikes($arrRequestVars["likes"]);
            $objTask->setRatings($arrRequestVars["ratings"]);
            $objTask->setTags($arrRequestVars["tags"]);
            $objTask->setDefinition($arrRequestVars["definitionId"]);
            $objTask->setContent($arrRequestVars["content"]);
            $objTask->upsert();
            $objId[] = new MongoId($arrRequestVars['definitionId']);
            $objDefinition = new Definition($objId);
            $arrTasks = $objDefinition->getTasks();
            $arrTasks[] = $objTask->getId();
            $objDefinition->setTasks($arrTasks);
            $objDefinition->upsert();
            RestUtils::sendResponse(200, (array)$objTask->getId(), 'application/json');
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
            $strName = (isset($arrRequestVars['name']) ? $arrRequestVars['name'] : $arrResults['name'])
            $objUser->setName($strName);
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
        if (isset($arrRequestVars['taskId'])) {
            $arrObjectId[] = $arrRequestVars['taskId'];
            $intStatus = Definition::delete($arrObjectId);
            RestUtils::sendResponse($intStatus, $arrRequestVars['taskId'], 'application/json');
        }
        else {
            RestUtils::sendResponse(400);
        }
        break;
}
?>