<script type="text/javascript">
    //Create dashboard boxes (NOT IN USE) and Create titles.
        $(document).ready(function(){
            $('form').append(getHtmlTaskRow('userId', 'description', 'text', '', true));
            $('form').append(getHtmlTaskRow('name', 'description', 'text', '', true));
            $('form').append(getHtmlTaskRow('textarea', 'description', 'text', '', true));
        });
	</script>