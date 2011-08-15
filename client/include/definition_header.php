<script type="text/javascript">
        $(document).ready(function(){
            var strUserId = getParameterByName("userId"); 
            if (getParameterByName("definitionId") != "" ) {
                $.getJSON("http://ec2-79-125-49-128.eu-west-1.compute.amazonaws.com/greentiger/api/definitions", { definitionId: <?php echo (isset($_GET['definitionId']) ? '"'. $_GET['definitionId'] .'"' : '""' ) ?> }, function(json) {
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
        });
    
    function addFormRow(){ 
        var newrow = document.createElement('article');
        var counter = document.getElementsByClassName('formRow').length;
		newrow.innerHTML = '<div class="formRow">Name: <input type="text" name="content[' + counter + '].name" value="" /> Description: <input type="text" name="content[' + counter + '].description" value="" /> Type: <select name="content[' + counter + '].type"><option value="text">Text</option><option value="textarea">Textarea</option><option value="email">Email</option><option value="checkbox">Checkbox</option><option value="radio">Radio button</option><option value="date">Date</option><option value="range">Range</option><option value="url">URL</option><option value="number">Number</option><option value="time">Time</option><option value="dropdown">Drop Down</option></select> Config: <input type="text" name="content[' + counter + '].config" value="" /></div>';
		document.getElementById("section").appendChild(newrow);
    }
</script>