<script type="text/javascript">
    //Create dashboard boxes (NOT IN USE) and Create titles.
        $(document).ready(function(){
            $('form').append(getHtmlTaskRow('id', 'description', 'text', '', true));
            $('form').append(getHtmlTaskRow('name', 'description', 'text', '', true));
            $('form').append(getHtmlTaskRow('description', 'description', 'textarea', '', true));
            $('input[name|="id"]').attr('value', window.sessionStorage.getItem("userId"));
            $('input[name|="name"]').attr('value', window.sessionStorage.getItem("userName"));
            $('textarea[name|="description"]').append(window.sessionStorage.getItem("userDescription"));
            $('form').append('<input class="button green" type="submit" name="PUT" value="Post" />');
            $('form').attr('url', getUrlApi("/users/"+ window.sessionStorage.getItem("userId")));
        });
        
        $("body").delegate("form", "submit", function(event) {
            if (event.preventDefault()) {
                event.preventDefault();// cancels the form submission
            }
            else {
                event.returnValue = false;
            }
            submitFormJSON(this, $(this).attr('url'), $(this).attr('method'), false);
        });
        
	</script>