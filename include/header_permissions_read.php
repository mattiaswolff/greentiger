<a href="/index.php" class="app-title">Project Copperfield</a>

<?php 
session_start();
echo "You are logged in as: " . $_SESSION['userId'];
if($_SESSION['userId']==$_GET['userId']) { ?>
	<form id="login" method="Post" action="/scripts/logoutUser.php">
		<input type="submit" value="logout" />
	</form>
<?php } else { ?>
	<?php 
	$m = new Mongo();
	$db = $m->projectcopperfield;
	$results = $db->users->findOne(array('userId' => $_GET['userId']));
	if (in_array("read", $results['definitions'][$_GET['definitionId']]['permissions']['All'])) {
		if (isset($_SESSION['userId'])) {?>
		<form id="login" method="Post" action="/scripts/logoutUser.php">
			<input type="submit" value="logout" />
		</form>
		<?php } else { ?>
		<form id="login" method="Post" action="/scripts/loginUser.php">
			<input type="text" name="userId" />
			<input type="password" name="password" />
			<input type="submit" value="login" />
		</form>
		<?php }?>
	<?php } else { header('Location: /index.php'); } ?>
<?php } ?>

<?php 
	
 ?>
