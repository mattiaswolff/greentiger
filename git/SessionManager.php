<?php
/**
 * A simple implementation for the SessionManager.
 */
class SessionManager implements gitSessionManager {
  private $config;
  private $accountService;

  public function __construct(gitConfig $config, gitAccountService $accountService) {
    $this->config = $config;
    $this->accountService = $accountService;
  }

  /**
   * Gets the logged in account in the current session.
   * @return mixed the logged in account or NULL if there is no account logged in.
   */
  public function getSessionAccount() {
    if (isset($this->config->sessionUserKey) && isset($_SESSION[$this->config->sessionUserKey])) {
      return $this->accountService->getAccountByEmail($_SESSION[$this->config->sessionUserKey]);
    }
    return NULL;
  }

  /**
   * Saves the logged account information to the session and logs the user in. If parameter is NULL,
   * the account in the session should be removed.
   * @param mixed $account the account which should be logged in.
   */
  public function setSessionAccount($account) {
        session_start();
        $_SESSION['email'] = $account->getEmail();
        $_SESSION['userId'] = $account->getLocalId();
  }

  /**
   * Gets the IDP assertion for the request.
   * @return mixed the IDP assertion
   */
  public function getAssertion() {
    $idpAssertionKey = $this->config->getIdpAssertionKey();
    if (isset($idpAssertionKey) && isset($_SESSION[$idpAssertionKey])) {
      return gitAssertion::fromString($_SESSION[$idpAssertionKey]);
    }
    return NULL;
  }

  /**
   * Saves the IDP assertion information to the session. If parameter is NULL, the data in the
   * session should be cleared.
   * @param mixed $assertion the data to be saved.
   */
  public function setAssertion($assertion) {
    session_start();
    $idpAssertionKey = $this->config->getIdpAssertionKey();
    $_SESSION[$idpAssertionKey] = (string)$assertion;
  }
}