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
			<?php
			$score = 0;
			if ($_SERVER["REQUEST_METHOD"] == "POST") {
				if (isset($_POST["score"])) {
					$score = $_POST["score"];
				}
			}
			require_once('mysqli_connect.php');
			$query = "SELECT * FROM quotes ORDER BY RAND() LIMIT 4";
			$response = mysqli_query($dbc, $query) or die(mysqli_error($dbc));
			if ($response) {
				$correctIndex = rand(0, 3);
				$answers = array();
				$values = array();
				$row;
				$j = 0;
				for ($i = 0; $i < 4; $i++) {
					if ($i == $correctIndex) {
						$row = mysqli_fetch_array($response);
						array_push($answers, $row['character']);
						array_push($values, 1);
					}
					else {
						$row2 = mysqli_fetch_array($response);
						array_push($answers, $row2['character']);
						array_push($values, 0);
					}
				}
				echo 'Which character in the work "' . $row['title'] . '" said the line:<br><br>"' .
				$row['quote'] . '"</div>' .
				'<form id="game-form" action="endless.php" method="POST">';
				for ($i = 0; $i < 4; $i++) {
					echo '<button name="score" value="' . ($score + $values[$i]) . '" id="' . (($values[$i] == 1) ? "correct" : "") . '" class="button" onclick="checkIfRightAnswer(this.id)">'. $answers[$i] .'</button>';
				}
				echo '<div class="score-display-div"><b><em>SCORE: ' .
				$score .'</em></b></div></form>';
			}
			?>
		</div>
		
		<footer>
			&copy; 2016
		</footer>
		
		<script>
			function checkIfRightAnswer(clicked_id) {
				if (clicked_id != "correct"){
					var form = document.getElementById("game-form");
					form.action = "gameover.php";
				}
			}
		</script>
	</body>
</html>