<?php

/**
 * The configuration for the relying party site customization.
 */
$gitConfig = array(
  // The API key in the Google API console.
  'apiKey' => 'AIzaSyDmeRvH3KgT5sqzp7j2k1b6592VRtWVTJw',
  // The default URL after the user is logged in.
  'homeUrl' => 'http://ec2-79-125-49-128.eu-west-1.compute.amazonaws.com/greentiger/git/auth.php',
  // The user signup page.
  'signupUrl' => 'http://ec2-79-125-49-128.eu-west-1.compute.amazonaws.com/greentiger/client/definition.php',
  // Scan the these absolute directories when finding the implementations e.g. account service and
  // session manager. The multiple directories should be separated by a ,
  'externalClassPaths' => '/var/www/html/greentiger/git',
  // The class name that implements the gitAccountService interface. You can also set the
  // implementation instance by leaving it empty and invoking the setter method in the gitContext
  // class. NOTE: The class name should be the same as the file name without the '.php' suffix.
  'accountService' => 'AccountService',
  // The class name that implements the gitSessionManager interface. Same as the account service,
  // there is a setter method in the gitContext class. NOTE: the class name should be the same as
  // the file name without the '.php' suffix.
  'sessionManager' => 'SessionManager',
);
