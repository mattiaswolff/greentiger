<script type="text/javascript">
        $(document).ready(function(){
            strUserId = getParameterByName("userId"); 
            strDefinitionId = getParameterByName("definitionId");
            $('form .fields').append(getHtmlTaskRow('name', 'name', 'description', 'text', '', true));
            $('form .fields').append(getHtmlTaskRow('description', 'description', 'description', 'textarea', '', true));
            if (getParameterByName("definitionId") != "" ) {
                $.getJSON(getUrlApi("definitions"), { definitionId: strDefinitionId }, function(json) {
                    $.each(json.definitions[0].content, function(key, value) {
                        var newrow = document.createElement('article');
                        var counter = document.getElementsByClassName('formRow').length;
                        newrow.innerHTML = '<div class="formRow">Name: <input type="text" name="content[' + counter + '].name" value="' + value.name + '" /> Description: <input type="text" name="content[' + counter + '].description" value="' + value.type + '" /> Type: <select name="content[' + counter + '].type"><option value="text">Text</option><option value="textarea">Textarea</option><option value="email">Email</option><option value="checkbox">Checkbox</option><option value="radio">Radio button</option><option value="date">Date</option><option value="range">Range</option><option value="url">URL</option><option value="number">Number</option><option value="time">Time</option><option value="dropdown">Drop Down</option></select></div>';
		                document.getElementById("section").appendChild(newrow);
                    });
                });
            }
            
            $('form .buttons').append('<input class="button green" type="submit" name="POST" value="Post" />');
            $('form .buttons').append('<span class="button blue" id="addRow">Add form row</span>');
            $('form').attr('url', getUrlApi("users/"+ window.sessionStorage.getItem("userId") + "/definitions"));
            $('form').attr('method', 'POST');
            
            $(".content").delegate("#addRow", "click", function(){
                var counter = $('.formRow').length;
    	        var strHtml = '<article class="formRow">Name: <input type="text" name="content[' + counter + '].name" value="" /> Description: <input type="text" name="content[' + counter + '].description" value="" /> Type: <select name="content[' + counter + '].type"><option value="text">Text</option><option value="textarea">Textarea</option><option value="email">Email</option><option value="checkbox">Checkbox</option><option value="radio">Radio button</option><option value="date">Date</option><option value="range">Range</option><option value="url">URL</option><option value="number">Number</option><option value="time">Time</option><option value="dropdown">Drop Down</option></select> Config: <input type="text" name="content[' + counter + '].config" value="" /></article>';
		        $("form .fields").append(strHtml);
            });
            
        $("body").delegate("form", "submit", function(event) {
            if (event.preventDefault()) {
                event.preventDefault();// cancels the form submission
            }
            else {
                event.returnValue = false;
            }
            submitFormJSON(this, $(this).attr('url'), $(this).attr('method'), false);
        });
        });
</script>