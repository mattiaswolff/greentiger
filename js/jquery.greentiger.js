function submitFormJSON(strURL, strType, arrQueryParameters) {
            var objJSON = $('form').toObject("All");
            strUrl = strUrl + "?";
            $.each(arrQueryParameters, function(key, value) {
                strUrl = strUrl + key + "=" + value + "&";
            });
            $.ajax({
                type: strType,
                url: strURL,
                dataType: 'json',
                data: objJSON,
                success: function(msg) {
                    alert( "Data Saved!");
                }
            });
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