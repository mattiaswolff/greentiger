<script type="text/javascript">
        strUserId = getParameterByName("userId");
        strAccessToken = "";
        $.each(location.hash.substring(1).split('&'), function (key, value) { 
                if (value.split('=')[0] == 'access_token') { 
                    strAccessToken = value.split('=')[1];  
                }
        });
        /*$.each(location.hash.substring(1).split('&'), function (key, value) { 
            if (value.split('=')[0] == 'access_token') { 
                strAccessToken = value.split('=')[1];  
            } 
        });*/
        
        //Create dashboard boxes (NOT IN USE) and Create titles.
        $(document).ready(function(){
        $.getJSON(getUrlApi('users/' + strUserId), {access_token: strAccessToken},function(json) {
            $.each(json.definitions, function(key, value) {
                //var counter = $('.definitions > article').length;
                //var strHtml = '<article class="definition" id="dashboard_' + value._id.$id +'"><span class="header">' + value.name + '(<span class="total"></span>)</span><table><thead><tr><th>Updated</th><th>Title</th><th>C</th><th>L</th></tr></thead><tbody></tbody></table><a href="">View all</a></article>';
    	        var strHtml2 = '<li><span class="button blue" id="' + value._id.$id + '">' + value.name + '</span></li>';
                //$('.definitions').append(strHtml);
                $('div.ctsk-definitions > ul').append(strHtml2); 
            });
            //$('article.definition:nth-child(odd)').addClass('left');
            //$('article.definition:nth-child(even)').addClass('right');
        });
            
        //Add tasks to dashboard boxes (NOT IN USE)
        /*var strUrl = "http://ec2-79-125-49-128.eu-west-1.compute.amazonaws.com/greentiger/api/users/" + strUserId + "/tasks?group=definition";
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
        });*/
        
        getTaskFlow(strUserId, strAccessToken, true);
        
        /*
        Purpose: Add definition form to create task area.
        Created: 2011-08-11 (Mattias Wolff)
        Updated: -
        */
        $("div.ctsk-definitions").delegate(".button", "click", function(){
            if (("f" + $(this).attr('id')) != $('form.ctsk-task').attr('id')) {
                $.getJSON(getUrlApi("definitions/" + $(this).attr('id')), {access_token: strAccessToken}, function(json) {
                    var arrHtml = new Array();
                    $.each(json.results[0].content, function(key, value) {
                        arrHtml.push(getHtmlTaskRow(value.name, value.name, "content." +value.name, value.description, value.type, '', value.config, value.required));
                    });
                    arrHtml.push('<input class="invisible" type="text" name="createUserId" value="' + window.sessionStorage.getItem("userId") + '" />');
                    arrHtml.push('<input class="invisible" type="text" name="createUserName" value="' + window.sessionStorage.getItem("userName") + '" />');
                    $('.ctsk form section').empty();
                    $('.ctsk div.ctsk-desc').empty();
                    $('.ctsk div.ctsk-desc').append(json.results[0].description);
                    $('.ctsk form section').append(arrHtml.join(""));
                    $('.ctsk form').attr('id', 'f' +json.results[0]._id);
                    $('.ctsk form').attr('url', getUrlApi("users/" + strUserId + "/definitions/" + json.results[0]._id + "/tasks"));
                    $('.ctsk form').removeClass('invisible');
                    
                });
                $("div.ctsk-definitions .button").removeClass('darkBlue');
                $("div.ctsk-definitions .button").addClass('blue');
                $(this).removeClass('blue');
                $(this).addClass('darkBlue');
            }
            else {
                $('.ctsk form').addClass('invisible');  
                $('.ctsk form').attr('id', '');
                $(this).removeClass('darkblue');
                $(this).addClass('blue');
                $('.ctsk form section').empty();
                $('.ctsk div.crt-desc').empty();
            }
        });
        
        /*
        Purpose: Submit form by JSON
        Created: 2011-08-11 (Mattias Wolff)
        Updated: -
        */
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
        
        /*
        Purpose: Remove open definition form from create task area.
        Created: 2011-08-11 (Mattias Wolff)
        Updated: -
        */
        $(".createTask").delegate(".delete", "click", function(){
            $('form.task').addClass('invisible');
        });
        
        /*
        Purpose: Search the dashboard
        Created: 2011-08-11 (Mattias Wolff)
        Updated: -
        */
        $("body").delegate("#search", "click", function(){
             var strSearch = $("body input.search").val();
            getTaskFlow (strUserId, strAccessToken, true, strSearch);
        });
        
        /*
        Purpose: Delete tasks (from task flow)
        Created: 2011-08-11 (Mattias Wolff)
        Updated: -
        */
        $(".taskFlow").delegate(".delete", "click", function(){
            $.ajax({
                type: "DELETE",
                async: false,
                url: getUrlApi("tasks/" + $(this).attr('id'))
            });
            getTaskFlow (strUserId, strAccessToken, true);
        });
        
        /*
        Purpose: Load additional content when scrolling down
        Created: 2011-09-19 (Mattias Wolff)
        Updated: -
        */
        $(window).scroll(function(){
        if  ($(window).scrollTop() >= $(document).height() - $(window).height() - Math.round($(window).height()/4)){
           getTaskFlow (strUserId, strAccessToken, false);
        }
});
        /*
        Purpose: Edit tasks (from task flow)
        Created: 2011-08-11 (Mattias Wolff)
        Updated: -
        */    
        $(".taskFlow").delegate(".edit", "click", function(){
            var this1 = this;
            $.getJSON(getUrlApi("tasks/" + $(this).attr('id')), {access_token: strAccessToken}, function(json) {
                var json1 = json;
                $.getJSON(getUrlApi("definitions/" + json.results[0][0].definition), {access_token: strAccessToken}, function(json) {
                    var arrHtml = new Array();
                    arrHtml.push('<form class="task" method="PUT" url="' + getUrlApi("tasks/") + $(this1).attr("id") +'"><div class="fields">');
                    $.each(json.results[0].content, function(key, value) {
                        arrHtml.push(getHtmlTaskRow(value.name, value.name, 'content.' + value.name, value.description, value.type, '', value.config, value.required));
                    });
                    arrHtml.push('</div><div class="buttons"><input class="button green" type="submit" name="PUT" value="Post" /></div><div class="clear"></div></form>');
                    $(this1).parents('.story').children('.content').empty();
                    $(this1).parents('.story').children('.content').append(arrHtml.join(""));
                    $.each(json1.results[0][0].content, function(key, value) {
                        $(this1).parents('.story').children('.content').children('form').children('.fields').children('article').children('.input').children('[name|="content.' + key + '"]').attr('value', value);
                    });
                });
            });
        });
    });        
	</script>