<?php
require "../classes/rest.php";
require "../classes/definition.php";
require "../classes/user.php";

$data = RestUtils::processRequest();  
$arrRequestVars = $data->getRequestVars();

echo "get: " . var_dump($arrRequestVars) . "getEnd";
echo '<script type="text/javascript">alert("test");
            var objJSON = {"requestUri": "http://ec2-79-125-49-128.eu-west-1.compute.amazonaws.com/greentiger/index.php", "postBody": $arrRequestVars}
            $.ajax({
                type: "POST",
                url: "https://www.googleapis.com/identitytoolkit/v1/relyingparty/verifyAssertion?key=AIzaSyD_mpU7Xw4GeTmQNqHgIuZFVyPXdOyj6qY",
                dataType: "json",
                data: objJSON
                }
            });<script>';
?>