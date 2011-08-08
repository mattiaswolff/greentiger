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
            <img class="user" src="http://v1.fein.de/fein-multimaster/media/images/fein-multimaster/fein_company_logo.jpg" alt="Företaget" title="Företaget" border="0" />
            <div class="description">This is a description of this user. We dont know that much about them yet though.</div>
            <div class="links">
                <ul>
                    <li><a href="http://www.dif.se">www.dif.se</a>
                </ul>
            </div>
        </aside>
        <div class="main">
            <section class="userName">
                Mattias Wolff
            </section>
            <div class="content">
                <section class="createTask">
                    CreateTask
                </section>
                <section class="definitions">
                    <article class="left">
                        <span class="header">FooDefinition (<span class="total">105</span>)</span>
                        <table>
                            <thead>
                                <tr><th>Updated</th><th>Title</th><th>C</th><th>L</th></tr>
                            </thead>
                            <tbody>
                                <tr><td>2001-01-01</td><td>This isfd a test</td><td>8</td><td>7</td></tr>
                                <tr><td>2001-01-01</td><td>This is sfda test</td><td>8</td><td>7</td></tr>
                                <tr><td>2001-01-01</td><td>This idfs a tesdfst</td><td>8</td><td>7</td></tr>
                                <tr><td>2001-01-01</td><td>Thisdssf is a tsdfest</td><td>8</td><td>7</td></tr>
                                <tr><td>2001-01-01</td><td>This idfs a test</td><td>8</td><td>7</td></tr>
                                <tr><td>2001-01-01</td><td>This idfssdsf a test</td><td>8</td><td>7</td></tr>
                                <tr><td>2001-01-01</td><td>This isf a test</td><td>8</td><td>7</td></tr>
                                <tr><td>2001-01-01</td><td>This sdis a test</td><td>8</td><td>7</td></tr>
                                <tr><td>2001-01-01</td><td>This is asdf test</td><td>8</td><td>7</td></tr>
                                <tr><td>2001-01-01</td><td>This is a tasdfest</td><td>8</td><td>7</td></tr>
                            </tbody>
                        </table>
                        <a href="">View all</a>
                    </article>
                    <article class="right">
                        <span class="title">FooDefinition</span>
                        <div class="header row"><span class="col_date">Updated</span><span class="col_content">Title</span><span class="col_comments">C</span><span class="col_likes">L</span></div>
                        <div class="row"><span class="col_date">2011-08-03</span><span class="col_content">Support</span><span class="col_comments">10</span><span class="col_likes">3</span></div>
                        <div class="row"><span class="col_date">2011-08-03</span><span class="col_content">Why is it like this?</span><span class="col_comments">8</span><span class="col_likes">2</span></div>
                        <div class="row"><span class="col_date">2011-08-03</span><span class="col_content">I don't know</span><span class="col_comments">0</span><span class="col_likes">8</span ></div>
                        <div class="row"><span class="col_date">2011-08-02</span><span class="col_content">Run run run into the forrest</span><span class="col_comments">7</span><span class="col_likes">1</span></div>
                        <div class="row"><span class="col_date">2011-08-01</span><span class="col_content">Where the wild roses grow</span><span class="col_comments">5</span><span class="col_likes">5</span></div>
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