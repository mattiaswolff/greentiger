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
                        strHtml += '<div><span>' + value1.updatedDate.sec + '</span>';
                        $.each(value1.content, function (key2, value2) {
                            strHtml += '<span>' + value1.content + '</span>';
                            return false;
                        }
                        strHtml += '<span>' + value1.comments.length + '</span><span>' + value1.likes.length + '</span></div>';
                        objNewRow.innerHTML = strHtml;
                        document.getElementById(key).appendChild(objNewRow);
                    });
                });
            });
        });
    
	</script>

</head>

<body id="home">
    <div id = "container">
        <nav>
            <a href="">home</a> | <a href="">definitions</a> | <a href="">tasks</a>
        </nav>
        <section id="top">
            LOGO
        </section>
        <aside>
        </aside>
        <section id="createTask">
        </section>
        <section id="definitions">
            <article>
                FooDefinition
                <div><span>Updated</span><span>Title</span><span>C</span><span>L</span></div>
                <div><span>2011-08-03</span><span>Support</span><span>10</span><span>3</span></div>
                <div><span>2011-08-03</span><span>Why is it like this?</span><span>8</span><span>2</span></div>
                <div><span>2011-08-03</span><span>I don't know</span><span>0</span><span>8</span></div>
                <div><span>2011-08-02</span><span>Run run run into the forrest</span><span>7</span><span>1</span></div>
                <div><span>2011-08-01</span><span>Where the wild roses grow</span><span>5</span><span>5</span></div>
            </article>
        </section>
    </div>
</body>
</html>