<?php
require "../classes/rest.php";
require "../classes/user.php";

$data = RestUtils::processRequest();  

switch($data->getMethod()) {  
    // this is a request for all users, not one in particular  
    case 'get':  
        $objUser = new User($_GET['email']);
        $arrUser = $objUser->toArray();
        if($data->getHttpAccept() == 'json') {
            RestUtils::sendResponse(200, json_encode($arrUser), 'application/json');  
        }
        //check xml fuctionality
        else if ($data->getHttpAccept() == 'xml') {
            // using the XML_SERIALIZER Pear Package  
            $options = array  
            (  
                'indent' => '     ',  
                'addDecl' => false,
                XML_SERIALIZER_OPTION_RETURN_RESULT => true  
            );  
            $serializer = new XML_Serializer($options);  
            RestUtils::sendResponse(200, $serializer->serialize($array), 'application/xml');  
        }  
        break;
    case 'post':
        $user = new User();
        $user->setEmail($_POST["email"]);
        $user->setName($_POST["name"]);
        $user->save();
        RestUtils::sendResponse(200, json_encode((array)$user->getEmail()), 'application/json');
        break;
}
?>
