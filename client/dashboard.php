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
            
            $("section.createTask > div").delegate(".button", "click", function(){
                //$('form.task').addClass('invisible');
                var strUrl = "http://ec2-79-125-49-128.eu-west-1.compute.amazonaws.com/greentiger/api/definitions/" + $(this).attr('id');
                $.getJSON(strUrl, function(json) {
                    var strHtml = '';
                    $.each(json.results[0].content, function(key, value) {
                        strHtml += '<article><div class="header"><span class="header">' + value.name +'</span> (<span class="link">?</span>)</div><div class="input">';
                        strHtml += getHtmlTaskInput('content.' + key, value.type, '', value.required, value.config);
                        strHtml += '</div><div class="description invisible clear"><span class="description">' + value.description + '</span></div></article>';
                        strHtml += '<div class="description invisible clear"><span class="description">This is a description</span></div></article>';
                    });
                    $('form.task section').empty();
                    $('form.task div.description').empty();
                    $('form.task div.description').append(json.results[0].description);
                    $('form.task section').append(strHtml);
                    $('form.task > .button').attr('id', json.results[0]._id);
                    $('form.task').removeClass('invisible');
                });    
            });
            $('form.task').submit(function() {
                var strUrl = "http://ec2-79-125-49-128.eu-west-1.compute.amazonaws.com/greentiger/api/users/" + strUserId +'/definitions/' + $(this).attr('id') + '/tasks';
                submitFormJSON('form.task' ,strUrl, 'POST');
                return false;
            });
        });
        
        $("section.createTask > div .red").click(function () {
            $('form.task').addClass('invisible');
        });//test
        
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
                    <div><ul class="horizontal"><li class="horizontal right"><span class="button red">X</span></li></ul></div>
                    <form class="task invisible">
                        <div class="description">
                        </div>
                        <section>
                        </section>
                        <input type="submit" class="button green" />
                    </form>
                </section>
                <section class="definitions">
                </section>
            </div>
        </div>
    </div>
</body>
</html>