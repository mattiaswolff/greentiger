/*
Purpose: Generate API Url.
Created: 2011-08-11 (Mattias Wolff)
Updated: test
*/
function getUrlApi(strUrlExtension) {
    var arrUrl = ["http://www.zowgle.com/api/", strUrlExtension];
    return  arrUrl.join("");
}

function getUrlClient(strUrlExtension) {
    var arrUrl = ["http://www.zowgle.com/client/", strUrlExtension];
    return  arrUrl.join("");
}
//test
function getUrlGit(strUrlExtension) {
    var arrUrl = ["http://www.zowgle.com/git/", strUrlExtension];
    return  arrUrl.join("");
}

/*
Purpose: Parse ISO date to date
Created: 2011-10-01 (Mattias Wolff)
Updated: -
*/

function parseISO8601(strDate) {
 // we assume str is a UTC date ending in 'Z'

 var parts = strDate.split('T'),
 dateParts = parts[0].split('-'),
 timeParts = parts[1].split('+'),
 timeSubParts = timeParts[0].split(':'),
 timeSecParts = timeSubParts[2].split('.'),
 timeHours = Number(timeSubParts[0]),
 _date = new Date;

 _date.setUTCFullYear(Number(dateParts[0]));
 _date.setUTCMonth(Number(dateParts[1])-1);
 _date.setUTCDate(Number(dateParts[2]));
 _date.setUTCHours(Number(timeHours));
 _date.setUTCMinutes(Number(timeSubParts[1]));
 _date.setUTCSeconds(Number(timeSecParts[0]));
 if (timeSecParts[1]) _date.setUTCMilliseconds(Number(timeSecParts[1]));

 // by using setUTC methods the date has already been converted to local time(?)
 return _date;
}

function formatDateOutput(date) {
  var day = date.getDate();
  if (day < 10) { day = "0" + day;}
  var month = date.getMonth() + 1; //months are zero based
  if (month < 10) { month = "0" + month;}
  var year = date.getFullYear();
  var hour = date.getHours();
  var min = date.getMinutes();
  if (min < 10) { min = "0" + min;}
  strDate = year + "-" + month + "-" + day + " " + hour + ":" + min;
  return strDate;
}

/*
Purpose: Add tasks to task flow.
Created: 2011-12-19 (Mattias Wolff)
Updated: -
*/
function getTaskFlow (strUserId, strAccessToken, boolEmpty, strSearch) {
    if (boolEmpty) {
        intOffset = 1;
    }
    else {        
        if (($("section.taskFlow article").length /10 ).toString().indexOf('.') != -1) {
            return;
        }
        intOffset = $("section.taskFlow article").length / 10 + 1;
    }
    $.ajax({
                type: "GET",
                data: {access_token: strAccessToken, offset: intOffset, search: strSearch},
                dataType: "json",
                async: false,
                url: getUrlApi("users/" + strUserId + "/tasks"),
                success: function(json) {
        var arrHtml = new Array();
        $.each(json.results[0], function(key, value) {    
            var d = new Date(value.updatedDate);
            arrHtml.push('<article><div class="story"><div class="header"><a href="' + getUrlClient("dashboard.php?userId=" + value.createdBy._id.$id) + '">' + value.createdBy.name + '</a></div><div class="content">');
            $.each(value.content, function (key1, value1) {
                arrHtml.push('<span class="title">'+ key1 +':</span> '+ value1 +' / ');
            });
            arrHtml.push('</div><div class="actions vague">' + formatDateOutput(parseISO8601(value.updatedDate)) + ' <span class="link edit" id="' + value._id + '">edit</span> <span class="delete link" id="' + value._id + '">delete</span></div><div class="comments">');
            $.each(value.comments, function (key1, value1) {
                arrHtml.push('<div class="comment clear"><div class="com-img"><a href="' + getUrlClient("dashboard.php?userId=" + value1.userId) + '">' + '<img src=https://lh3.googleusercontent.com/-dFqXxFOgTFQ/AAAAAAAAAAI/AAAAAAAAACI/XzKe9ak5jgo/photo.jpg?sz=200" width="32" height="32" /></a></div><div><a href="' + getUrlClient("dashboard.php?userId=" + value1.userId) + '">' + value1.userName + '</a> <span class="vague">' + formatDateOutput(parseISO8601(value1.date)) + '</span></div><div class="com-text"> ' + nl2br(value1.text) + '</div></div>');
            });
            if (!(window.sessionStorage.getItem("userId") === null)) {
            arrHtml.push('<form method="PUT" url="'+ getUrlApi("tasks/" + value._id + "?part=comments")+'"><input class="invisible" type="text" name="comments.userId" value="'+ window.sessionStorage.getItem("userId") +'" /><textarea class="small" name="comments.text" value="" placeholder="Write a comment..."></textarea><div class="com-buttons"><input class="button blue" type="submit"/></div><div class="clear"></div></form>');
            }
            arrHtml.push('</div></div><div class="left"><a href="' + getUrlClient("dashboard.php?userId=" + value.createdBy._id.$id) +'"><img src="https://lh3.googleusercontent.com/-dFqXxFOgTFQ/AAAAAAAAAAI/AAAAAAAAACI/XzKe9ak5jgo/photo.jpg?sz=200" width="50" height="50" /></a></div><div class="clear" /></article>');
        });
        if (boolEmpty) {
            $('section.taskFlow').empty();
        }
        $('section.taskFlow').append(arrHtml.join(""));
        
    }});
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
        
        function getHtmlTaskRow(id, title, name, description, type, value, config, required) {
            var strHtml = '<article id="' + id + '"><div class="header"><span class="header">' + title +'</span> (<span class="link">?</span>)</div><div class="input">';
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
        
        function nl2br (str) {   
            var breakTag = '<br />';    
            return (str + '').replace(/([^>\r\n]?)(\r\n|\n\r|\r|\n)/g, '$1'+ breakTag +'$2');
        }