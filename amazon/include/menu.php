<nav class="app-nav">
		<ul>
			<li class="inbox">
				<a href="/v/tasks"><span class="lable">Inbox</span></a>
				<ul class="sub">
					<?php 
						$user_menu = new User();
						$user_menu->get('v');
						foreach ($user_menu->definitions as $key => $value) {
					?>
						<li><a href="/v/definitions/<?php echo $key;?>/tasks"><span class="lable"><?php echo $value['name'];?></span></a></li>
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
