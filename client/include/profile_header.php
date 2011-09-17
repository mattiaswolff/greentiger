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
            $('form').attr('url', getUrlApi("users/"+ window.sessionStorage.getItem("userId")));
            $('form').attr('method', 'PUT');
        
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
            });
        });
        
        
        
	</script>