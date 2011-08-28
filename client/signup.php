<?php
    function include_get_contents($path) {
        ob_start();
        include($path);
        return ob_get_clean();
    }
    
    $page_content = include_get_contents("./include/signup_content.php");
    $page_header = include_get_contents("./include/signup_header.php");
    include('master.php');
?>