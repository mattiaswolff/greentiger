<?php
/**
 * The callback logic to handle the various cases.
 */

class gitCallbackLogic {
  private $action;

  public function __construct($action) {
    $this->action = $action;
  }

  public function run($request, $response) {
    $purpose = $request->getPurpose();
    if (!empty($purpose) && $purpose != 'signin' && $purpose != 'upgrade') {
      $response->setError('Invalid param rp_purpose.');
      return;
    }

    $inputEmail = $request->getInputEmail();
    $assertion = $request->getAssertion();
    $verifiedEmail = $assertion->getVerifiedEmail();
    if (empty($purpose) || $purpose == 'signin') {
      // Check whether the user input email matches the email in the IDP assertion.
      if (!empty($inputEmail) && ($inputEmail != $verifiedEmail)) {
        $this->action->saveAssertion($request, $response);
        $this->action->sendErrorMismatch($request, $response);
      } else {
        $this->action->setFederatedTab($request, $response);
        // Check whether the email already exists.
        $account = gitContext::getAccountService()->getAccountByEmail($verifiedEmail);
        $request->setAccount($account);
        if (empty($account)) {
          $this->action->saveAssertion($request, $response);
          $this->action->showNewAccountPage($request, $response);
        } else {
          if ($account->getAccountType() != gitAccount::FEDERATED) {
            $this->action->upgrade($request, $response);
            $account->setAccountType(gitAccount::FEDERATED);
            $request->setAccount($account);
          }
          $this->action->login($request, $response);
          $this->action->showHomePage($request, $response);
        }
      }
    } else if ($purpose == 'upgrade') {
      $account = gitContext::getSessionManager()->getSessionAccount($verifiedEmail);
      if (empty($account)) {
        $response->setError(sprintf('The email: %s has not logged in.', $verifiedEmail));
      } else if ($account->getEmail() != $verifiedEmail) {
        $this->action->sendErrorMismatch($request, $response);
      } else {
        $this->action->upgrade($request, $response);
        $this->action->setFederatedTab($request, $response);
        $this->action->showHomePage($request, $response);
      }
    }
  }
}
