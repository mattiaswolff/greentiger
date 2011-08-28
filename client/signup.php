<?php
    require_once('../git/handler/gitLoginHandler.php');
    require_once('../git/util/gitConfig.php');
    require_once('../git/util/gitApiClient.php');
    require_once('../git/util/gitContext.php');
    require_once('../git/AccountService.php');
    require_once('../git/SessionManager.php');
 
    $sessionManager = gitContext::getSessionManager();
    $idpAssertion = $sessionManager->getAssertion();
    $page_content = include("./include/signup_content.php");
    $page_header = include("./include/signup_header.php");
    include('master.php');
?>