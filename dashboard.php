<!DOCTYPE HTML>
<html>

<head>
	
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

	<title>Project Copperfield - test</title>
	
	<link rel="stylesheet" type="text/css" href="/css/main.css" />
	<script type="text/javascript" src="/js/jquery.js"></script>
	<script type="text/javascript" src="/js/autoresize.jquery.min.js"></script>
	<script type="text/javascript">
	$(document).ready(function(){
		
		$.getJSON("http://ec2-46-51-156-7.eu-west-1.compute.amazonaws.com/api2.php",
				{
					userId: "<?php echo $_GET['userId'];?>",
				},
				function(data) {
					var i = 0;
					var strDashboardBox = '';
					$.each(data.definitions, function(key, value) {
						strDashboardBox = '';
						strDashboardBox += '<article class="content_box medium blue';
						if (i % 2 != 0) {
							strDashboardBox += ' right';
							}
						strDashboardBox +='" id="' + key + '"><p class="text header small">' + value.name +'</p><p class="text small task"></p><p class="text small"><a href="/' + value.name +'/inbox.php">View all</a></p></article>';
						$("section.dashboard").append(strDashboardBox); 
						i = i + 1;
						$.getJSON("http://ec2-46-51-156-7.eu-west-1.compute.amazonaws.com/api3.php",
							{
								userId: "<?php echo $_GET['userId'];?>",
								definitionId: key
							},
							function(json) {
								var i = 0;
								var strTasks = '<ul>';
								$.each(json, function(key, value) {
									strTasks += '<li><span><a href="http://ec2-46-51-156-7.eu-west-1.compute.amazonaws.com/">'; 
                                    for(var prop in value.info) {
                                        strTasks += value.info.prop + '</a></span>';
                                        break;
								    }
									if (value.likes != null ) { strTasks += '<span class="meta"><span class="no-of-likes">' + value.likes.length + '</span>'} else { strTasks += '<span class="no-of-likes">0</span>' };
									if (value.comments != null ) { strTasks += '<span class="no-of-comments">' + value.comments.length + '</span>'} else { strTasks += '<span class="no-of-comments">0</span>' };
									strTasks +='</span></li>'; 
								});
								strTasks +='</ul>';
								$('#' + key +' .task').append(strTasks);
							});
						});
				});
		
		$("div.button").click(function(event) {
			$.getJSON("http://ec2-46-51-156-7.eu-west-1.compute.amazonaws.com/api.php",
				{
					definitionId: $(this).attr("title"),
				},
				function(data) {
					var strDynamicForm = "";
					$.each(data.info, function(key, value) { 
						if (jQuery.inArray(value.type,['text', 'email', 'url' , 'date', 'time']) != -1) { strDynamicForm += '<tr><td class="label">' + value.title + '</td><td><div class="field_container"><input type="' + value.type + '" class="inputtext" name="' + value.name + '" /></div></td></tr>'; }
						else if (jQuery.inArray(value.type,['number', 'range']) != -1) { strDynamicForm += '<tr><td class="label">' + value.title + '</td><td><div class="field_container"><input type="' + value.type + '" name="' + value.name + '" class="inputtext" min="' + value.properties.split(";")[0] + '" max="' + value.properties.split(";")[1] + '" step="' + value.properties.split(";")[2] + '" /></div></td></tr>'; }
						else if (value.type == 'dropdown') { 
							var strOptions = "";
							$.each(value.properties.split(";"), function(key1, value1) {
								strOptions += '<option>'+value1+'</option>';
							});
							strDynamicForm += '<tr><td class="label">' + value.title + '</td><td><div class="field_container"><select name="' + value.name + '" class="inputtext">'+ strOptions +'</select></td></tr>'; }
						else if (value.type == 'textarea') { strDynamicForm += '<tr><td class="label">' + value.title + '</td><td><div class="field_container"><textarea name="' + value.name + '"/></div></td></tr>'; }
					});
					$("#form").empty();
					$("#form").append('<table><tbody>' + strDynamicForm +'<tr><td class="label"></td><td><div class="field_container"><div class="button large green">Save</div></td></tr></tbody></table>'); 
					$('textarea').autoResize({
						onResize : function() {
							$(this).css({opacity:1});
						},
						animateCallback : function() {
							$(this).css({opacity:1});
						},
						animateDuration : 100,
						extraSpace : 20
					});
				});
		});
	});
	</script>   
</head>
<body id="home">
	<?php 
		date_default_timezone_set('Europe/Stockholm');
		require ($_SERVER["DOCUMENT_ROOT"]."/classes/definition.php");
		require ($_SERVER["DOCUMENT_ROOT"]."/classes/user.php");
		require ($_SERVER["DOCUMENT_ROOT"]."/classes/task.php");
		$user = new User();
		$user->get($_GET['userId']);
		if (isset($_GET['taskId'])) {
			$task = new Task();
			$task->get($_GET['taskId']);
		}
	?>
	<div id="container">
		<header>
			<span id="logo">ProjectLogo.com / <?php echo $user->userId; ?></span> 
		</header>  
		<section class="dashboard two_col">
			<form>
				<div>
					<?php foreach ($user->definitions as $key => $value) {?>
					<div class="button large blue" title="<?php echo $key?>"><?php echo $value["name"]?></div>
					<?php }?>
				</div>
				<div id="form">
					
				</div>
			</form>
		</section>
		<aside> 
			<p class="text header small">About us</p>
			<p class="text small"><?php echo $user->description; ?></p>
		</aside>
		<footer>
			<article class="content_box small"> 
				<span class="text header micro">Follow us</span><br/>
				<span class="text micro">Blog</span><br/>
				<span class="text micro">YouTube</span><br/>
				<span class="text micro">Facebook</span><br/>
				<span class="text micro">Twitter</span><br/>
				<span class="text micro">LinkedIn</span>
			</article>
			<article class="content_box small"> 
				<span class="text header micro">About us</span><br/>
				<span class="text micro">Jobs</span><br/>
				<span class="text micro">Investors</span><br/>
				<span class="text micro">Press</span><br/>
				<span class="text micro">Contact</span><br/>
				<span class="text micro">LinkedIn</span>
			</article>
			<article class="content_box small"> 
				<span class="text header micro">Help</span><br/>
				<span class="text micro">FAQ</span><br/>
				<span class="text micro">Developers recources</span><br/>
				<span class="text micro">Facebook</span><br/>
				<span class="text micro">Twitter</span><br/>
				<span class="text micro">LinkedIn</span>
			</article>
		</footer>
	</div>
</body>
</html>
