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
			if ($response) {
			if ($response2) {
			$row = mysqli_fetch_array($response);
			$row2 = mysqli_fetch_array($response2, MYSQLI_NUM);
		
			$wrongAnswers = array();
			$j = 0;
			for ($i =0; $i < 10; $i++) {
				if (count($wrongAnswers) >= 3) {
				break;
				}
				else {
					array_push($wrongAnswers, $row2[$i]);
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
			echo "Which character in the movie" . $row['title'] . "said the line:<br><br>" .
			$row['quote'] .
			'</div>' .
			'<button class="button" id="answer1" onclick="checkIfRightAnswer(<?php echo json_encode($wrongAnswers[0]); ?> ;)">'. $wrongAnswers[0] .'</button>'.
			'<button class="button" id="answer2" onclick="refreshPage()">'. $correct  .'</button>'.
			'<button class="button" id="answer3" onclick="refreshPage()">'. $wrongAnswers[1]  .'</button>'.
			'<button class="button" id="answer4" onclick="refreshPage()">'. $wrongAnswers[2] .'</button>'.
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
			var correct = <?php echo json_encode($correct); ?> ;
			var notCorrect1 = <?php echo json_encode($wrongAnswers[0]); ?> ;
			var notCorrect2 = <?php echo json_encode($wrongAnswers[1]); ?> ;
			var notCorrect3 = <?php echo json_encode($wrongAnswers[2]); ?> ;
			var score = <?php echo json_encode($score); ?> ;

			function refreshPage() {

 				window.location.reload();

			} 
			function checkIfRightAnswer(var g) {
				var right = <?php echo json_encode($correct); ?> ;
				var given = <?php echo json_encode(g); ?> ;
				if (c === g){
					score++;
					window.location.href = "question1.php?w1=" + score;
				}
				else {
					window.location.href = 'gameover.php';
				}
			}
		</script>
	</body>
</html>