<script type="text/javascript">
        $(document).ready(function(){
            strUserId = getParameterByName("userId"); 
            strDefinitionId = getParameterByName("definitionId");
            $('form .fields').append(getHtmlTaskRow('name' , 'name', 'name', 'description', 'text', '', true));
            $('form .fields').append(getHtmlTaskRow('description' , 'description', 'description', 'description', 'textarea', '', true));
            
            if (getParameterByName("definitionId") != "" ) {
                $.getJSON(getUrlApi("definitions"), { definitionId: strDefinitionId }, function(json) {
                    
                    $("#name input").attr('value', json.results[0].name);
                    $("#description name").attr('value', json.results[0].description);
                    
                    $.each(json.results[0].content, function(key, value) {
                        var newrow = document.createElement('article');
                        var counter = document.getElementsByClassName('edef-row').length;
                        newrow.innerHTML = 'Name: <input type="text" name="content[' + counter + '].name" value="' + value.name + '" /> Description: <textarea name="content[' + counter + '].description">' + value.type + '</textarea> Type: <select name="content[' + counter + '].type"><option value="text">Text</option><option value="textarea">Textarea</option><option value="email">Email</option><option value="checkbox">Checkbox</option><option value="radio">Radio button</option><option value="date">Date</option><option value="range">Range</option><option value="url">URL</option><option value="number">Number</option><option value="time">Time</option><option value="dropdown">Drop Down</option></select>Config: <input type="text" name="content[' + counter + '].config" value="' + value.config + '" />';
		                newrow.className += 'edef-row';
                        $(".edef .fields").append(newrow);
                    });
                    
                });
            }
            
            $('form .buttons').append('<input class="button green" type="submit" name="POST" value="Post" />');
            $('form .buttons').append('<span class="button blue" id="addRow">Add form row</span>');
            $('form').attr('url', getUrlApi("users/"+ window.sessionStorage.getItem("userId") + "/definitions"));
            $('form').attr('method', 'POST');
            
            $(".content").delegate("#addRow", "click", function(){
                var counter = $('.edef-row').length;
    	        var strHtml = '<article class="edef-row">Name: <input type="text" name="content[' + counter + '].name" value="" /> Description: <textarea name="content[' + counter + '].description"></textarea> Type: <select name="content[' + counter + '].type"><option value="text">Text</option><option value="textarea">Textarea</option><option value="email">Email</option><option value="checkbox">Checkbox</option><option value="radio">Radio button</option><option value="date">Date</option><option value="range">Range</option><option value="url">URL</option><option value="number">Number</option><option value="time">Time</option><option value="dropdown">Drop Down</option></select>Config: <input type="text" name="content[' + counter + '].config" value="" /></article>';
		        $(".edef .fields").append(strHtml);
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