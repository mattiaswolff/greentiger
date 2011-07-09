<?php

require "./1.php";
require "../classes/task.php";

$data = RestUtils::processRequest();  

switch($data->getMethod()) {  
    // this is a request for all users, not one in particular  
    case 'get':  
    $suggestions = getTask("Suggestion"); // assume this returns an array  
	$array = iterator_to_array (  $suggestions );
	$data->getHttpAccept = 'json';
        if($data->getHttpAccept == 'json')  
        {
            RestUtils::sendResponse(200, json_encode($array), 'application/json');  
        }
  
        else if ($data->getHttpAccept == 'xml')  
        {
            // using the XML_SERIALIZER Pear Package  
            $options = array  
            (  
                'indent' => '     ',  
                'addDecl' => false,  
                'rootName' => $fc->getAction(),  
                XML_SERIALIZER_OPTION_RETURN_RESULT => true  
            );  
	
            $serializer = new XML_Serializer($options);  
  	
            RestUtils::sendResponse(200, $serializer->serialize($array), 'application/xml');  
        }  

        break;
}
?>
