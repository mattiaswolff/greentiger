<!DOCTYPE HTML>
<html>

<head>
	
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

	<title>Project Copperfield</title>
	
	<link rel="stylesheet" type="text/css" href="./css/main.css" />

   
</head>

<body id="home">
	<header>	
		<?php require ("header.php"); require ("./classes/task.php"); ?> 
	</header> 
	<section id = "content">			
		<article> 	 	
			<form action="./scripts/updateUser.php" method="post">
				<?php 
					$m = new Mongo();
					$db = $m->projectcopperfield;
					$collection = $db->definitions;
					
					$results_user = $db->users->findOne(array('email' => $_SESSION['email']));?> 

					<table>
						<tr>
							<td>Name</td>
							<td>Read</td>
						</tr>	
					<?php foreach ($results_user['definitions'] as $result1) { 
						echo '<input type=hidden name="definitionId[]" value="' . $result1['id'] . '">';
						echo '<input type=hidden name="definitionName_' . $result1['id'] . '" value="' . htmlspecialchars($result1['name']) . '">';
						echo '<tr><td>' . $result1['name'] . '</td><td><select name = "definitionVisible_' . $result1['id'] . '"><option value ="private">private</option><option value ="public">public</option></select>';
						}?>
					</table>
					<br>add def / create def
					<br><input type="Submit"/>
					
			</form>	
		</article>
	</section>		
	<footer>
		<?php			
			require ("footer.php"); 
		?> 
	</footer>
</body>
</html>      
