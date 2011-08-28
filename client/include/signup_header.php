<script type="text/javascript">
<?php 
        $sessionManager = gitContext::getSessionManager();
        $idpAssertion = $sessionManager->getAssertion();
?>
$(document).ready(function(){
        $('input[name="name"]').attr('value', "<?php echo $idpAssertion->getVerifiedEmail(); ?>");
    });        
</script>