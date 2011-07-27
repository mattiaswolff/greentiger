<!DOCTYPE HTML>
<html>

<head>
	
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <script type="text/javascript" src="../js/jquery.js"></script>
    <script type="text/javascript">	
        $(document).ready(function(){
    	    $.getJSON("http://ec2-79-125-49-128.eu-west-1.compute.amazonaws.com/greentiger/api/user.php", { userId: <?php echo '"'. $_GET['userId'] .'"' ?> }, function(json) {
                $("#name").val(json.users[0].name);
                $("#email").val(json.users[0].email);
                $("#userId").val(json.users[0]._id);
            });
	    });
    </script>
</head>

<body id="home">
				<form>
   		 			    UserId: <input id="userId" type="text" name="userId" />
                        Name: <input id="name" type="text" name="name" />
                        Email: <input id="email" type="text" name="email" maxlength="30" />
				</form>
</body>
</html>      
