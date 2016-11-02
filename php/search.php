<!DOCTYPE HTML>
<html lang="en">
	<head>
		<meta charset="UTF-8" />
		<title>Quotebook</title>
		<link rel="stylesheet" href="../css/site.css" />
		<link rel="stylesheet" href="../css/search.css" />
		<link rel="icon" href="../images/favicon.ico" type="image/x-icon" />
	</head>
	
	<body>
		<header>
			<a href="home.php"><img alt="img" id="home-button" src="../images/home.png"/></a>
			<a href="game.php"><img alt="img" id="game-button" src="../images/game.png"/></a>
			<div class="ribbon">
				<img alt="img" id="facebook-logo" src="../images/facebook.png" />
				<a href="../index.php"><img alt="img" id="gear" src="../images/gear.png"/></a>
				<div id="user">John Doe</div>
			</div>
		</header>
		
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
			<input type="text" id="search" name="search" value="Run, Forrest, run" placeholder="Search Quotebook..."/>
			<a href="search.php"><img alt="img" id="magnifying-glass" src="../images/magnifying_glass.png"/></a>
			<div id="results"><table>
				<tr><th>Quote</th><th>Character</th><th><a href="search.php">Actor</a></th><th><span id="asc">Title</span><span id="up-arrow">&#9650;</span><span id="down-arrow">&#9661;</span></th></tr>
				<?php
				require_once('mysqli_connect.php');
				$query = "SELECT * FROM quotes";
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
				}
				?>
			</table></div>
			<div id="per-page">Results per page: <span id="current-rpp">5</span> 10 20</div>
			<div id="page-arrows"><span class="page-arrow">&lt;&lt;</span> <span class="page-arrow">&lt;</span>  1  <span class="page-arrow">&gt;</span> <span class="page-arrow">&gt;&gt;</span> </div>
		</div>
		
		<footer>
			&copy; 2016
		</footer>
		
	</body>
</html>
