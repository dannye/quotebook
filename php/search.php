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
				<div class="filter-label">Movie
				<input type="checkbox" name="movie-check" class="filter-check" <?php echo empty($_GET['movie-check']) ? '' : ' checked="checked" '; ?> /></div>
				<div class="filter-label">TV Show
				<input type="checkbox" name="tv-check" class="filter-check" <?php echo empty($_GET['tv-check']) ? '' : ' checked="checked" '; ?> /></div>
				<div class="filter-label">Novel
				<input type="checkbox" name="novel-check" class="filter-check" <?php echo empty($_GET['novel-check']) ? '' : ' checked="checked" '; ?> /></div>
				<div class="filter-label">Character</div>
				<input type="text" name="character-search" class="filter-text" value="<?php echo empty($_GET['character-search']) ? '' : $_GET['character-search']; ?>" >
				<div class="filter-label">Actor</div>
				<input type="text" name="actor-search" class="filter-text" value="<?php echo empty($_GET['actor-search']) ? '' : $_GET['actor-search']; ?>" >
				<div class="filter-label">Title</div>
				<input type="text" name="title-search" class="filter-text" value="<?php echo empty($_GET['title-search']) ? '' : $_GET['title-search']; ?>" >
			</div>
		</div>
		
		<div id="page">
			<script>
				function sortByColumn() {
					var element = document.getElementById("page");
					var child = document.getElementById("old-sort");
					if (child != null) {
						element.removeChild(child);
					}
				}
				
				function sortAscDesc() {
					var element = document.getElementById("page");
					var child = document.getElementById("old-order");
					if (child != null) {
						element.removeChild(child);
					}
				}
				
				function selectedQuote(value) {
					var index = parseInt(value);
					var table = document.getElementById("results-table");
					if (table.rows.length > 0) {
						console.log(table.rows.length);
						var selected = table.rows[index + 1].cells[0];
						console.log(index + 1);
						selected.firstChild.className = "";
						selected.children[1].className = "hidden";
						for (var i = 1; i < table.rows.length; i++) {
							var quote = table.rows[i].cells[0];
							if (i != index + 1) {
								quote.firstChild.className = "hidden";
								quote.children[1].className = "";
							}
						}
					}
				}
			</script>
			<input type="text" id="search" name="search" value="<?php echo empty($_GET['search']) ? '' : $_GET['search']; ?>" placeholder="Search Quotebook..."/>
            <input type="submit" id="magnifying-glass" value="">
			<input type="hidden" name="sort" value="<?php echo empty($_GET['sort']) ? 'title' : $_GET['sort']; ?>" id="old-sort">
			<input type="hidden" name="order" value="<?php echo empty($_GET['order']) ? 'asc' : $_GET['order']; ?>" id="old-order">
			<?php
				function addHeader($name, $sort, $order) {
					echo '<th>';
					if ($sort == strtolower($name)) {
						echo "<span id='$order'>";
					}
					echo '<button type="submit" name="sort" value="' . strtolower($name) . '" onclick="sortByColumn();" id="' . strtolower($name) . '-sort">' . $name . '</button>';
					if ($sort == strtolower($name)) {
						echo '</span>';
					}
					if ($sort == strtolower($name)) {
						if ($order == "asc") {
							echo '<span id="asc-up-arrow"><button type="submit" name="order" value="asc" onclick="sortAscDesc();">&#9650;</button></span><span id="down-arrow"><button type="submit" name="order" value="desc" onclick="sortAscDesc();">&#9663;</button></span>';
						}
						else {
							echo '<span id="up-arrow"><button type="submit" name="order" value="asc" onclick="sortAscDesc();">&#9653;</button></span><span id="desc-down-arrow"><button type="submit" name="order" value="desc" onclick="sortAscDesc();">&#9660;</button></span>';
						}
					}
					echo '</th>';
				}
				
				$sort = "title";
				if (isset($_GET['sort'])) {
					if ($_GET['sort'] == "quote" || $_GET['sort'] == "character" || $_GET['sort'] == "actor" || $_GET['sort'] == "title") {
						$sort = $_GET['sort'];
					}
				}
				$order = "asc";
				if (isset($_GET['order'])) {
					if ($_GET['order'] == "asc" || $_GET['order'] == "desc") {
						$order = $_GET['order'];
					}
				}
				
				echo '<div id="results"><table id="results-table"><tr>';
				
				addHeader("Quote", $sort, $order);
				addHeader("Character", $sort, $order);
				addHeader("Actor", $sort, $order);
				addHeader("Title", $sort, $order);
				
				echo '</tr>';
				require_once('mysqli_connect.php');
				$query = "SELECT * FROM `quotes`";
				if ($_SERVER["REQUEST_METHOD"] == "GET") {
					if (isset($_GET['search'])) {
						$search = $_GET['search'];
						$movie = "";
						$tv = "";
						$novel = "";
						if (isset($_GET['movie-check'])) {
							$movie = $_GET['movie-check'];
						}
						if (isset($_GET['tv-check'])) {
							$tv = $_GET['tv-check'];
						}
						if (isset($_GET['novel-check'])) {
							$novel = $_GET['novel-check'];
						}
						if ($movie == 'on' && $tv == 'on' && $novel == 'on') {
							$movie = "";
							$tv = "";
							$novel = "";
						}
						$character = "";
						$actor = "";
						$title = "";
						if (isset($_GET['character-search'])) {
							$character = $_GET['character-search'];
						}
						if (isset($_GET['actor-search'])) {
							$actor = $_GET['actor-search'];
						}
						if (isset($_GET['title-search'])) {
							$title = $_GET['title-search'];
						}
						if ($search != "" || $movie == 'on' || $tv == 'on' || $novel == 'on' ||
							$character != "" || $actor != "" || $title != "") {
							$query = $query . " WHERE";
						}
						if ($search != "") {
							$query = $query . " ((`quote` LIKE '%$search%') OR (`character` LIKE '%$search%') OR (`actor` LIKE '%$search%') OR (`title` LIKE '%$search%'))";
							if ($movie == 'on' || $tv == 'on' || $novel == 'on' ||
								$character != "" || $actor != "" || $title != "") {
								$query = $query . " AND";
							}
						}
						if ($movie == 'on' || $tv == 'on' || $novel == 'on') {
							$query = $query . " (";
						}
						if ($movie == 'on') {
							$query = $query . " `medium` = 'movie'";
							if ($tv == 'on' || $novel == 'on') {
								$query = $query . " OR";
							}
						}
						if ($tv == 'on') {
							$query = $query . " `medium` = 'tv-show'";
							if ($novel == 'on') {
								$query = $query . " OR";
							}
						}
						if ($novel == 'on') {
							$query = $query . " `medium` = 'novel'";
						}
						if ($movie == 'on' || $tv == 'on' || $novel == 'on') {
							$query = $query . ")";
						}
						if ((($movie == 'on' || $tv == 'on' || $novel == 'on')) &&
							($character != "" || $actor != "" || $title != "")) {
							$query = $query . " AND";
						}
						if ($character != "") {
							$query = $query . " `character` LIKE '%$character%'";
							if ($actor != "" || $title != "") {
								$query = $query . " AND";
							}
						}
						if ($actor != "") {
							$query = $query . " `actor` LIKE '%$actor%'";
							if ($title != "") {
								$query = $query . " AND";
							}
						}
						if ($title != "") {
							$query = $query . " `title` LIKE '%$title%'";
						}
						//echo $query;
					}
				}
				$query = $query . "ORDER BY `$sort` $order LIMIT 5";
				$response = mysqli_query($dbc, $query) or die(mysqli_error($dbc));
				$count = 0;
				if ($response) {
					while ($row = mysqli_fetch_array($response)) {
						echo  '<tr><td>';
						if ($count == 0) {
							echo '<div class=""><div id="selected">' . $row['quote'] . '</div>' .
							'<img alt="like" class="fb-like" src="../images/facebook_like_thumb.png"/>' .
							'<img alt="share" class="fb-share" src="../images/facebook_share.png"/></div>';
							echo '<div class="hidden"><button type="button" name="selected" value="' . $count . '" onclick="selectedQuote(this.value);">' . $row['quote'] . '</button></div>';
}
						else {
							echo '<div class="hidden"><div id="selected">' . $row['quote'] . '</div>' .
							'<img alt="like" class="fb-like" src="../images/facebook_like_thumb.png"/>' .
							'<img alt="share" class="fb-share" src="../images/facebook_share.png"/></div>';
							echo '<div class=""><button type="button" name="selected" value="' . $count . '" onclick="selectedQuote(this.value);">' . $row['quote'] . '</button><div>';
						}
						echo '</td>' .
						'<td>' . $row['character'] . '</td>' .
						'<td>' . $row['actor'] . '</td>' .
						'<td>' . $row['title'] .
						'<br><img alt="img" id="title-img" src="' . $row['image'] . '" /></td></tr>';
						$count += 1;
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
