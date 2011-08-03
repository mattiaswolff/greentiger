<!DOCTYPE HTML>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <script type="text/javascript" src="../js/jquery.js"></script>
    <script type="text/javascript" src="../js/jquery.greentiger.js"></script>
    <script type="text/javascript" src="../js/jquery.toObject.js"></script>
    <script type="text/javascript" src="../js/form2object.js"></script>
    <script type="text/javascript">	
        strUserId = "<?php echo $_GET['userId'] ?>";
        $(document).ready(function(){
            var strAccessToken = '';
            $.each(location.hash.substring(1).split('&'), function (key, value) { 
                if (value.split('=')[0] == 'access_token') { 
                    strAccessToken = value.split('=')[1];  
                } 
            });
            if (strAccessToken == '') {
                var uri="http://ec2-79-125-49-128.eu-west-1.compute.amazonaws.com/greentiger/client/user.php";
                window.location.href = "http://ec2-79-125-49-128.eu-west-1.compute.amazonaws.com/greentiger/git/test.php?clientId=4e36a30fcdb4bf1d69000002&redirectUri=" + encodeURI(uri) + "&responseType=token";
            }
            if (strUserId != '' ) {
                var strUrl = "http://ec2-79-125-49-128.eu-west-1.compute.amazonaws.com/greentiger/api/users/" + strUserId;
                $.getJSON(strUrl, { access_token : strAccessToken}, function(json) {
                    $.each(json.definitions, function(key, value) {
                        var counter = document.getElementsByClassName('definitionRow').length;
                        var strNewRow = document.createElement('div');
                        strNewRow.innerHTML = '<div class="definitionRow"><a href="http://ec2-79-125-49-128.eu-west-1.compute.amazonaws.com/greentiger/api/user.php?definitionId=' + value.id + '">' + value.name + '</a> <input name="definitions[' + counter + '].state" type="radio" value="private" /> <input name="definitions[' + counter + '].state" type="radio" value="public" /></div>';
                        document.getElementById("definitions").appendChild(strNewRow);
                    });
                });
                //.error(function() { var uri="http://ec2-79-125-49-128.eu-west-1.compute.amazonaws.com/greentiger/client/user.php"; window.location.href = "http://ec2-79-125-49-128.eu-west-1.compute.amazonaws.com/greentiger/git/test.php?clientId=4e36a30fcdb4bf1d69000002&redirectUri=" + encodeURI(uri) + "&responseType=token"; });
            }
            $('#submit').click(function() {
                var strSubmitUrl = 'http://ec2-79-125-49-128.eu-west-1.compute.amazonaws.com/greentiger/api/users/' + strUserId;
                submitFormJSON(strSubmitUrl, 'PUT');
            });     
	    });
        
        
    </script>
</head>

<body id="home">
    
    <section>
        User
			<form id ="definitions">
            </form>
            <span id="submit">Save user</span>
    <section>
</body>
</html>