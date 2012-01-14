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
    <link href="https://lh3.googleusercontent.com/-6TJ8qDQCiZg/TxHlBLLbg2I/AAAAAAAAADc/iiCN_iePBIs/s47/zowgle_favicon.png" rel="icon" type="image/x-icon" /> 
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
                <div class="firstpage-head-media">
                    <iframe width="426" height="254" src="https://www.youtube.com/embed/cfOa1a8hYP8?rel=0&border=0&showinfo=0" frameborder="0" allowfullscreen></iframe>
                </div>
                <div class="firstpage-head-text">
                    <h1>Ta tillvara på det fulla värdet av Ert företags kommunikation. Har ditt företag råd att inte haka på?!</h1>
                    <h2>Zowgle är en digital hub där ditt företags kommunikation står i centrum. Vårt mål är att hjälpa Er att strukturera och effektivisera er kommunikation för att nå er fulla potential!</h2>
                </div>
                <div class="clear" />
            </div>
            <div class="firstpagehead-action">
                <span class="button cta rounded blue">Register now for 1 month free trial!</span>
            </div>
            <div class="firstpagehead-functionality">
                <div class="firstpagehead-functionality-usp">
                    <ul>
                        <li><h3>Enkelt att komma igång och använda</h3><p>Vi har byggt Zowgle för att vara enkelt och intuitivt att använda. Ge tjänsten 15 minuter och den är klar att användas!</p></li>
                        <li><h3>Enkelt att komma igång och använda</h3><p>Vi har byggt Zowgle för att vara enkelt och intuitivt att använda. Ge tjänsten 15 minuter och den är klar att användas!</p></li>
                        <li><h3>Enkelt att komma igång och använda</h3><p>Vi har byggt Zowgle för att vara enkelt och intuitivt att använda. Ge tjänsten 15 minuter och den är klar att användas!</p></li>
                        <li><h3>Enkelt att komma igång och använda</h3><p>Vi har byggt Zowgle för att vara enkelt och intuitivt att använda. Ge tjänsten 15 minuter och den är klar att användas!</p></li>
                        <li><h3>Enkelt att komma igång och använda</h3><p>Vi har byggt Zowgle för att vara enkelt och intuitivt att använda. Ge tjänsten 15 minuter och den är klar att användas!</p></li>
                    </ul>  
                </div>
                <div class="firstpagehead-functionality-description">
                    <h3>Beskrivning</h3>
                    <p>Ditt företag kommunicerar med omvärlden på massor av olika sätt. Vi tror att en del av denna kommunikationen fungerar utmärkt men att det finns potential att förbättra andra delar.</p>
                    <p>Zowgle är en digital hub där ditt företag kan strukturera och effektivisera den kommunikation som idag inte når sin fulla potential.</p>   
                    <p>För att hjälpa dig att lyckas har vi skapat ett flexibelt verktyg för kommunikation. Hur du använder detta är givetvis upp till dig men vi har följande idéer:</p>
                    <p>- Hur ser din kuntjänst ut idag? Vi tror att Zowgle passar utmärkt för att effektivisera arbetet och framförallt nå den fulla potentialen i kontakt med kunder.</p> 
                    <p>- Hur fungerar gränssnitten mot era affärssystem? Zowgle kan användas som en portal mot omvärlden där t ex fakturor eller order kan läggs upp. Allt som krävs är sedan att hämta denna information från vårt API till era system.</p>
                    <p>Givetvis finns också andra möjligheter. Tveka inte att kontakta oss om ni har idéer till egna tillämpningar.</p> 
                </div>
            </div>
            <div class="firstpagehead-customers">
                <h3>First 100 customers</h3>
                <ul>
                        <li><a href="http://www.zowgle.com/zowgle">Zowgle</a></li>
                        <li><a href="http://www.zowgle.com/zowgle-developers">Zowgle Developers</a></li>
                        <li><a href="http://www.zowgle.com/medius">Medius</a></li>
                        <li></li>
                        <li></li>
                    </ul>
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
            $('span.button').click(function() {$('#navbar').accountChooser('showAccountChooser')});
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