<!DOCTYPE HTML>
<html>

<head>
	
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

	<title>Project Copperfield</title>
	
	<link rel="stylesheet" type="text/css" href="/css/app.css" />

	<script type="text/javascript">
		function addFormRow(){
				var newrow = document.createElement('div');
				var counter = document.getElementsByClassName('formrow').length - 1;
				newrow.innerHTML = '<div class="formrow"><div class="formlabel"><span class="label text body"><input type="text" name="array[' + counter + '][title]" /></span></div><div class="formfield"><span><select name="array['+ counter +'][type]"><option value="text" >Text</option><option value="textarea">Textarea</option><option value="email">Email</option><option value="checkbox">Checkbox</option></select></span><span><input type="checkbox" name="array[' + counter + '][required]" value="private" checked></span></div></div>';
				document.getElementById("form").appendChild(newrow);
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
	?>
	<div class = "page-container">
		<div class = "app-container">
			<div class = "app">
				<section class = "app-panel theme-standard">
					<header><a href="./index.php" class="app-title">Project Copperfield</a></header>
					<aside>
						<?php require ($_SERVER["DOCUMENT_ROOT"]."/include/menu.php"); ?>
					</aside>
					<section class="content">
						<div id="notfication"></div>
						<div class="definition">
							<h2 class="lable text heading">Edit definition</h2>
							<p class="lable text feature">Edit this definition by adding or removeing fields, changing titles etc.</p>
							<div class="content-box">
								<form action="/scripts/manageDefinition.php" method="post">
								<h2 class="lable text subheading"><?php if (isset($definition->name)){ echo $definition->name; echo '<input type="text" name="name" value="' . $definition->name .'" hidden />'; } else { echo "Definition Title" . '<input type="text" name="name" />'; } ?></h2>
								<p class="lable text body">Set sharing options to decide if the tasks you use should be private or public.</p>
									<fieldset id="form">
										<div class="formrow title">
											<input type="text" name="_id" value="<?php echo $_GET['definitionId'];?>" hidden />
											<div class="formlabel">
												<span class="label text body">Field title</span>
											</div>
											<div class="formfield">
												<span class="label text body">Type</span>
												<span class="label text body">Required</span>
											</div>
										</div>
										<?php 
											foreach($definition->info as $key => $value) {
										?>
										<div class="formrow">
											<div class="formlabel">
												<span class="label text body"><input type="text" name="array[<?php echo $key; ?>][title]" value="<?php echo $value['title']; ?>" /></span>
											</div>
											<div class="formfield">
												<span>
													<select name="array[<?php echo $key; ?>][type]">
														<option value="text" <?php if ($value['type'] == 'text') { echo "selected"; }; ?>>Text</option>
														<option value="textarea" <?php if ($value['type'] == 'textarea') { echo "selected"; }; ?>>Textarea</option>
														<option value="email" <?php if ($value['type'] == 'email') { echo "selected"; }; ?>>Email</option>
														<option value="checkbox" <?php if ($value['type'] == 'checkbox') { echo "selected"; }; ?>>Checkbox</option>
													</select>
												</span>
												<span><input type="checkbox" name="array[<?php echo $key ?>][required]" value="yes" checked></span>
											</div>
										</div>
										<?php 
											}
										?>
									</fieldset>	
									<span class="label button2 shiny grey" onclick="addFormRow()">Add row</span>
									<span class="label button2 shiny grey" onclick="notification('hej')">not</span>
									<div class="formend">
										<span class="label button2 shiny blue">Preview</span>
										<input type="submit" class="label button2 shiny blue" value="Save" />
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
