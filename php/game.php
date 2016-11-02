<?php

echo <<<_HD
<!DOCTYPE HTML>
<html lang="en">
	<head>
		<meta charset="UTF-8" />
		<title>Quotebook</title>
		<link rel="stylesheet" href="../css/site.css" />
		<link rel="stylesheet" href="../css/game.css" />
		<link rel="icon" href="../images/favicon.ico" type="image/x-icon" />
	</head>
	
	<body>
		<header>
			<a href="home.php"><img alt="img" id="home-button" src="../images/home.png"/></a>
			<div class="ribbon">
				<img alt="img" id="facebook-logo" src="../images/facebook.png" />
				<a href="../index.php"><img alt="img" id="gear" src="../images/gear.png"/></a>
				<div id="user">John Doe</div>
			</div>
		</header>
		
		<div id="page">
			
			<img alt="img" id="game-screen-pic" src="../images/quote.png"/>
			<a href="question1.php" class="button" id="endless">ENDLESS</a>
			<a href="" class="button" id="timed">TIMED</a>
			<a href="" class="button" id="challenge">CHALLENGE A FRIEND</a>
			
		</div>

		<footer>
			&copy; 2016
		</footer>
		
	</body>
</html>
_HD;
?>