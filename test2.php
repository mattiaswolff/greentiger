<!DOCTYPE HTML>
<html>

<head>
	
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

	<title>Project Copperfield</title>
	
	<link rel="stylesheet" type="text/css" href="/css/main.css" />
	<script type="text/javascript" src="/js/jquery.js"></script>
	<script type="text/javascript" src="/js/autoresize.jquery.min.js"></script>
	<script type="text/javascript">
	$(document).ready(function(){
		var jsonObjects = [{method : "identitytoolkit.relyingparty.createAuthUrl", id : "identitytoolkit.relyingparty.createAuthUrl", params : { continueUrl : "http://ec2-46-51-156-7.eu-west-1.compute.amazonaws.com/git/login.php?rp_purpose=signin" , identifier : "gmail.com" }, jsonrpc : "2.0", key : "identitytoolkit.relyingparty.createAuthUrl", apiVersion : "v1"}];
		$.post(
			"https://www.googleapis.com/rpc?key=AIzaSyD_mpU7Xw4GeTmQNqHgIuZFVyPXdOyj6qY", 
			{JSON.stringify(jsonObjects)},
			function(data){
				console.log(data.name); // John
				console.log(data.time); //  2pm
			});
	});
 
	</script>   
</head>
<body id="home">
	<?php 
	echo "test7";
	?>
</body>
</html>
