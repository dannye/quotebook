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
		<link rel="stylesheet" href="../css/search.css" />
		<link rel="icon" href="../images/favicon.ico" type="image/x-icon" />
	</head>
	
	<body>
		<?php
			buildHeader(true, true);
		?>
		
		<form action="search.php" method="GET">
		<div id="left-column">
			<div id="filter-box">
				<h4 id="filter-header">Search Filters</h4>
				<div class="filter-label">Quote
				<input type="checkbox" name="quote-check" class="filter-check"/></div>
				<div class="filter-label">Movie
				<input type="checkbox" name="movie-check" class="filter-check"/></div>
				<div class="filter-label">TV Show
				<input type="checkbox" name="tv-check" class="filter-check"/></div>
				<div class="filter-label">Novel
				<input type="checkbox" name="novel-check" class="filter-check"/></div>
				<div class="filter-label">Actor
				<input type="checkbox" name="actor-check" class="filter-check"/></div>
				<input type="text" class="filter-text">
				<div class="filter-label">Character
				<input type="checkbox" name="char-check" class="filter-check"/></div>
				<input type="text" class="filter-text">
			</div>
		</div>
		
		<div id="page">
			<input type="text" id="search" name="search" value="" placeholder="Search Quotebook..."/>
            <input type="submit" name="submit" id="magnifying-glass" value="">
			<div id="results"><table>
				<tr><th>Quote</th><th>Character</th><th><a href="search.php">Actor</a></th><th><span id="asc">Title</span><span id="up-arrow">&#9650;</span><span id="down-arrow">&#9661;</span></th></tr>
				<?php
				require_once('mysqli_connect.php');
				$query = "SELECT * FROM `quotes`";
				if ($_SERVER["REQUEST_METHOD"] == "GET") {
					if (isset($_GET['submit'])) {
						$search = $_GET['search'];
						if ($search != "") {
							$query = $query . " WHERE (`quote` LIKE '%$search%') OR (`character` LIKE '%$search%') OR (`actor` LIKE '%$search%') OR (`title` LIKE '%$search%')";
						}
					}
				}
				$query = $query . "ORDER BY `title`";
				$response = mysqli_query($dbc, $query) or die(mysqli_error($dbc));
				if ($response) {
					$row = mysqli_fetch_array($response);
					echo  '<tr><td><div id="selected">' . $row['quote'] . '</div>' .
					'<img alt="like" class="fb-like" src="../images/facebook_like_thumb.png"/>' .
					'<img alt="share" class="fb-share" src="../images/facebook_share.png"/></td>' .
					'<td>' . $row['character'] . '</td>' .
					'<td>' . $row['actor'] . '</td>' .
					'<td>' . $row['title'] .
					'<br><img alt="img" id="title-img" src="' . $row['image'] . '" /></td>';
					while ($row = mysqli_fetch_array($response)) {
						echo  '<tr><td><div>' . $row['quote'] . '</div>' .
						'<td>' . $row['character'] . '</td>' .
						'<td>' . $row['actor'] . '</td>' .
						'<td>' . $row['title'] .
						'<br><img alt="img" id="title-img" src="' . $row['image'] . '" /></td>';
					}
				}
				mysqli_close($dbc);
				?>
			</table></div>
			<div id="per-page">Results per page: <span id="current-rpp">5</span> 10 20</div>
			<div id="page-arrows"><span class="page-arrow">&lt;&lt;</span> <span class="page-arrow">&lt;</span>  1  <span class="page-arrow">&gt;</span> <span class="page-arrow">&gt;&gt;</span> </div>
		</div>
		</form>
		
		<footer>
			&copy; 2016
		</footer>
		
	</body>
</html>
