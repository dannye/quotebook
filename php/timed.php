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
			<div class="question-display-div">
			<?php
			$score = 0;
			$currTime = 60;
				if ($_SERVER["REQUEST_METHOD"] == "POST") {
					if (isset($_POST["score"])) {
						$score = $_POST["score"];
					}
					if (isset($_POST["time"])) {
						$currTime = $_POST["time"] - 1;
					}
				}
				require_once('mysqli_connect.php');
				$query = "SELECT DISTINCT `character`, `quote`, `title` FROM quotes ORDER BY RAND() LIMIT 4";
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
					'<form id="game-form" action="timed.php" method="POST">' .
					'<input type="hidden" name="source" value="timed" id="source">' .
					'<input type="hidden" name="time" value="' . $currTime . '"id="time">';
					for ($i = 0; $i < 4; $i++) {
						echo '<button name="score" value="' . ($score + $values[$i]) . '" class="button">'. $answers[$i] .'</button>';
					}
					echo '<div class="score-display-div"><b><em>SCORE: ' .
					$score .'</em></b></div></form>';
				}
				echo
				'<div id="timer" class="timer-display-div">' .
				'<b><em>' ."TIMER: " . $currTime .'</em></b>'.
				'</div>';
				mysqli_close($dbc);
			?>		
		</div>
		
		<footer>
			&copy; 2016
		</footer>
		<script>
			
			var score = <?php echo json_encode($score); ?> ;
			var currTime = <?php echo json_encode($currTime); ?> ;
			var t = setInterval(function() {
				document.getElementById('timer').innerHTML = "<b><em>TIMER: " + --currTime + "</em></b>";
				document.getElementById('time').value = currTime;
				source = document.getElementById('source').value;
				if (currTime <= 0 ) {
					clearInterval(t);
					window.location.href = "gameover.php?source=" + source + "&score=" + score;
				} 
			}, 1000);
		</script>
	</body>
</html>