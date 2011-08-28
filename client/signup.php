<?php
    function include_get_contents($path) {
        ob_start();
        include($path);
        return ob_get_clean();
    }
    $page_content = ob_get_clean("./include/signup_content.php");
    $page_header = ob_get_clean("./include/signup_header.php");
    include('master.php');
?>