<script type="text/javascript">
strEmail = getParameterByName("email");
$(document).ready(function(){
    $('form').attr('url', getUrlApi("users"));
    $('form input[name="email"]').attr('value', strEmail);
    $("body").delegate("form", "submit", function(event) {
            if (event.preventDefault()) {
                event.preventDefault();// cancels the form submission
            }
            else {
                event.returnValue = false;
            }
            
            submitFormJSON(this ,$(this).attr('url'), $(this).attr('method'), false);
        });
});
</script>