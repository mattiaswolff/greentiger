<script type="text/javascript">
    //Create dashboard boxes (NOT IN USE) and Create titles.
        $(document).ready(function(){
            $('form').append(getHtmlTaskRow('userId', 'description', 'text', '', true));
            $('form').append(getHtmlTaskRow('name', 'description', 'text', '', true));
            $('form').append(getHtmlTaskRow('description', 'description', 'textarea', '', true));
            $('form').append('<input class="button green" type="submit" name="PUT" value="Post" />');
        });
	</script>