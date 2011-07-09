<?php
/**
 * The action class to set the login responses. The responses will be sent back to the identity
 * toolkit widget.
 */

class gitLoginAction {
  public function sendErrorEmptyEmail($request, $response) {
    $response->setStatus(gitLoginResponse::STATUS_ERROR)
        ->setErrorCode(gitLoginResponse::ERROR_EMPTY_EMAIL);
    $response->setOutput($response->toJson(), 'application/json');
  }

  public function sendErrorEmailFormat($request, $response) {
    $response->setStatus(gitLoginResponse::STATUS_ERROR)
        ->setErrorCode(gitLoginResponse::ERROR_EMAIL_FORMAT)
        ->setEmail($request->getEmail());
    $response->setOutput($response->toJson(), 'application/json');
  }

  public function sendErrorUnregistered($request, $response) {
    $response->setStatus(gitLoginResponse::STATUS_ERROR)
        ->setErrorCode(gitLoginResponse::ERROR_EMAIL_NOT_EXIST)
        ->setEmail($request->getEmail())
        ->setAccountType($request->getAccountType());
    $response->setOutput($response->toJson(), 'application/json');
  }

  public function sendErrorPassword($request, $response) {
    $response->setStatus(gitLoginResponse::STATUS_ERROR)
        ->setErrorCode(gitLoginResponse::ERROR_PASSWORD)
        ->setEmail($request->getEmail())
        ->setAccountType($request->getAccountType());
    $response->setOutput($response->toJson(), 'application/json');
  }

  public function sendErrorFederatedWithPassword($request, $response) {
    $account = $request->getAccount();
    $response->setStatus(gitLoginResponse::STATUS_ERROR)
        ->setErrorCode(gitLoginResponse::ERROR_FEDERATED_WITH_PASSWORD)
        ->setEmail($request->getEmail())
        ->setAccountType($request->getAccountType())
        ->setRegistered(!empty($account));
    $response->setOutput($response->toJson(), 'application/json');
  }

  public function sendOk($request, $response) {
    $response->setStatus(gitLoginResponse::STATUS_OK)
        ->setEmail($request->getEmail())
        ->setAccountType($request->getAccountType())
        ->setUpgrade($request->getDomainFederated());
    $response->setOutput($response->toJson(), 'application/json');
  }

  public function sendNeedFederated($request, $response) {
    $response->setStatus(gitLoginResponse::STATUS_NEED_FEDERATED_LOGIN)
        ->setAccountType($request->getAccountType())
        ->setEmail($request->getEmail())
        ->setDomain(gitUtil::getEmailDomain($request->getEmail()))
        ->setRegistered(!!$request->getAccount());
    $response->setOutput($response->toJson(), 'application/json');
  }

  public function setLegacyTab($request, $response) {
    setcookie('defaultTab', '1st', time() + 3600 * 24 * 365, '/');
  }

  public function login($request, $response) {
    gitContext::getSessionManager()->setSessionAccount($request->getAccount());
  }
}
