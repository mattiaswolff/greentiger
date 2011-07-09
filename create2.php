<!DOCTYPE HTML>
<html>

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title>Project Copperfield</title>
	<link rel="stylesheet" type="text/css" href="/css/app.css" />   
</head>
<body id="<?php echo basename($_SERVER['PHP_SELF'], ".php"); ?>"> 
	<?php 
		date_default_timezone_set('Europe/Stockholm');
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
					<header><?php require ($_SERVER["DOCUMENT_ROOT"]."/include/header.php");?></header>
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
										<?php foreach($definition->info as $key => $value) { $properties = explode(";",$value['properties']);?>
										<div class="formrow">
											<div class="formfield">
												<span><?php echo $value['title']; ?></span>
												<span>
													<?php if (in_array($value['type'], array('text', 'email', 'url' , 'date', 'time'))) { ?>
														<input class="small" type="<?php echo $value['type']; ?>" name="<?php echo $value['title']; ?>" value="<?php echo $task->info[$value['title']] ?>" <?php if ($value['required']=="yes") echo "required"; ?>>
													<?php } elseif (in_array($value['type'], array('checkbox'))) { ?>
														<?php foreach(explode(";",$value['properties']) as $key1 => $value1) {?>
															<?php echo $value1 . ":"; ?><input type="<?php echo $value['type']; ?>" name="<?php echo $value['title']; ?>[]" value="<?php echo $value1; ?>" <?php if (in_array($value1, $task->info[$value['title']])) echo "checked"; ?>>
														<?php } ?>
													<?php } elseif (in_array($value['type'], array('number', 'range'))) { ?>
														<input class="small" type="<?php echo $value['type']; ?>" name="<?php echo $value['title']; ?>" value="<?php echo $task->info[$value['title']] ?>" min="<?php echo $properties[0]; ?>" max="<?php echo $properties[1]; ?>" step="<?php echo $properties[2]; ?>" <?php if ($value['required']=="yes") echo "required"; ?>>
													<?php } elseif (in_array($value['type'], array('radio'))) { ?>
														<?php foreach(explode(";",$value['properties']) as $key1 => $value1) {?>
															<?php echo $value1 . ":"; ?><input type="<?php echo $value['type']; ?>" name="<?php echo $value['title']; ?>" value="<?php echo $value1; ?>" <?php if ($value['required']=="yes") echo "required "; if ($task->info[$value['title']]==$value1) echo "checked"; ?>>
														<?php } ?>
													<?php } elseif (in_array($value['type'], array('textarea'))) { ?>
														<textarea class="large" name="<?php echo $value['title']; ?>" <?php if ($value['required']=="yes") echo "required"; ?>><?php echo $task->info[$value['title']]; ?></textarea>
													<?php } elseif (in_array($value['type'], array('dropdown'))) { ?>
														<select class="large" name="<?php echo $value['title']; ?>" <?php if ($value['required']=="yes") echo "required"; ?>>
															<?php foreach ($properties as $value1) { ?>
															<option value="<?php echo $value1; ?>" <?php if ($value1==$task->info[$value['title']]) echo "selected"; ?>><?php echo $value1; ?></option>
															<?php } ?>
														</select>
													<?php } ?>
												</span>
											</div>
										</div>
										<?php 
											}
										?>
										<div class="formend">
										<input type="submit" class="button grey rounded" value="Save"/>
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
											<input type="submit" class="button grey rounded" value="Post comment"/>
										</form>
										<?php 
											foreach($task->comments as $key => $value) {
										?>
											<div>
												<span><?php echo $value['email']; ?></span>
												<span><?php echo date('Y-m-d H:i:s',$value['date']->sec); ?></span>
												<p>
													<span><?php echo $value['comment']; ?></span>
												</p>
											</div>
										<?php 
											}
										?>
										<form enctype="multipart/form-data" action="/scripts/upload.php" method="POST">
											<input name="taskId" type="text" value="<?php echo $_GET['taskId']; ?>" hidden/>
											Choose a file to upload: <input name="Filedata" type="file" required/><br />
											<input type="submit" value="Upload File" />
										</form>
										<?php 
											foreach($task->attachments as $key => $value) {
										?>
											<div>
												<object style="width: 100%" type="<?php echo $value["type"]?>" data="/scripts/showAttachment.php?attachmentId=<?php echo $value["id"]?>"></object>
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
