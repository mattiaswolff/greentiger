<section>
    <form class="task" method="POST">
        Name: <input type="text" name="name" maxlength="30" value=""/><br/>
        Email: <input type="text" name="email" value=""/><br/>
        UserId: <input id="userId" type="text" name="userId" value="" /><br/>
        <div class="buttons"><input class="button green" type="submit" name="POST" value="Post" onClick="submitFormJSON('form', getUrlApi('users'), 'POST', true)" /><div>
    </form>
</section>
