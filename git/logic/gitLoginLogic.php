<?php
/**
 * The logic to handle the cases. It collects the input params and the current account status then
 * make decision to call the action class to generate the response.
 */

class gitLoginLogic {
  private $action;
  public function __construct($action) {
    $this->action = $action;
  }

  public function run($request, $response) {
    $email = $request->getEmail();
    $password = $request->getPassword();
    // Check whether the email param is valid.
    if (empty($email)) {
      $this->action->sendErrorEmptyEmail($request, $response);
    } else if (!gitUtil::isValidEmail($email)) {
      $this->action->sendErrorEmailFormat($request, $response);
    } else {
      $account = gitContext::getAccountService()->getAccountByEmail($request->getEmail());
      $request->setAccount($account);
      $isFederatedDomain = gitUtil::isFederatedDomain(gitUtil::getEmailDomain($email));
      $request->setDomainFederated($isFederatedDomain);

      // Check whether the email exists.
      if (empty($account)) {
        // Check whether the domain is a federated domain.
        if ($isFederatedDomain) {
          $this->federated($request, $response);
        } else {
          $this->action->sendErrorUnregistered($request, $response);
        }
      } else {
        if ($account->getAccountType() == gitAccount::FEDERATED) {
          $this->federated($request, $response);
        } else {
          if (empty($password)) {
            // Check whether the account can be upgraded.
            if ($isFederatedDomain) {
              $this->action->sendNeedFederated($request, $response);
            } else {
              $this->action->sendErrorPassword($request, $response);
            }
          } else {
            // Check whether the password is correct.
            if (gitContext::getAccountService()->checkPassword($email, $password)) {
              $this->action->setLegacyTab($request, $response);
              $this->action->login($request, $response);
              $this->action->sendOk($request, $response);
            } else {
              $this->action->sendErrorPassword($request, $response);
            }
          }
        }
      }
    }
  }

  private function federated($request, $response) {
    $password = $request->getPassword();
    if (empty($password)) {
      $this->action->sendNeedFederated($request, $response);
    } else {
      $this->action->sendErrorFederatedWithPassword($request, $response);
    }
  }
}
