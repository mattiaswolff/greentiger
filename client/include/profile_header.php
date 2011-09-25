<script type="text/javascript" src="../js/plupload.full.js"></script>
<script type="text/javascript">
// Custom example logic
$(function() {
    var uploader = new plupload.Uploader({
        runtimes : 'html5',
        browse_button : 'pickfiles',
        container : 'container',
        max_file_size : '10mb',
        url : getUrlApi('users/' + window.sessionStorage.getItem('userId')+ '?part=image',
        filters : [
            {title : "Image files", extensions : "jpg,gif,png"},
            {title : "Zip files", extensions : "zip"}
        ],
        resize : {width : 320, height : 240, quality : 90}
    });
    uploader.bind('Init', function(up, params) {
        $('#filelist').html("<div>Current runtime: " + params.runtime + "</div>");
    });

    $('#uploadfiles').click(function(e) {
        uploader.start();
        e.preventDefault();
    });
    uploader.init();

    uploader.bind('FilesAdded', function(up, files) {
        $.each(files, function(i, file) {
            $('#filelist').append(
                '<div id="' + file.id + '">' +
                file.name + ' (' + plupload.formatSize(file.size) + ') <b></b>' + '</div>');
        });
        up.refresh(); // Reposition Flash/Silverlight
    });
    uploader.bind('UploadProgress', function(up, file) {
        $('#' + file.id + " b").html(file.percent + "%");
    });
    uploader.bind('Error', function(up, err) {
        $('#filelist').append("<div>Error: " + err.code +
            ", Message: " + err.message +
            (err.file ? ", File: " + err.file.name : "") +
            "</div>"
        );
        up.refresh(); // Reposition Flash/Silverlight
    });
    uploader.bind('FileUploaded', function(up, file) {
        $('#' + file.id + " b").html("100%");
    });
});
</script>
<script type="text/javascript">
    //Create dashboard boxes (NOT IN USE) and Create titles.
        $(document).ready(function(){
            $('#userInfo .fields').append(getHtmlTaskRow('id', 'id', 'description', 'text', '', true));
            $('#userInfo .fields').append(getHtmlTaskRow('name', 'name', 'description', 'text', '', true));
            $('#userInfo .fields').append(getHtmlTaskRow('description', 'description', 'description', 'textarea', '', true));
            $('input[name|="id"]').attr('value', window.sessionStorage.getItem("userId"));
            $('input[name|="name"]').attr('value', window.sessionStorage.getItem("userName"));
                    $('textarea[name|="description"]').append(window.sessionStorage.getItem("userDescription"));
            $('input[name|="id"]').attr("disabled", true);
            $('#userInfo .buttons').append('<input class="button green" type="submit" name="PUT" value="Post" />');
            $('#userInfo').attr('url', getUrlApi("users/"+ window.sessionStorage.getItem("userId")));
            $('#userImage').attr('url', getUrlApi("users/"+ window.sessionStorage.getItem("userId")+ "?part=image"));
            $('form').attr('method', 'PUT');
            $('#userImage').attr('method', 'POST');
            $("body").delegate("#userInfo", "submit", function(event) {
                if (event.preventDefault()) {
                    event.preventDefault();// cancels the form submission
                }
                else {
                    event.returnValue = false;
                }
                submitFormJSON(this, $(this).attr('url'), $(this).attr('method'), false);
                window.sessionStorage.setItem("userDescription", $('textarea[name|="description"]').val());
                window.sessionStorage.setItem("userName", $('input[name|="name"]').val());
                window.location.reload();
            });
        });
	</script>