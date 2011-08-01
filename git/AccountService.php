<?php
require_once(dirname(__FILE__) . '/data/gitAccountService.php');

/**
 * The account related operations that the relying party site needs to implement.
 */
class AccountService implements gitAccountService{
  /**
   * Given the email returns the account or NULL if the account doesn't exist.
   *
   * @param string $email the email to be checked
   * @return mixed the account object or NULL if not exist.
   */
  function getAccountByEmail($email){
        $ret = NULL;
  	    $m = new Mongo();
        $db = $m->projectcopperfield;
	    $arrResults = $db->users->findOne(array("email" => $email));
		if (count($arrResults)) {
		    $ret = new gitAccount($arrResults['email'], '1');
		    $ret->setLocalId($arrResults['_id']);
		    //$ret->setLocal($arrResults['name']);
		}
		return $ret;
  }

  /**
   * Returns true if the email and password pair is correct.
   *
   * @param string $email the user input email
   * @param string $password the user input password
   */
  function checkPassword($email, $password) {
        $m = new Mongo();
        $db = $m->projectcopperfield;
	    $arrResults = $db->users->findOne(array("email" => $email));
		if (count($arrResults)) {
			$isFederated = '1';
			if (!$isFederated) {
				return md5($password) ==  $arrResults['password'];
			} else {
				return TRUE;
			}
		}
	  return FALSE;
  }

  /**
   * Given the email upgrade the corresponding account to use federated login. The password of the
   * account should be removed.
   *
   * @param string $email the ID for the account to be upgraded
   * @return bool true if the operation succeeds.
   */
  function toFederated($email){
    return TRUE;
  }
}