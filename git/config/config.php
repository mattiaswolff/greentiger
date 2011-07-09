<?php

/**
 * The configuration for the relying party site customization.
 */
$gitConfig = array(
  // The API key in the Google API console.
  'apiKey' => 'AIzaSyDmeRvH3KgT5sqzp7j2k1b6592VRtWVTJw',
  // The default URL after the user is logged in.
  'homeUrl' => 'http://jinhuidu.bej.corp.google.com/phpclient/index.php?route=account/account',
  // The user signup page.
  'signupUrl' => 'http://jinhuidu.bej.corp.google.com/phpclient/index.php?route=account/create',
  // Scan the these absolute directories when finding the implementations e.g. account service and
  // session manager. The multiple directories should be separated by a ,
  'externalClassPaths' => '/home/dujinhui/phpclient/google3/experimental/users/dujinhui/opencart/impl',
  // The class name that implements the gitAccountService interface. You can also set the
  // implementation instance by leaving it empty and invoking the setter method in the gitContext
  // class. NOTE: The class name should be the same as the file name without the '.php' suffix.
  'accountService' => 'AccountServiceImpl',
  // The class name that implements the gitSessionManager interface. Same as the account service,
  // there is a setter method in the gitContext class. NOTE: the class name should be the same as
  // the file name without the '.php' suffix.
  'sessionManager' => 'SessionManagerImpl',
);
