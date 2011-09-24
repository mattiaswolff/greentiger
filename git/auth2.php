<?php
require "../classes/user.php";
session_start();
echo "test: " . print_r($_SESSION);

if (isset($_SESSION['userId'])) {?>
<script type="text/javascript" src="//ajax.googleapis.com/jsapi"></script>
<script type="text/javascript">
  google.load("identitytoolkit", "1.0", {packages: ["ac"]});
</script>
    <script type='text/javascript'>
        var userData = { email: 'name@idp.com', displayName: 'User Name', photoUrl: 'http://website.com/img/user.png'}; window.google.identitytoolkit.updateSavedAccount(userData); 
    </script>
    <?php
}
?>