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
						<form action="/scripts/updateUser.php" method="post">
									<input type="text" name="userId" value="<?php echo $user->userId; ?>" hidden />
									<table>
										<thead>
											<tr>
												<th><?php echo $user->userId; ?></th>
												<th>Social</th>
											</tr>
										</thead>
										<tbody>
											<tr>
												<td class="form">
													<p class="text subheader">Email</p>
													<p class="text feature">Please provide your e-mail address.</p>
													<input class="field" type="email" name="email" value="<?php echo $user->email ?>"/>	
												</td>
											</tr>
											<tr>
												<td class="form">
													<p class="text subheader">URL</p>
													<p class="text feature">Please provide an URL that you would like to present on your user page.</p>
													<input class="field" type="url" name="url" value="<?php echo $user->url ?>"/>	
												</td>
											</tr>
											<tr>
												<td class="form">
													<p class="text subheader">Description</p>
													<p class="text feature">Please privide a short description (max 200 characters) about you or your company.</p>
													<textarea class="field" name="description"><?php echo $user->description ?></textarea>	
												</td>
											</tr>
											<tr>
												<td class="form">
													<p class="text subheader">Image</p>
													<p class="text feature">Upload an image to be display at your site.</p>
													<input name="Filedata" type="file"/><br />
													<input type="submit" value="Upload File" />
												</td>
											</tr>
										</tbody>	
									</table>
									<div class="formend">
										<input type="submit" class="button grey rounded" name="userInfo" value="Save"/>
									</div>
								</form>
							</div>
						</div>
					</section>
				</section>
			</div>
		</div>
	</div>
</body>
</html>
