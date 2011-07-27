<!DOCTYPE HTML>
<html>

<head>
	
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <script type="text/javascript" src="../js/jquery.js"></script>
    <script type="text/javascript">	
        $(document).ready(function(){
    	    $.getJSON("http://ec2-79-125-49-128.eu-west-1.compute.amazonaws.com/greentiger/api/user.php", { userId: <?php echo '"'. $_GET['userId'] .'"' ?> }, function(json) {
                $("#name").val(json.users[0].name);
            });
	    });
    </script>
</head>

<body id="home">
                test
                Post
				<form name="register" action="http://ec2-79-125-49-128.eu-west-1.compute.amazonaws.com/greentiger/api/user.php" method="post">
   		 			    UserId: <input id="userId" type="text" name="userId" />
                        Email: <input id="email" type="text" name="email" maxlength="30" />
    					Name: <input id="name" type="text" name="name" />
    					<input type="submit" value="Register" />
				</form>
                
                Put
    			<form name="register" action="http://ec2-79-125-49-128.eu-west-1.compute.amazonaws.com/greentiger/api/user.php" method="put">
   		 			    Email: <input type="text" name="emailput" maxlength="30" />
    					Name: <input type="text" name="nameput" />
    					<input type="submit" value="Update" />
				</form>
                
                Delete
                <form name="delete" action="http://ec2-79-125-49-128.eu-west-1.compute.amazonaws.com/greentiger/api/user.php" method="delete">
   		 			    Email: <input type="text" name="emaildelete" maxlength="30" />
    					<input type="submit" value="delete" />
				</form>
</body>
</html>      
