<?php

require_once('logic/gitLogicTests.php');
class AllTests {
  public static function suite() {
    $suite = new PHPUnit_Framework_TestSuite();
    $suite->setName('All Google Identity Toolkit tests');
    $suite->addTestSuite(gitLogicTests::suite());
    return $suite;
  }
}
