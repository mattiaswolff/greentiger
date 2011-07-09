<?php
/**
 * The page to handle the user login requests. The identity toolkit widget posts requests to this
 * page.
 */
require_once('autoload.php');

class gitLoginHandler {
  private $action;
  private $email;
  private $password;

  public function __construct($action, $email, $password) {
    $this->action = $action;
    $this->email = $email;
    $this->password = $password;
  }

  public function execute() {
    if (empty($this->action)) {
      $this->handleLogin();
    } else {
      $this->handleAction();
    }
  }

  private function handleLogin() {
    $action = new gitLoginAction();
    $request = new gitLoginRequest($this->email, $this->password);
    $response = new gitLoginResponse();
    $logic = new gitLoginLogic($action);
    $logic->run($request, $response);
    $error = $response->getError();
    if (!empty($error)) {
      gitUtil::sendError($error);
    } else {
      header(sprintf('Content-type: %s', $response->getContentType()));
      echo $response->getOutput();
    }
  }

  private function handleAction() {
    if ($this->action == 'useVerifiedEmail') {
      $json = array();
      if (empty($this->email) || !gitUtil::isValidEmail($this->email)) {
        $json['status'] = 'invalidRequest';
      } else {
        $json['email'] = $this->email;
        $assertion = gitContext::getSessionManager()->getAssertion();
        if (empty($assertion)) {
          $json['status'] = 'sessionTimeout';
        } else {
          $verifiedEmail = $assertion->getVerifiedEmail();
          if ($this->email != $verifiedEmail) {
            $json['status'] = 'invalidRequest';
          } else {
            $account = gitContext::getAccountService()->getAccountByEmail($this->email);
            if (empty($account)) {
              $json['status'] = 'emailNotExist';
            } else {
              if ($account->getAccountType() == gitAccount::LEGACY) {
                gitContext::getAccountService()->toFederated($this->email);
                $account = gitContext::getAccountService()->getAccountByEmail($this->email);
              }
              gitContext::getSessionManager()->setAssertion(NULL);
              gitContext::getSessionManager()->setSessionAccount($account);
              $json['status'] = 'ok';
            }
          }
        }
      }
      header('Content-type: application/json');
      echo json_encode($json);
    } else if ($this->action == 'resetIdpAssertion') {
      gitContext::getSessionManager()->setAssertion(NULL);
    } else {
      gitUtil::sendError(sprintf('Invalid param action: %s'), $this->action);
    }
  }
}
