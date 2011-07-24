<?php
require "../classes/rest.php";
require "../classes/user.php";

$data = RestUtils::processRequest();  

switch($data->getMethod()) {  
    // this is a request for all users, not one in particular  
    case 'get':
        echo var_dump($data);
        echo $data->getData()['email'];
        if (isset($_GET['email'])) {
            $objUser = new User($_GET['email']);
            $arrUser = $objUser->toArray();
            RestUtils::sendResponse(200, $arrUser, 'json');
        }
        else {
            $arrResults = User::get();
            RestUtils::sendResponse(200, $arrResults, 'json');
        }
        break;
    case 'post':
        
        $user = new User();
        $user->setEmail($_POST["email"]);
        $user->setName($_POST["name"]);
        $user->save();
        RestUtils::sendResponse(200, (array)$user->getEmail(), 'json');
        break;
    case 'put':
        echo var_dump($data);
        break;
    case 'delete':
        echo 'delete';
        echo var_dump($data);
        
        break;
}
?>
