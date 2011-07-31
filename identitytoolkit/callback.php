<?php
require "../classes/rest.php";
require "../classes/definition.php";
require "../classes/user.php";
?>
<script type="text/javascript" src="../js/jquery.greentiger.js"></script>
    <script type="text/javascript" src="../js/jquery.js"></script>
    <script type="text/javascript" src="../js/jquery.toObject.js"></script>
    <script type="text/javascript" src="../js/form2object.js"></script>
	<script type="text/javascript">
    function addFormRow(){ 
        var newrow = document.createElement('article');
        var counter = document.getElementsByClassName('formRow').length;
		newrow.innerHTML = '<div class="formRow">Name: <input type="text" name="content[' + counter + '].name" value="" /> Description: <input type="text" name="content[' + counter + '].description" value="" /> Type: <select name="content[' + counter + '].type"><option value="text">Text</option><option value="textarea">Textarea</option><option value="email">Email</option><option value="checkbox">Checkbox</option><option value="radio">Radio button</option><option value="date">Date</option><option value="range">Range</option><option value="url">URL</option><option value="number">Number</option><option value="time">Time</option><option value="dropdown">Drop Down</option></select></div>';
		document.getElementById("section").appendChild(newrow);
    }  
	</script>
<?php

$data = RestUtils::processRequest();  
$arrRequestVars = $data->getRequestVars();
echo '<script type="text/javascript">var obj = jQuery.parseJSON('{"openid_ns":"hej"}');alert("test" + obj.openid_ns)</script>';
?>