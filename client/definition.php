<!DOCTYPE HTML>
<html>

<head>
    
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <script type="text/javascript" src="../js/jquery.greentiger.js"></script>
    <script type="text/javascript" src="../js/jquery.js"></script>
    <script type="text/javascript" src="../js/jquery.toObject.js"></script>
    <script type="text/javascript" src="../js/form2object.js"></script>
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
		newrow.innerHTML = '<div class="formRow">Name: <input type="text" name="content[' + counter + '].name" value="" /> Description: <input type="text" name="content[' + counter + '].description" value="" /> Type: <select name="content[' + counter + '].type"><option value="text">Text</option><option value="textarea">Textarea</option><option value="email">Email</option><option value="checkbox">Checkbox</option><option value="radio">Radio button</option><option value="date">Date</option><option value="range">Range</option><option value="url">URL</option><option value="number">Number</option><option value="time">Time</option><option value="dropdown">Drop Down</option></select></div>';
		document.getElementById("section").appendChild(newrow);
    }
    
	</script>

</head>

<body id="home">
    <section>
        <form id="section">
        Name: 
            <input type="text" name="name" value="" id="name" />
            Description: 
            <input type="text" name="description" value="" id="description" />
        </form>
    </section>
        <span onclick="addFormRow()">Add form row</span></br>
        <?php if (!isset($_GET['definitionId'])) {
            echo '<span onClick="' . "submitFormJSON('form', 'http://ec2-79-125-49-128.eu-west-1.compute.amazonaws.com/greentiger/api/users/" . $_GET['userId'] . "/definitions', 'POST')" . '">Save</span>';
        }
        else {
            echo '<span onClick="' . "submitFormJSON('form,', 'http://ec2-79-125-49-128.eu-west-1.compute.amazonaws.com/greentiger/api/definitions/" . $_GET['definitionId'] . "', 'PUT')" . '">Save</span>';
        } ?>
        <br/>
        <span onClick=<?php echo (!isset($_GET['definitionId']) ? '"' . "submitFormJSON('http://ec2-79-125-49-128.eu-west-1.compute.amazonaws.com/greentiger/api/definitions', 'POST')" . '"' : '"' . "submitFormJSON('http://ec2-79-125-49-128.eu-west-1.compute.amazonaws.com/greentiger/api/definition.php', 'PUT')" . '"' ); ?>>OldSave</span>
</body>
</html>