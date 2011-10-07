<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
    <script type="text/javascript" src="../js/jquery.greentiger.js"></script>
    <link rel="stylesheet" type="text/css" href="../css/main.css" />
    <script type="text/javascript">
    $(document).ready(function(){
        strUserId = getParameterByName("userId");
        $.getJSON(getUrlApi('users/' + strUserId),function(json) {
            $.each(json.definitions, function(key, value) {
                //var counter = $('.definitions > article').length;
                //var strHtml = '<article class="definition" id="dashboard_' + value._id.$id +'"><span class="header">' + value.name + '(<span class="total"></span>)</span><table><thead><tr><th>Updated</th><th>Title</th><th>C</th><th>L</th></tr></thead><tbody></tbody></table><a href="">View all</a></article>';
                var strHtml2 = '<li class="horizontal"><span class="button blue" id="' + value._id.$id + '">' + value.name + '</span></li>';
                //$('.definitions').append(strHtml);
                $('section.createTask > div > ul').append(strHtml2); 
            });
            //$('article.definition:nth-child(odd)').addClass('left');
            //$('article.definition:nth-child(even)').addClass('right');
        });
    });
    </script>    
</head>
<body id="home">
<section class="createTask">
    <div><ul class="horizontal"></ul></div>
    <form class="task invisible" method="POST">
        <div class="description left"></div>
        <section class="clear"></section>
        <div class="buttons"><input class="button green" type="submit" name="POST" value="Post" /></div>
        <div class="clear"></div>
    </form>
</section>
</body>
</html>