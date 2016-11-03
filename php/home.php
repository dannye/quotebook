<?php
@session_start();
?>

<!DOCTYPE HTML>

<?php
	require_once('site.php');
	
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		if (isset($_POST['submit'])) {
			if ($_POST['username'] != "") {
				$_SESSION["username"] = $_POST['username'];
			}
		}
	}
?>

<html lang="en">
	<head>
		<meta charset="UTF-8" />
		<title>Quotebook</title>
		<link rel="stylesheet" href="../css/site.css" />
		<link rel="stylesheet" href="../css/home.css" />
		<link rel="icon" href="../images/favicon.ico" type="image/x-icon" />
	</head>
	
	<body>
		<?php
			buildHeader(true, true);
		?>
		<div id="page">
			<form action="search.php" method="GET">
			<input type="text" id="search" name="search" placeholder="Search Quotebook..."/>
			<input type="submit" id="magnifying-glass" value=""><br>
			</form>
			<a href="submit.php" id="submit-quote">Submit New Quote</a>
			<h2 id="trending-title">Trending</h2>
			<div id="trending">
				<?php
				require_once('mysqli_connect.php');
				$query = "SELECT * FROM quotes ORDER BY RAND() LIMIT 10";
				$response = mysqli_query($dbc, $query) or die(mysqli_error($dbc));
				$num_rows = $response->num_rows;
				while($row = $response->fetch_array())
				{
					echo '<div class="trending-quote">' .
					$row['title'] . '<br><br>"' .
					$row['quote'] . '"<br>-' .
					$row['character'] .
					'<img alt="like" class="fb-like" src="../images/facebook_like_thumb.png"/>' . 
					'<img alt="share" class="fb-share" src="../images/facebook_share.png"/></div>';
				}
				?>
			</div>
		</div>
		
		<footer>
			&copy; 2016
		</footer>
		
	</body>
</html>
