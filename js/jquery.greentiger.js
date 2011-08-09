function submitFormJSON(strSelector, strUrl, strType) {
            var objJSON = $(strSelector).toObject("All");
            $.ajax({
                type: strType,
                url: strUrl,
                dataType: 'json',
                data: objJSON,
                success: function(msg) {
                    alert( "Data Saved!");
                }
            });
        }
        
        function getHtmlTaskRow(name, description, type, counter) {
            var strHtml = '<div class="formRow">';
            strHtml = strHtml + name + "<br/>" + description + "<br/>";
            switch (type) {
                case "text":
                    strHtml = strHtml + '<input type="text" value="" name="content.' + name + '" />'; 
                    break;
            }
            strHtml = strHtml + '</div>';
            return strHtml;
        }
        
        function getHtmlTaskInput(name, type, value, requiered, config) {
            var strHtml = '';
            switch (type) {
                
                case "text": case "email": case "url": case "date":
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
                        
                        strHtml += '<div class="horizontal"><input id="' + value1 + '" type="' + type + '" value="' + value1 + '" name="' + name + '" /><label for="' +value1 + '">' + value1 + '</label></div>';
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