<!DOCTYPE HTML>
<html>

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title>Project Copperfield</title>
	<link rel="stylesheet" type="text/css" href="/css/app.css" />
	<script type="text/javascript" src="/js/jquery.js"></script>
	<script type="text/javascript" src="/js/jquery.tablesorter.min.js"></script>
	<script type="text/javascript" src="/js/jquery.tablesorter.pager.js"></script>
	<script type="text/javascript">
		$(document).ready(function() 
			{ 
				$("#inboxTable") 
				.tablesorter() 
				.tablesorterPager({container: $("#pager")}); 
			} 
		); 
		
		function showResult(str, definitionId) {
			if (str.length==0){ 
				document.getElementById("livesearch").innerHTML="";
				document.getElementById("livesearch").style.border="0px";
				return;
			}
			if (window.XMLHttpRequest) {// code for IE7+, Firefox, Chrome, Opera, Safari
				xmlhttp=new XMLHttpRequest();
			}
			else {// code for IE6, IE5
				xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
			}
			xmlhttp.onreadystatechange=function() {
				if (xmlhttp.readyState==4 && xmlhttp.status==200){
					document.getElementById("livesearch").innerHTML=xmlhttp.responseText;
					document.getElementById("livesearch").style.border="1px solid #A5ACB2";
				}
			}	
		xmlhttp.open("GET","/scripts/livesearch.php?q="+str+"&definitionId="+definitionId,true);
		xmlhttp.send();
		}
	</script>

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
					<header><?php require ($_SERVER["DOCUMENT_ROOT"]."/include/header_permissions_read.php");?></header>
					<aside>
						<?php require ($_SERVER["DOCUMENT_ROOT"]."/include/menu.php");?>
					</aside>
					<section id="content">
						<div class="settings-sharing">
							<div class="part header">
								<img class="image medium" src="http://1.bp.blogspot.com/_qtUS1n_seHA/TSV2zh7kk4I/AAAAAAAAE00/RlK2-6ZMHJs/s200/hm-logo.png" />
								<div class="float-left">
									<h2 class="text subheader"><?php echo $definition->name;?></h2>
									<p class="text feature"><?php echo $definition->description;?></p>
									<form action="/<?php echo $_GET['userId']; ?>/definitions/<?php echo $_GET['definitionId']; ?>/tasks" method="get">
										<input value="" title="Sök" autocomplete="on" class="field search" type="text" name="query" size="41" maxlength="2048" spellcheck="false">
										<input value="Search" class="button search grey" type="submit">
										<a href="/<?php echo $_GET['userId']; ?>/definitions/<?php echo $_GET['definitionId']; ?>/tasks/new" class="button grey no-underline rounded right margin">Create new</a>
									</form>
								</div>
							</div>
							<div class="part content">
								<table id="inboxTable" class="tablesorter"> 
									<thead> 
										<tr>
											<th class="table action"></th>
											<th class="table action">C</th> 
											<th class="table action">L</th>  
											<?php foreach ($definition->info as $value) { ?>
											<th><?php echo $value['title'];?></th> 
											<?php } ?> 
										</tr> 
									</thead> 
									<tbody> 
									<?php 
									$m = new Mongo();
									$db = $m->projectcopperfield;
									if (isset($_GET['query'])) $query = array('keywords' => $_GET['query'], '_id' => array('$in' => $user->definitions[$_GET['definitionId']]['tasks']));
									else $query = array('_id' => array('$in' => $user->definitions[$_GET['definitionId']]['tasks']));
									//if (isset($_GET['page'])) $skip = (int)('20' * ($_GET['page'] - 1));
									//else $skip = 0;
									//$results = $db->tasks->find($query)->limit('20')->skip($skip);
									$results = $db->tasks->find($query);
									foreach($results as $key => $value) { ?>
									<tr>
											<td class="table action"><a href="./<?php echo $value['_id'];?>">E</a></td>
											<td class="table action"><?php echo count($value['comments']);?></td>
											<td class="table action"><?php echo count($value['likes']);?></td>
										<?php foreach($definition->info as $value1) { ?>
											<td class="text table"><?php if (is_array($value['info'][$value1['title']])) { echo implode(", ", $value['info'][$value1['title']]); } else { echo $value['info'][$value1['title']];}?></td>
										<?php } ?>
									</tr>
									<?php } ?>
									</tbody>
								</table>
								<div id="pager">
									<form>
										<img src="/images/pager_first.png" class="first"/>
										<img src="/images/pager_prev.png" class="prev"/>
										<input type="text" class="pagedisplay"/>
										<img src="/images/pager_next.png" class="next"/>
										<img src="/images/pager_last.png" class="last"/>
										<select class="pagesize">
								            <option value="10">10</option>
								            <option selected="selected" value="20">20</option>
								            <option value="30">30</option>
								            <option  value="40">40</option>
										</select>
									</form>
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
