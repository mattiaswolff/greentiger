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
        
        function submitForm() {
            var objFormValues = {};
            $.each($('form').serializeArray(), function(key,value) {
                objFormValues[value.name] = value.value;
            });
            console.log(objFormValues);
            $.ajax({
                type: "POST",
                url: <?php echo '"http://ec2-79-125-49-128.eu-west-1.compute.amazonaws.com/greentiger/api/definition.php?userId=' . $_GET["userId"] . '"'?>,
                dataType: 'json',
                data: objFormValues,
                success: function(msg) {
                    alert( "Data Saved: " + msg );
                }
            });
        }
    </script>
</head>

<body id="home">
				<form>
   		 			    UserId: <input id="userId" type="text" name="userId" value="" /><br/>
                        Name: <input id="name" type="text" name="name" value="" /><br/>
                        Email: <input id="email" type="text" name="email" maxlength="30" value="" /><br/>
				</form>
                <span onClick="submitForm()">Submit</span>
</body>
</html>      
