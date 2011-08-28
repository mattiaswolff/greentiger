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
        $('input[name="name"]').attr('value', '<?php echo $idpAssertion->getVerifiedEmail(); ?>');
    });        
</script>