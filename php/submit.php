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
		<link rel="stylesheet" href="../css/submit.css" />
		<link rel="icon" href="../images/favicon.ico" type="image/x-icon" />
	</head>
	
	<body>
		<?php
			buildHeader(false, false);
		?>
		
		<div id="page">
			<h2 id="submit-title">Submit Quote</h2>
			<fieldset id="submit-form">
			<div id="submit-fields">
				<h4 class="submit-label">Quote:</h4>
				<input type="text" id="quote" name="quote" placeholder=""/><br>
				<h4 class="submit-label">Character:</h4>
				<input type="text" id="character" name="character" placeholder=""/><br>
				<h4 class="submit-label">Actor:</h4>
				<input type="text" id="actor" name="actor" placeholder=""/><br>
				<h4 class="submit-label">Title:</h4>
				<input type="text" id="title" name="title" placeholder=""/><br><br>
			</div>
			<div id="submit-radio">
				<input type="radio" name="media" value="movie" checked><div class="radio-label">Movie</div><br><br>
				<input type="radio" name="media" value="tv-show"><div class="radio-label">TV Show</div><br><br>
				<input type="radio" name="media" value="novel"><div class="radio-label">Novel</div>
			</div>
			</fieldset>
			<a id="submit-button" href="home.php">Submit Quote</a>
		</div>
		
		<footer>
			&copy; 2016
		</footer>
		
	</body>
</html>
