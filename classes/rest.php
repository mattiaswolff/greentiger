<?php
class RestUtils
{  
    public static function processRequest()
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
  
    public static function sendResponse($status = 200, $arrObject = '', $strContentType = 'text/html') {  
        $status_header = 'HTTP/1.1 ' . $status . ' ' . RestUtils::getStatusCodeMessage($status);  
        // set the status  
        header($status_header);  
        // set the content type  
        header('Content-type: application/' . $strContentType);  
        $body = RestUtils::getReplayBody($arrObject, $strContentType)
        // pages with body are easy  
        if($body != '')  
        {    
            echo $body;  
            exit;  
        }    
        else  
        {    
            $message = '';   
            switch($status)  
            {  
                case 401:  
                    $message = 'You must be authorized to view this page.';  
                    break;  
                case 404:  
                    $message = 'The requested URL ' . $_SERVER['REQUEST_URI'] . ' was not found.';  
                    break;  
                case 500:  
                    $message = 'The server encountered an error processing your request.';  
                    break;  
                case 501:  
                    $message = 'The requested method is not implemented.';  
                    break;  
            }  
  
            // servers don't always have a signature turned on (this is an apache directive "ServerSignature On")  
            $signature = ($_SERVER['SERVER_SIGNATURE'] == '') ? $_SERVER['SERVER_SOFTWARE'] . ' Server at ' . $_SERVER['SERVER_NAME'] . ' Port ' . $_SERVER['SERVER_PORT'] : $_SERVER['SERVER_SIGNATURE'];  
  
            // this should be templatized in a real-world solution  
            $body = '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">  
                        <html>  
                            <head>  
                                <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">  
                                <title>' . $status . ' ' . RestUtils::getStatusCodeMessage($status) . '</title>  
                            </head>  
                            <body>  
                                <h1>' . RestUtils::getStatusCodeMessage($status) . '</h1>  
                                <p>' . $message . '</p>  
                                <hr />  
                                <address>' . $signature . '</address>  
                            </body>  
                        </html>';  
            
            echo $body;  
            exit;  
        }  
    }  
    public static function getReplayBody($arrObject, $strContentType) {
        if ($strContentType == 'json') {
            $body = json_encode($arrObject);
        else if ($strContentType == 'xml') {
            $options = array  
            (  
                'indent' => '     ',  
                'addDecl' => false,
                XML_SERIALIZER_OPTION_RETURN_RESULT => true  
            );  
            $serializer = new XML_Serializer($options);
            $body = $serializer->serialize($arrObject);
        else {
            $body = '';
        }
        return $body;
    }
    public static function getStatusCodeMessage($status)  
    {  
        // these could be stored in a .ini file and loaded  
        // via parse_ini_file()... however, this will suffice  
        // for an example  
        $codes = Array(  
            100 => 'Continue',  
            101 => 'Switching Protocols',  
            200 => 'OK',  
            201 => 'Created',  
            202 => 'Accepted',  
            203 => 'Non-Authoritative Information',  
            204 => 'No Content',  
            205 => 'Reset Content',  
            206 => 'Partial Content',  
            300 => 'Multiple Choices',  
            301 => 'Moved Permanently',  
            302 => 'Found',  
            303 => 'See Other',  
            304 => 'Not Modified',  
            305 => 'Use Proxy',  
            306 => '(Unused)',  
            307 => 'Temporary Redirect',  
            400 => 'Bad Request',  
            401 => 'Unauthorized',  
            402 => 'Payment Required',  
            403 => 'Forbidden',  
            404 => 'Not Found',  
            405 => 'Method Not Allowed',  
            406 => 'Not Acceptable',  
            407 => 'Proxy Authentication Required',  
            408 => 'Request Timeout',  
            409 => 'Conflict',  
            410 => 'Gone',  
            411 => 'Length Required',  
            412 => 'Precondition Failed',  
            413 => 'Request Entity Too Large',  
            414 => 'Request-URI Too Long',  
            415 => 'Unsupported Media Type',  
            416 => 'Requested Range Not Satisfiable',  
            417 => 'Expectation Failed',  
            500 => 'Internal Server Error',  
            501 => 'Not Implemented',  
            502 => 'Bad Gateway',  
            503 => 'Service Unavailable',  
            504 => 'Gateway Timeout',  
            505 => 'HTTP Version Not Supported'  
        );  
  
        return (isset($codes[$status])) ? $codes[$status] : '';  
    }
}  
  
class RestRequest  
{  
    private $request_vars;  
    private $data;  
    private $http_accept;  
    private $method;  
  
    public function __construct()  
    {  
        $this->request_vars      = array();  
        $this->data              = '';  
        $this->http_accept       = 'json';//(strpos($_SERVER['HTTP_ACCEPT'], 'json')) ? 'json' : 'xml';  
        $this->method            = 'get';  
    }  
  
    public function setData($data)  
    {  
        $this->data = $data;  
    }  
  
    public function setMethod($method)  
    {  		
        $this->method = $method;  
    }  
  
    public function setRequestVars($request_vars)  
    {  
        $this->request_vars = $request_vars;  
    }  
  
    public function getData()  
    {  
        return $this->data;  
    }  
  
    public function getMethod()  
    {  
        return $this->method;  
    }  
  
    public function getHttpAccept()  
    {  
        return $this->http_accept;  
    }  
  
    public function getRequestVars()  
    {  
        return $this->request_vars;  
    }  
}
?>