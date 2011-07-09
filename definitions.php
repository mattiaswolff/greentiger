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
						<div class="settings-sharing">
							<h2 class="lable text heading">Definitions</h2>
							<div class="content-box">
								<form action="/scripts/updateUser.php" method="post">	
									<table>
										<thead>
											<tr>
												<th class="table medium">Definition</td>
											</tr>
										</thead>
										<tbody>
											<?php foreach($user->definitions as $key => $value) {?>
											<tr>
												<td class="form"><p class="text subheader"><a href="/<?php echo $_GET['userId']; ?>/definitions/<?php echo $key; ?>"><?php echo $value['name']; ?></a></p>
												<?php foreach($value['permissions'] as $key1 => $value1) {?>
													<p class="text feature">
														<?php echo $key1; ?>
													</p>
													Read: <input type="checkbox" name="array[<?php echo $key ?>][<?php echo $key1; ?>][]" value="read" <?php if (in_array("read", $value1)) echo "checked" ?> />
													Create: <input type="checkbox" name="array[<?php echo $key ?>][<?php echo $key1; ?>][]" value="create" <?php if (in_array("create", $value1)) echo "checked" ?> />
												<?php } ?>
											</tr>
											<?php } ?>	
										</tbody>
									</table>
									<div class="formend">
										<a href = "/<?php echo $_GET['userId']; ?>/definitions/new" class="button grey rounded no-underline">Add definition</a>
										<input type="submit" class="button grey rounded" value="Save"/>
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
