<!DOCTYPE HTML>
<html>

<head>
    
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <script type="text/javascript" src="../js/jquery.greentiger.js"></script>
    <script type="text/javascript" src="../js/jquery.js"></script>
    <script type="text/javascript" src="../js/jquery.toObject.js"></script>
    <script type="text/javascript" src="../js/form2object.js"></script>
	<script type="text/javascript">
        strUserId = "<?php echo $_GET['userId']; ?>"
        
        $.each(location.hash.substring(1).split('&'), function (key, value) { 
            if (value.split('=')[0] == 'access_token') { 
                strAccessToken = value.split('=')[1];  
            } 
        });
        
        $(document).ready(function(){
            var strUrlUser = 'http://ec2-79-125-49-128.eu-west-1.compute.amazonaws.com/greentiger/api/users/' + strUserId;
            $.getJSON(strUrlUser, { access_token : strAccessToken}, function(json) {
                    $.each(json.definitions, function(key, value) {
                        var newrow = document.createElement('article');
                        var counter = document.getElementsByClassName('dasboard_definition').length;
                        newrow.className = 'dasboard_definition';
                        newrow.id = value._id.$id;
                        newrow.innerHTML = '<h1><a href="http://ec2-79-125-49-128.eu-west-1.compute.amazonaws.com/greentiger/client/definition.php?definitionId=' + value._id.$id + '">' + value.name + '</a></h1><h2>' + value.description + '</h2></br><a href="http://ec2-79-125-49-128.eu-west-1.compute.amazonaws.com/greentiger/client/task.php?userId=' + strUserId + '&definitionId=' + value._id.$id + '">Add task</a>';
		                document.getElementById("definitions").appendChild(newrow);
                    });
            });
            var strUrl = "http://ec2-79-125-49-128.eu-west-1.compute.amazonaws.com/greentiger/api/users/" + strUserId + "/tasks?group=definition";
            $.getJSON(strUrl, function(json) {
                $.each(json.results, function(key, value) {
                    $.each(value, function(key1, value1) {
                        var objNewRow = document.createElement('div');
                        var counter = document.getElementsByClassName('dasboard_definition').length;
                        objNewRow.className = 'dasboard_definition_task';
                        objNewRow.id = value1._id;
                        strHtml = '';
                        $.each(value1.content, function(key2, value2) {
                            strHtml = strHtml + key2 + ': ' + value2 + '<br/>';
                        });
                        objNewRow.innerHTML = strHtml;
                        document.getElementById(key).appendChild(objNewRow);
                    });
                });
            });
        });
    
	</script>

</head>

<body id="home">
Dashboard
    <section id="definitions">
    </section>
</body>
</html>