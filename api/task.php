<?php
require "../classes/rest.php";
require "../classes/definition.php";
require "../classes/user.php";
require "../classes/task.php";

$data = RestUtils::processRequest();  
switch($data->getMethod()) {  
    case 'get':
        $arrRequestVars = $data->getRequestVars();
        
        $strDefinitionId = (isset($arrRequestVars['definitionId']) ? $arrRequestVars['definitionId'] : '');
        $strUserId = (isset($arrRequestVars['userId']) ? $arrRequestVars['userId'] : '');
        $strTaskId = (isset($arrRequestVars['taskId']) ? $arrRequestVars['taskId'] : '');
        
        $strGroup = (isset($arrRequestVars['group']) ? $arrRequestVars['group'] : '');
        
        $arrId = array();
        if ($strTaskId != '') {
            $arrId[] = new MongoId($strTaskId);
        }
        else if (($strDefinitionId != '') && ($strUserId != '')) {
            $objUser = new User($strUserId);
            $arrDefinitions = $objUser->getDefinitions();
            $arrId = $arrDefinitions[$strDefinitionId]['tasks'];
        }
        else if (($strUserId != '')) {
            $objUser = new User($strUserId);
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
        $arrResults = Task::get(10, 1, $arrId);
        RestUtils::sendResponse(200, $arrResults, 'application/json');
        break;
    
    case 'post':
        $arrRequestVars = $data->getRequestVars();    
        $strDefinitionId = (isset($arrRequestVars['definitionId']) ? $arrRequestVars['definitionId'] : '');
        $strUserId = (isset($arrRequestVars['userId']) ? $arrRequestVars['userId'] : '');
        
        if (($strDefinitionId != '') && ($strUserId != '')) {
            $objTask = new Task();
            $objUser = new User($strUserId); //check if user object is returned sucessfully
            $objTask->setId();
            $objTask->setCreatedBy("CreateFunction");
            //$objTask->setKeywords($arrRequestVars["keywords"]); should be handled internally
            //$objTask->setAttachments("attachment"); not implemented
            $objTask->setComments($arrRequestVars["comments"]);
            $objTask->setLikes($arrRequestVars["likes"]);
            $objTask->setRatings($arrRequestVars["ratings"]);
            $objTask->setTags($arrRequestVars["tags"]);
            $objTask->setDefinition($arrRequestVars["definitionId"]);
            $objTask->setContent($arrRequestVars["content"]);
            $objTask->upsert();
            $arrDefinitions = $objUser->getDefinitions();
            foreach ($arrDefinitions as $key => $var) {
                if ($var['_id'] == new MongoId($strDefinitionId)) {
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
    
        $strDefinitionId = (isset($arrRequestVars['definitionId']) ? $arrRequestVars['definitionId'] : '');
        $strUserId = (isset($arrRequestVars['userId']) ? $arrRequestVars['userId'] : '');
        $strTaskId = (isset($arrRequestVars['taskId']) ? $arrRequestVars['taskId'] : '');
        $strPart = (isset($arrRequestVars['part']) ? $arrRequestVars['part'] : '');
        
        if ($strTaskId != '') {
            $objTask = new Task(new MongoId($arrRequestVars['taskId']));
            //$objTask->setCreatedBy("CreateFunction"); should not be updated
            //$objTask->setKeywords($arrRequestVars["keywords"]); should be handled automat..
            //$objTask->setAttachments("attachment"); not implemented
            if (($strPart == '') or ($strPart == 'comments')) {
                $objUser = new User($arrRequestVars["comments"]["userId"]);
                $arrComment = array("text" => $arrRequestVars["comments"]["text"],"userId" => $arrRequestVars["comments"]["userId"], "userName" =>
                $objUser->getName();)
                $objTask->setComments($arrComment);
            }
            if (($strPart == '') or ($strPart == 'likes')) {
                $objTask->setLikes($arrRequestVars["likes"]);
            }
            if (($strPart == '') or ($strPart == 'ratings')) {
                $objTask->setRatings($arrRequestVars["ratings"]);
            }
            if (($strPart == '') or ($strPart == 'tags')) {
                $objTask->setTags($arrRequestVars["tags"]);
            }
            //$objTask->setDefinition($arrRequestVars["definitionId"]); should not be updated
            if (($strPart == '') or ($strPart == 'content')) {
                $objTask->setContent($arrRequestVars["content"]);
            }
            $objTask->upsert();
            RestUtils::sendResponse(200, (array)$objTask->getId(), 'application/json');
        }
        else {
            RestUtils::sendResponse(400);
        }
        break;
    case 'delete':
        $arrRequestVars = $data->getRequestVars();
        
        $strTaskId = (isset($arrRequestVars['taskId']) ? $arrRequestVars['taskId'] : '');
        
        if ($strTaskId != '') {
            $arrObjectId[] = new MongoId($strTaskId);
            $intStatus = Task::delete($arrObjectId);
            RestUtils::sendResponse($intStatus, $intStatus, 'application/json');
        }
        else {
            RestUtils::sendResponse(400);
        }
        break;
}
?>