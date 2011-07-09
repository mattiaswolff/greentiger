<?php
/**
 * Wrapper for the login responses. It builds the JSON response which is sent back to the identity
 * toolkit widget.
 */

class gitLoginResponse extends gitAbstractResponse {
  const STATUS_OK = 'ok';
  const STATUS_ERROR = 'error';
  const STATUS_NEED_FEDERATED_LOGIN = 'needFed';

  const ERROR_EMPTY_EMAIL = 'emptyEmail';
  const ERROR_EMAIL_FORMAT = 'emailFormatError';
  const ERROR_EMAIL_NOT_EXIST = 'emailNotExist';
  const ERROR_FEDERATED_WITH_PASSWORD = 'fedWithPassword';
  const ERROR_PASSWORD = 'passwordError';

  const ACCOUNT_TYPE_FEDERATED = 'FEDERATED';
  const ACCOUNT_TYPE_LEGACY = 'LEGACY';

  private $email;
  private $status;
  private $accountType;
  private $registered;
  private $loginUrl;
  private $errorCode;
  private $domain;
  private $upgrade;

  private $json = array();

  public function setEmail($email) {
    $this->email = $email;
    $this->json['email'] = $email;
    return $this;
  }

  public function setStatus($status) {
    $this->status = $status;
    $this->json['status'] = $status;
    return $this;
  }

  public function setAccountType($accountType) {
    $this->accountType = $accountType;
    $this->json['type'] = $accountType;
    return $this;
  }

  public function setRegistered($registered) {
    $this->registered = $registered;
    $this->json['exist'] = !!$registered;
    return $this;
  }

  public function setLoginUrl($loginUrl) {
    $this->loginUrl = $loginUrl;
    $this->json['url'] = $loginUrl;
    return $this;
  }

  public function setErrorCode($errorCode) {
    $this->errorCode = $errorCode;
    $this->json['message'] = $errorCode;
    return $this;
  }

  public function setDomain($domain) {
    $this->domain = $domain;
    $this->json['domain'] = $domain;
    return $this;
  }

  public function setUpgrade($upgrade) {
    $this->upgrade = $upgrade;
    $this->json['upgrade'] = !!$upgrade;
    return $this;
  }

  public function toJson() {
    return json_encode($this->json);
  }
}
