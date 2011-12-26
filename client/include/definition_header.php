<script type="text/javascript">
        $(document).ready(function(){
            strDefinitionId = getParameterByName("definitionId");
            $('form .fields').append(getHtmlTaskRow('name' , 'name', 'name', 'description', 'text', '', true));
            $('form .fields').append(getHtmlTaskRow('description' , 'description', 'description', 'description', 'textarea', '', true));
            
            $.each(jsonPageUser .definitions, function(key, value) {
                strHtml = '<tr id="' + value._id.$id + '"><td>' + value.name + '</td><td class="odef-edit link">edit</td><td class="odef-delete link">delete</td></tr>';
                $('.odef').append(strHtml);
            });
            
            if (getParameterByName("definitionId") != "" ) {
                $.getJSON(getUrlApi("definitions"), { definitionId: strDefinitionId }, function(json) {
                    
                    $("#name input").attr('value', json.results[0].name);
                    $("#description name").attr('value', json.results[0].description);
                    
                    $.each(json.results[0].content, function(key, value) {
                        var newrow = document.createElement('article');
                        var counter = document.getElementsByClassName('edef-row').length;
                        newrow.innerHTML = '<input type="text" name="content[' + counter + '].name" value="' + value.name + '" placeholder="Name" /><select name="content[' + counter + '].type"><option value="text">Text</option><option value="textarea">Textarea</option><option value="email">Email</option><option value="checkbox">Checkbox</option><option value="radio">Radio button</option><option value="date">Date</option><option value="range">Range</option><option value="url">URL</option><option value="number">Number</option><option value="time">Time</option><option value="dropdown">Drop Down</option></select><input type="text" name="content[' + counter + '].config" value="' + value.config + '"Config" /> Description: <textarea name="content[' + counter + '].description">' + value.type + '</textarea>';
		                newrow.className += 'edef-row';
                        $(".edef .fields").append(newrow);
                    });
                    
                });
            }
            
            $('form .buttons').append('<input class="button green" type="submit" name="POST" value="Post" />');
            $('form .buttons').append('<span class="button blue" id="addRow">Add form row</span>');
            
            if (strDefinitionId == "") {
                $('form.edef').attr('method', 'POST');
                $('form.edef').attr('url', getUrlApi("users/"+ window.sessionStorage.getItem("userId") + "/definitions"));
            }
            else {
                $('form.edef').attr('method', 'PUT');
                $('form.edef').attr('url', getUrlApi("definitions/" + strDefinitionId));
            }
            $(".content").delegate("#addRow", "click", function(){
                var counter = $('.edef-row').length;
    	        var strHtml = '<article class="edef-row">Name: <input type="text" name="content[' + counter + '].name" value="" /> Description: <textarea name="content[' + counter + '].description"></textarea> Type: <select name="content[' + counter + '].type"><option value="text">Text</option><option value="textarea">Textarea</option><option value="email">Email</option><option value="checkbox">Checkbox</option><option value="radio">Radio button</option><option value="date">Date</option><option value="range">Range</option><option value="url">URL</option><option value="number">Number</option><option value="time">Time</option><option value="dropdown">Drop Down</option></select>Config: <input type="text" name="content[' + counter + '].config" value="" /></article>';
		        $(".edef .fields").append(strHtml);
            });
            
            $(".odef").delegate("td.odef-edit", "click", function(){
                $('.edef-row').remove();
                $.getJSON(getUrlApi("definitions/" + $(this).parent().attr('id')), function(json) {
                    
                    $("#name input").attr('value', json.results[0].name);
                    $("#description name").attr('value', json.results[0].description);
                    
                    $.each(json.results[0].content, function(key, value) {
                        var newrow = document.createElement('article');
                        var counter = document.getElementsByClassName('edef-row').length;
                        newrow.innerHTML = '<input type="text" name="content[' + counter + '].name" value="' + value.name + '" placeholder="Title" /><select name="content[' + counter + '].type"><option value="text">Text</option><option value="textarea">Textarea</option><option value="email">Email</option><option value="checkbox">Checkbox</option><option value="radio">Radio button</option><option value="date">Date</option><option value="range">Range</option><option value="url">URL</option><option value="number">Number</option><option value="time">Time</option><option value="dropdown">Drop Down</option></select><textarea name="content[' + counter + '].config">' + value.config + '</textarea><textarea name="content[' + counter + '].description">' + value.type + '</textarea>';
    	                newrow.className += 'edef-row';
                        $(".edef .fields").append(newrow);
                    });
                    
                });
                
                $('form.edef').attr('method', 'PUT');
                $('form.edef').attr('url', getUrlApi("definitions/" + $(this).parent().attr('id')));
                $('form.edef').removeClass('invisible');
                
            });
            
            $(".ndef").delegate("span.ndef-edit", "click", function(){
                $('.edef-row').remove();
                $('form.edef').removeClass('invisible');
            });
            
            $(".odef").delegate("td.odef-delete", "click", function(){
                $.ajax({
                    type: "DELETE",
                    async: false,
                    url: getUrlApi("users/" + strUserId + "?definitionId=" + $(this).parent().attr('id'))
                });
                 $(this).parent().remove();
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