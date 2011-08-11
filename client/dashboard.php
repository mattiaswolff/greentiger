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
        
        /*$.each(location.hash.substring(1).split('&'), function (key, value) { 
            if (value.split('=')[0] == 'access_token') { 
                strAccessToken = value.split('=')[1];  
            } 
        });*/
        
        $(document).ready(function(){
            var strUrlUser = 'http://ec2-79-125-49-128.eu-west-1.compute.amazonaws.com/greentiger/api/users/' + strUserId;
            $.getJSON(strUrlUser, function(json) {
                    $.each(json.definitions, function(key, value) {
                        var counter = $('.definitions > article').length;
                        var strHtml = '<article class="definition" id="dashboard_' + value._id.$id +'"><span class="header">' + value.name + '(<span class="total"></span>)</span><table><thead><tr><th>Updated</th><th>Title</th><th>C</th><th>L</th></tr></thead><tbody></tbody></table><a href="">View all</a></article>';
		                var strHtml2 = '<li class="horizontal"><span class="button blue" id="' + value._id.$id + '">' + value.name + '</span></li>';
                        $('.definitions').append(strHtml);
                        $('section.createTask > div > ul').append(strHtml2); 
                    });
            $('article.definition:nth-child(odd)').addClass('left');
            $('article.definition:nth-child(even)').addClass('right');
            });
            
            var strUrl = "http://ec2-79-125-49-128.eu-west-1.compute.amazonaws.com/greentiger/api/users/" + strUserId + "/tasks?group=definition";
            
            $.getJSON(strUrl, function(json) {
                $.each(json.results, function(key, value) {
                    $.each(value, function(key1, value1) {
                        strHtml = '';
                        var d = new Date(value1.updatedDate);
                        strHtml += '<tr><td>' + d.getFullYear() + '-' + (d.getMonth() + 1) + '-' + d.getDate() + '</td>';
                        $.each(value1.content, function (key2, value2) {
                            strHtml += '<td><a href="http://ec2-79-125-49-128.eu-west-1.compute.amazonaws.com/greentiger/client/task.php?taskId=' + value1._id + '">' + value2 + '</a></td>';
                            return false;
                        });
                        strHtml = strHtml + '<td>' + value1.comments.length + '</td><td>' + value1.likes.length + '</td></tr>';
                        $('#dashboard_' + key + ' tbody').append(strHtml);
                    });
                });
            });
            
            strUrl = "http://ec2-79-125-49-128.eu-west-1.compute.amazonaws.com/greentiger/api/users/" + strUserId + "/tasks";
            
            $.getJSON(strUrl, function(json) {
                $.each(json.results[0], function(key, value) {
                    strHtml = '';
                    var d = new Date(value.updatedDate);
                    strHtml += '<article><div class="left"><span class="button blue">Type</span></div><div class="story"><div class="header">2011-04-13 Created by <span class="link">' + value.createdBy + '</span></div><div class="content">';
                    $.each(value.content, function (key1, value1) {
                        strHtml += '<span class="title">'+ key1 +':</span> '+ value1 +' / ';
                    });
                    strHtml += '</div><div class="actions"><span class="link edit" id="' + value._id + '">edit</span> <span class="link" id="' + value._id + '">comment</span> (10) <span class="link" id="' + value._id + '">like</span> (3) <span class="delete link" id="' + value._id + '">delete</span></div>';
                    $('section.taskFlow').append(strHtml);
                });
            });
            //test
            $("section.createTask > div").delegate(".blue", "click", function(){
                //$('form.task').addClass('invisible');
                var strUrl = "http://ec2-79-125-49-128.eu-west-1.compute.amazonaws.com/greentiger/api/definitions/" + $(this).attr('id');
                $.getJSON(strUrl, function(json) {
                    var strHtml = '';
                    $.each(json.results[0].content, function(key, value) {
                        strHtml += getHtmlTaskRow(value.name, value.description, value.type, value.config, value.required)
                    });
                    $('form.task section').empty();
                    $('form.task div.description').empty();
                    $('form.task div.description').append(json.results[0].description);
                    $('form.task section').append(strHtml);
                    $('form.task').attr('id', json.results[0]._id);
                    $('form.task').removeClass('invisible');
                });    
            });
            $('form.task').submit(function() {
                // cancels the form submission
                event.preventDefault();
                // do whatever you want here
            
                var strUrl = "http://ec2-79-125-49-128.eu-west-1.compute.amazonaws.com/greentiger/api/users/" + strUserId +'/definitions/' + $(this).attr('id') + '/tasks';
                submitFormJSON('form.task' ,strUrl, 'POST');
            });
        
            $("form.task > .red").click(function () {
                $('form.task').addClass('invisible');
            });
            
            $(".taskFlow").delegate(".delete", "click", function(){
                var strId = $(this).attr('id');
                strId2 = $(this).attr('id');
                this2 = this;
                var strUrl = "http://ec2-79-125-49-128.eu-west-1.compute.amazonaws.com/greentiger/api/tasks/" + $(this).attr('id');
                $.ajax({
                    type: "DELETE",
                    url: strUrl
                });
            });
            
            $(".taskFlow").delegate(".edit", "click", function(){
                strId = $(this).attr('id');
                this2 = this;
                var strUrlTask = "http://ec2-79-125-49-128.eu-west-1.compute.amazonaws.com/greentiger/api/tasks/" + $(this).attr('id');
                var strUrlDefinition = "http://ec2-79-125-49-128.eu-west-1.compute.amazonaws.com/greentiger/api/definitions/4e403283cdb4bf053f000000";
                $.getJSON(strUrlDefinition, function(json) {
                    var strHtml = '<form class="task">'';
                    $.each(json.results[0].content, function(key, value) {
                        strHtml += getHtmlTaskRow(value.name, value.description, value.type, value.config, value.required)
                    });
                    strHtml += '<input class="button green" type="submit" name="Post" value="Post" /></form>';
                    $(this2).parents('.story').children('.content').empty();
                    $(this2).parents('.story').children('.content').append(strHtml);
                    
                    var strUrlTask = "http://ec2-79-125-49-128.eu-west-1.compute.amazonaws.com/greentiger/api/tasks/" + $(this2).attr('id');
                    
                    $.getJSON(strUrlTask, function(json) {
                        $.each(json.results[0][0].content, function(key, value) {
                            $(this2).parents('.story').children('.content').children('article').children('.input').children('input[name|="content.' + key + '"]').attr('value', value);
                        });
                        
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
                    <div><ul class="horizontal"><li class="horizontal right"></li></ul></div>
                    <form class="task invisible">
                        <div class="description left">
                        </div>
                        <span class="button red right">X</span>
                        <section class="clear">
                        </section>
                        <input class="button green" type="submit" name="Post" value="Post" />
                    </form>
                </section>
                <section class="definitions invisible">
                </section>
                <section class="taskFlow">
                </section>
            </div>
        </div>
    </div>
</body>
</html>