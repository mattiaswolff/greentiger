<!DOCTYPE HTML>
<html>

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title>Project Copperfield</title>
	 
	<link rel="stylesheet" type="text/css" href="/css/app.css" />
	<link href='http://fonts.googleapis.com/css?family=Droid+Serif:regular,italic,bold' rel='stylesheet' type='text/css'>
	<script type="text/javascript" src="/js/jquery.js"></script>
	<script type="text/javascript" src="/js/autoresize.jquery.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){
			$('textarea').autoResize({
				onResize : function() {
				$(this).css({opacity:0.8});
			},
			animateCallback : function() {
				$(this).css({opacity:1});
			},
			animateDuration : 100,
			extraSpace : 20
			});
		});
	</script>   
</head>
<body id="<?php echo basename($_SERVER['PHP_SELF'], ".php"); ?>"> 
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
	<div class = "page-container">
		<div class = "app-container">
			<div class = "app">
				<section class = "app-panel theme-standard">
					<header><?php require ($_SERVER["DOCUMENT_ROOT"]."/include/header.php");?></header>
					<aside>
						<?php require ($_SERVER["DOCUMENT_ROOT"]."/include/menu.php");?>
					</aside>
					<section id="content">
						<div>
							<div class="part header">
								<img class="image medium" src="http://1.bp.blogspot.com/_qtUS1n_seHA/TSV2zh7kk4I/AAAAAAAAE00/RlK2-6ZMHJs/s200/hm-logo.png" />
								<div class="float-left">
									<h2 class="text header"><?php echo $user->userId; if ($_GET['userId'] == $_SESSION['userId']) echo ' (<a href="/' . $_SESSION['userId'] . '/edit">edit</a>)'; ?></h2>
									<p class="text feature"><?php echo $user->email; ?> <a href="<?php echo $user->url; ?>"><?php echo $user->url; ?></a></p>
									<p class="text feature"><?php echo $user->description; ?></p>
								 </div>
							</div>
							<div class="part content">
								<div class="clear">
									<h2 class="lable text subheader">Definitions <?php if ($_GET['userId'] == $_SESSION['userId']) echo ' (<a href="/' . $_SESSION['userId'] . '/definitions/new">add</a>)'; ?></h2>
									<hr/>
									<?php foreach ($user->definitions as $key => $value) {?>
									<div class="box dashboard">
										<p class="text subheader"><?php echo $value['name'] . " (" . count($value['tasks']) . ")"; if ($_GET['userId'] == $_SESSION['userId']) echo ' (<a href="/' . $_SESSION['userId'] . '/definitions/' . $key . '">edit</a>)';  ?></p>
										<p class="text feature"><?php echo "This would be the description of the definition. There might be som eintresting info."; ?></p>
										<a href="/<?php echo $user->userId; ?>/definitions/<?php echo $key; ?>/tasks/">Inbox</a> | 
										<a href="/<?php echo $user->userId; ?>/definitions/<?php echo $key; ?>/tasks/new">Create New</a>
									</div>
									<?php } ?>
								</div>
							</div>
						</div>
					</section>
				</section>
			</div>
		</div>
	</div>
</body>
</html>
