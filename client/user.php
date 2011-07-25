<!DOCTYPE HTML>
<html>

<head>
	
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

</head>

<body id="home">
                test
                Post
				<form name="register" action="http://ec2-79-125-49-128.eu-west-1.compute.amazonaws.com/greentiger/api/user.php" method="post">
   		 			    UserId: <input type="text" name="userId" />
                        Email: <input type="text" name="email" maxlength="30" />
    					Name: <input type="text" name="name" />
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
