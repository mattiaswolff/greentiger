<!DOCTYPE HTML>
<html>

<head>
	
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

	<title>Project Copperfield</title>
	
	<link rel="stylesheet" type="text/css" href="./css/app.css" />

   
</head>

<body id="<?php echo basename($_SERVER['PHP_SELF'], ".php"); ?>"> 
	<?php 
		require ($_SERVER["DOCUMENT_ROOT"]."/projectcopperfield/classes/user.php");		
	?>
	<div class = "page-container">
		<div class = "app-container">
			<div class = "app">
				<section class = "app-panel theme-standard">
					<header><a href="./index.php" class="app-title">Project Copperfield</a></header>
					<aside>
						<?php require ($_SERVER["DOCUMENT_ROOT"]."/projectcopperfield/include/menu.php"); ?>
					</aside>
					<section class="content">
						<div class="settings-sharing">
							<h2 class="lable text heading">Sharing</h2>
							<p class="lable text feature">Select sharing options for each definition in use.</p>
							<div class="conent-box"> 	 	
								<p class="lable text body">Set sharing options to decide if the tasks you use should be private or public.</p>
								<fieldset class="lable text body">
									<div class="formrow title">
										<div class="formlabel">Defintion</div>
										<div class="formfield">
											<span>Private</span>
											<span>Public</span>
										</div>
									</div>
									<div class="formrow">
										<div class="formlabel">Agreement</div>
										<div class="formfield">
											<span><input type="radio" name="definition" value="public"></span>
											<span><input type="radio" name="definition" value="private" checked></span>
										</div>
									</div>
									<div class="formrow">
										<div class="formlabel">Suggestion</div>
										<div class="formfield">
											<span><input type="radio" name="definition" value="public"></span>
											<span><input type="radio" name="definition" value="private" checked></span>
										</div>
									</div>
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
