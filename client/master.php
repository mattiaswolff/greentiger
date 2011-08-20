<!DOCTYPE HTML>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <script type="text/javascript" src="../js/jquery.greentiger.js"></script>
    <script type="text/javascript" src="../js/jquery.js"></script>
    <script type="text/javascript" src="../js/jquery.toObject.js"></script>
    <script type="text/javascript" src="../js/form2object.js"></script>
    <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
    <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jqueryui/1.8.2/jquery-ui.min.js"></script>
    <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/googleapis/0.0.4/googleapis.min.js"></script>
    <script type="text/javascript" src="//ajax.googleapis.com/jsapi"></script>
    <link rel="stylesheet" type="text/css" href="../css/main.css" />
    <script type="text/javascript">google.load("identitytoolkit", "1.0", {packages: ["ac"]});</script>
    <script type="text/javascript">
        strUserId = getParameterByName("userId");
        strAccessToken = "";
        if (strUserId == 'me') {
            $.each(location.hash.substring(1).split('&'), function (key, value) { 
                if (value.split('=')[0] == 'access_token') { 
                    strAccessToken = value.split('=')[1];  
                }
            });
        }
        
        $(document).ready(function(){
            if ((window.sessionStorage.getItem("userId") === null) && !(strAccessToken == '')) {
                $.ajax({  
                    url: getUrlApi("users/me"),  
                    dataType: 'json',  
                    async: false,
                    data: {access_token: strAccessToken},
                    success: function(json){  
                        jsonUser = json;
                        window.sessionStorage.setItem("userId", json._id);
                        window.sessionStorage.setItem("userName", json.name);
                        window.sessionStorage.setItem("access_token", strAccessToken);
                    }
                });
            }
            $.ajax({  
                    url: getUrlApi("users/" + strUserId),  
                    dataType: 'json',  
                    async: false,
                    data: {access_token: strAccessToken},
                    success: function(json){  
                        jsonUser = json;
                        window.sessionStorage.setItem("userId", json._id);
                        window.sessionStorage.setItem("userName", json.name);
                        window.sessionStorage.setItem("access_token", strAccessToken);
                    }
            });
            
            $('.userName').append(window.sessionStorage.getItem("userName"));
            
            window.google.identitytoolkit.setConfig({
                developerKey: "AIzaSyD_mpU7Xw4GeTmQNqHgIuZFVyPXdOyj6qY",
                companyName: "GreenTiger",
                callbackUrl: "http://ec2-79-125-49-128.eu-west-1.compute.amazonaws.com/greentiger/git/callback.php",
                realm: "",
                userStatusUrl: "http://ec2-79-125-49-128.eu-west-1.compute.amazonaws.com/greentiger/git/userstatus.php",
                loginUrl: "http://ec2-79-125-49-128.eu-west-1.compute.amazonaws.com/greentiger/git/login.php",
                signupUrl: "http://ec2-79-125-49-128.eu-west-1.compute.amazonaws.com/greentiger/git/signup.php",
                homeUrl: "http://ec2-79-125-49-128.eu-west-1.compute.amazonaws.com/client/dashboard.php",
                logoutUrl: "http://ec2-79-125-49-128.eu-west-1.compute.amazonaws.com/greentiger/git/signout.php",
                language: "en",
                idps: ["Gmail", "Yahoo", "AOL"],
                tryFederatedFirst: true,
                useCachedUserStatus: false
            });
            if (window.sessionStorage.getItem("userId") === null) {
                $("#navbar").accountChooser();
            }
            else {
                $(".top > nav").removeClass("invisible");
                $("#navbar").append("Logged in as " + window.sessionStorage.getItem("userId"));
                $(".top > nav > #a_home").attr('href', 'http://ec2-79-125-49-128.eu-west-1.compute.amazonaws.com/greentiger/client/dashboard.php?userId=' + window.sessionStorage.getItem("userId"));
                $(".top > nav > #a_definition").attr('href', 'http://ec2-79-125-49-128.eu-west-1.compute.amazonaws.com/greentiger/client/definition.php?userId=' + window.sessionStorage.getItem("userId"));
                $(".top > nav > #a_group").attr('href', 'http://ec2-79-125-49-128.eu-west-1.compute.amazonaws.com/greentiger/client/group.php?userId=' + window.sessionStorage.getItem("userId"));
                $(".top > nav > #a_profile").attr('href', 'http://ec2-79-125-49-128.eu-west-1.compute.amazonaws.com/greentiger/client/profile.php?userId=' + window.sessionStorage.getItem("userId"));
            }
        });  
	</script>
    <?php echo $page_header; ?>
</head>

<body id="home">
        <div class ="top">
            <nav class="pageNav invisible">
                <a id="a_home">home</a> | <a id="a_definition">definitions</a> | <a id="a_group">groups</a> | <a id="a_profile">profile</a>
            </nav>
            <section id="navbar"></section>
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
            <section class="userName"></section>
            <div class="content">
                <?php echo $page_content; ?>
            </div>
            <aside>Test</aside>
        </div>
    </div>
</body>
</html>