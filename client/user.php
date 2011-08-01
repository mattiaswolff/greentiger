<!DOCTYPE HTML>
<html>
<head>
	
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <script type="text/javascript" src="../js/jquery.js"></script>
    <script type="text/javascript" src="../js/jquery.greentiger.js"></script>
    <script type="text/javascript" src="../js/jquery.toObject.js"></script>
    <script type="text/javascript" src="../js/form2object.js"></script>
    <script type="text/javascript">	
        $(document).ready(function(){
            var strUserId = getParameterByName("userId"); 
            if (getParameterByName("userId") != "" ) {
                $.getJSON("http://ec2-79-125-49-128.eu-west-1.compute.amazonaws.com/greentiger/api/user.php", { userId: <?php echo (isset($_GET['userId']) ? '"'. $_GET['userId'] .'"' : '""' ) ?> }, function(json) {
                    $("#name").val(json.users[0].name);
                    $("#email").val(json.users[0].email);
                    $("#userId").val(json.users[0]._id);
                    $.each(json.users[0].definitions, function(key, value) {
                        var strNewRow = document.createElement('div');
                        strNewRow.innerHTML = '<a href="http://ec2-79-125-49-128.eu-west-1.compute.amazonaws.com/greentiger/api/user.php?definitionId=' + key + '">' + value.name + '</a> <input name="state" type="radio" value="private" /> <input name="state" type="radio" value="public" />';
                        document.getElementById("definitions").appendChild(strNewRow);
                    });
                });
            }
	    });
        
        function submitDefinitions() {
            var objFormValues = {};
            objFormValues.userId = "matwo065";
            objFormValues.definitions = {};
            $.each($('#definitions').serializeArray(), function(key,value) {
                objFormValues['definitions'][value.name] = value.value;
            });
            $.ajax({
                type: "PUT",
                url: "http://ec2-79-125-49-128.eu-west-1.compute.amazonaws.com/greentiger/api/user.php",
                dataType: 'json',
                data: objFormValues,
                success: function(msg) {
                    alert( "Data Saved!");
                }
            });
        }
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
    <?php session_start(); echo var_dump($_SESSION); ?>
</body>
</html>