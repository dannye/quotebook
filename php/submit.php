<?php
@session_start();
?>

<!DOCTYPE HTML>

<?php
	require_once('site.php');
	require_once('mysqli_connect.php');
	$affected = -1;
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		if (isset($_POST['submit'])) {
			$quote = "";
			$character = "";
			$actor = "";
			$title = "";
			$image = "";
			$media = "";
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
			
			$imageQuery = "SELECT `image` FROM `quotes` WHERE `title` = '$title' LIMIT 1";
			$imageResponse = mysqli_query($dbc, $imageQuery) or die(mysqli_error($dbc));
			if ($imageResponse) {
				$imageName = mysqli_fetch_array($imageResponse)['image'];
				if ($image == "") {
					$image = $imageName;
				}
			}
			if ($quote != "") {
				$query = "INSERT INTO `quotes` VALUES (DEFAULT,?,?,?,?,?,?)";
				$stmt = mysqli_prepare($dbc, $query);
				mysqli_stmt_bind_param($stmt, "ssssss", $quote, $character, $actor, $title, $image, $media);
				mysqli_stmt_execute($stmt);
				$affected = mysqli_stmt_affected_rows($stmt);
				mysqli_stmt_close($stmt);
				mysqli_close($dbc);
			}
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
				var quote = document.forms["submit-form"]["quote"].value;
				if (quote == null || quote == "") {
					return false;
				}
				var character = document.forms["submit-form"]["character"].value;
				if (character == null || character == "") {
					return false;
				}
				var title = document.forms["submit-form"]["title"].value;
				if (title == null || title == "") {
					return false;
				}
				return true;
			}
		</script>
		
		<div id="page">
			<h2 id="submit-title">Submit Quote</h2>
			<form name="submit-form" action="submit.php" method="post" onsubmit="return validateSubmitForm()" id="submit-form">
			<fieldset id="submit-fieldset">
			<div id="submit-fields">
				<h4 class="submit-label">Quote:</h4>
				<input type="text" id="quote" name="quote" placeholder=""/><br>
				<h4 class="submit-label">Character:</h4>
				<input type="text" id="character" name="character" placeholder=""/><br>
				<h4 class="submit-label">Actor:</h4>
				<input type="text" id="actor" name="actor" placeholder=""/><br>
				<h4 class="submit-label">Title:</h4>
				<input type="text" id="title" name="title" placeholder=""/><br>
				<h4 class="submit-label">Image:</h4>
				<input type="text" id="image" name="image" placeholder=""/><br><br>
			</div>
			<div id="submit-radio">
				<input type="radio" name="media" value="movie" checked><div class="radio-label">Movie</div><br><br>
				<input type="radio" name="media" value="tv-show"><div class="radio-label">TV Show</div><br><br>
				<input type="radio" name="media" value="novel"><div class="radio-label">Novel</div>
			</div>
			</fieldset>
			<input type="submit" name="submit" value="Submit Quote" id="submit-button">
			<?php
				if ($affected == 1) {
					echo 'Quote added!';
				}
				elseif ($affected == 0) {
					echo 'Please double check input.';
				}
			?>
			</form>
		</div>
		
		<footer>
			&copy; 2016
		</footer>
		
	</body>
</html>
