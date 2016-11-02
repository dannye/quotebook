<!DOCTYPE HTML>

<?php
	require_once('site.php');
?>

<html lang="en">
	<head>
		<meta charset="UTF-8" />
		<title>Quotebook</title>
		<link rel="stylesheet" href="../css/site.css" />
		<link rel="stylesheet" href="../css/login.css" />
		<link rel="icon" href="../images/favicon.ico" type="image/x-icon" />
	</head>
	
	<body>
		<?php
			$username = "";
			buildHeader(false, false, $username);
		?>
		
		<div id="page">
			<img alt="img" id="wordmark" src="../images/facebook_wordmark.png"/>
			<form action="home.php" method="post">
			<fieldset>
			<input type="text" id="username" name="username" placeholder="username"/>
			<br>
			<input type="password" id="password" name="password" placeholder="password"/>
			<br>
			<input type="submit" value="Log in" id="login-button">
			</fieldset>
			</form>
		</div>
		
		<footer>
			&copy; 2016
		</footer>
		
	</body>
</html>
