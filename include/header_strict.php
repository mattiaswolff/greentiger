<a href="/index.php" class="app-title">Project Copperfield</a>

<?php session_start();
echo "You are logged in as: " . $_SESSION['userId'];
if($_SESSION['userId'] == $_GET['userId']) { ?>
<form id="login" method="Post" action="/scripts/logoutUser.php">
	<input type="submit" value="logout" />
</form>
<?php } else {
	header('Location: /index.php');
 } ?>
