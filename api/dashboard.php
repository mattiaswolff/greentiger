<!DOCTYPE HTML>
<html>

<head>
	
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

	<title>Project Copperfield</title>
	
	<link rel="stylesheet" type="text/css" href="/css/main.css" />
	<script type="text/javascript" src="/js/jquery.js"></script>
	<script type="text/javascript" src="/js/autoresize.jquery.min.js"></script>
	<script type="text/javascript">
	$(document).ready(function(){
		$("div.button").click(function(event) {
			$("#form").empty();
			$.getJSON("http://ec2-46-51-156-7.eu-west-1.compute.amazonaws.com/api.php",
				{
					definitionId: $(this).attr("title"),
				},
				function(data) {
					alert("success");
				});
			})
			$("#form").append('<input type="text" class="textinput" value="' + $(this).attr("title") + '" />');
		});
	});
	</script>   
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
					<div class="button" title="<?php echo $key?>"><?php echo $value["name"]?></div>
					<?php }?>
				</div>
				<div id="form">
					
				</div>
			</form>
			<article class="content_box medium red"> 
				<p class="text header small">Agreements</p>
				<p class="text small">Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
				<p class="text small"><a href="/index3.php">Create new</a> | <a href="/index3.php">View all</a></p>
			</article>
			<article class="content_box medium green"> 
				<p class="text header small">Agreements</p>
				<p class="text small">Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
				<p class="text small"><a href="/index3.php">Create new</a> | <a href="/index3.php">View all</a></p>
			</article>
			<article class="content_box medium blue"> 
				<p class="text header small">Agreements</p>
				<p class="text small">Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
				<p class="text small"><a href="/index3.php">Create new</a> | <a href="/index3.php">View all</a></p>
			</article>
		</section>
		<aside> 
			<p class="text header small">About us</p>
			<p class="text small"><?php echo $user->description; ?></p>
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
