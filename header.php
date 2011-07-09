		<?php		
				require ($_SERVER["DOCUMENT_ROOT"]."/scripts/functions/loginFunctions.php");	

				if (!isLoggedIn()) { 
					 header('Location: login.php');
				}
				else { ?>
				<div id="login">
					<form action="./scripts/logoutUser.php" method="post">
						<input type="submit" value="log out" />	
					</form>		
				</div>
		<?php } ?>
