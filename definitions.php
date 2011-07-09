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
				newrow.innerHTML = '<div class="formrow"><div class="formlabel"><span class="label text body"><input type="text" name="array[' + counter + '][name]" /></span></div><div class="formfield"><span><input type="radio" name="array['+ counter +'][share]" value="public"></span><span><input type="radio" name="array[' + counter + '][share]" value="private" checked></span>';
				document.getElementById("form").appendChild(newrow);
		}
	</script>
   
</head>

<body id="<?php echo basename($_SERVER['PHP_SELF'], ".php"); ?>"> 
	<?php 
		require ($_SERVER["DOCUMENT_ROOT"]."/classes/user.php");
		$user = new User();
		$user->get('v');
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
						<div class="settings-sharing">
							<h2 class="lable text heading">Definitions</h2>
							<p class="lable text feature">Select definitions to be used and decide if they are to be private or public.</p>
							<div class="content-box">
								<h2 class="lable text subheading">Manage definitions</h2>
								<p class="lable text body">Set sharing options to decide if the tasks you use should be private or public.</p>
								<form action="./scripts/updateUser.php" method="post">	
									<fieldset id="form">
										<div class="formrow title">
											<div class="formlabel">
												<span class="label text body">Definition</span>
											</div>
											<div class="formfield">
												<span class="label text body">Public</span>
												<span class="label text body">Private</span>
											</div>
										</div>
										<?php 
											foreach($user->definitions as $key => $value) {
										?>
										<div class="formrow">
											
											<div class="formlabel">
												<input type="text" name="array[<?php echo $key ?>][id]" value="<?php echo $value['id'] ?>" hidden />
												<input type="text" name="array[<?php echo $key ?>][name]" value="<?php echo $value['name'] ?>" hidden />
												<a href="/<?php echo $_GET['userId']; ?>/definitions/<?php echo $key; ?>"><span class="label text body"><?php echo $value['name']; ?></span></a>
											</div>
											<div class="formfield">
												<span><input type="radio" name="array[<?php echo $key ?>][share]" value="public" <?php if ($value['share']=="public") echo "checked"; ?>></span>
												<span><input type="radio" name="array[<?php echo $key ?>][share]" value="private" <?php if ($value['share']=="private") echo "checked"; ?>></span>
												<a href="/scripts/removeDefinition.php?definitionId=<?php echo $value['id']; ?>"><span class="label text body"><img src="/images/remove.png" /></span></a>
											</div>
										</div>
										<?php 
											}
										?>
									</fieldset>
									<div class="formend">
										<a href = "/<?php echo $_GET['userId']; ?>/definitions/new"><span class="label button2 shiny grey">Add definition</span></a>
										<input type="submit" class="label button2 shiny blue" value="Save"/>
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
