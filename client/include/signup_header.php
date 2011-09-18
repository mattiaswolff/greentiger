<script type="text/javascript">
strEmail = getParameterByName("email");
$(document).ready(function(){
    $('form').attr('url', getUrlApi("users"));
    $('form input[name="email"]').attr('value', strEmail);
});
</script>