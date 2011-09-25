<form id="userInfo" method="PUT">
    <div class="fields"></div>
    <div class="buttons"></div>
    <div class="clear"></div>
</form>
<form id="userImage" method="POST" enctype="multipart/form-data">
    <label for="file">Filename:</label>
    <input type="file" name="file" id="file" /> 
    <br />
    <input type="submit" name="submit" value="Submit" />
</form>

<div id="container">
    <div id="filelist">No runtime found.</div>
    <br />
    <a id="pickfiles" href="#">[Select files]</a>
    <a id="uploadfiles" href="#">[Upload files]</a>
</div>
