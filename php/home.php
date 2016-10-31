<!DOCTYPE HTML>
<html lang="en">
	<head>
		<meta charset="UTF-8" />
		<title>Quotebook</title>
		<link rel="stylesheet" href="../css/site.css" />
		<link rel="stylesheet" href="../css/home.css" />
		<link rel="icon" href="../images/favicon.ico" type="image/x-icon" />
	</head>
	
	<body>
		<header>
			<a href="home.php"><img alt="img" id="home-button" src="../images/home.png"/></a>
			<a href="game.php"><img alt="img" id="game-button" src="../images/game.png"/></a>
			<div class="ribbon">
				<img alt="img" id="facebook-logo" src="../images/facebook.png" />
				<a href="../index.php"><img alt="img" id="gear" src="../images/gear.png"/></a>
				<div id="user">John Doe</div>
			</div>
		</header>
		
		<div id="page">
			<input type="text" id="search" name="search" placeholder="Search Quotebook..."/>
			<a href="search.php"><img alt="img" id="magnifying-glass" src="../images/magnifying_glass.png"/></a><br>
			<a href="submit.php" id="submit-quote">Submit New Quote</a>
			<h2 id="trending-title">Trending</h2>
			<div id="trending">
				<div class="trending-quote">
					Movie: Shrek (2001)<br><br>
					"This is gonna be fun. We can stay up late, swappin' manly stories, and in the mornin', I'm makin' waffles!" - Donkey (Eddie Murphy)<br><br>
					<img alt="like" class="fb-like" src="../images/facebook_like_thumb.png"/>
					<img alt="share" class="fb-share" src="../images/facebook_share.png"/>
				</div>
				<div class="trending-quote">
					Novel: Frankenstein; or, the Modern Prometheus (1818)<br><br>
					"Nothing is so painful to the human mind as a great and sudden change." - Victor Frankenstein<br><br>
					<img alt="like" class="fb-like" src="../images/facebook_like_thumb.png"/>
					<img alt="share" class="fb-share" src="../images/facebook_share.png"/>
				</div>
			</div>
		</div>
		
		<footer>
			&copy; 2016
		</footer>
		
	</body>
</html>
