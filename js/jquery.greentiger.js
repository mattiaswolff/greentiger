function submitFormJSON(strUrl, strType) {
            var objJSON = $('form').toObject("All");
            var strUrl = strUrl + "?";
            $.each(getUrlVars(), function(key, value) {
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
        // Read a page's GET URL variables and return them as an associative array.
        function getUrlVars()
        {
            var vars = [], hash;
            var hashes = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');
            for(var i = 0; i < hashes.length; i++)
            {
                hash = hashes[i].split('=');
                vars.push(hash[0]);
                vars[hash[0]] = hash[1];
            }
            return vars;
        }