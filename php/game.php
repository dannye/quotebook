<!DOCTYPE HTML>

<?php
	require_once('site.php');
?>

<html lang="en">
	<head>
		<meta charset="UTF-8" />
		<title>Quotebook</title>
		<link rel="stylesheet" href="../css/site.css" />
		<link rel="stylesheet" href="../css/game.css" />
		<link rel="icon" href="../images/favicon.ico" type="image/x-icon" />
	</head>
	
	<body>
		<?php
			$username = "John Doe";
			buildHeader(false, true, $username);
		?>
		
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
