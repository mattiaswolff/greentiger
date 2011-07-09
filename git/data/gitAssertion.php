<?php
/**
 * The assertion returned by the IDP.
 */
 
class gitAssertion {
  private $firstName;
  private $lastName;
  private $verifiedEmail;

  public function __construct($verifiedEmail) {
    $this->verifiedEmail = strtolower($verifiedEmail);
  }

  public function getVerifiedEmail() {
    return $this->verifiedEmail;
  }

  public function getFirstName() {
    return $this->firstName;
  }

  public function setFirstName($firstName) {
    $this->firstName = $firstName;
  }

  public function getLastName() {
    return $this->lastName;
  }

  public function setLastName($lastName) {
    $this->lastName = $lastName;
  }
  
  public function __toString() {
    $obj = array('verifiedEmail' => $this->verifiedEmail,
        'firstName' => $this->firstName, 'lastName' => $this->lastName);
    return json_encode($obj);
  }
  
  public static function fromString($json) {
    $obj = json_decode($json);
    if (!empty($obj) && !empty($obj->verifiedEmail)) {
      $ret = new gitAssertion($obj->verifiedEmail);
      if (!empty($obj->firstName)) {
        $ret->setFirstName($obj->firstName);
      }
      if (!empty($obj->lastName)) {
        $ret->setLastName($obj->lastName);
      }
      return $ret;
    }
    return NULL;
  }
}
