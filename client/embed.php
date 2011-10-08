<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    
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
                var strHtml2 = '<li class="horizontal"><span class="button blue" id="' + value._id.$id + '">' + value.name + '</span></li>';
                $('section.createTask > div > ul').append(strHtml2); 
            });
        });
        
         $("section.createTask > div").delegate(".blue", "click", function(){
            $.getJSON(getUrlApi("definitions/" + $(this).attr('id')), function(json) {
                var arrHtml = new Array();
                $.each(json.results[0].content, function(key, value) {
                    arrHtml.push(getHtmlTaskRow(value.name, "content." +value.name, value.description, value.type, '', value.config, value.required));
                });
                arrHtml.push('<input class="invisible" type="text" name="createUserId" value="' + window.sessionStorage.getItem("userId") + '" />');
                arrHtml.push('<input class="invisible" type="text" name="createUserName" value="' + window.sessionStorage.getItem("userName") + '" />');
                $('form.task section').empty();
                $('form.task div.description').empty();
                $('form.task div.description').append(json.results[0].description);
                $('form.task section').append(arrHtml.join(""));
                $('form.task').attr('id', json.results[0]._id);
                $('form.task').attr('url', getUrlApi("users/" + strUserId + "/definitions/" + json.results[0]._id + "/tasks"));
                $('form.task').removeClass('invisible');
            }); 
            $("section.createTask > div .blue").removeClass('inUse');
            $(this).addClass('inUse');
        });
        
        $("body").delegate("form", "submit", function(event) {
            if (event.preventDefault()) {
                event.preventDefault();// cancels the form submission
            }
            else {
                event.returnValue = false;
            }
            
            submitFormJSON(this ,$(this).attr('url'), $(this).attr('method'), false);
            getTaskFlow (strUserId, strAccessToken, true);
            $('form.task').addClass('invisible');
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