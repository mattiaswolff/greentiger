<script type="text/javascript">
    //Create dashboard boxes (NOT IN USE) and Create titles.
        $(document).ready(function(){
            $('.eusr .fields').append(getHtmlTaskRow('id', 'id', 'id', 'description', 'text', '', true));
            $('.eusr .fields').append(getHtmlTaskRow('name', 'name', 'name', 'description', 'text', '', true));
            $('.eusr .fields').append(getHtmlTaskRow('url', 'url', 'url', 'description', 'url', '', true));
            $('.eusr .fields').append(getHtmlTaskRow('imgUrl', 'Image URL', 'imgUrl', 'description', 'url', '', true));
            $('.eusr .fields').append(getHtmlTaskRow('description', 'description', 'description', 'description', 'textarea', '', true));
            $('input[name|="id"]').attr('value', window.sessionStorage.getItem("userId"));
            $('input[name|="name"]').attr('value', window.sessionStorage.getItem("userName"));
            $('input[name|="url"]').attr('value', window.sessionStorage.getItem("userUrl"));
            $('textarea[name|="description"]').append(window.sessionStorage.getItem("userDescription"));
            $('input[name|="id"]').parent().parent("article").addClass("invisible");
            $('.eusr .buttons').append('<input class="button green" type="submit" name="PUT" value="Post" />');
            $('.eusr').attr('url', getUrlApi("users/"+ window.sessionStorage.getItem("userId")));
            $('#userImage').attr('url', getUrlApi("users/"+ window.sessionStorage.getItem("userId")+ "?part=image"));
            $('form').attr('method', 'PUT');
            $('#userImage').attr('method', 'POST');
            $("body").delegate(".eusr", "submit", function(event) {
                if (event.preventDefault()) {
                    event.preventDefault();// cancels the form submission
                }
                else {
                    event.returnValue = false;
                }
                submitFormJSON(this, $(this).attr('url'), $(this).attr('method'), false);
                window.sessionStorage.setItem("userDescription", $('textarea[name|="description"]').val());
                window.sessionStorage.setItem("userName", $('input[name|="name"]').val());
                window.sessionStorage.setItem("userUrl", $('input[name|="url"]').val());
                window.location.reload();
            });
        });
	</script>