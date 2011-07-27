<!DOCTYPE HTML>
<html>

<head>
    
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <script type="text/javascript" src="../js/jquery.js"></script>
	<script type="text/javascript">	
    function send(){
		$.ajax({
        type: "POST",
        url: "http://ec2-79-125-49-128.eu-west-1.compute.amazonaws.com/greentiger/api/definition.php?userId=matwo065",
        dataType: 'json',
        data: {'name': 'testdesc', 'description': 'testdescription', 'content' : { '0' : {'name' : 'testName', 'description' : 'TestDescr', 'type' : 'text'}},
        success: function(msg){
            alert( "Data Saved: " + msg );
        }
        });
    }
	</script>

</head>

<body id="home">
                test2
                Post
				<form name="register" action="http://ec2-79-125-49-128.eu-west-1.compute.amazonaws.com/greentiger/api/definition.php?userId=matwo065" method="post">
   		 			    Name: <input type="text" name="name" maxlength="30" />
    					Desc: <input type="text" name="description" />
    					<input type="submit" value="Register" />
				</form>
                
                <span onclick="send()">Send</span>

</body>
</html>      
