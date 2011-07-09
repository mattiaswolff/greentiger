<!DOCTYPE HTML>
<html>

<head>
	
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

	<title>Project Copperfield</title>
	
	<link rel="stylesheet" type="text/css" href="/css/app.css" />

</head>

<body id="<?php echo basename($_SERVER['PHP_SELF'], ".php"); ?>"> 
	<?php 
		require ($_SERVER["DOCUMENT_ROOT"]."/classes/definition.php");
		require ($_SERVER["DOCUMENT_ROOT"]."/classes/user.php");
		$definition = new Definition();
		$definition->get($_GET['definitionId']);
		$user = new User();
		$user->get($_GET['userId']);		
	?>
	<div class = "page-container">
		<div class = "app-container">
			<div class = "app">
				<section class = "app-panel theme-standard">
					<header><a href="./index.php" class="app-title">Project Copperfield</a></header>
					<aside>
						<?php require ($_SERVER["DOCUMENT_ROOT"]."/include/menu.php");?>
					</aside>
					<section class="content">
						<div class="settings-sharing">
							<h2 class="lable text heading"><?php echo $definition->name;?></h2>
							<form action="/<?php echo $_GET['userId']; ?>/<?php echo $_GET['definitionId']; ?>/inbox" method="get">
								<input value="" title="Sök" autocomplete="off" class="searchfield" type="text" name="query" size="41" maxlength="2048" spellcheck="false">
								<input value="Search" class="searchbutton" type="submit" name="btnG">
								<a href="/v/definitions/<?php echo $_GET['definitionId']; ?>/tasks/new"><span class="createbutton">Create</span></a>
							</form>
							<div class="content-box">	
								<fieldset id="inbox">
									<div class="inboxrow title">
										<div class="inboxfield">
											<span class="label text body"></span>
											<?php foreach ($definition->info as $value) { ?>
												<span class="label text body"><?php echo $value['title'];?></span>
											<?php } ?>
										</div>
									</div>
									<?php 
									$m = new Mongo();
									$db = $m->projectcopperfield;
									if (isset($_GET['query'])) $query = array('keywords' => $_GET['query'], '_id' => array('$in' => $user->definitions[$_GET['definitionId']]['tasks']));
									else $query = array('_id' => array('$in' => $user->definitions[$_GET['definitionId']]['tasks']));
									if (isset($_GET['page'])) $skip = (int)('20' * ($_GET['page'] - 1));
									else $skip = 0;
									$results = $db->tasks->find($query)->limit('20')->skip($skip);
									foreach($results as $key => $value) { ?>
									<div class="inboxrow">
										<div class="inboxfield">
											<a href="/<?php echo $_GET['userId'];?>/definitions/<?php echo $_GET['definitionId'];?>/tasks/<?php echo $value['_id'];?>"><span class="label text body">edit</span></a>
											<?php foreach($value['info'] as $key1 => $value1) { ?>
												<span class="label text body"><?php echo $value1;?></span>
											<?php } ?>
										</div>
									</div>
									<?php } ?>
								</fieldset>
								<div class="inboxend">
									<?php
										for ($i = max('1', $_GET['page'] - 9);$i <= min(ceil($results->count()/18), $_GET['page'] + 9); $i++){
										echo '<a href="/v/definitions/' .$_GET['definitionId'] .'/tasks?&query=' . $_GET['query'] . '&page=' . $i . '">' . $i . '</a>' . ' ';}
									?>
								</div>
							</div>
						</div>
					</section>
				</section>
			</div>
		</div>
	</div>
</body>
</html>      
