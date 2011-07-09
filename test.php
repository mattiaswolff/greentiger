<!DOCTYPE HTML>
<html>

<head>
	
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

	<title>Project Copperfield</title>
	
	<link rel="stylesheet" type="text/css" href="/css/main.css" />
	<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
	<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jqueryui/1.8.2/jquery-ui.min.js"></script>
	<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/googleapis/0.0.3/googleapis.min.js"></script>
	<script type="text/javascript" src="//ajax.googleapis.com/jsapi"></script>
	<script type="text/javascript">
		google.load("identitytoolkit", "1.0", {packages: ["tabs"]});
	</script>
	<script type="text/javascript">
		window.google.identitytoolkit.easyrp.config.setConfig({
		developerKey: "AIzaSyD_mpU7Xw4GeTmQNqHgIuZFVyPXdOyj6qY",
		width: "small",
		companyName: "Project Copperfield",
		returnToUrl: "http://ec2-46-51-156-7.eu-west-1.compute.amazonaws.com/git/login.php",
		realm: "",
		loginUrl: "http://ec2-46-51-156-7.eu-west-1.compute.amazonaws.com/login.php",
		signupUrl: "http://ec2-46-51-156-7.eu-west-1.compute.amazonaws.com/signup.php",
		homeUrl: "http://ec2-46-51-156-7.eu-west-1.compute.amazonaws.com/",
		forgotUrl: "http://ec2-46-51-156-7.eu-west-1.compute.amazonaws.com/forgottenpwd.php",
		language: "en",
		idps: ["Gmail", "GoogleApps", "Yahoo", "AOL", "Hotmail"]
		});
		$(function() {
			$("#widget-container").tabs_login();
		});
	</script>
<!-- Insert the widget container element somewhere in the HTML page -->
   
</head>
<body id="home">
	<?php 
		date_default_timezone_set('Europe/Stockholm');
		require ($_SERVER["DOCUMENT_ROOT"]."/classes/definition.php");
		require ($_SERVER["DOCUMENT_ROOT"]."/classes/user.php");
		require ($_SERVER["DOCUMENT_ROOT"]."/classes/task.php");
		$user = new User();
		$user->get($_GET['userId']);
		if (isset($_GET['taskId'])) {
			$task = new Task();
			$task->get($_GET['taskId']);
		}
	?>
	<div id="container">
		<header>
			<span id="logo">ProjectLogo.com / <?php echo $user->userId; ?></span> 
		</header>  
		<section class="dashboard two_col">
			<form>
				<div>
					<?php foreach ($user->definitions as $key => $value) {?>
					<div class="button large blue" title="<?php echo $key?>"><?php echo $value["name"]?></div>
					<?php }?>
				</div>
				<div id="form">
					
				</div>
			</form>
		</section>
		<aside> 
			<p class="text header small">About us</p>
			<p class="text small"><?php echo $user->description; ?></p>
			<div id="widget-container"></div>
		</aside>
		<footer>
			<article class="content_box small"> 
				<span class="text header micro">Follow us</span><br/>
				<span class="text micro">Blog</span><br/>
				<span class="text micro">YouTube</span><br/>
				<span class="text micro">Facebook</span><br/>
				<span class="text micro">Twitter</span><br/>
				<span class="text micro">LinkedIn</span>
			</article>
			<article class="content_box small"> 
				<span class="text header micro">About us</span><br/>
				<span class="text micro">Jobs</span><br/>
				<span class="text micro">Investors</span><br/>
				<span class="text micro">Press</span><br/>
				<span class="text micro">Contact</span><br/>
				<span class="text micro">LinkedIn</span>
			</article>
			<article class="content_box small"> 
				<span class="text header micro">Help</span><br/>
				<span class="text micro">FAQ</span><br/>
				<span class="text micro">Developers recources</span><br/>
				<span class="text micro">Facebook</span><br/>
				<span class="text micro">Twitter</span><br/>
				<span class="text micro">LinkedIn</span>
			</article>
		</footer>
	</div>
</body>
</html>
