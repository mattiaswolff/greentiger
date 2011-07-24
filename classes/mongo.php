<?php
class MongoUtils
{  
    public static function validate()
    {  
        $request_method = strtolower($_SERVER['REQUEST_METHOD']);  //get request type (GET, POST, etc.)
        $return_obj = new RestRequest(); //create new request object    
        $data = array();  
    
        switch ($request_method)
        {
            case 'get':  
                $data = $_GET;     
                break;  
            case 'post':  
                $data = $_POST;  
                break;
            case 'put':  
                // basically, we read a string from PHP's special input location,  
                // and then parse it out into an array via parse_str... per the PHP docs:  
                // Parses str as if it were the query string passed via a URL and sets  
                // variables in the current scope.  
                parse_str(file_get_contents('php://input'), $put_vars);  
                $data = $put_vars;  
                break;  
        }  
  
        $return_obj->setMethod($request_method);
        $return_obj->setRequestVars($data);  
  
        if(isset($data['data']))  
        {    
            $return_obj->setData(json_decode($data['data'])); // translate the JSON to an Object for use however you want  
        }  
        
        return $return_obj;  
    }    
}  
?>