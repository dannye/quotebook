<?php
@session_start();
?>

<!DOCTYPE HTML>

<?php
	require_once('site.php');
	
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		if (isset($_POST['submit'])) {
			if ($_POST['username'] != "") {
				$_SESSION["username"] = $_POST['username'];
			}
		}
	}
?>

<html lang="en">
	<head>
		<meta charset="UTF-8" />
		<title>Quotebook</title>
		<link rel="stylesheet" href="../css/site.css" />
		<link rel="stylesheet" href="../css/home.css" />
		<link rel="icon" href="../images/favicon.ico" type="image/x-icon" />
	</head>
	
	<body>
		<?php
			buildHeader(true, true);
		?>
		<div id="page">
			<form action="search.php" method="GET">
			<input type="text" id="search" name="search" placeholder="Search Quotebook..."/>
			<input type="submit" id="magnifying-glass" value=""><br>
			</form>
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
