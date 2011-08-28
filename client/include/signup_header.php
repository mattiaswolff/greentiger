<?php
    require_once('../git/handler/gitLoginHandler.php');
    require_once('../git//util/gitConfig.php');
    require_once('../git//util/gitApiClient.php');
    require_once('../git//util/gitContext.php');
    require_once('../git//AccountService.php');
    require_once('../git//SessionManager.php');
    $sessionManager = gitContext::getSessionManager();
    $idpAssertion = $sessionManager->getAssertion();
?>
<script type="text/javascript">
$(document).ready(function(){
        $('input[name="name"]').attr('value', '<?php echo $idpAssertion->getFirstName(); ?>');
        $('input[name="email"]').attr('value', '<?php echo $idpAssertion->getVerifiedEmail(); ?>');
        $('form').attr('url', getUrlApi("users"));
        /*
        Purpose: Submit form by JSON
        Created: 2011-08-28 (Mattias Wolff)
        Updated: -
        */
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