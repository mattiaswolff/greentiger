<!DOCTYPE HTML>
<html>
<head>
    
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <script type="text/javascript" src="../js/jquery.js"></script>
    <script type="text/javascript" src="../js/jquery.greentiger.js"></script>
    <script type="text/javascript">	
        $(document).ready(function(){
            var strUserId = getParameterByName("userId"); 
            var strDefinitionId = getParameterByName("definitionId");
            var strUrl = "http://ec2-79-125-49-128.eu-west-1.compute.amazonaws.com/greentiger/api/definitions/" + strDefinitionId;
            $.getJSON(strUrl, function(json) {
                $.each(json.definitions[0].content, function(key, value) {
                    var strNewRow = document.createElement('article');
                    var counter = document.getElementsByClassName('formRow').length;
                    strNewRow.innerHTML = getHtmlTaskRow(value.name, value.description, value.type, counter);
                    document.getElementById("definitions").appendChild(strNewRow);
                });
            });
                    
            if (getParameterByName("userId") != "" ) {
                var strUrl = "http://ec2-79-125-49-128.eu-west-1.compute.amazonaws.com/greentiger/api/tasks/" + strUserId;
                $.getJSON(strUrl, function(json) {
                    $.each(json.users[0].definitions, function(key, value) {
                        var strNewRow = document.createElement('div');
                        strNewRow.innerHTML = '<a href="http://ec2-79-125-49-128.eu-west-1.compute.amazonaws.com/greentiger/api/user.php?definitionId=' + key + '">' + value.name + '</a> <input name="state" type="radio" value="private" /> <input name="state" type="radio" value="public" />';
                        document.getElementById("definitions").appendChild(strNewRow);
                    });
                });
            }
	    });
    </script>
</head>

<body id="home">
    <section>
        User
				<form>
   		 			    UserId: <input id="userId" type="text" name="userId" value=""<?php echo (isset($_GET['userId']) ? 'readonly="readonly"' : '') ?> /><br/>
                        Name: <input id="name" type="text" name="name" value="" /><br/>
                        Email: <input id="email" type="text" name="email" maxlength="30" value="" /><br/>
				</form>
                <span onClick=<?php echo (!isset($_GET['userId']) ? '"' . "submitFormJSON('http://ec2-79-125-49-128.eu-west-1.compute.amazonaws.com/greentiger/api/users', 'POST')" . '"' : '"' . "submitFormJSON('http://ec2-79-125-49-128.eu-west-1.compute.amazonaws.com/greentiger/api/users/" . $_GET['userId'] ."', 'PUT')" . '"' ); ?>>Save user</span>
    <section>
        Definitions12
    			<form id="definitions">
				</form>
                <span onClick="submitDefinitions()">Save definitions</span>
    </section>            
</body>
</html>