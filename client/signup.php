<?php
    $sessionManager = gitContext::getSessionManager();
    $idpAssertion = $sessionManager->getAssertion();
    $page_content = file_get_contents("./include/signup_content.php");
    $page_header = file_get_contents("./include/signup_header.php");
    include('master.php');
?>