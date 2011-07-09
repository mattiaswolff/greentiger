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
					<header><?php require ($_SERVER["DOCUMENT_ROOT"]."/include/header_permissions_create.php");?></header>
					<aside>
						<?php require ($_SERVER["DOCUMENT_ROOT"]."/include/menu.php");?>
					</aside>
					<section id="content">
						<div class="settings-sharing">
							<h2 class="lable text heading"><?php echo $definition->name; ?></h2>
							<p class="lable text feature"><?php echo $definition->description; ?></p>
							<div class="content-box">
								<form action="/scripts/addSuggestion.php" method="post">
									<input type="text" name="definitionId" value="<?php echo $_GET['definitionId']; ?>" hidden />
									<input type="text" name="taskId" value="<?php echo $_GET['taskId']; ?>" hidden />
									<input type="text" name="userId" value="<?php echo $_GET['userId']; ?>" hidden />
									<table>
										<thead>
											<tr>
												<th>Information</th>
												<th>Social</th>
											</tr>
										</thead>
										<tbody>
											<?php 
											$first = true;
											foreach($definition->info as $key => $value) {$properties = explode(";",$value['properties']);?>
											<tr>
												<td class="form"><p class="text subheader"><?php echo $value['title']; ?></p>
												<p class="text feature"><?php echo $value['description']; ?></p>
													<?php if (in_array($value['type'], array('text', 'email', 'url' , 'date', 'time'))) { ?>
														<input class="field" type="<?php echo $value['type']; ?>" name="<?php echo $value['title']; ?>" value="<?php echo $task->info[$value['title']] ?>" <?php if ($value['required']=="yes") echo "required"; ?>>
													<?php } elseif (in_array($value['type'], array('checkbox'))) { ?>
														<?php foreach(explode(";",$value['properties']) as $key1 => $value1) {?>
															<?php echo $value1 . ":"; ?><input type="<?php echo $value['type']; ?>" name="<?php echo $value['title']; ?>[]" value="<?php echo $value1; ?>" <?php if (in_array($value1, $task->info[$value['title']])) echo "checked"; ?>>
														<?php } ?>
													<?php } elseif (in_array($value['type'], array('number', 'range'))) { ?>
														<input class="field" type="<?php echo $value['type']; ?>" name="<?php echo $value['title']; ?>" value="<?php echo $task->info[$value['title']] ?>" min="<?php echo $properties[0]; ?>" max="<?php echo $properties[1]; ?>" step="<?php echo $properties[2]; ?>" <?php if ($value['required']=="yes") echo "required"; ?>>
													<?php } elseif (in_array($value['type'], array('radio'))) { ?>
														<?php foreach(explode(";",$value['properties']) as $key1 => $value1) {?>
															<?php echo $value1 . ":"; ?><input type="<?php echo $value['type']; ?>" name="<?php echo $value['title']; ?>" value="<?php echo $value1; ?>" <?php if ($value['required']=="yes") echo "required "; if ($task->info[$value['title']]==$value1) echo "checked"; ?>>
														<?php } ?>
													<?php } elseif (in_array($value['type'], array('textarea'))) { ?>
														<textarea class="field" name="<?php echo $value['title']; ?>" <?php if ($value['required']=="yes") echo "required"; ?>><?php echo $task->info[$value['title']]; ?></textarea>
													<?php } elseif (in_array($value['type'], array('dropdown'))) { ?>
														<select class="field" name="<?php echo $value['title']; ?>" <?php if ($value['required']=="yes") echo "required"; ?>>
															<?php foreach ($properties as $value1) { ?>
															<option value="<?php echo $value1; ?>" <?php if ($value1==$task->info[$value['title']]) echo "selected"; ?>><?php echo $value1; ?></option>
															<?php } ?>
														</select>
													<?php } ?>
												</td>
												<?php if ($first) { ?>
												<td class="form" rowspan="100%">
														<textarea class="field" name="comment"></textarea>
														<input type="submit" class="button grey rounded" name="updateType" value="Post Comment"/>
													</form>
													<?php foreach($task->comments as $key => $value) { ?>
													<div>
														<hr/>
														<a href="/<?php echo $value['userId']; ?>"><span class="text subheader no-underline"><?php echo $value['userId']; ?></span></a>
														<span class="text feature"><?php echo date('Y-m-d H:i:s',$value['date']->sec); ?></span>
														<p>
															<span><?php echo $value['comment']; ?></span>
														</p>
													</div>
													<?php } ?>
												</td>
												<?php $first = false; } ?>
											</tr>
											<?php } ?>
										</tbody>	
									</table>
									<div class="formend">
										<input type="submit" class="button grey rounded" name="updateType" value="Save"/>
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
