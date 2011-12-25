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
            $objUser = new User(new MongoId($strUserId));
            if (isset($objUser)) {
                if ($strPart == 'image') {
                    echo '<img src="' . $objUser->getImgUrl() . '"/>'; 
                }
                else {
                    $objUser->setId((string)$objUser->getId());
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
        $strUserId = (isset($arrRequestVars['userId']) ? $arrRequestVars['userId'] : '');
        $strImgUrl = (isset($arrRequestVars['imgUrl']) ? $arrRequestVars['imgUrl'] : '');
        $strPassword1 = (isset($arrRequestVars['password1']) ? $arrRequestVars['password1'] : '');
        $strPassword2 = (isset($arrRequestVars['password2']) ? $arrRequestVars['password2'] : '');
        
        $user = new User();
        $user->setId();
        $user->setEmail($arrRequestVars["email"]);
        $user->setName($arrRequestVars["name"]);
        $user->setUrl($arrRequestVars["name"]);
        $user->setClientId();
        $user->setImgUrl($strImgUrl);
        $user->setRedirectUri($arrRequestVars["redirectUri"]);
        
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
            $objUser = new User(new MongoId($arrRequestVars['userId']));
            if ($strPart == '') {
            $objUser->setEmail($arrRequestVars["email"]);
            $objUser->setName($arrRequestVars["name"]);
            $objUser->setUrl($arrRequestVars["url"]);
            $objUser->setImgUrl($arrRequestVars["imgUrl"]);
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
        $strUserId = (isset($arrRequestVars['userId']) ? new MongoId($arrRequestVars['userId']) : '');
        $strDefinitionId = (isset($arrRequestVars['definitionId']) ? new MongoId($arrRequestVars['definitionId']) : '');
        $intStatus = 401;
        if (isset($strUserId)) {
            if (isset($strDefinitionId)) {
                $objUser = new User($strUserId);
                $arrAllDefinitions = $objUser->getDefinitions();
                $arrDefinitions = array();
                foreach ($arrAllDefinitions as $var) {
                    if ($var["_id"] != $strDefinitionId) {
                         $arrDefinitions[] = $var;
                    }
                    else {
                        echo $var["_id"];
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
