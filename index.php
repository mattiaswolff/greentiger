<!DOCTYPE HTML>
<html>

<head>
	
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

	<title>Project Copperfield</title>
	
	<link rel="stylesheet" type="text/css" href="/projectcopperfield/css/main.css" />

</head>

<body id="home">
	
	<header>
		<div id="login">
		<?php		
				require './scripts/functions/loginFunctions.php';	
				
				if (!isLoggedIn()) { ?>
					<form action="./scripts/loginUser.php" method="post">
						<input type="text" placeholder="user name" name="email" />
						<input type="password" placeholder="password" name="password" />
						<input type="submit" value="log in" />	
					</form>
		<?php		} else {?>
					<form action="./scripts/logoutUser.php" method="post">
						<input type="submit" value="log out" />	
					</form>		
		<?php		}					
		?>
	    </div>
		
		<hgroup>
			<a href="./index.php"><h1>Project Copperfield</h1></a> 
		</hgroup>
		 
		<nav>
  			<ul>  	
				<li><a href="./inbox.php">inbox</a></li>
				<li><a href="./addSuggestion.php">task</a></li>
  			</ul>  
  		</nav>
	</header>  

	<section id="content">
		
		<article> 
			 	 	
			<h1>Title</h1>
			<p>Here is a lot of text. Not right now but in the future something impotant will be stated here.</p>
			<h2>Sub Title</h2>

				<form name="register" action="./scripts/registerUser.php" method="post">
   		 			Email: <input type="text" name="userId" maxlength="30" />
    					Password: <input type="password" name="pass1" />
    					Password Again: <input type="password" name="pass2" />
    					<input type="submit" value="Register" />
				</form>   
		</article>

		<article> 	 	
			<h1>Title</h1>
			<p>Here is a lot of text. Not right now but in the future something impotant will be stated here.</p>
			<h2>Sub Title</h2>
			<p>Here is a lot of text. Not right now but in the future something impotant will be stated here.</p>     
		</article>

	</section>

	<footer>
		<?php			
			require ("footer.php"); 
		?> 
	</footer>

</body>
</html>      
