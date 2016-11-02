<?php
@session_start();
?>

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
			buildHeader(false, false);
		?>
		
		<div id="page">
			<div class="question-display-div">
			Which character in the movie Forest Gump said the line:<br><br>
			"Life's like a box of chocolates, you never know what you're gonna get."
			</div>
			<a href="" class="button" id="answer1">Jenny Curan</a>
			<a href="" class="button" id="answer2">Forrest Gump</a>
			<a href="" class="button" id="answer3">Spartacus</a>
			<a href="./gameover.php" class="button" id="answer4">Mr. Rogers</a>
			<div class="score-display-div">
				<b><em>SCORE: 0</em></b>
			</div>
		</div>
		
		<footer>
			&copy; 2016
		</footer>
		
	</body>
</html>
