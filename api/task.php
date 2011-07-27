<?php
require "../classes/rest.php";
require "../classes/definition.php";
require "../classes/user.php";
require "../classes/task.php";
//test
$data = RestUtils::processRequest();  
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
            $objUser = new User($arrRequestVars['userId']);
            $arrDefinitions = $objUser->getDefinitions();
            echo var_dump($arrDefinitions);
            $arrDefinitions[$arrRequestVars['definitionId']]['tasks'][] = $objTask->getId();
            echo var_dump($arrDefinitions);
            $objUser->setDefinitions($arrDefinitions);
            $objUser->upsert();
            RestUtils::sendResponse(200, (array)$objTask->getId(), 'application/json');
        }
        else {
            RestUtils::sendResponse(400);
        }
        break;
    case 'put':
        $arrRequestVars = $data->getRequestVars();
        if (isset($arrRequestVars['taskId'])) {
            $objTask = new Task(new MongoId($arrRequestVars['taskId']));
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
            RestUtils::sendResponse(200, (array)$objTask->getId(), 'application/json');
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