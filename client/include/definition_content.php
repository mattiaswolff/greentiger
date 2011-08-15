<form id="section">Name: 
    <input type="text" name="name" value="" id="name" />
    Description: 
    <input type="text" name="description" value="" id="description" />
</form>

<span class="button blue" id="addRow">Add form row</span></br>
<span onClick='submitFormJSON("form", "http://ec2-79-125-49-128.eu-west-1.compute.amazonaws.com/greentiger/api/definitions/", "POST")'>Save</span>