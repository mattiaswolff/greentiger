<?php
   require_once(dirname(__FILE__) . '/handler/gitLoginHandler.php');
        require_once(dirname(__FILE__) . '/util/gitConfig.php');
        require_once(dirname(__FILE__) . '/util/gitApiClient.php');
        require_once(dirname(__FILE__) . '/util/gitContext.php');
        require_once(dirname(__FILE__) . '/AccountService.php');
        require_once(dirname(__FILE__) . '/SessionManager.php');
 
    $sessionManager = gitContext::getSessionManager();
    $idpAssertion = $sessionManager->getAssertion();
    $page_content = file_get_contents("./include/signup_content.php");
    $page_header = file_get_contents("./include/signup_header.php");
    include('master.php');
?>