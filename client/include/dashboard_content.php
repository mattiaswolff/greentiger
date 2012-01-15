<section class="createTask ctsk">
    <div class="ctsk-definitions"><ul></ul></div>
    <form class="task ctsk-task invisible" method="POST">
        <div class="ctsk-desc"></div>
        <section class="clear"></section>
        <div class="crt-post">
            <input type="text" class="invisible" name="createUserId" />
            <input class="button green" type="submit" name="POST" value="Post" />
            <input type="text" name="createUserName" required placeholder="Name" />
            <input type="email" name="createUserEmail" required placeholder="Email" />
            
        </div>
        <div class="clear"></div>
    </form>
</section>
<div class="search">
    <input type="text" name="search" class="search" /><div class="button blue search-btn" id="search">Search</div>
    <div class="clear"></div>
</div>
<section class="taskFlow"></section>