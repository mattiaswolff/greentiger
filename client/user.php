<!DOCTYPE HTML>
<html>
<head>
	
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <script type="text/javascript" src="../js/jquery.js"></script>
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
        
        function getParameterByName(name) {
            name = name.replace(/[\[]/, "\\\[").replace(/[\]]/, "\\\]");
            var regexS = "[\\?&]" + name + "=([^&#]*)";
            var regex = new RegExp(regexS);
            var results = regex.exec(window.location.href);
            if(results == null)
                return "";
            else
            return decodeURIComponent(results[1].replace(/\+/g, " "));
        }
        
        function submitForm() {
            var objFormValues = {};
            $.each($('form').serializeArray(), function(key,value) {
                objFormValues[value.name] = value.value;
            });
            $.ajax({
                type: <?php echo (isset($_GET['userId']) ? '"PUT"' : '"POST"') ?>,
                url: "http://ec2-79-125-49-128.eu-west-1.compute.amazonaws.com/greentiger/api/user.php",
                dataType: 'json',
                data: objFormValues,
                success: function(msg) {
                    alert( "Data Saved!");
                }
            });
        }
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
                <span onClick="submitForm()">Save user</span>
    </section>
    <section>
        Definitions
    			<form id="definitions">
				</form>
                <span onClick="submitDefinitions()">Save definitions</span>
    </section>            
</body>
</html>