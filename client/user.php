<!DOCTYPE HTML>
<html>
<head>
	<?php session_start(); ?>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <script type="text/javascript" src="../js/jquery.js"></script>
    <script type="text/javascript" src="../js/jquery.greentiger.js"></script>
    <script type="text/javascript" src="../js/jquery.toObject.js"></script>
    <script type="text/javascript" src="../js/form2object.js"></script>
    <script type="text/javascript">	
        $(document).ready(function(){
            var strAccessToken = '';
            var strUserId = getParameterByName("userId"); 
            $.each(location.hash.substring(1).split('&'), function (key, value) { 
                if (value.split('=')[0] == 'access_token') { 
                    strAccessToken = value.split('=')[1];  
                } 
            });
            if (strUserId != '' ) {
                var strUrl = "http://ec2-79-125-49-128.eu-west-1.compute.amazonaws.com/greentiger/api/users/" + strUserId;
                $.getJSON(strUrl, { access_token : strAccessToken}, function(json) {
                    $("#name").val(json.name);
                    $("#email").val(json.email);
                    $("#userId").val(json._id);
                    $("#redirect_uri").val(json.redirect_uri);
                    $("#client_id").val(json.client_id);
                });
                //.error(function() { var uri="http://ec2-79-125-49-128.eu-west-1.compute.amazonaws.com/greentiger/client/user.php"; window.location.href = "http://ec2-79-125-49-128.eu-west-1.compute.amazonaws.com/greentiger/git/test.php?clientId=4e36a30fcdb4bf1d69000002&redirectUri=" + encodeURI(uri) + "&responseType=token"; });
            }
	    });
    </script>
</head>

<body id="home">
    
    <section>
        User
			<form>
                General<br/>
   		 	    UserId: <input id="userId" type="text" name="userId" value="" readonly="readonly"/><br/>
                Name: <input id="name" type="text" name="name" value="" /><br/>
                Email: <input id="email" type="email" name="email" maxlength="30" value="" /><br/>
                Developer<br/>
                Redirect Uri: <input id="redirect_uri" type="url" name="redirect_uri" maxlength="200" value="" /><br/>
			    Your developer id is: <input id="client_id" type="text" name="client_id" maxlength="200" value="" readonly="readonly" /><br/>
            </form>
            <span onClick=<?php echo (!isset($_GET['userId']) ? '"' . "submitFormJSON('http://ec2-79-125-49-128.eu-west-1.compute.amazonaws.com/greentiger/api/users', 'POST')" . '"' : '"' . "submitFormJSON('http://ec2-79-125-49-128.eu-west-1.compute.amazonaws.com/greentiger/api/users/" . $_GET['userId'] ."', 'PUT')" . '"' ); ?>>Save user</span>
    <section>
</body>
</html>