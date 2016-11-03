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
			<img alt="img" id="gameover-screen-pic" src="../images/game_over.png"/>
			<div id="game-buttons">
				<a href="./endless.php" class="button" id="try-again">TRY AGAIN</a>
				<a href="./game.php" class="button" id="main-menu">MAIN MENU</a>
			</div>
			
			<div class="score-display-div">
				<?php	
				if (!isset($score)) {
						$score = 0;
					}
				if (isset($_GET["w1"])) {
					$score = $_GET["w1"];
				}
				echo '<b><em>'."SCORE: " . $score .'</em></b>';
				?>
			</div>		
		</div>
	
		<footer>
			&copy; 2016
		</footer>
		
	</body>
</html>
