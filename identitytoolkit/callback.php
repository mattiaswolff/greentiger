<?php
require "../classes/rest.php";
require "../classes/definition.php";
require "../classes/user.php";

$data = RestUtils::processRequest();  

switch($data->getMethod()) {  
    case 'get':
        $arrRequestVars = $data->getRequestVars();
        if (isset($arrRequestVars['definitionId'])) {
            $arrId[] = new MongoId($arrRequestVars['definitionId']);
        }
        else if (isset($arrRequestVars['userId'])) {
            $arrResults = User::get(1000, 1, $arrRequestVars['userId']);
            $arrId = $arrResults['users'][0]['definitions'];
        }
        else {
            $arrId = null;
        }
        $arrResults = Definition::get(10, 1, $arrId);
        RestUtils::sendResponse(200, $arrResults, 'application/json');
        break;
    case 'post':
        $arrRequestVars = $data->getRequestVars();
        echo '<script type="text/javascript">
            var objJSON = {"requestUri": "http://ec2-79-125-49-128.eu-west-1.compute.amazonaws.com/greentiger/index.php", "postBody": $arrRequestVars}
            $.ajax({
                type: "POST",
                url: "https://www.googleapis.com/identitytoolkit/v1/relyingparty/verifyAssertion?key=AIzaSyD_mpU7Xw4GeTmQNqHgIuZFVyPXdOyj6qY",
                dataType: "json",
                data: objJSON
                }
            });'        
        break;
}
?>