<a href="/index.php" class="app-title">Project Copperfield</a>

<?php session_start();
echo "You are logged in as: " . $_SESSION['userId'];
if(!isset($_SESSION['valid'])) { ?>
<form id="login" method="Post" action="/scripts/loginUser.php">
	<input type="text" name="userId" />
	<input type="password" name="password" />
	<input type="submit" value="login" />
</form>
<?php } else { ?>
<form id="login" method="Post" action="/scripts/logoutUser.php">
	<input type="submit" value="logout" />
</form>
<?php } ?>

<?php 
	
 ?>
