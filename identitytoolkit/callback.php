<?php
class gitConfig {
  private $config;

  private function loadConfigFile() {
    global $gitConfig;
    $gitConfig = array(
        // The API key in the Google API console.
        'apiKey' => 'AIzaSyDmeRvH3KgT5sqzp7j2k1b6592VRtWVTJw',
        // The default URL after the user is logged in.
  'homeUrl' => '',
  // The user signup page.
  'signupUrl' => '',
  // Scan the these absolute directories when finding the implementations e.g. account service and
  // session manager. The multiple directories should be separated by a ,
  'externalClassPaths' => '',
  // The class name that implements the gitAccountService interface. You can also set the
  // implementation instance by leaving it empty and invoking the setter method in the gitContext
  // class. NOTE: The class name should be the same as the file name without the '.php' suffix.
  'accountService' => 'AccountServiceImpl',
  // The class name that implements the gitSessionManager interface. Same as the account service,
  // there is a setter method in the gitContext class. NOTE: the class name should be the same as
  // the file name without the '.php' suffix.
  'sessionManager' => 'SessionManagerImpl',
);
    foreach($gitConfig as $key => $value) {
      $this->config[$key] = $value;
    }
  }
  
  public function __construct($loadConfigFile = false) {
   $this->config = array();
    if ($loadConfigFile) {
      $this->loadConfigFile();
    }
  }

  private function get($key) {
    if (isset($this->config[$key])) {
      return $this->config[$key];
    } else {
      return NULL;
    }
  }

  private function set($key, $value) {
    $this->config[$key] = $value;
  }

  public function setHomeUrl($value) {
    return $this->set('homeUrl', $value);
  }

  public function getHomeUrl() {
    return $this->get('homeUrl');
  }

  public function setSignupUrl($value) {
    return $this->set('signupUrl', $value);
  }

  public function getSignupUrl() {
    return $this->get('signupUrl');
  }

  public function setApiKey($value) {
    return $this->set('apiKey', $value);
  }

  public function getApiKey() {
    return $this->get('apiKey');
  }

  public function getExtensionClassPaths() {
    return $this->get('externalClassPaths');
  }

  public function getAccountServiceName() {
    return $this->get('accountService');
  }

  public function getSessionManagerName() {
    return $this->get('sessionManager');
  }
}

class gitContext {
  private static $dasherDomainChecker = false;
  private static $apiClient = false;
  private static $config = false;
  private static $accountService = false;
  private static $sessionManager = false;

  private static function loadExternal($className) {
    $config = self::getConfig();
    $paths = explode(',', $config->getExtensionClassPaths());
    foreach ($paths as $path) {
      if (!empty($path) && $path[strlen($path) - 1] != '/') {
        $path .= '/';
      }
      $fileName = $path . $className . '.php';
      if (file_exists($fileName)) {
        require_once($fileName);
        return true;
      }
    }
    return false;
  }

  /**
   * Returns the account service instance which is implemented by the relying party site.
   * @static
   * @return mixed account service instance if it's created successfully otherwise false.
   */
  public static function getAccountService() {
    if (!self::$accountService) {
      $className = self::getConfig()->getAccountServiceName();
      if (self::loadExternal($className)) {
        self::$accountService = new $className;
      }
    }
    return self::$accountService;
  }

  /**
   * Sets the account service.
   */
  public static function setAccountService($accountService) {
    self::$accountService = $accountService;
  }

  /**
   * Returns the session manager instance which is implemented by the relying party site.
   * @static
   * @return mixed session manager instance if it's created successfully otherwise false.
   */
  public static function getSessionManager() {
    if (!self::$sessionManager) {
      $className = self::getConfig()->getSessionManagerName();
      if (self::loadExternal($className)) {
        self::$sessionManager = new $className;
      }
    }
    return self::$sessionManager;
  }

  /**
   * Sets the session manager instance.
   */
  public static function setSessionManager($sessionManager) {
    self::$sessionManager = $sessionManager;
  }

  public static function getDasherDomainChecker() {
    if (empty(self::$dasherDomainChecker)) {
      self::$dasherDomainChecker = new gitDasherDomainChecker();
    }
    return self::$dasherDomainChecker;
  }

  public static function setDasherDomainChecker($dasherDomainChecker) {
    self::$dasherDomainChecker = $dasherDomainChecker;
  }

  public static function setConfig($config) {
    self::$config = $config;
  }

  public static function getConfig() {
    if (empty(self::$config)) {
      self::$config = new gitConfig(true);
    }
    return self::$config;
  }

  public static function getApiClient() {
    if (empty(self::$apiClient)) {
      self::$apiClient = new gitApiClient(self::getConfig()->getApiKey());
    }
    return self::$apiClient;
  }
}

