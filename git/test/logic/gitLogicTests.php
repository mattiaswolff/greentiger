<?php
 
class gitLogicTests extends PHPUnit_Framework_TestSuite {
  public static function suite() {
    $suite = new PHPUnit_Framework_TestSuite();
    $suite->setName('Google identity toolkit logic tests');
    $path = realpath('.');

    foreach (glob("$path/*Test.php") as $file) {
      if (is_readable($file)) {
        require_once($file);
        $className = str_replace('.php', '', basename($file));
        $suite->addTestSuite($className);
      }
    }
    return $suite;
  }

}
