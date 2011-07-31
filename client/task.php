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
        Task
				<form id ="definitions"></form>
    <?php if (!isset($_GET['taskId'])) {
            echo '<span onClick="' . "submitFormJSON('http://ec2-79-125-49-128.eu-west-1.compute.amazonaws.com/greentiger/api/users/" . $_GET['definitionId'] . "/definitions/" . $_GET['definitionId'] . "/tasks', 'POST')" . '">Save</span>';
        }
        else {
            echo '<span onClick="' . "submitFormJSON('http://ec2-79-125-49-128.eu-west-1.compute.amazonaws.com/greentiger/api/users/" . $_GET['definitionId'] . "/definitions/" . $_GET['definitionId'] . "/tasks/" . $_GET['taskId'] . "', 'PUT')" . '">Save</span>';
        } ?>
    </section>
    
</body>
</html>