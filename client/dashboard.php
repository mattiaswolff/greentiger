<!DOCTYPE HTML>
<html>

<head>
    
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <script type="text/javascript" src="../js/jquery.greentiger.js"></script>
    <script type="text/javascript" src="../js/jquery.js"></script>
    <script type="text/javascript" src="../js/jquery.toObject.js"></script>
    <script type="text/javascript" src="../js/form2object.js"></script>
    <link rel="stylesheet" type="text/css" href="../css/main.css" />
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
                        newrow.innerHTML = '<span><a href="http://ec2-79-125-49-128.eu-west-1.compute.amazonaws.com/greentiger/client/definition.php?definitionId=' + value._id.$id + '">' + value.name + '</a></span><br/>';
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
                        var d = new Date(value1.updatedDate);
                        strHtml += '<div><span>' + d.getMonth() + '-' + d.getDate() + '</span>';
                        $.each(value1.content, function (key2, value2) {
                            strHtml += '<span><a href="http://ec2-79-125-49-128.eu-west-1.compute.amazonaws.com/greentiger/client/task.php?taskId=' + value1._id + '">' + value2 + '</a></span>';
                            return false;
                        });
                        strHtml = strHtml + '<span>' + value1.comments.length + '</span><span>' + value1.likes.length + '</span></div>';
                        objNewRow.innerHTML = strHtml;
                        document.getElementById(key).appendChild(objNewRow);
                    });
                });
            });
        });
    
	</script>

</head>

<body id="home">
        <div class ="top">
            <nav class="pageNav">
                <a href="">home</a> | <a href="">definitions</a> | <a href="">tasks</a>
            </nav>
            <section class="login">
                Login
            </section>
        </div>
    <div class = "container">
        <aside class="userInfo">
            User Info
        </aside>
        <div class="main">
            <section class="userName">
                UserName
            </section>
            <nav class="userNav">
                <a href="">home</a> | <a href="">definitions</a> | <a href="">tasks</a>
            </nav>
            <div class="content">
                <section class="createTask">
                    CreateTask
                </section>
                <section class="definitions">
                    <article class="left">
                        FooDefinition
                        <div><span>Updated</span><span>Title</span><span>C</span><span>L</span></div>
                        <div><span>2011-08-03</span><span>Support</span><span>10</span><span>3</span></div>
                        <div><span>2011-08-03</span><span>Why is it like this?</span><span>8</span><span>2</span></div>
                        <div><span>2011-08-03</span><span>I don't know</span><span>0</span><span>8</span></div>
                        <div><span>2011-08-02</span><span>Run run run into the forrest</span><span>7</span><span>1</span></div>
                        <div><span>2011-08-01</span><span>Where the wild roses grow</span><span>5</span><span>5</span></div>
                    </article>
                    <article class="right">
                        FooDefinition2
                        <div><span>Updated</span><span>Title</span><span>C</span><span>L</span></div>
                        <div><span>2011-08-03</span><span>Support</span><span>10</span><span>3</span></div>
                        <div><span>2011-08-03</span><span>Why is it like this?</span><span>8</span><span>2</span></div>
                        <div><span>2011-08-03</span><span>I don't know</span><span>0</span><span>8</span></div>
                        <div><span>2011-08-02</span><span>Run run run into the forrest</span><span>7</span><span>1</span></div>
                        <div><span>2011-08-01</span><span>Where the wild roses grow</span><span>5</span><span>5</span></div>
                    </article>
                </section>
            </div>
        </div>
        <footer class="footer">
            footer
        </footer>
    </div>
</body>
</html>