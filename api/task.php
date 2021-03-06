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
        $intOffset = (isset($arrRequestVars['offset']) ? $arrRequestVars['offset'] : 1);
        $strSearch = (isset($arrRequestVars['search']) ? $arrRequestVars['search'] : '');
        
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
        $arrResults = Task::get(10, $intOffset, $arrId, $strSearch);
        RestUtils::sendResponse(200, $arrResults, 'application/json');
        break;
    
    case 'post':
        $arrRequestVars = $data->getRequestVars();    
        $strDefinitionId = (isset($arrRequestVars['definitionId']) ? $arrRequestVars['definitionId'] : '');
        $strUserId = (isset($arrRequestVars['userId']) ? $arrRequestVars['userId'] : '');
        
        $strCreateUserId = (isset($arrRequestVars['createUserId']) ? $arrRequestVars['createUserId'] : '');
        $strCreateUserName = (isset($arrRequestVars['createUserName']) ? $arrRequestVars['createUserName'] : 'unknown');
        $strCreateUserEmail = (isset($arrRequestVars['createUserEmail']) ? $arrRequestVars['createUserEmail'] : '');

        if ($strCreateUserId == '') {
            $strCreateUserId = user::validateEmail($strCreateUserEmail);
            if (!$strCreateUserId) {
                $user = new User();
                $user->setId();
                $user->setName($strCreateUserName);
                $user->setEmail($strCreateUserEmail);
                $strCreateUserId = $user->upsert();
            }
        }
        else {
            $strCreateUserId = new MongoId($strCreateUserId);
        }
        
        if (($strDefinitionId != '') && ($strUserId != '')) {
            $objTask = new Task();
            $objUser = new User($strUserId); //check if user object is returned sucessfully
            $arrUser = array("_id" => $strCreateUserId, "name" => $strCreateUserName); 
            $objTask->setId();
            $objTask->setCreatedBy($arrUser);
            $objTask->setComments($arrRequestVars["comments"]);
            $objTask->setLikes($arrRequestVars["likes"]);
            $objTask->setRatings($arrRequestVars["ratings"]);
            $objTask->setTags($arrRequestVars["tags"]);
            $objTask->setDefinition($arrRequestVars["definitionId"]);
            $objTask->setElements($arrRequestVars["elements"]);
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
            if ($strPart == 'comments') {
                $objUser = new User(new MongoId($arrRequestVars["comments"]["userId"]));
                $arrComment = array("text" => $arrRequestVars["comments"]["text"],"userId" => $arrRequestVars["comments"]["userId"], "userName" =>
                $objUser->getName(), "date" => date("c"));
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
            if (($strPart == '') or ($strPart == 'elements')) {
                $objTask->Elements($arrRequestVars["elements"]);
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