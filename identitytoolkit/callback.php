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
    function postJSON(strUrl, strJson){ 
        var objJSON = jQuery.parseJSON(strJson);
        $.ajax({
                type: "POST",
                url: strUrl,
                dataType: "json",
                data: objJSON,
                success: function(msg) {
                    alert( "Data Saved!");
                }
        });
    }
	</script>
<?php

$data = RestUtils::processRequest();  
$arrRequestVars = $data->getRequestVars();
echo '<script type="text/javascript">postJSON("https://www.googleapis.com/identitytoolkit/v1/relyingparty/verifyAssertion?key=AIzaSyD_mpU7Xw4GeTmQNqHgIuZFVyPXdOyj6qY&callback=?",' . "'" . JSON_encode($arrRequestVars) . "'" . ');</script>'
?>