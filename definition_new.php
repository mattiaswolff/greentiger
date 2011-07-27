<!DOCTYPE HTML>
<html>

<head>
	
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

	<title>Project Copperfield</title>
	
	<link rel="stylesheet" type="text/css" href="/css/app.css" />
	<script type="text/javascript" src="/js/jquery.js"></script>
	<script type="text/javascript" src="/js/autoresize.jquery.min.js"></script>
	<script type="text/javascript">
	 $(document).ready(function(){
		$('td.delete > a').click(function(event){
			$(this).parent().parent().remove();
		});
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
		function addFormRow(){
				var newrow = document.createElement('tr');
				var counter = document.getElementsByTagName('tr').length - 1;
				newrow.innerHTML = '<td class="table action delete"><a href="#">D</a></td><td><input class="field" type="text" name="array[' + counter + '][title]" /></td><td><textarea class="field" name="array[' + counter + '][description]"></textarea></td><td><select class="field" name="array['+ counter +'][type]"><option value="text" >Text</option><option value="textarea">Textarea</option><option value="email">Email</option><option value="checkbox">Checkbox</option><option value="radio">Radio button</option><option value="date">Date</option><option value="range">Range</option><option value="url">URL</option><option value="number">Number</option><option value="time">Time</option><option value="dropdown">Drop Down</option></select></td><td><input class="field" type="checkbox" name="array[' + counter + '][required]" value="private" checked></td><td><textarea class="field" name="array[' + counter + '][properties]"></textarea></td>';
				document.getElementById("tbody").appendChild(newrow);
				$('td.delete > a').bind('click', function() {
					$(this).parent().parent().remove();
				});
		}
		
		function notification(text){
				document.getElementById("notification").innerHTML = text ;
		}
	</script>
	
</head>

<body id="<?php echo basename($_SERVER['PHP_SELF'], ".php"); ?>"> 
	<?php 
		require ($_SERVER["DOCUMENT_ROOT"]."/classes/definition.php");
		require ($_SERVER["DOCUMENT_ROOT"]."/classes/user.php");
		$definition = new Definition();
		$definition->get($_GET['definitionId']);
		$user = new User();
		$user->get($_GET['userId']);
	?>
	<div class = "page-container">
		<div class = "app-container">
			<div class = "app">
				<section class = "app-panel theme-standard">
					<header><?php require ($_SERVER["DOCUMENT_ROOT"]."/include/header_strict.php");?></header>
					<aside>
						<?php require ($_SERVER["DOCUMENT_ROOT"]."/include/menu.php"); ?>
					</aside>
					<section id="content">
						<form action="/scripts/manageDefinition.php" method="post">
						<h1 class="lable text subheader"><?php if (isset($definition->name)){ echo $definition->name; echo '<input type="text" name="name" value="' . $definition->name .'" hidden />'; } else { echo "Definition Title" . '<input type="text" name="name" />'; } ?></h1>
							<div class="content-box">
								<input type="text" name="_id" value="<?php echo $_GET['definitionId'];?>" hidden />
								<h3 class="lable text subheader">Description</h3>
								<textarea class="field" name="description"><?php echo $definition->description; ?></textarea>	
								<h3 class="lable text subheader">Permissions</h3>
								Public Read: <input type="checkbox" name="array['permissions']['All'][]" value="read" <?php if (in_array("read", $user->definitions[$definition->_id]['permissions']['All'])) echo "checked"; ?> /> Create: <input type="checkbox" name="array['permissions']['All'][]" value="create" <?php if (in_array("create", $user->definitions[$definition->_id]['permissions']['All'])) echo "checked"; ?> />
								<h2 class="lable text subheader">Fields</h2>
						
									<table>
										<thead>
											<tr>
												<th class="table action"></th>
												<th class="table medium">Title</th>
												<th class="table large">Description</th>
												<th class="table medium">Type</th>
												<th class="table small">Required</th>
												<th class="table large">Config</th>
											</tr>
										</thead>
										<tbody id="tbody">
											<?php foreach($definition->info as $key => $value) {?>
											<tr>
												<td class="table action delete"><a href="#">D</a></td>
												<td><input class="field" type="text" name="array[<?php echo $key; ?>][title]" value="<?php echo $value['title']; ?>" /></td>
												<td><textarea class="field" name="array[<?php echo $key ?>][description]"><?php echo $value['description']; ?></textarea></td>
												<td>
													<select class="field" name="array[<?php echo $key; ?>][type]">
														<option value="text" <?php if ($value['type'] == 'text') { echo "selected"; }; ?>>Text</option>
														<option value="textarea" <?php if ($value['type'] == 'textarea') { echo "selected"; }; ?>>Textarea</option>
														<option value="email" <?php if ($value['type'] == 'email') { echo "selected"; }; ?>>Email</option>
														<option value="checkbox" <?php if ($value['type'] == 'checkbox') { echo "selected"; }; ?>>Checkbox</option>
														<option value="radio" <?php if ($value['type'] == 'radio') { echo "selected"; }; ?>>Radio button</option>
														<option value="date" <?php if ($value['type'] == 'date') { echo "selected"; }; ?>>Date</option>
														<option value="range" <?php if ($value['type'] == 'range') { echo "selected"; }; ?>>Range</option>
														<option value="url" <?php if ($value['type'] == 'url') { echo "selected"; }; ?>>URL</option>
														<option value="number" <?php if ($value['type'] == 'number') { echo "selected"; }; ?>>Number</option>
														<option value="time" <?php if ($value['type'] == 'time') { echo "selected"; }; ?>>Time</option>
														<option value="dropdown" <?php if ($value['type'] == 'dropdown') { echo "selected"; }; ?>>Drop Down</option>
													</select>
												</td>
												<td><input class="field" type="checkbox" name="array[<?php echo $key ?>][required]" value="yes" checked></td>
												<td><textarea class="field" name="array[<?php echo $key ?>][properties]"><?php echo $value['properties']; ?></textarea></td>
											</tr>
											<?php } ?>
										</tbody>
									</table>
									<div class="formend">
										<span class="button grey rounded" onclick="addFormRow()">Add row</span>
										<input class="button grey rounded" type="submit" value="Save" />
									</div>
								</form>
							</div>
					</section>
				</section>
			</div>
		</div>
	</div>
</body>
</html>      
