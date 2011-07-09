<!DOCTYPE HTML>
<html>

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title>Project Copperfield</title>
	<link rel="stylesheet" type="text/css" href="/css/app.css" />   
</head>
<body id="<?php echo basename($_SERVER['PHP_SELF'], ".php"); ?>"> 
	<?php 
		require ($_SERVER["DOCUMENT_ROOT"]."/classes/definition.php");
		require ($_SERVER["DOCUMENT_ROOT"]."/classes/user.php");
		require ($_SERVER["DOCUMENT_ROOT"]."/classes/task.php");
		echo $_GET['definitionId'];
		echo $_GET['taskId'];
		$definition = new Definition();
		$definition->get($_GET['definitionId']);
		if (isset($_GET['taskId'])) {
			$task = new Task();
			$task->get($_GET['taskId']);
		}
	?>
	<div class = "page-container">
		<div class = "app-container">
			<div class = "app">
				<section class = "app-panel theme-standard">
					<header><a href="./index.php" class="app-title">Project Copperfield</a></header>
					<aside>
						<?php require ($_SERVER["DOCUMENT_ROOT"]."/include/menu.php");?>
					</aside>
					<section class="content">
						<div class="settings-sharing">
							<h2 class="lable text heading"><?php echo $definition->name; ?></h2>
							<p class="lable text feature"><?php echo $definition->description; ?></p>
							<div class="content-box">
									<fieldset id="form" class="taskform">
										<form action="/scripts/addSuggestion.php" method="post">
											<input type="text" name="definitionId" value="<?php echo $_GET['definitionId']; ?>" hidden />
											<input type="text" name="taskId" value="<?php echo $_GET['taskId']; ?>" hidden />
											<input type="text" name="email" value="<?php echo $_GET['userId']; ?>" hidden />
											<input type="text" name="updateType" value="info" hidden />
										<?php 
											foreach($definition->info as $key => $value) {
										?>
										<div class="formrow">
											<div class="formfield">
												<span><?php echo $value['title']; ?></span>
												<span>
													<?php if ($value['type'] != 'textarea') { ?>
														<input class="small" type="<?php echo $value['type']; ?>" name="<?php echo $value['title']; ?>" value="<?php echo $task->info[$value['title']] ?>" <?php if ($value['required']=="yes") echo "required"; ?>>
													<?php } else { ?>
														<textarea class="large" name="<?php echo $value['title']; ?>" <?php if ($value['required']=="yes") echo "required"; ?>><?php echo $task->info[$value['title']]; ?></textarea>
													<?php } ?>
												</span>
											</div>
										</div>
										<?php 
											}
										?>
										<div class="formend">
										<input type="submit" class="label button2 shiny blue" value="Save"/>
									</div>
										</form>
									</fieldset>
									<fieldset class="taskform">
										<form action="/scripts/addSuggestion.php" method="post">
											<input type="text" name="definitionId" value="<?php echo $_GET['definitionId']; ?>" hidden />
											<input type="text" name="taskId" value="<?php echo $_GET['taskId']; ?>" hidden />
											<input type="text" name="email" value="<?php echo $_GET['userId']; ?>" hidden />
											<input type="text" name="updateType" value="comment" hidden />
											<textarea class="medium" name="comment"></textarea>
											<input type="submit" class="label button2 shiny blue" value="Post comment"/>
										</form>
										<?php 
											foreach($task->comments as $key => $value) {
										?>
											<div>
												<span><?php echo $value['user']; ?></span>
												<span><?php echo $value['date']; ?></span>
												<span><?php echo $value['comment']; ?></span>
											</div>
										<?php 
											}
										?>
									</fieldset>
									
							</div>
						</div>
					</section>
				</section>
			</div>
		</div>
	</div>
</body>
</html>      
