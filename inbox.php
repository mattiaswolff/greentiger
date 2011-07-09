<!DOCTYPE HTML>
<html>

<head>
	
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

	<title>Project Copperfield</title>
	
	<link rel="stylesheet" type="text/css" href="./css/main.css" />
   	
</head>

<body id="home">
	
	<header>	
		<?php require ("header.php"); require ("./classes/task.php");?> 
	</header> 
	
	<section id = "content">			
		<section id = "search">
			<form action="./inbox.php" method="get">
				<input type="search" name="q" <?php if (!isset($_GET['q'])) { echo 'placeholder="' . 'search..."';} else { echo 'value="' . $_GET['q'] . '"';}?> autofocus/>
				<div id="livesearch"></div>
			</form>
			<?php
					if (!isset($_GET['q'])) {
					  	$_GET['q'] = "search...";
					}				
					if (!isset($_GET['page'])) {
	    					$_GET['page'] = "1";
					}	
					$results_inbox = getTask($_GET['q'], "18", $_GET['page'], $_SESSION['email']);	
			?>
		</section>	
		<section id = "inbox">
			<?php
				foreach($results_inbox as $res) { ?>
					<article draggable="true">
						<h1>
							<?php echo reset($res['info']); ?>
							<a href="./scripts/forwardTask.php?id=<?php echo $res['_id']; ?>">L</a> (<?php echo count($res['likes']); ?>) 
							<a href="./scripts/forwardTask.php?id=<?php echo $res['_id']; ?>">C</a> (<?php echo count($res['comments']); ?>)
						</h1>
						<p>
							<?php foreach ($res['info'] as $key => $value) {
								echo $value . ' ';			
								} ?>
						</p>
						<aside>
							<?php echo '<a href="./scripts/deleteTask.php?id=' . $res['_id'] . '">'; ?><img src="./images/remove.png" /></a>
						</aside>
					</article>
			<?php } ?>		
		</section>
		<aside id="col">
			<?php	
				$results = getTask("favourite", "6", $_GET['page'], $_SESSION['email']);
				
			foreach($results as $result)
				{echo 'test';
    				 	echo '<article draggable="true"><h1>' . $result['title'] . ' <a href="./scripts/likeTask.php?id=' . $result['_id'] . '">L</a> (' . count($result['likes']) . ') <a href="./scripts/commentTask.php?id=' . $result['_id'] . '">C</a> (' . count($result['comments']) .  ')</h1>';
					echo "<p>". $result['description'] . "</p>";
				?>
							<aside>
								<?php echo '<a href="./forwardTask.php?id=' . $result['_id'] . '">'; ?><img src="./images/forwardarrow.png" /></a>
								<?php echo '<a href="./returnTask.php?id=' . $result['_id'] . '">'; ?><img src="./images/previous.png"/></a>
								<?php echo '<a href="./deleteTask.php?id=' . $result['_id'] . '">'; ?><img src="./images/remove.png" /></a>
							</aside></article>	
				<?php
			
				}

			?>
		</aside>
		<section id="paging">

				<?php
				/*if ($_GET['page'] > 1) {
					echo "<a href='./viewInbox.php?page=" . ($_GET['page'] - 1) . "'>Previous page</a> ";	 
				}*/				
										
				for ($i = max('1', $_GET['page'] - 9);$i <= min(ceil($results_inbox->count()/18), $_GET['page'] + 9); $i++){
					echo '<a href="./inbox.php?page=' . $i . '">' . $i . '</a>' . ' ';}
				
				/*if ($_GET['page'] < ceil($results->count()/18)) {
					echo " <a href='./viewInbox.php?page=" . ($_GET['page'] + 1) . "'>Next page</a>" . " "; 
				}*/		
				?>
		</section>
	</section>
					
	<footer>
		<?php			
			require ("footer.php"); 
		?> 
	</footer>

</body>
</html>      
