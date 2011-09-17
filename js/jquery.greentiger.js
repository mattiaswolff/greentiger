/*
Purpose: Generate API Url.
Created: 2011-08-11 (Mattias Wolff)
Updated: -
*/
function getUrlApi(strUrlExtension) {
    var arrUrl = ["http://ec2-46-51-141-34.eu-west-1.compute.amazonaws.com/greentiger/api/", strUrlExtension];
    return  arrUrl.join("");
}

/*
Purpose: Add tasks to task flow.
Created: 2011-08-11 (Mattias Wolff)
Updated: -
*/
function getTaskFlow (strUserId, strAccessToken) {
    $.getJSON(getUrlApi("users/" + strUserId + "/tasks"), {access_token: strAccessToken}, function(json) {
        var arrHtml = new Array();
        $.each(json.results[0], function(key, value) {    
            var d = new Date(value.updatedDate);
            arrHtml.push('<article><div class="left"><span class="blue">Type</span></div><div class="story"><div class="header">2011-04-13 Created by <span class="link">' + value.createdBy + '</span> <span class="link edit" id="' + value._id + '">edit</span> <span class="delete link" id="' + value._id + '">delete</span></div><div class="content">');
            $.each(value.content, function (key1, value1) {
                arrHtml.push('<span class="title">'+ key1 +':</span> '+ value1 +' / ');
            });
            arrHtml.push('</div><div class="actions"> <span class="link" id="' + value._id + '">comment</span> (10) <span class="link" id="' + value._id + '">like</span> (3) </div><div class="comments">');
            $.each(value.comments, function (key1, value1) {
                arrHtml.push('<div class="comment">' + value1.userId + ' ' + value1.text + '</div>');
            });
            if (!(window.sessionStorage.getItem("userId") === null)) {
            arrHtml.push('<form class="task" method="PUT" url="'+ getUrlApi("tasks/" + value._id + "?part=comments")+'"><input class="invisible" type="text" name="comments[0].userId" value="'+ window.sessionStorage.getItem("userId") +'" /><input type="text" name="comments[0].text" value="" /><input class="invisible" type="submit"/></form>');
            }
            arrHtml.push('</div></article>');
        });
        $('section.taskFlow').empty();
        $('section.taskFlow').append(arrHtml.join(""));
    });
}

function submitFormJSON(strSelector, strUrl, strType, strAsync) {
            var objJSON = $(strSelector).toObject("All");
            $.ajax({
                type: strType,
                url: strUrl,
                dataType: 'json',
                data: objJSON,
                async: strAsync,
                success: function(msg) {
                    alert( "Data Saved!");
                }
            });
        }
        
        function getHtmlTaskRow(title, name, description, type, value, config, required) {
            var strHtml = '<article><div class="header"><span class="header">' + title +'</span> (<span class="link">?</span>)</div><div class="input">';
            strHtml += getHtmlTaskInput(name, type, value, config, required);
            strHtml += '</div><div class="description invisible clear"><span class="description">' + description + '</span></div></article>';
            return strHtml;
        }
        
        function getHtmlTaskInput(name, type, value, config, required) {
            var strHtml = '';
            switch (type) {
                
                case "text": case "email": case "url": case "date": case "time":
                    strHtml = '<input type="' + type + '" value="' + value + '" name="' + name + '" />'; 
                    break;
                case "textarea":
                    strHtml = '<textarea name="' + name + '" />' + value + '</textarea>';
                    break;
                case "dropdown":
                    strHtml = '<select name="' + name + '">';
                    $.each(config.split(";"), function (key1, value1) {
                        strHtml += '<option value="' + value1 + '">' + value1 + '</option>';
                    });
                    strHtml += '</select>';
                    break;
                case "checkbox": case "radio":
                    //strHtml += '<ul class="horizontal">'
                    $.each(config.split(";"), function (key1, value1) {
                        strHtml += '<div class="form-field"><input id="' + value1 + '" type="' + type + '" value="' + value1 + '" name="' + name + '" /><label for="' +value1 + '">' + value1 + '</label></div>';
                    });
                    //strHtml += '</ul>'
                    break;
                case "number": case "range":
                    var arrConfig = config.split(";");
                    strHtml = '<input type="' + type + '" value="' + value + '" name="' + name + '" min="' + arrConfig[0] + '" max="' + arrConfig[1] + '" step="' + arrConfig[2] + '" />'; 
                    break;
            }
            return strHtml;
        }
        
        function getParameterByName(name) {
            name = name.replace(/[\[]/, "\\\[").replace(/[\]]/, "\\\]");
            var regexS = "[\\?&]" + name + "=([^&#]*)";
            var regex = new RegExp(regexS);
            var results = regex.exec(window.location.href);
            if(results == null)
                return "";
            else
            return decodeURIComponent(results[1].replace(/\+/g, " "));
        }