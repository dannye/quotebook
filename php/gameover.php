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
			buildHeader(true, false);
		?>
		
		<div id="page">
			<?php
				$score = 0;
				$source = "endless";
				if ($_SERVER["REQUEST_METHOD"] == "POST") {
					if (isset($_POST["score"])) {
						$score = $_POST["score"];
					}
					if (isset($_POST["source"])) {
						$source = $_POST["source"];
					}
				}
				if ($_SERVER["REQUEST_METHOD"] == "GET") {
					if (isset($_GET["score"])) {
						$score = $_GET["score"];
					}
					if (isset($_GET["source"])) {
						$source = $_GET["source"];
					}
				}
				$source = $source . ".php";
			echo '<img alt="img" id="gameover-screen-pic" src="../images/game_over.png"/>' .
			'<div id="game-buttons">' .
				'<a href="' . $source . '" class="button" id="try-again">TRY AGAIN</a>' .
				'<a href="game.php" class="button" id="main-menu">MAIN MENU</a>' .
			'</div>' .
			
			'<div class="score-display-div">' .
					'<b><em>'."SCORE: " . $score .'</em></b>' .
			'</div>';
			?>
		</div>
		
		<footer>
			&copy; 2016
		</footer>
		
	</body>
</html>
