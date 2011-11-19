<!DOCTYPE html>
<html>
<head> 
    <?php
        $data = $_POST;
        foreach ($_GET as $key => $var){
                $data[$key] = $var;
        }
        if ($data["userId"]) {
            echo '<title>Zowgle - ' . $data["userId"] . '</title>';
        }
        else {
            echo '<title>Zowgle</title>';
        }
    ?>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <link rel="stylesheet" type="text/css" href="../css/main.css" />
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
                <div class="iusr-url"></div>
                <div class="description"></div>
            </aside>
        <div class="main">
            <section class="userName"></section>
            <section class="iusr-soc">
                <article>
                    <div class="fb-like" data-send="false" data-layout="button_count" data-width="40" data-show-faces="false" data-font="arial"></div>
                </article>
                <article>
                    <g:plusone size="medium"></g:plusone>
                </article>
                
            </section>
            <div class="content">
                <?php include $page_content; ?>
            </div>
            <aside>
            </aside>
        </div>
    </div>
    <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
    <script type="text/javascript" src="../js/jquery.toObject.js"></script>
    <script type="text/javascript" src="../js/form2object.js"></script>
    <script type="text/javascript" src="../js/jquery.greentiger.js"></script>
    <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jqueryui/1.8.2/jquery-ui.min.js"></script>
    <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/googleapis/0.0.4/googleapis.min.js"></script>
    <script type="text/javascript" src="//ajax.googleapis.com/jsapi"></script>
    <script type="text/javascript">
        var _gaq = _gaq || [];
        _gaq.push(['_setAccount', 'UA-26662915-1']);
        _gaq.push(['_trackPageview']);
        (function() {
            var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
            ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
            var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
        })();
    </script>
    <script type="text/javascript" src="https://apis.google.com/js/plusone.js"></script>
    <script type="text/javascript">google.load("identitytoolkit", "1.0", {packages: ["ac"]});</script>
    <script type="text/javascript">
        strUserId = getParameterByName("userId");
        strAccessToken = "";
        $.each(location.hash.substring(1).split('&'), function (key, value) { 
            if (value.split('=')[0] == 'access_token') { 
                strAccessToken = value.split('=')[1];  
            }
        });
        
        $(document).ready(function(){
            $("#userImage").attr('src', getUrlApi("users/" + strUserId + "?part=image"));
            if ((window.sessionStorage.getItem("userId") === null) &&  !(strAccessToken == '')) {
                $.ajax({  
                    url: getUrlApi("users/me"),  
                    dataType: 'json',  
                    async: false,
                    data: {access_token: strAccessToken},
                    success: function(json){  
                        jsonUser = json;
                        window.sessionStorage.setItem("userId", json._id);
                        window.sessionStorage.setItem("userName", json.name);
                        window.sessionStorage.setItem("userEmail", json.email);
                        window.sessionStorage.setItem("userUrl", json.url);
                        window.sessionStorage.setItem("userDescription", json.description);
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
                        jsonPageUser = json;
                        $('.userName').append(json.name);
                        $('.userInfo .iusr-url').append('<a href="' + json.url + '">' + json.url + '</a>');
                        $('.userInfo .description').append(nl2br(json.description));
                    }
            });
            
            window.google.identitytoolkit.setConfig({
    developerKey: "AIzaSyD_mpU7Xw4GeTmQNqHgIuZFVyPXdOyj6qY",
    companyName: "Zowgle",
    callbackUrl: getUrlGit("callback2.php"),
    realm: "",
    userStatusUrl: getUrlGit("userstatus.php"),
    loginUrl: getUrlGit("login2.php"),
    signupUrl: getUrlClient("signup.php"),
    homeUrl: getUrlGit("auth2.php"),
    logoutUrl: getUrlClient("logout.php"),
    language: "en",
    idps: ["Gmail", "Yahoo", "AOL"],
    tryFederatedFirst: true,
    useCachedUserStatus: false,
                dropdownmenu: [ 
                { 
                    "label": "Switch account",
                    "handler": "onSwitchAccountClicked"
                },
                { 
                    "label": "Log out",
                    "url": "/logout",
                    "handler": "onSignOutClicked"
                }]
            });
            $("#navbar").accountChooser(); 
            if (!(window.sessionStorage.getItem("userId") === null)) {
                $(".top > nav").removeClass("invisible"); window.google.identitytoolkit.showSavedAccount(window.sessionStorage.getItem("userEmail"));
                $(".top > nav > #a_home").attr('href', getUrlClient('dashboard.php?userId=' + window.sessionStorage.getItem("userId")));
                $(".top > nav > #a_definition").attr('href', getUrlClient('definition.php?userId=' + window.sessionStorage.getItem("userId")));
                $(".top > nav > #a_profile").attr('href', getUrlClient('profile.php?userId=' + window.sessionStorage.getItem("userId")));
            }
        $("#navbar").delegate(".red", "click", function(){
                sessionStorage.clear();
                window.location.reload();
        });
        });  
    </script>
    <?php include $page_header; ?>
</body>
</html>