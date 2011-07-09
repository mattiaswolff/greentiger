<?php
/**
 * The relying party account data model.
 */
 
class gitAccount {
  const FEDERATED = 'FEDERATED';
  const LEGACY = 'LEGACY';
  private $email;
  private $accountType;
  private $localId;

  public function __construct($email, $accountType) {
    $this->email = $email;
    $this->accountType = self::LEGACY;
    if ($accountType == self::FEDERATED) {
      $this->accountType = self::FEDERATED;
    }
  }

  public function getAccountType() {
    return $this->accountType;
  }

  public function getEmail() {
    return $this->email;
  }

  public function setAccountType($accountType) {
    if ($accountType == self::FEDERATED) {
      $this->accountType = self::FEDERATED;
    } else if ($accountType == self::LEGACY) {
      $this->accountType = self::LEGACY;
    }
  }
  
  public function setLocalId($value) {
    $this->localId = $value;
  }

  public function getLocalId() {
    return $this->localId;
  }
}
