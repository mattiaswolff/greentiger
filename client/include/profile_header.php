<script type="text/javascript">
    //Create dashboard boxes (NOT IN USE) and Create titles.
        $(document).ready(function(){
            $('input[name="name"]').val(jsonUser.name);
            $('textarea').append(jsonUser.description);
            $('form').append(getHtmlTaskRow('name', description, 'text', '', true));
        });
	</script>