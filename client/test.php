<!DOCTYPE html>
<html>
<head>
    <title>Project Copperfield</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <link rel="stylesheet" type="text/css" href="../css/main.css" />
    <script type="text/javascript">
        var _pc = _pc || {};
        var _pc["id"] = "matwo";
        //var _pc["definitions"] = "matwo";
        var _pc["userName"] = "matwo";
        var _pc["userEmail"] = "matwo";
        (function() {
        function async_load(){
            var s = document.createElement('script');
            s.type = 'text/javascript';
            s.async = true;
            s.src = "http://ec2-46-51-141-34.eu-west-1.compute.amazonaws.com/greentiger/js/embed.js";
            var x = document.getElementsByTagName('script')[0];
            x.parentNode.insertBefore(s, x);
        }
        if (window.attachEvent)
            window.attachEvent('onload', async_load);
        else
            window.addEventListener('load', async_load, false);
    })();
    </script>
</head>

<body id="home">
        <div class ="top">
            <nav class="pageNav invisible">
                <a id="a_home">home</a> | 
                <a id="a_definition">definitions</a> | 
                <a id="a_profile">profile</a>
            </nav>
            <section id="navbar"></section>
        </div>
        <div class = "container">
            <aside class="userInfo">
                <img id="userImage" class="user" alt="Företaget" title="Företaget" src="" />
                <div class="description"></div>
            </aside>
        <div class="main">
            <section class="userName"></section>
            <div class="content">
                <?php include $page_content; ?>
            </div>
            <aside></aside>
        </div>
    </div>
        
    <script type="text/javascript" src="../js/jquery.greentiger.js"></script>
    <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jqueryui/1.8.2/jquery-ui.min.js"></script>
    <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/googleapis/0.0.4/googleapis.min.js"></script>
    <script type="text/javascript" src="//ajax.googleapis.com/jsapi"></script>

</body>
</html>