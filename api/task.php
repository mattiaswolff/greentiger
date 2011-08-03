<?php
require "../classes/rest.php";
require "../classes/definition.php";
require "../classes/user.php";
require "../classes/task.php";
//test231
$data = RestUtils::processRequest();  
switch($data->getMethod()) {  
    case 'get':
        $arrRequestVars = $data->getRequestVars();
        $strGroup = (isset($arrRequestVars['group']) ? $arrRequestVars['group'] : '');
        $arrId = array();
        if (isset($arrRequestVars['taskId'])) {
            $arrId[] = $arrRequestVars['taskId'];
        }
        else if (isset($arrRequestVars['definitionId']) && isset($arrRequestVars['userId'])) {
            $objUser = new User($arrRequestVars['userId']);
            $arrDefinitions = $objUser->getDefinitions();
            $arrId = $arrDefinitions[$arrRequestVars['definitionId']]['tasks'];
        }
        else if (isset($arrRequestVars['userId'])) {
            $objUser = new User($arrRequestVars['userId']);
            $arrDefinitions = $objUser->getDefinitions();
            foreach ($arrDefinitions as $key => $var) {
                if ($strGroup == '' && isset($var['tasks'])) {
                    $arrId = array_merge($arrId, $var['tasks']);    
                }
                elseif ($strGroup == 'definition' && isset($var['tasks'])) {
                    $arrId[(string)$var['_id']] = $var['tasks']; 
                }
            }
        }
        else {
            $arrId = null;
        }
        echo var_dump($arrId);
        $arrResults = Task::get(10, 1, $arrId);
        RestUtils::sendResponse(200, $arrResults, 'application/json');
        break;
    case 'post':
        $arrRequestVars = $data->getRequestVars();
        if (isset($arrRequestVars['definitionId']) and isset($arrRequestVars['userId'])) {
            $objTask = new Task();
            $objUser = new User($arrRequestVars['userId']);
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
            $arrDefinitions = $objUser->getDefinitions();
            foreach ($arrDefinitions as $key => $var) {
                if ($var['_id'] == new MongoId($arrRequestVars['definitionId'])) {
                    $arrDefinitions[$key]['tasks'][] = $objTask->getId();
                    break;
                }
            }
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