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
				<div class="filter-label">Movies
				<input type="checkbox" name="movie-check" class="filter-check" <?php echo empty($_GET['movie-check']) ? '' : ' checked="checked" '; ?> /></div>
				<div class="filter-label">TV Shows
				<input type="checkbox" name="tv-check" class="filter-check" <?php echo empty($_GET['tv-check']) ? '' : ' checked="checked" '; ?> /></div>
				<div class="filter-label">Novels
				<input type="checkbox" name="novel-check" class="filter-check" <?php echo empty($_GET['novel-check']) ? '' : ' checked="checked" '; ?> /></div>
				<div class="filter-label">Character</div>
				<input type="text" name="character-search" id="character-text" class="filter-text" value="<?php echo empty($_GET['character-search']) ? '' : strip_tags($_GET['character-search']); ?>" >
				<div class="filter-label">Actor/Author</div>
				<input type="text" name="actor-search" id="actor-text" class="filter-text" value="<?php echo empty($_GET['actor-search']) ? '' : strip_tags($_GET['actor-search']); ?>" >
				<div class="filter-label">Title</div>
				<input type="text" name="title-search" id="title-text" class="filter-text" value="<?php echo empty($_GET['title-search']) ? '' : strip_tags($_GET['title-search']); ?>" >
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
					var page = document.getElementById("old-page");
					page.value = "1";
				}
				
				function sortAscDesc() {
					var element = document.getElementById("page");
					var child = document.getElementById("old-order");
					if (child != null) {
						element.removeChild(child);
					}
					var page = document.getElementById("old-page");
					page.value = "1";
				}
				
				function selectedResultsPerPage() {
					var element = document.getElementById("page");
					var child = document.getElementById("old-rpp");
					if (child != null) {
						element.removeChild(child);
					}
					var page = document.getElementById("old-page");
					page.value = "1";
				}
				
				function selectedPageButton() {
					var element = document.getElementById("page");
					var child = document.getElementById("old-page");
					if (child != null) {
						element.removeChild(child);
					}
				}
				
				function selectedQuote(value) {
					var index = parseInt(value);
					var table = document.getElementById("results-table");
					if (table.rows.length > 0) {
						var selected = table.rows[index + 1].cells[0];
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
				
				function clickedCell(cell, columnID) {
					var column = document.getElementById(columnID);
					var characterColumn = document.getElementById('character-text');
					var actorColumn = document.getElementById('actor-text');
					var titleColumn = document.getElementById('title-text');
					characterColumn.value = "";
					actorColumn.value = "";
					titleColumn.value = "";
					column.value = cell.innerText;
					var page = document.getElementById("old-page");
					page.value = "1";
				}
			</script>
			<input type="text" id="search" name="search" value="<?php echo empty($_GET['search']) ? '' : strip_tags($_GET['search']); ?>" placeholder="Search Quotebook..."/>
            <input type="submit" id="magnifying-glass" value="">
			<input type="hidden" name="sort" value="<?php echo empty($_GET['sort']) ? 'title' : $_GET['sort']; ?>" id="old-sort">
			<input type="hidden" name="order" value="<?php echo empty($_GET['order']) ? 'asc' : $_GET['order']; ?>" id="old-order">
			<input type="hidden" name="rpp" value="<?php echo empty($_GET['rpp']) ? '5' : $_GET['rpp']; ?>" id="old-rpp">
			<input type="hidden" name="page" value="<?php echo empty($_GET['page']) ? '1' : $_GET['page']; ?>" id="old-page">
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
				$rpp = "5";
				if (isset($_GET['rpp'])) {
					if ($_GET['rpp'] == "5" || $_GET['rpp'] == "10" || $_GET['rpp'] == "20") {
						$rpp = $_GET['rpp'];
					}
				}
				$page = "1";
				if (isset($_GET['page'])) {
					if (is_numeric($_GET['page'])) {
						$page = $_GET['page'];
					}
				}
				
				echo '<div id="results"><table id="results-table"><tr>';
				
				addHeader("Quote", $sort, $order);
				addHeader("Character", $sort, $order);
				addHeader("Actor", $sort, $order);
				addHeader("Title", $sort, $order);
				
				echo '</tr>';
				require_once('mysqli_connect.php');
				$query = " FROM `quotes`";
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
				$countQuery = "SELECT `quote`, `character`, `actor`, `title`, `medium`, `image`, COUNT(*) " .
					$query . " GROUP BY `quote`, `character`, `actor`, `title`, `medium`, `image`";
				$response = mysqli_query($dbc, $countQuery) or die(mysqli_error($dbc));
				$numResults = mysqli_affected_rows($dbc);
				$query = "SELECT * " . $query . " ORDER BY `$sort` $order";
				$response = mysqli_query($dbc, $query) or die(mysqli_error($dbc));
				$numPages = ceil($numResults / $rpp);
				if ($page > $numPages) {
					$page = 1;
				}
				$start = 1 + ($page - 1) * $rpp;
				if ($start > $numResults) {
					$start = $numResults;
				}
				$end = $page * $rpp;
				if ($numResults == 0) {
					$page = 0;
				}
				if ($end > $numResults) {
					$end = $numResults;
				}
				$count = 0;
				if ($response) {
					while ($count < $start - 1) {
						$row = mysqli_fetch_array($response);
						$count += 1;
					}
					while ($count < $end) {
						$row = mysqli_fetch_array($response);
						$words = explode(" ", $search);
						$characterWords = explode(" ", $character);
						$actorWords = explode(" ", $actor);
						$titleWords = explode(" ", $title);
						for($i = 0; $i < count($words); $i++)
						{
							$row['quote'] = str_ireplace($words[$i], '<b>'.strtoupper($words[$i]).'</b>', $row['quote']);
							$row['character'] = str_ireplace($words[$i], '<b>'.strtoupper($words[$i]).'</b>', $row['character']);
							$row['actor'] = str_ireplace($words[$i], '<b>'.strtoupper($words[$i]).'</b>', $row['actor']);
							$row['title'] = str_ireplace($words[$i], '<b>'.strtoupper($words[$i]).'</b>', $row['title']);
						}
						for($i = 0; $i < count($characterWords); $i++)
						{
							$row['character'] = str_ireplace($characterWords[$i], '<b>'.strtoupper($characterWords[$i]).'</b>', $row['character']);
						}
						for($i = 0; $i < count($actorWords); $i++)
						{
							$row['actor'] = str_ireplace($actorWords[$i], '<b>'.strtoupper($actorWords[$i]).'</b>', $row['actor']);
						}
						for($i = 0; $i < count($titleWords); $i++)
						{
							$row['title'] = str_ireplace($titleWords[$i], '<b>'.strtoupper($titleWords[$i]).'</b>', $row['title']);
						}
						echo  '<tr><td>';
						if ($count == $start - 1) {
							echo '<div class=""><div class="selected">' . $row['quote'] . '</div>' .
							'<img alt="like" class="fb-like" src="../images/facebook_like_thumb.png"/>' .
							'<img alt="share" class="fb-share" src="../images/facebook_share.png"/></div>';
							echo '<div class="hidden"><button class="quote-button" type="button" name="selected" value="' . ($count - $start + 1) . '" onclick="selectedQuote(this.value);">' . $row['quote'] . '</button></div>';
}
						else {
							echo '<div class="hidden"><div class="selected">' . $row['quote'] . '</div>' .
							'<img alt="like" class="fb-like" src="../images/facebook_like_thumb.png"/>' .
							'<img alt="share" class="fb-share" src="../images/facebook_share.png"/></div>';
							echo '<div class=""><button class="quote-button" type="button" name="selected" value="' . ($count - $start + 1) . '" onclick="selectedQuote(this.value);">' . $row['quote'] . '</button><div>';
						}
						echo '</td>' .
						'<td><button type="submit" class="cell-button" onclick="clickedCell(this, ' . "'character-text'" . ');">' . $row['character'] . '</button></td>' .
						'<td><button type="submit" class="cell-button" onclick="clickedCell(this, ' . "'actor-text'" . ');">' . $row['actor'] . '</button></td>' .
						'<td><button type="submit" class="cell-button" onclick="clickedCell(this, ' . "'title-text'" . ');">' . $row['title'] . '</button>' .
						'<br><a href="' . $row['image'] . '" target="_blank"><img alt="img" class="title-img" src="' . $row['image'] . '" ></a></td></tr>';
						$count += 1;
					}
				}
				echo '</table></div>';
				mysqli_close($dbc);
				echo '<div id="per-page">Results per page: ';
				if ($rpp =="5") {
					echo '<span id="current-rpp">5</span> ' .
					'<input class="rpp-opt" type="submit" name="rpp" value="10" onclick="selectedResultsPerPage();"> ' .
					'<input class="rpp-opt" type="submit" name="rpp" value="20" onclick="selectedResultsPerPage();"></div>';
				}
				elseif ($rpp =="10") {
					echo '<input class="rpp-opt" type="submit" name="rpp" value="5" onclick="selectedResultsPerPage();"> ' .
					'<span id="current-rpp">10</span> ' .
					'<input class="rpp-opt" type="submit" name="rpp" value="20" onclick="selectedResultsPerPage();"></div>';
				}
				elseif ($rpp =="20") {
					echo '<input class="rpp-opt" type="submit" name="rpp" value="5" onclick="selectedResultsPerPage();"> ' .
					'<input class="rpp-opt" type="submit" name="rpp" value="10" onclick="selectedResultsPerPage();"> ' .
					'<span id="current-rpp">20</span></div>';
				}
				echo '<div id="page-arrows"><span id="num-results">Showing ' . $start . '-' . $end . ' of ' . $numResults . '</span>
				<button type="submit" name="page" value="1" class="page-arrow" onclick="selectedPageButton();">&lt;&lt;</button> <button type="submit" name="page" value="' . (($page > 1) ? ($page - 1) : 1) . '"class="page-arrow" onclick="selectedPageButton();">&lt;</button>  ' .
				$page . ' of ' . $numPages .
				'  <button type="submit" name="page" value="' . (($page < $numPages) ? ($page + 1) : $numPages) . '"class="page-arrow" onclick="selectedPageButton();">&gt;</button> <button type="submit" name="page" value="' . $numPages . '"class="page-arrow" onclick="selectedPageButton()";>&gt;&gt;</button></div>';
			?>
		</div>
		</form>
		
		<footer>
			&copy; 2016
		</footer>
		
	</body>
</html>
