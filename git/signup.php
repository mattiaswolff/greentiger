<!DOCTYPE HTML>
<html>
<head>
    
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <script type="text/javascript" src="../js/jquery.js"></script>
    <script type="text/javascript" src="../js/jquery.greentiger.js"></script>
    <script type="text/javascript" src="../js/jquery.toObject.js"></script>
    <script type="text/javascript" src="../js/form2object.js"></script>
    </script>
</head>

<body id="home">
    <?php
        require_once(dirname(__FILE__) . '/handler/gitLoginHandler.php');
        require_once(dirname(__FILE__) . '/util/gitConfig.php');
        require_once(dirname(__FILE__) . '/util/gitApiClient.php');
        require_once(dirname(__FILE__) . '/util/gitContext.php');
        require_once(dirname(__FILE__) . '/AccountService.php');
        require_once(dirname(__FILE__) . '/SessionManager.php');
    ?>
    
    <?php 
        $sessionManager = gitContext::getSessionManager();
        $idpAssertion = $sessionManager->getAssertion();
    ?>
    <section>
        User
				<form>
   		 			    Name: <input type="text" name="name" maxlength="30" value="<?php echo $idpAssertion->getFirstName() . ' ' . $idpAssertion->getLastName(); ?>" /><br/>
                        Email: <input type="text" name="email" value="<?php echo $idpAssertion->getVerifiedEmail(); ?>" /><br/>
                        UserId: <input id="userId" type="text" name="userId" value="" /><br/>
				</form>
                <span onClick="submitFormJSON('http://ec2-79-125-49-128.eu-west-1.compute.amazonaws.com/greentiger/api/users', 'POST')">Save user</span>
    <section>
</body>
</html>