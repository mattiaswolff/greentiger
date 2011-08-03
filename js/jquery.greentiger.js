function submitFormJSON(strUrl, strType) {
            var objJSON = $('form').toObject("All");
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
                    strHtml = strHtml + '<input type="text" value="" name="content[' + name + ']" />'; 
                    break;
            }
            strHtml = strHtml + '</div>';
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