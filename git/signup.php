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
    <section>
        User
				<form>
   		 			    UserId: <input id="userId" type="text" name="userId" value="" /><br/>
                        Name: <input id="name" type="text" name="name" value="" /><br/>
                        Email: <input id="email" type="text" name="email" maxlength="30" value="" /><br/>
				</form>
                <span onClick="submitFormJSON('http://ec2-79-125-49-128.eu-west-1.compute.amazonaws.com/greentiger/api/users', 'POST')">Save user</span>
    <section>
    <?php
require_once(dirname(__FILE__) . '/handler/gitLoginHandler.php');
require_once(dirname(__FILE__) . '/util/gitConfig.php');
require_once(dirname(__FILE__) . '/util/gitApiClient.php');
require_once(dirname(__FILE__) . '/util/gitContext.php');
require_once(dirname(__FILE__) . '/AccountService.php');
require_once(dirname(__FILE__) . '/SessionManager.php');

class ContextLoader{
    public static function load() {
    $config = new gitConfig();
    $config->setApiKey('AIzaSyBwylS6nmQZCKvan4qpnbpndgPFNjwHzxk');
    $config->setHomeUrl('http://www.openidsamplestore.com/basic/index.php?route=account/account');
    $config->setSignupUrl('http://www.openidsamplestore.com/basic/index.php?route=account/create');
    $config->sessionUserKey = 'customer_id';
    $config->idpAssertionKey = 'idpAssertion';
    gitContext::setConfig($config);
    gitContext::setAccountService(new AccountService());
    gitContext::setSessionManager(new SessionManager());
    
    }
}
?>
    <?php 
        ContextLoader::load();
        $sessionManager = gitContext::getSessionManager(gitContext::getConfig);
        $idpAssertion = $sessionManager->getAssertion();
        echo var_dump($idpAssertion);
    ?> 
</body>
</html>


