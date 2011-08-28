<script type="text/javascript">
    $(document).ready(function(){
        $('input[name="name"]').attr('value', "<?php echo $idpAssertion->getVerifiedEmail(); ?>");
    });        
</script>