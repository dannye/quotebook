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
			if (!isset($score)) {
			$score = 0;
			}
			if (isset($_GET["w1"])) {
			$score = $_GET["w1"];
			}
			require_once('mysqli_connect.php');
			$query = "SELECT * FROM quotes ORDER BY RAND() LIMIT 1";
			$query2 = "SELECT t.character FROM quotes AS t ORDER BY RAND() LIMIT 10";
			$response = mysqli_query($dbc, $query) or die(mysqli_error($dbc));
			$response2 = mysqli_query($dbc, $query2) or die(mysqli_error($dbc));
			$num_rows = $response2->num_rows;
			if ($response) {
			if ($response2) {
			$row = mysqli_fetch_array($response);
			$row2 = mysqli_fetch_array($response2, MYSQLI_NUM);
			$wrongAnswers = array();
			$possibleAnswers = array();
			while($row2 = $response2->fetch_array()) {
				array_push($possibleAnswers, $row2['character']);
			}	
			$j = 0;
			for ($i =0; $i < 10; $i++) {
				if (count($wrongAnswers) >= 3) {
				break;
				}
				else {
					array_push($wrongAnswers, $possibleAnswers[$i]);
					if ($wrongAnswers[$j] == $row['character']) {
						unset($wrongAnswers[$j]);
						$wrongAnswers = array_values($wrongAnswers);
					}
					else {
						$j++;	
					}
				}
			}
			$correct = $row['character'];
			echo "Which character in the movie " . $row['title'] . " said the line:<br><br>" .
			$row['quote'] .
			'</div>' .
			'<button class="button" id="answer1" onclick="checkIfRightAnswer(this.id)">'. $wrongAnswers[0] .'</button>'.
			'<button class="button" id="correct" onclick="checkIfRightAnswer(this.id)">'. $correct  .'</button>'.
			'<button class="button" id="answer3" onclick="checkIfRightAnswer(this.id)">'. $wrongAnswers[1]  .'</button>'.
			'<button class="button" id="answer4" onclick="checkIfRightAnswer(this.id)">'. $wrongAnswers[2] .'</button>'.
			'<div class="score-display-div">'.
				'<b><em>'."SCORE: " . $score .'</em></b>'.
			'</div>';
			}
			}
			?>		
			
		</div>
		
		<footer>
			&copy; 2016
		</footer>
		<script>

			var score = <?php echo json_encode($score); ?> ;

			function checkIfRightAnswer(clicked_id) {

				if (clicked_id === "correct"){
					score++;
					window.location.href = "endless.php?w1=" + score;
				}
				else {
					window.location.href = "gameover.php?w1=" + score;
				}
			}
		</script>
	</body>
</html>