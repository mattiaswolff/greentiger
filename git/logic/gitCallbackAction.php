<?php
/**
 * The action class to generate the responses.
 */

class gitCallbackAction {
  public function saveAssertion($request, $response) {
    gitContext::getSessionManager()->setAssertion($request->getAssertion());
  }

  public function setFederatedTab($request, $response) {
    setcookie('defaultTab', '2nd', time() + 3600 * 24 * 365, '/');
  }

  public function sendErrorMismatch($request, $response) {
    $HTML = "<html>\n<head>\n<script type='text/javascript'>"
        . "\nfunction notify() {\n  window.opener.google.identitytoolkit.easyrp.util.notifyWidget("
        . "'accountMismatch', %s);\n  window.close();\n}"
        . "\n</script>\n</head>\n<body onload='notify();'>\n</body>\n</html>";
    
    $result = array();
    $result['validatedEmail'] = $request->getAssertion()->getVerifiedEmail();
    $result['inputEmail'] = $request->getInputEmail();
    $result['purpose'] = $request->getPurpose();
    $response->setOutput(sprintf($HTML, json_encode($result)));
  }

  private function getRedirectionPage($url) {
    $HTML = "<html>\n<head>\n<script type='text/javascript'>"
        . "\nfunction notify() {\n  window.opener.location.href='%s';\n  window.close();\n}"
        . "\n</script>\n</head>\n<body onload='notify();'>\n</body>\n</html>";
    return sprintf($HTML, $url);
  }

  public function showHomePage($request, $response) {
    $response->setOutput($this->getRedirectionPage(gitContext::getConfig()->getHomeUrl()));
  }

  public function showNewAccountPage($request, $response) {
    $response->setOutput($this->getRedirectionPage(gitContext::getConfig()->getSignupUrl()));
  }

  public function upgrade($request, $response) {
    $verifiedEmail = $request->getAssertion()->getVerifiedEmail();
    gitContext::getAccountService()->toFederated($verifiedEmail);
    // Update the account info in the session.
    $account = gitContext::getAccountService()->getAccountByEmail($verifiedEmail);
    if (!empty($account)) {
      gitContext::getSessionManager()->setSessionAccount($account);
    }
  }

  public function login($request, $response) {
    gitContext::getSessionManager()->setSessionAccount($request->getAccount());
  }
}
