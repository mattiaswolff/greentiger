<!DOCTYPE HTML>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <script type="text/javascript" src="../js/jquery.greentiger.js"></script>
    <script type="text/javascript" src="../js/jquery.js"></script>
    <script type="text/javascript" src="../js/jquery.toObject.js"></script>
    <script type="text/javascript" src="../js/form2object.js"></script>
    <link rel="stylesheet" type="text/css" href="../css/main.css" />
    <script type="text/javascript">
        strUserId = getParameterByName("userId");
        
        $(document).ready(function(){
            $.ajax({  
                url: getUrlApi("users/" + strUserId),  
                dataType: 'json',  
                async: false,  
                success: function(json){  
                    jsonUser = json;
                    $('.userName').append(json.name);
                }  
            });
        });  
	</script>
    <?php echo $page_header; ?>
</head>

<body id="home">
        <div class ="top">
            <nav class="pageNav">
                <a href="http://ec2-79-125-49-128.eu-west-1.compute.amazonaws.com/greentiger/client/dashboard.php">home</a> | <a href="http://ec2-79-125-49-128.eu-west-1.compute.amazonaws.com/greentiger/client/definition.php">definitions</a> | <a href="http://ec2-79-125-49-128.eu-west-1.compute.amazonaws.com/greentiger/client/group.php">groups</a> | <a href="http://ec2-79-125-49-128.eu-west-1.compute.amazonaws.com/greentiger/client/profile.php">profile</a>
            </nav>
            <section class="login">
                Login
            </section>
        </div>
    <div class = "container">
        <aside class="userInfo">
            <img class="user" src="http://v1.fein.de/fein-multimaster/media/images/fein-multimaster/fein_company_logo.jpg" alt="Företaget" title="Företaget" border="0" />
            <div class="description">This is a description of this user. We dont know that much about them yet though.</div>
            <div class="links">
                <ul>
                    <li><a href="http://www.dif.se">www.dif.se</a>
                </ul>
            </div>
        </aside>
        <div class="main">
            <section class="userName">
            </section>
            <div class="content">
                <?php echo $page_content; ?>
            </div>
            <aside>
                Test
            </aside>
        </div>
    </div>
</body>
</html>