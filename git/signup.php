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
        require_once('SessionManager.php');
        require_once('session/gitSessionManager.php');
        session_start(); 
        echo ($_SESSION['']);
        echo ($_SESSION['']['email']);
        $assertion = SessionManager::getAssertion();
        echo var_dump($assertion);
    ?> 
</body>
</html>