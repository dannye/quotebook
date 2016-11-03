<?php
@session_start();
?>

<!DOCTYPE HTML>

<?php
	require_once('site.php');
	$affected = -1;
	$imageFound = true;
	$imageExists = true;
	$quote = "";
	$character = "";
	$actor = "";
	$title = "";
	$image = "";
	$media = "";
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		if (isset($_POST['submit'])) {
			$imageFound = false;
			$imageExists = false;
			require_once('mysqli_connect.php');
			if ($_POST['quote'] != "") {
				$quote = $_POST['quote'];
			}
			if ($_POST['character'] != "") {
				$character = $_POST['character'];
			}
			if ($_POST['actor'] != "") {
				$actor = $_POST['actor'];
			}
			if ($_POST['title'] != "") {
				$title = $_POST['title'];
			}
			if ($_POST['image'] != "") {
				$image = $_POST['image'];
			}
			if ($_POST['media'] != "") {
				$media = $_POST['media'];
			}
			
			$imageQuery = "SELECT `image` FROM `quotes` WHERE `title` = ? AND `medium` = ? LIMIT 1";
			$stmt = mysqli_prepare($dbc, $imageQuery);
			mysqli_stmt_bind_param($stmt, "ss", $title, $media);
			mysqli_stmt_execute($stmt);
			$result = mysqli_stmt_get_result($stmt);
			mysqli_stmt_close($stmt);
			if ($result) {
				$imageName = mysqli_fetch_array($result)['image'];
				if ($image == "") {
					$image = $imageName;
				}
			}
			if ($image != "") {
				$imageFound = true;
				$headers=@get_headers($image);
				if (stripos($headers[0],"200 OK")) {
					if(@getimagesize($image)) {
						$imageExists = true;
					}
				}
			}
			if ($quote != "" && $title != "" && $image != "" && $imageExists) {
				$query = "INSERT INTO `quotes` VALUES (DEFAULT,?,?,?,?,?,?)";
				$stmt = mysqli_prepare($dbc, $query);
				mysqli_stmt_bind_param($stmt, "ssssss", $quote, $character, $actor, $title, $image, $media);
				mysqli_stmt_execute($stmt);
				$affected = mysqli_stmt_affected_rows($stmt);
				mysqli_stmt_close($stmt);
			}
			mysqli_close($dbc);
		}
	}
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
		
		<script>
			function validateSubmitForm() {
				var quote = document.getElementById("quote").value;
				var quoteError = document.getElementById("quote-error");
				var characterError = document.getElementById("character-error");
				var actorError = document.getElementById("actor-error");
				var titleError = document.getElementById("title-error");
				var imageError = document.getElementById("image-error");
				var character = document.getElementById("character").value;
				var actor = document.getElementById("actor").value;
				var title = document.getElementById("title").value;
				var image = document.getElementById("image").value;
				quoteError.innerHTML = "";
				characterError.innerHTML = "";
				actorError.innerHTML = "";
				titleError.innerHTML = "";
				imageError.innerHTML = "<br><br>";
				var success = true;
				if (quote == "") {
					quoteError.innerHTML = "You must enter a quote.";
					success =  false;
				}
				else if (quote.length >= 1000) {
					quoteError.innerHTML = "Max quote length is 1000 characters.";
					success =  false;
				}
				else if (character.length >= 50) {
					characterError.innerHTML = "Max character length is 50 characters.";
					success =  false;
				}
				else if (actor.length >= 50) {
					actorError.innerHTML = "Max actor length is 50 characters.";
					success =  false;
				}
				else if (title == null || title == "") {
					titleError.innerHTML = "You must enter a title.";
					success =  false;
				}
				else if (title.length >= 50) {
					titleError.innerHTML = "Max title length is 50 characters.";
					success =  false;
				}
				else if (image.length >= 200) {
					imageError.innerHTML = "Max image length is 200 characters.<br><br>";
					imageError.className = "error";
					success =  false;
				}
				if (!success) {
					var element = document.getElementById("progress");
					element.innerHTML = '';
				}
				return success;
			}
			
			function selectedRadio(radioID) {
				var radio = document.getElementById(radioID);
				radio.checked = true;
				var label = document.getElementById("actor-label");
				if (radioID == "novel-radio") {
					label.innerHTML = "Author:";
				}
				else {
					label.innerHTML = "Actor:";
				}
			}
			
			function imageInputFocus() {
				var imageError = document.getElementById("image-error");
				imageError.innerHTML = "If this title is in the database, image is optional.";
				imageError.className = "warning";
			}
			
			function imageInputBlur() {
				var imageError = document.getElementById("image-error");
				imageError.innerHTML = "<br><br>";
				imageError.className = "error";
			}
			
			function beginSubmit() {
				var element = document.getElementById("progress");
				element.innerHTML = 'Processing...';
			}
		</script>
		
		<div id="page">
			<h2 id="submit-title">Submit Quote</h2>
			<form name="submit-form" action="submit.php" method="post" onsubmit="return validateSubmitForm()" id="submit-form">
			<fieldset id="submit-fieldset">
			<div id="submit-fields">
				<?php
					echo '<h4 class="submit-label">Quote: *</h4>';
					if (!$imageFound || !$imageExists) {
						echo '<input type="text" id="quote" name="quote" value="' . $quote . '" placeholder=""/><br>';
					}
					else {
						echo '<input type="text" id="quote" name="quote" placeholder=""/><br>';
					}
					echo '<div id="quote-error" class="error"></div>';
					echo '<h4 class="submit-label">Character:</h4>';
					if (!$imageFound || !$imageExists) {
						echo '<input type="text" id="character" name="character" value="' . $character . '" placeholder=""/><br>';
					}
					else {
						echo '<input type="text" id="character" name="character" placeholder=""/><br>';
					}
					echo '<div id="character-error" class="error"></div>';
					echo '<h4 id="actor-label" class="submit-label">Actor:</h4>';
					if (!$imageFound || !$imageExists) {
						echo '<input type="text" id="actor" name="actor" value="' . $actor . '" placeholder=""/><br>';
					}
					else {
						echo '<input type="text" id="actor" name="actor" placeholder=""/><br>';
					}
					echo '<div id="actor-error" class="error"></div>';
					echo '<h4 class="submit-label">Title: *</h4>';
					if (!$imageFound || !$imageExists) {
						echo '<input type="text" id="title" name="title" value="' . $title . '" placeholder=""/><br>';
					}
					else {
						echo '<input type="text" id="title" name="title" placeholder=""/><br>';
					}
					echo '<div id="title-error" class="error"></div>';
					echo '<h4 class="submit-label">Image: **</h4>';
					if (!$imageFound || !$imageExists) {
						echo '<input type="text" id="image" name="image" value="' . $image . '" placeholder="" onfocus="imageInputFocus();" onblur="imageInputBlur();"/><br>';
					}
					else {
						echo '<input type="text" id="image" name="image" placeholder="" onfocus="imageInputFocus();" onblur="imageInputBlur();"/><br>';
					}
					if (!$imageFound) {
						echo '<div id="image-error" class="error">Title not in database, image required.<br><br></div>';
					}
					elseif (!$imageExists) {
						echo '<div id="image-error" class="error">URL is not a valid image.<br><br></div>';
					}
					else {
						echo '<div id="image-error" class="error"><br><br></div>';
					}
				?>
			</div>
			<div id="submit-radio">
				<input id="movie-radio" type="radio" name="media" value="movie" checked onclick="selectedRadio('movie-radio');">
				<div class="radio-label" onclick="selectedRadio('movie-radio')";>Movie</div><br><br>
				<input id="tv-radio" type="radio" name="media" value="tv-show" onclick="selectedRadio('tv-radio');">
				<div class="radio-label" onclick="selectedRadio('tv-radio')";>TV Show</div><br><br>
				<input id="novel-radio" type="radio" name="media" value="novel" onclick="selectedRadio('novel-radio');">
				<div class="radio-label" onclick="selectedRadio('novel-radio')";>Novel</div>
			</div>
			</fieldset>
			<input type="submit" name="submit" value="Submit Quote" id="submit-button" onclick="beginSubmit();">
			<?php
				if ($affected == 1) {
					echo '<div id="progress">Quote added!</div>';
				}
				elseif ($affected == 0) {
					echo '<div id="progress">Please double check input.</div>';
				}
				else {
					echo '<div id="progress"></div>';
				}
			?>
			</form>
			<div id="required">* required fields<br>** required unless already in database</div>
		</div>
		
		<footer>
			&copy; 2016
		</footer>
		
	</body>
</html>
