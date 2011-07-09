<nav class="app-nav">
		<ul>
			<li class="inbox">
				<a href="/inbox_new.php"><span class="lable">Inbox</span></a>
				<ul class="sub">
					<?php 
						$user_menu = new User();
						$user_menu->get('v');
						foreach ($user_menu->definitions as $value) {
					?>
						<li><a href="/v/<?php echo $value['id'];?>/inbox"><span class="lable"><?php echo $value['name'];?></span></a></li>
					<?php } ?>	
				</ul>
			</li>
			<li class="definitions">
				<a href="/v/definitions"><span class="lable">Definitions</span></a>
				<ul class="sub">
				</ul>
			</li>
			<li class="settings">
				<a href="/v/settings"><span class="lable">Settings</span></a></li>
		</ul>
</nav>
