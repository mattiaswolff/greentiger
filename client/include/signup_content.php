<section>
    <form class="task" method="POST">
        Name: <input type="text" name="name" maxlength="30" value="<?php echo $idpAssertion->getFirstName() . ' ' . $idpAssertion->getLastName(); ?>" /><br/>
        Email: <input type="text" name="email" value="<?php echo $idpAssertion->getVerifiedEmail(); ?>" /><br/>
        UserId: <input id="userId" type="text" name="userId" value="" /><br/>
        <div class="buttons"><input class="button green" type="submit" name="POST" value="Post" onClick="submitFormJSON('http://ec2-46-51-141-34.eu-west-1.compute.amazonaws.com/greentiger/api/users', 'POST')" /><div>
    </form>
</section>
