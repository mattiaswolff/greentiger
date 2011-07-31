<?php
require "../classes/rest.php";
require "../classes/definition.php";
require "../classes/user.php";

$data = RestUtils::processRequest();  
$arrRequestVars = $data->getRequestVars();

echo JSON_encode($arrRequestVars);
echo '<script type="text/javascript">var obj = jQuery.parseJSON(' . JSON_encode($arrRequestVars) . ');alert("test" + obj.openid_ns)</script>';
?>