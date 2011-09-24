<!DOCTYPE html>
<html>
<head>
<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jqueryui/1.8.2/jquery-ui.min.js"></script>
<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/googleapis/0.0.4/googleapis.min.js"></script>
<script type="text/javascript" src="//ajax.googleapis.com/jsapi"></script>
<script type="text/javascript">
  google.load("identitytoolkit", "1.0", {packages: ["ac"]});
</script>
<script type="text/javascript">
$(function() {
  window.google.identitytoolkit.setConfig({
    developerKey: "AIzaSyD_mpU7Xw4GeTmQNqHgIuZFVyPXdOyj6qY",
    companyName: "Project Copperfield",
    callbackUrl: "http://ec2-46-51-141-34.eu-west-1.compute.amazonaws.com/greentiger/git/callback2.php",
    realm: "",
    userStatusUrl: "http://ec2-46-51-141-34.eu-west-1.compute.amazonaws.com/greentiger/git/userstatus.php",
    loginUrl: "http://ec2-46-51-141-34.eu-west-1.compute.amazonaws.com/greentiger/git/login2.php",
    signupUrl: "http://ec2-46-51-141-34.eu-west-1.compute.amazonaws.com/greentiger/client/signup.php",
    homeUrl: "http://ec2-46-51-141-34.eu-west-1.compute.amazonaws.com/greentiger/git/auth2.php",
    logoutUrl: "http://ec2-46-51-141-34.eu-west-1.compute.amazonaws.com/greentiger/git/signout.php",
    language: "en",
    idps: ["Gmail", "Yahoo", "AOL"],
    tryFederatedFirst: true,
    useCachedUserStatus: false
  }
  dropdownmenu: [ 
    { 
      "label": "Edit profile", 
      "url": "/user/edit/5"
    },
    { 
      "label": "Switch account",
      "handler": "onSwitchAccountClicked"
    },
    { 
      "label": "Log out",
      "url": "/logout",
      "handler": "onSignOutClicked"
    }
  ]);
  $("#navbar").accountChooser();
});
</script>
</head>
<body id="home">
    <div id="navbar"></div>
</body>
</html>