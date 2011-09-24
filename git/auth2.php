<?php

require "../classes/user.php";
session_start();

if (isset($_SESSION['userId'])) {
    $objUser = new User($_SESSION['userId']); ?>
    <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
    <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jqueryui/1.8.2/jquery-ui.min.js"></script>
    <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/googleapis/0.0.4/googleapis.min.js"></script>
    <script type="text/javascript" src="//ajax.googleapis.com/jsapi"></script>
    <script type="text/javascript">
        google.load("identitytoolkit", "1.0", {packages: ["ac"]});
    </script>
    <script type='text/javascript'>
        var userData = { email: "<?php echo $objUser->getEmail(); ?>", displayName: "<?php echo $objUser->getName();?>", photoUrl: 'http://website.com/img/user.png'};
        window.google.identitytoolkit.updateSavedAccount(userData); 
    </script>
    <?php
}


?>