class gitUtil {
  private static $EMAIL_PATTERN = '/\w+(\.\w+)*@(\w+(\.\w+)+)/';

  private static $FEDERATED_DOMAINS = array(
    // Gmail
    'gmail.com', 'googlemail.com',
    // Aol
    'aol.com', 'aim.com', 'netscape.net', 'cs.com',
    'ygm.com', 'games.com', 'love.com', 'wow.com',
    // Yahoo
    'yahoo.com', 'rocketmail.com', 'ymail.com', 'y7mail.com',
    'yahoo.com.au', 'yahoo.com.cn', 'yahoo.cn', 'yahoo.com.hk',
    'yahoo.co.nz', 'yahoo.com.pk', 'yahoo.com.tw', 'kimo.com',
    'bellsouth.net', 'ameritech.net', 'att.net', 'attworld.com',
    'flash.net', 'nvbell.net', 'pacbell.net', 'prodigy.net',
    'sbcglobal.net', 'snet.net', 'swbell.net', 'wans.net',
    'btinternet.com', 'btopenworld.com', 'talk21.com', 'rogers.com',
    'nl.rogers.com', 'demobroadband.com', 'xtra.co.nz', 'verizon.net',
    // Hotmail
    'hotmail.com', 'hotmail.co.uk', 'hotmail.fr',
    'hotmail.it', 'live.com', 'msn.com');

  public static function getCurrentUrl() {
    $url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') ? 'https://' : 'http://';
    $url .= $_SERVER['SERVER_NAME'];
    if ($_SERVER['SERVER_PORT'] != '80') {
      $url .= $_SERVER['SERVER_PORT'];
    }
    $url .= $_SERVER["REQUEST_URI"];
    return $url;
  }

  public static function sendError($message) {
    exit('Error: ' . $message);
  }

  public static function isValidEmail($email) {
    return preg_match(gitUtil::$EMAIL_PATTERN, $email);
  }

  public static function getEmailDomain($email) {
    $email = strtolower(trim($email));
    $parts = explode('@', $email);
    if (count($parts) > 1) {
      return $parts[1];
    }
    return $parts[0];
  }

  public static function isFederatedDomain($domain) {
    if (in_array($domain, gitUtil::$FEDERATED_DOMAINS)) {
      return true;
    }
    return gitContext::getDasherDomainChecker()->isDasherDomain($domain);
  }
}
class gitAssertion {
  private $firstName;
  private $lastName;
  private $verifiedEmail;
  private $identifier;
  private $photoUrl;
  private $nickName;
  private $fullName;

  public function __construct($identifier, $verifiedEmail) {
    $this->identifier = $identifier;
    if (!empty($verifiedEmail)) {
      $this->verifiedEmail = strtolower($verifiedEmail);
    }
  }

  public function getIdentifier() {
    return $this->identifier;
  }

  public function getVerifiedEmail() {
    return $this->verifiedEmail;
  }

  public function getFirstName() {
    return $this->firstName;
  }

  public function setFirstName($firstName) {
    $this->firstName = $firstName;
  }

  public function getLastName() {
    return $this->lastName;
  }

  public function setLastName($lastName) {
    $this->lastName = $lastName;
  }

  public function getPhotoUrl() {
    return $this->photoUrl;
  }

  public function setPhotoUrl($photoUrl) {
    $this->photoUrl = $photoUrl;
  }

  public function getNickName() {
    return $this->nickName;
  }

  public function setNickName($nickName) {
    $this->nickName = $nickName;
  }

  public function getFullName() {
    return $this->fullName;
  }

  public function setFullName($fullName) {
    $this->fullName = $fullName;
  }

  public function getDisplayName() {
    if ($this->nickName != '') {
      return $this->nickName;
    } else if ($this->fullName != '') {
      return $this->fullName;
    } else if ($this->firstName != '') {
      return $this->firstName;
    } else if ($this->lastName != '') {
      return $this->lastName;
    }
    return '';
  }

  public function __toString() {
    $obj = array('verifiedEmail' => $this->verifiedEmail,
                 'firstName' => $this->firstName,
                 'lastName' => $this->lastName,
                 'fullName' => $this->fullName,
                 'nickName' => $this->nickName,
                 'identifier' => $this->identifier,
                 'photoUrl' => $this->photoUrl);
    return json_encode($obj);
  }
  
