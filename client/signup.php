<?php
    require_once('../git/handler/gitLoginHandler.php');
    require_once('../git/util/gitConfig.php');
    require_once('../git/util/gitApiClient.php');
    require_once('../git/util/gitContext.php');
    require_once('../git/AccountService.php');
    require_once('../git/SessionManager.php');
 
    $sessionManager = gitContext::getSessionManager();
    $idpAssertion = $sessionManager->getAssertion();
    $page_content = file_get_contents("./include/signup_content.php");
    $page_header = file_get_contents("./include/signup_header.php");
    include('master.php');
?>