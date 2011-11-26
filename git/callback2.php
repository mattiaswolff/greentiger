<?php
  require "../classes/user.php";
  $url = EasyRpService::getCurrentUrl();
  $postData = @file_get_contents('php://input');
  $result = EasyRpService::verify($url, $postData);
class EasyRpService {
  private static $SERVER_URL = "https://www.googleapis.com/identitytoolkit/v1/relyingparty/verifyAssertion?key=AIzaSyD_mpU7Xw4GeTmQNqHgIuZFVyPXdOyj6qY";

  public static function getCurrentUrl() {
    $url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') ? 'https://' : 'http://';
    $url .= $_SERVER['SERVER_NAME'];
    if ($_SERVER['SERVER_PORT'] != '80') {
      $url .= $_SERVER['SERVER_PORT'];
    }
    $url .= $_SERVER["REQUEST_URI"];
    return $url;
  }

  private static function post($postData) {
    $ch = curl_init();
    curl_setopt_array($ch, array(
      CURLOPT_URL => EasyRpService::$SERVER_URL,
      CURLOPT_RETURNTRANSFER => 1,
      CURLOPT_HTTPHEADER => array('Content-Type: application/json'),
      CURLOPT_POSTFIELDS => json_encode($postData)));
    $response = curl_exec($ch);
    $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    if ($http_code == '200' && !empty($response)) {
        return json_decode($response, true);
    }
    return NULL;
  }
  
  public static function verify($continueUrl, $response) {
    $request = array();
    $request['requestUri'] = $continueUrl;
    $request['postBody'] = $response;
    $result = EasyRpService::post($request);
    echo var_dump($result);
    if ($result["verifiedEmail"]) {
        $email = $result["verifiedEmail"];
        }
    else {
        $email = $result["email"];
    }
    if (!empty($email)) {
        $m = new Mongo();
        $db = $m->projectcopperfield;   
        $arrResults = $db->users->findOne(array("email" => $result['verifiedEmail']));
        $strUserId = $arrResults["_id"];
        if ($strUserId == null) {
            echo "test";
            $user = new User();
            $user->setId();
            $user->setName($result["displayName"]);
            $user->setEmail($email);
            $strUserId = $user->upsert();
        }
        session_start();
        $_SESSION["userId"] = $strUserId;
        //print
        echo  "<script type='text/javascript' src='https://ajax.googleapis.com/jsapi'></script><script type='text/javascript'>google.load('identitytoolkit', '1.0', {packages: ['notify']});</script><script type='text/javascript'>window.google.identitytoolkit.notifyFederatedSuccess({'email': '" . $result["verifiedEmail"] ."', 'registered': true });</script>";
        return "OK";
    }
    return NULL;
  }
}
?>