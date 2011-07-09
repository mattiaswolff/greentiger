<nav class="app-nav">
		<ul>
			<li class="inbox">
				<a href="/user.php?userId=<?php echo $_SESSION['userId']; ?>"><span class="lable">Inbox</span></a>
				<ul class="sub">
					<?php
						$user_menu = new User();
						$user_menu->get($_SESSION['userId']);
						foreach ($user_menu->definitions as $key => $value) {
					?>
						<li><a href="/<?php echo $_SESSION['userId'];?>/definitions/<?php echo $key;?>/tasks"><span class="lable"><?php echo $value['name'];?></span></a>(<?php echo count($value['tasks']);?>)</li>
					<?php } ?>	
				</ul>
			</li>
		</ul>
</nav>
