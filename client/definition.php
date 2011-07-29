<!DOCTYPE HTML>
<html>

<head>
    
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <script type="text/javascript" src="../js/jquery.greentiger.js"></script>
    <script type="text/javascript" src="../js/jquery.js"></script>
	<script type="text/javascript">	
    $(document).ready(function(){
        
    	$('td.delete > a').click(function(event){
			$(this).parent().parent().remove();
		});
	});
    
    function send(){
		$.ajax({
        type: "POST",
        url: <?php echo '"http://ec2-79-125-49-128.eu-west-1.compute.amazonaws.com/greentiger/api/definition.php?userId=' . $_GET["userId"] . '"'?>,
        dataType: 'json',
        data: {'name': 'testdesc', 'description': 'testdescription', 'content' : { '0' : {'name' : 'testName', 'description' : 'TestDescr', 'type' : 'text'}}},
        success: function(msg){
            alert( "Data Saved: " + msg );
        }
        });
    }
    
    function addFormRow(){
    	var newrow = document.createElement('article');
		newrow.innerHTML = 'Name: <input type="text" name="content[0][name]" value="" /> Description: <input type="text" name="content[0][description]" value="" /> Type: <select name="content[0][description]"><option value="text">Text</option><option value="textarea">Textarea</option><option value="email">Email</option><option value="checkbox">Checkbox</option><option value="radio">Radio button</option><option value="date">Date</option><option value="range">Range</option><option value="url">URL</option><option value="number">Number</option><option value="time">Time</option><option value="dropdown">Drop Down</option></select>';
		document.getElementById("section").appendChild(newrow);
    }
    
    function showValues() {
    var values = {};
    $.each($('#section').serializeArray(), function(i, field) {
        values[field.name] = field.value;
    });
    alert(values);
      var str = $("section").serialize();
      $("#results").text(str);
    }
    
    $('form').submit(function() {
  console.log($(this).serializeArray());
  return false;
});
    
	</script>

</head>

<body id="home">
    <section id="section">
        <form>
        Name: 
            <input type="text" name="name" value="" />
            Description: 
            <input type="text" name="description" value="" />
        </form>
    </section>
        <span onclick="addFormRow()">Add form row</span>
        
        <span onClick=<?php echo (!isset($_GET['definitionId']) ? '"' . "submitFormJSON('http://ec2-79-125-49-128.eu-west-1.compute.amazonaws.com/greentiger/api/definition.php?userId=matwo065', 'POST')" . '"' : '"' . "submitFormJSON('http://ec2-79-125-49-128.eu-west-1.compute.amazonaws.com/greentiger/api/definition.php?userId=matwo065', 'PUT')" . '"' ); ?>>Save</span>
        
        <span id="results"></span>
                
                <span onclick="send()">Send</span>

</body>
</html>      
