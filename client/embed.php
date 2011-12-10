<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <link href='http://fonts.googleapis.com/css?family=Comfortaa' rel='stylesheet' type='text/css'>
    <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
    <script type="text/javascript" src="../js/jquery.toObject.js"></script>
    <script type="text/javascript" src="../js/form2object.js"></script>
    <script type="text/javascript" src="../js/jquery.greentiger.js"></script>
    <link rel="stylesheet" type="text/css" href="../css/embed.css" />
    <script type="text/javascript">
    $(document).ready(function(){
        strUserId = getParameterByName("userId");
        $.getJSON(getUrlApi('users/' + strUserId),function(json) {
            $.each(json.definitions, function(key, value) {
                var strHtml2 = '<li><span class="button blue" id="' + value._id.$id + '">' + value.name + '</span></li>';
                $('.crt div.crt-definitions ul').append(strHtml2); 
            });
        });
        
         $("section.createTask > div").delegate(".button", "click", function(){
            if (("f" + $(this).attr('id')) != $('form.crt-task').attr('id')) {
            $.getJSON(getUrlApi("definitions/" + $(this).attr('id')), function(json) {
                var arrHtml = new Array();
                $.each(json.results[0].content, function(key, value) {
                    arrHtml.push(getHtmlTaskRow(value.name, value.name, "content." +value.name, value.description, value.type, '', value.config, value.required));
                });
                $('.crt form.crt-task section').empty();
                $('.crt div.crt-desc').empty();
                $('.crt div.crt-desc').append(json.results[0].description);
                $('.crt form.crt-task section').append(arrHtml.join(""));
                //$('form.task').attr('id', json.results[0]._id);
                $('.crt form.crt-task').attr('url', getUrlApi("users/" + strUserId + "/definitions/" + json.results[0]._id + "/tasks"));
            }); 
            $('.crt form.crt-task').removeClass('invisible');
            $('.crt form.crt-task').attr('id', ("f" + $(this).attr('id')));
            $("section.createTask > div span.button").removeClass('darkBlue');
            $("section.createTask > div span.button").addClass('blue');
            $(this).removeClass('blue');
            $(this).addClass('darkBlue');
            }
            else {
                $('.crt form.crt-task').addClass('invisible');  
                $('.crt form.crt-task').attr('id', '');
                $(this).removeClass('darkblue');
                $(this).addClass('blue');
                $('.crt form.crt-task section').empty();
                $('.crt div.crt-desc').empty();
            }
        });
        
        $("body").delegate("form", "submit", function(event) {
            if (event.preventDefault()) {
                event.preventDefault();// cancels the form submission
            }
            else {
                event.returnValue = false;
            }
            
            submitFormJSON(this ,$(this).attr('url'), $(this).attr('method'), false);
            $('.crt form.crt-task').addClass('invisible');
        });
        
    });
    </script>    
</head>
<body id="home">
<section class="createTask crt">
    <div class="crt-definitions"><ul></ul></div>
    <form class="crt-task invisible" method="POST">
        <div class="crt-desc"></div>
        <section class="clear"></section>
        <div class="crt-post">
            <div class="crt-post-userinfo">
                <input type="text" name="createUserName" />
                <input type="email" name="createUserEmail" />
            </div>
            <div class="crt-post-buttons">
                <input class="button green" type="submit" name="POST" value="Post" />
            </div>
        </div>
        <div class="clear"></div>
    </form>
</section>
<aside>
</aside>
</body>
</html>