  public static function fromString($json) {
    $obj = json_decode($json);
    if (!empty($obj) && !empty($obj->identifier)) {
      $ret = new gitAssertion($obj->identifier, $obj->verifiedEmail);
      if (!empty($obj->firstName)) {
        $ret->setFirstName($obj->firstName);
      }
      if (!empty($obj->lastName)) {
        $ret->setLastName($obj->lastName);
      }
      if (!empty($obj->photoUrl)) {
        $ret->setPhotoUrl($obj->photoUrl);
      }
      if (!empty($obj->nickName)) {
        $ret->setNickName($obj->nickName);
      }
      if (!empty($obj->fullName)) {
        $ret->setFullName($obj->fullName);
      }
      return $ret;
    }
    return NULL;
  }
}

class gitApiClient {
  private static $VERIFY_URL = 'https://www.googleapis.com/identitytoolkit/v1/relyingparty/verifyAssertion?key=';
  private $apiKey = 'AIzaSyD_mpU7Xw4GeTmQNqHgIuZFVyPXdOyj6qY';

  public function __construct($apiKey) {
    $this->apiKey = $apiKey;
  }
  
  private function post($postData) {
    $ch = curl_init();
    curl_setopt_array($ch, array(
        CURLOPT_URL => gitApiClient::$VERIFY_URL . $this->apiKey,
        CURLOPT_RETURNTRANSFER => 1,
        CURLOPT_HTTPHEADER => array('Content-Type: application/json'),
        CURLOPT_POSTFIELDS => json_encode($postData),
        CURLOPT_SSL_VERIFYPEER => FALSE,
        CURLOPT_SSL_VERIFYHOST => FALSE));

    $response = curl_exec($ch);
    $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    if ($http_code == '200' && !empty($response)) {
      return json_decode($response, true);
    } else {
      return NULL;
    }
  }

  /**
   * Sends request to the identity toolkit API endpoint to verify the IDP response.
   *
   * @param string $url The URL which is requested by the IDP.
   * @param string $postBody The post body which is posted by the IDP.
   * @return mixed: parsed raw user identity object from authentication server's HTTP response.
   */
  public function verify($url, $postBody) {
    $request = array();
    $request['requestUri'] = $url;
    $request['postBody'] = $postBody;

    $response = $this->post($request);
    if (!empty($response)) {
      if (empty($response['identifier'])) {
        return NULL;
      }
      $verifiedEmail = NULL;
      if (isset($response['verifiedEmail'])) {
        $verifiedEmail = $response['verifiedEmail'];
      }
      $assertion = new gitAssertion($response['identifier'], $verifiedEmail);
      if (!empty($response['firstName'])) {
        $assertion->setFirstName($response['firstName']);
      }
      if (!empty($response['lastName'])) {
        $assertion->setLastName($response['lastName']);
      }
      if (!empty($response['profilePicture'])) {
        $assertion->setPhotoUrl($response['profilePicture']);
      }
      if (!empty($response['fullName'])) {
        $assertion->setFullName($response['fullName']);
      }
      if (!empty($response['nickName'])) {
        $assertion->setNickName($response['nickName']);
      }
      return $assertion;
    }
    return NULL;
  }
}

class gitCallbackHandler {
    private $email;
    private $purpose;
    private $url;
    private $idpResponse;

    public function __construct($email, $purpose, $url, $idpResponse) {
        $this->email = $email;
        $this->purpose = $purpose;
        $this->url = $url;
        $this->idpResponse = $idpResponse;
    }

    public function execute() {
        $apiClient = gitContext::getApiClient();
        $assertion = $apiClient->verify($this->url, $this->idpResponse);
        if (empty($assertion)) {
            echo "<html>\n<head>\n</head>\n<body onload='window.close();'>\n</body>\n</html>";
        } 
        else if ($assertion->getVerifiedEmail() == '') {
            echo "<html>\n<head>\n</head>\n<body>Error: Your email is not owned by the site you have logged in. We can not connect your account.\n</body>\n</html>";
        } 
        else {
            echo var_dump($assertion);
            /*$request = new gitCallbackRequest($this->email, $this->purpose, $assertion);
            $response = new gitCallbackResponse();
            $action = new gitCallbackAction();
            $logic = new gitCallbackLogic($action);
            $logic->run($request, $response);
            $error = $response->getError();
            if (!empty($error)) {
                gitUtil::sendError($error);
            } 
            else {
                header(sprintf('Content-type: %s', $response->getContentType()));
                echo $response->getOutput();
            }*/
        }
    }
}

$inputEmail = isset($_GET['rp_input_email']) ? $_GET['rp_input_email'] : '';
$purpose = isset($_GET['rp_purpose']) ? $_GET['rp_purpose'] : '';
$url = gitUtil::getCurrentUrl();
$idpResponse = @file_get_contents('php://input');

$handler = new gitCallbackHandler($inputEmail, $purpose, $url, $idpResponse);
$handler->execute();
