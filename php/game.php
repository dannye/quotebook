Skip to content
This repository
Search
Pull requests
Issues
Gist
 @adwoold
 Watch 1
  Star 0
  Fork 0 dannye/quotebook
 Code  Issues 0  Pull requests 0  Projects 0  Wiki  Pulse  Graphs
Branch: master Find file Copy pathquotebook/php/game.php
115b0ab  19 hours ago
@dannye dannye Add log in functionality
1 contributor
RawBlameHistory     
Executable File  40 lines (30 sloc)  744 Bytes
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
			buildHeader(false, false);
		?>
		
		<div id="page">
			
			<img alt="img" id="game-screen-pic" src="../images/quote.png"/>
			<a href="question1.php" class="button" id="endless">ENDLESS</a>
			<a href="" class="button" id="timed">TIMED</a>
			<a href="" class="button" id="challenge">CHALLENGE A FRIEND</a>
			
		</div>

		<footer>
			&copy; 2016
		</footer>
		
	</body>
</html>
Contact GitHub API Training Shop Blog About
© 2016 GitHub, Inc. Terms Privacy Security Status Help