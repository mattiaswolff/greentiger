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
        
        function getHtmlTaskRow(name, description, type, config, required) {
            var strHtml = '<article><div class="header"><span class="header">' + name +'</span> (<span class="link">?</span>)</div><div class="input">';
            strHtml += getHtmlTaskInput('content.' + name, type, '', required, config);
            strHtml += '</div><div class="description invisible clear"><span class="description">' + description + '</span></div></article>';
            strHtml += '<div class="description invisible clear"><span class="description">This is a description</span></div></article>';
            return strHtml;
        }
        
        function getHtmlTaskInput(name, type, value, requiered, config) {
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