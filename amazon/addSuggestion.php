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
			<form action="./scripts/addSuggestion.php" method="post">
				<?php 
					$m = new Mongo();
					$db = $m->projectcopperfield;
					$collection = $db->definitions;
					
					$results_user_definitions = $db->users->findOne(array('email' => $_SESSION['email']), array('definitions'));
					
					echo '<select ONCHANGE="location = this.options[this.selectedIndex].value;">';
					
					
					foreach ($results_user_definitions['definitions'] as $result1) {
							
							echo '<option value ="addSuggestion.php?id=' . $result1['id'] . '"';
							
							if ($result1['id'] == $_GET['id']) {
								echo ' selected="yes"';
								$id['id'] = $_GET['id'];
							}	
							
							elseif ($result1['id'] == $results_user_definitions['definitions'][0]['id']) {
									echo ' selected="yes"';
									$id['id'] = $result1['id'];
							}
							
							echo '>' . $result1['name'] . '</option>';
					}
					
					echo '</select>';
					
					echo '<input type="text" name="definitionId" value ="' . $id['id'] . '" hidden/>';
					echo '<input type="text" name="email" value ="' . $_SESSION['email'] . '" hidden/>';
					
					$query = array('_id' => new MongoId($id['id']));
					
					$results = $collection->find($query);

					foreach ($results as $result2) {
						
						foreach ($result2['info'] as $result) { ?> 
						
							<p><?php echo $result['title'];?></p>
							<?php if ($result['type'] != 'textarea') { ?>
								<input type="<?php echo $result['type'];?>" name="<?php echo $result['title'];?>" <?php if ($result['required']) { echo 'required'; } ?>/>
							<?php } 
							else { ?>
								<textarea type="<?php echo $result['type'];?>" name="<?php echo $result['title'];?>" <?php if ($result['required']) { echo 'required'; } ?>></textarea>
							<?php }
							}} ?>
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
