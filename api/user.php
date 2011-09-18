<?php
require "../classes/rest.php";
require "../classes/user.php";

$data = RestUtils::processRequest();  

switch($data->getMethod()) {  

    case 'get':
        $arrRequestVars = $data->getRequestVars();
        $strUserId = (isset($arrRequestVars['userId']) ? $arrRequestVars['userId'] : '');
        if ($strUserId != '') {
            $objUser = new User($strUserId);
            if (isset($objUser)) {
                RestUtils::sendResponse(200, $objUser->toArray(), 'application/json');
            }
            else {
                RestUtils::sendResponse(400, array("error" => "User with id " . $strUserId . "not found."), 'application/json');
            }
        }
        else {
            RestUtils::sendResponse(400, array("error" => "No user Id given."), 'application/json');
        }
        break;
        
    case 'post':
        $arrRequestVars = $data->getRequestVars();
        $strPart = (isset($arrRequestVars['part']) ? $arrRequestVars['part'] : '');
        $strPassword1 = (isset($arrRequestVars['password1']) ? $arrRequestVars['password1'] : '');
        $strPassword2 = (isset($arrRequestVars['password2']) ? $arrRequestVars['password2'] : '');
        
        if (isset($arrRequestVars['userId'])) {
            $user = new User();
            $user->setId($arrRequestVars["userId"]);
            $user->setEmail($arrRequestVars["email"]);
            $user->setName($arrRequestVars["name"]);
            $user->setClientId();
            $user->setRedirectUri($arrRequestVars["redirectUri"]);
            if ($strPart == 'image') {  
                $m = new Mongo();
                $db = $m->projectcopperfield;
                $grid = $db->getGridFS();
                $storedfile = $grid->storeFile($_FILES["file"]["name"], array("date" => new MongoDate()));
                echo $storedfile;
                die();
            }
            $user->upsert();
            if ($strPassword1 != '') {
                $array = array("password" => $strPassword1, "userId" => $user->getId()); 
                $m = new Mongo();
                $db = $m->projectcopperfield;
                $result = $db->command(array('findAndModify' => 'passwords', 
                'query' => array('userId' => $user->getID()),
                'update' => $array,
                'new' => true,   
                'upsert' => true,
                'fields' => array( '_id' => 1 )));
            }
            RestUtils::sendResponse(200, (array)$user->getEmail(), 'application/json');
        }
        else {
            RestUtils::sendResponse(400);
        }
        break;
        
    case 'put':
        
        $arrRequestVars = $data->getRequestVars();
        if (isset($arrRequestVars['userId'])) {
            $objUser = new User($arrRequestVars['userId']);
            if ($strPart == '') {
            $objUser->setEmail($arrRequestVars["email"]);
            $objUser->setName($arrRequestVars["name"]);
            $objUser->setDescription($arrRequestVars["description"]);
            $objUser->setDefinitions($arrRequestVars["definitions"]);
            $objUser->setClientId();
            $objUser->setRedirectUri($arrRequestVars["redirect_uri"]);
            }
            $objUser->upsert();
            RestUtils::sendResponse(200, (array)$objUser->getId(), 'application/json');
        }
        else {
            RestUtils::sendResponse(400);
        }
        break;
    
    case 'delete':
        $arrRequestVars = $data->getRequestVars();
        if (isset($arrRequestVars['userId'])) {
            $intStatus = User::delete($arrRequestVars['userId']);
            RestUtils::sendResponse($intStatus, $arrRequestVars['userId'], 'application/json');
        }
        else {
            RestUtils::sendResponse(400);
        }
        break;
}
?>
