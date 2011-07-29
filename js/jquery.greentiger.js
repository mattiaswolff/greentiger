function submitFormJSON(strURL, strType) {
            var objFormValues = {};
            $.each($('form').serializeArray(), function(key,value) {
                objFormValues[value.name] = value.value;
            });
            $.ajax({
                type: strType,
                url: strURL,
                dataType: 'json',
                data: objFormValues,
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