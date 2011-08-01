<?php
/**
 * A simple implementation for the SessionManager.
 */
class SessionManager implements gitSessionManager {
  /**
   * Gets the logged in account in the current session.
   * @return mixed the logged in account or NULL if there is no account logged in.
   */
  public function getSessionAccount() {
    /*$customer = $this->registry->get('customer');
  	if ($customer->isLogged()) {
  		$ret = new gitAccount($customer->getEmail(), $customer->getAccountType());
  		$ret->setLocalId($customer->getId());
  	  return $ret;
  	}*/
  	return NULL;
  }

  /**
   * Saves the logged account information to the session and logs the user in. If parameter is NULL,
   * the account in the session should be removed.
   * @param mixed $account the account which should be logged in.
   */
  public function setSessionAccount($account) {
  	if (empty($account)) {
  		unset($_SESSION['userId']);
  	} else {
  	  $_SESSION['userId'] = $account->getLocalId();
  	}
  }

  /**
   * Gets the IDP assertion for the request.
   * @return mixed the IDP assertion
   */
  public function getAssertion() {
  	if (isset($_SESSION['idpAssertion'])) {
  	  return gitAssertion::fromString($_SESSION['idpAssertion']);
  	}
  	return NULL;
  }

  /**
   * Saves the IDP assertion information to the session. If parameter is NULL, the data in the
   * session should be cleared.
   * @param mixed $assertion the data to be saved.
   */
  public function setAssertion($assertion) {
  	$_SESSION['idpAssertion'] = (string)$assertion;
  }
}
