<!DOCTYPE html>
<html>
<head> 
    <?php
        die();
        $data = $_POST;
        foreach ($_GET as $key => $var){
                $data[$key] = $var;
        }
        if ($data["userId"]) {
            echo '<title>' . $data["userId"] . ' | Zowgle</title>';
        }
        else {
            echo '<title>Zowgle</title>';
        }
    ?>
    <meta name="description" content="This is a description that is used to describe the content of this web page">
    <meta name="keyword" content="zowgle,test">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <link rel="stylesheet" type="text/css" href="../css/main.css" />
</head>

<body id="home">
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) {return;}
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/sv_SE/all.js#xfbml=1&appId=214551768609754";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
        <div class ="top">
            <nav class="pageNav invisible">
                <a id="a_home">home</a> | 
                <a id="a_definition">definitions</a> | 
                <a id="a_profile">profile</a> |
                <a id="a_extensions">extensions &amp; widgets</a>
            </nav>
            <section id="navbar"></section>
        </div>
        <div class = "container">
            <div class="main">
                <div class="content">
                    <?php include $page_content; ?>
                </div>
            </div>
            <aside class="userInfo">
                <section class="userName"></section>
                <div class="iusr-url"></div>
                <div class="description"></div>
            </aside>
        
    </div>
    <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
    <script type="text/javascript" src="../js/jquery.toObject.js"></script>
    <script type="text/javascript" src="../js/form2object.js"></script>
    <script type="text/javascript" src="../js/jquery.greentiger.js"></script>
    <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jqueryui/1.8.2/jquery-ui.min.js"></script>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/googleapis/0.0.4/googleapis.min.js"></script>
    <script type="text/javascript" src="//ajax.googleapis.com/jsapi"></script>
    <script type="text/javascript" src="http://updateyourbrowser.net/uyb.js"> </script>
    <script type="text/javascript">google.load("identitytoolkit", "1", {packages: ["ac"]});</script>
    <script type="text/javascript">
        strUserId = getParameterByName("userId");
        strAccessToken = "";
        $.each(location.hash.substring(1).split('&'), function (key, value) { 
            if (value.split('=')[0] == 'access_token') { 
                strAccessToken = value.split('=')[1];  
            }
        });
        
        $(document).ready(function(){
            if((!window.sessionStorage.getItem("userId") || window.sessionStorage.getItem("userId") == "null") && strAccessToken != "") {
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
            $("#userImage").attr('src', getUrlApi("users/" + strUserId + "?part=image"));
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
                window.google.identitytoolkit.showSavedAccount(window.sessionStorage.getItem("userEmail"));
                $(".top > nav").removeClass("invisible"); 
                $(".top > nav > #a_home").attr('href', getUrlClient('dashboard.php?userId=' + window.sessionStorage.getItem("userId")));
                $(".top > nav > #a_definition").attr('href', getUrlClient('definition.php?userId=' + window.sessionStorage.getItem("userId")));
                $(".top > nav > #a_profile").attr('href', getUrlClient('profile.php?userId=' + window.sessionStorage.getItem("userId")));
                $(".top > nav > #a_extensions").attr('href', getUrlClient('extensions.php?userId=' + window.sessionStorage.getItem("userId")));
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