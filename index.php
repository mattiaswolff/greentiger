<!DOCTYPE html>
<html>
<head> 
    <?php
        
        $data = $_POST;
        foreach ($_GET as $key => $var){
                $data[$key] = $var;
        }
        if ($data["userId"]) {
            require "../classes/user.php";
            $objUser = new User($data["userId"]);
            echo '<title>' . $objUser->getName() . ' | Zowgle - Engage your online business community!</title>';
            echo '<meta name="description" content="' . $objUser->getDescription() . '" />';
        }
        else {
            echo '<title>Zowgle - Engage your online business community!</title>';
        }
    ?>
    <meta name="keyword" content="" />
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <link rel="stylesheet" type="text/css" href="../css/main.css" />
    <script type="text/javascript">

    var _gaq = _gaq || [];
    _gaq.push(['_setAccount', 'UA-26662915-1']);
    _gaq.push(['_setDomainName', '.zowgle.com']);
    _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
</head>

<body id="home">
        <div class ="top">
            <nav class="pageNav invisible">
                <a id="a_home">home</a> | 
                <a id="a_definition">definitions</a> | 
                <a id="a_profile">profile</a> |
                <a id="a_extensions">extensions &amp; widgets</a>
            </nav>
            <section id="navbar"></section>
        </div>
        <div class = "firstpage">
            <div class="firstpage-head">
                <div class="firstpage-head-text">
                    <h1>Ta tillvara på det fulla värdet av Ert företags kommunikation. Har ditt företag råd att inte haka på?!</h1>
                    <h2>Zowgle är en digital hub där ditt företags kommunikation står i centrum. Vårt mål är att hjälpa Er att strukturera och effektivisera er kommunikation för att nå er fulla potential!</h2>
                </div>
                <div class="firstpage-head-media">
                    <iframe width="426" height="254" src="https://www.youtube.com/embed/cfOa1a8hYP8" frameborder="0" allowfullscreen></iframe>
                </div>
            </div>
            <div class="firstpagehead-action">
            </div>
            <div class="firstpagehead-functionality">
            </div>
            <div class="firstpagehead-customers">
                First 100 customers<br/>
                <a href="http://www.zowgle.com/zowgle">Zowgle</a><br/>
                <a href="http://www.zowgle.com/zowgle-developers">Zowgle Developers</a><br/>
                <a href="http://www.zowgle.com/medius">Medius</a>
            </div>
        </div>
    <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
    <script type="text/javascript" src="../js/jquery.toObject.js"></script>
    <script type="text/javascript" src="../js/form2object.js"></script>
    <script type="text/javascript" src="../js/jquery.greentiger.js"></script>
    <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jqueryui/1.8.2/jquery-ui.min.js"></script>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/googleapis/0.0.4/googleapis.min.js"></script>
    <script type="text/javascript" src="//ajax.googleapis.com/jsapi"></script>
    
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
                        window.sessionStorage.setItem("urlName", json.urlName);
                        window.sessionStorage.setItem("userImgUrl", json.imgUrl);
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
                $(".top > nav > #a_home").attr('href', getUrlBase(window.sessionStorage.getItem("urlName")));
                $(".top > nav > #a_definition").attr('href', getUrlBase(window.sessionStorage.getItem("urlName") + "/definitions"));
                $(".top > nav > #a_profile").attr('href', getUrlBase(window.sessionStorage.getItem("urlName") + "/profile"));
                $(".top > nav > #a_extensions").attr('href', getUrlBase(window.sessionStorage.getItem("urlName") + "/extensions"));
            }
        $("#navbar").delegate(".red", "click", function(){
                sessionStorage.clear();
                window.location.reload();
        });
        });  
    </script>
</body>
</html>