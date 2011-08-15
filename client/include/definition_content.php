<form id="section">Name: 
    <input type="text" name="name" value="" id="name" />
    Description: 
    <input type="text" name="description" value="" id="description" />
</form>

<span onclick="addFormRow()">Add form row</span></br>
<?php 
    if (!isset($_GET['definitionId'])) {
        echo '<span onClick="' . "submitFormJSON('form', 'http://ec2-79-125-49-128.eu-west-1.compute.amazonaws.com/greentiger/api/users/" . $_GET['userId'] . "/definitions', 'POST')" . '">Save</span>';
    }
    else {
        echo '<span onClick="' . "submitFormJSON('form,', 'http://ec2-79-125-49-128.eu-west-1.compute.amazonaws.com/greentiger/api/definitions/" . $_GET['definitionId'] . "', 'PUT')" . '">Save</span>';
    } 
?>
<br/>
<span onClick=<?php echo (!isset($_GET['definitionId']) ? '"' . "submitFormJSON('http://ec2-79-125-49-128.eu-west-1.compute.amazonaws.com/greentiger/api/definitions', 'POST')" . '"' : '"' . "submitFormJSON('http://ec2-79-125-49-128.eu-west-1.compute.amazonaws.com/greentiger/api/definition.php', 'PUT')" . '"' ); ?>>OldSave</span>';