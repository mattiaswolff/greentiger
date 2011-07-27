<!DOCTYPE HTML>
<html>
<head>
	
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <script type="text/javascript" src="../js/jquery.js"></script>
    <script type="text/javascript">	
        $(document).ready(function(){
            alert(getParameterByName("userId"));
    	    $.getJSON("http://ec2-79-125-49-128.eu-west-1.compute.amazonaws.com/greentiger/api/user.php", { userId: <?php echo '"'. $_GET['userId'] .'"' ?> }, function(json) {
                $("#name").val(json.users[0].name);
                $("#email").val(json.users[0].email);
                $("#userId").val(json.users[0]._id);
            });
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
    </script>
</head>

<body id="home">
				<form>
   		 			    UserId: <input id="userId" type="text" name="userId" value=""<?php echo (isset($_GET['userId']) ? 'readonly="readonly"' : '') ?> /><br/>
                        Name: <input id="name" type="text" name="name" value="" /><br/>
                        Email: <input id="email" type="text" name="email" maxlength="30" value="" /><br/>
				</form>
                <span onClick="submitForm()">Submit</span>
</body>
</html>      
