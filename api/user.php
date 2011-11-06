<?php
require "../classes/rest.php";
require "../classes/user.php";

$data = RestUtils::processRequest();  

switch($data->getMethod()) {  

    case 'get':
        $arrRequestVars = $data->getRequestVars();
        $strUserId = (isset($arrRequestVars['userId']) ? $arrRequestVars['userId'] : '');
        $strPart = (isset($arrRequestVars['part']) ? $arrRequestVars['part'] : '');
        if ($strUserId != '') {
            $objUser = new User($strUserId);
            if (isset($objUser)) {
                if ($strPart == 'image') {
                    $m = new Mongo();
                    $db = $m->projectcopperfield;
                    $grid = $db->getGridFS();
                    $image = $grid->findOne(array("_id" => $objUser->getImageId()));
                    header('Content-type: image/png;');
                    echo $image->getBytes();
                }
                else {
                RestUtils::sendResponse(200, $objUser->toArray(), 'application/json');
                }
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
        $strUserId = (isset($arrRequestVars['userId']) ? $arrRequestVars['userId'] : '');
        $strPassword1 = (isset($arrRequestVars['password1']) ? $arrRequestVars['password1'] : '');
        $strPassword2 = (isset($arrRequestVars['password2']) ? $arrRequestVars['password2'] : '');
            if ($strPart == 'image') {  
                $user = new User($strUserId);
                $m = new Mongo();
                $db = $m->projectcopperfield;
                $grid = $db->getGridFS();
                $storedfile = $grid->storeFile($_FILES["file"]["tmp_name"], array("date" => new MongoDate()));
                $user->setImageId($storedfile);
            }
            else { 
            $user = new User();
            $user->setId();
            $user->setEmail($arrRequestVars["email"]);
            $user->setName($arrRequestVars["name"]);
            $user->setUrl($arrRequestVars["name"]);
            $user->setClientId();
            $user->setRedirectUri($arrRequestVars["redirectUri"]);
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
        break;
        
    case 'put':
        
        $arrRequestVars = $data->getRequestVars();
        if (isset($arrRequestVars['userId'])) {
            $objUser = new User($arrRequestVars['userId']);
            if ($strPart == '') {
            $objUser->setEmail($arrRequestVars["email"]);
            $objUser->setName($arrRequestVars["name"]);
            $objUser->setUrl($arrRequestVars["url"]);
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
        $strUserId = (isset($arrRequestVars['userId']) ? $arrRequestVars['userId'] : '');
        $strDefinitionId = (isset($arrRequestVars['definitionId']) ? $arrRequestVars['definitionId'] : '');
        $intStatus = 401;
        if (isset($strUserId)) {
            if (isset($strDefinitionId)) {
                $objUser = new User($strUserId);
                $arrAllDefinitions = $objUser->getDefinitions();
                echo $strDefinitionId;
                foreach ($arrAllDefinitions as $var) {
                    echo var_dump $var;
                    if ($var["$id"] != $strDefinitionId) {
                        $arrDefinitions[] = $var;
                    }
                    else {
                        echo $var["$id"];
                        $intStatus = 200;
                    }
                }
                $objUser->setDefinitions($arrDefinitions);
                $objUser->upsert();
                RestUtils::sendResponse($intStatus, (array)$objUser->getId(), 'application/json');
            }
            else {
                $intStatus = User::delete($strUserId);
                RestUtils::sendResponse($intStatus, $strUserId, 'application/json');
            }
        }
        else {
            RestUtils::sendResponse(400);
        }
        break;
}
?>
