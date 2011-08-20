<script type="text/javascript">
        $(document).ready(function(){
            strUserId = getParameterByName("userId"); 
            strDefinitionId = getParameterByName("definitionId");
            if (getParameterByName("definitionId") != "" ) {
                $.getJSON("http://ec2-79-125-49-128.eu-west-1.compute.amazonaws.com/greentiger/api/definitions", { definitionId: strDefinitionId }, function(json) {
                    $("#name").val(json.definitions[0].name);
                    $("#description").val(json.definitions[0].description);
                    $.each(json.definitions[0].content, function(key, value) {
                        var newrow = document.createElement('article');
                        var counter = document.getElementsByClassName('formRow').length;
                        newrow.innerHTML = '<div class="formRow">Name: <input type="text" name="content[' + counter + '].name" value="' + value.name + '" /> Description: <input type="text" name="content[' + counter + '].description" value="' + value.type + '" /> Type: <select name="content[' + counter + '].type"><option value="text">Text</option><option value="textarea">Textarea</option><option value="email">Email</option><option value="checkbox">Checkbox</option><option value="radio">Radio button</option><option value="date">Date</option><option value="range">Range</option><option value="url">URL</option><option value="number">Number</option><option value="time">Time</option><option value="dropdown">Drop Down</option></select></div>';
		                document.getElementById("section").appendChild(newrow);
                    });
                });
            }
            
            $('form').append('<input class="button green" type="submit" name="POST" value="Post" />');
            $('form').append('<span class="button blue" id="addRow">Add form row</span>');
            $('form').attr('url', getUrlApi("/users/"+ window.sessionStorage.getItem("userId") + "/definitions"));
        
            $(".content").delegate("#addRow", "click", function(){
                var counter = $('formRow').length;
    	        var strHtml = '<article><div class="formRow">Name: <input type="text" name="content[' + counter + '].name" value="" /> Description: <input type="text" name="content[' + counter + '].description" value="" /> Type: <select name="content[' + counter + '].type"><option value="text">Text</option><option value="textarea">Textarea</option><option value="email">Email</option><option value="checkbox">Checkbox</option><option value="radio">Radio button</option><option value="date">Date</option><option value="range">Range</option><option value="url">URL</option><option value="number">Number</option><option value="time">Time</option><option value="dropdown">Drop Down</option></select> Config: <input type="text" name="content[' + counter + '].config" value="" /></div></article>';
		        $("form").append(strHtml);
            });
            
            $(".content").delegate("#save", "click", function(){
                submitFormJSON("form", "http://ec2-79-125-49-128.eu-west-1.compute.amazonaws.com/greentiger/api/users/" + strUserId + "/definitions", "POST");
            });
        });
</script>