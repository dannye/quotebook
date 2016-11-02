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
		<link rel="stylesheet" href="../css/login.css" />
		<link rel="icon" href="../images/favicon.ico" type="image/x-icon" />
	</head>
	
	<body>
		<?php
			buildHeader(false, false);
		?>
		
		<script>
			function validateForm() {
				var x = document.forms["login-form"]["username"].value;
				if (x == null || x == "") {
					return false;
				}
				return true;
			}
		</script>
		
		<div id="page">
			<img alt="img" id="wordmark" src="../images/facebook_wordmark.png"/>
			<form name="login-form" action="home.php" method="post" onsubmit="return validateForm()" id="login-form">
			<fieldset>
			<input type="text" id="username" name="username" placeholder="username"/>
			<br>
			<input type="password" id="password" name="password" placeholder="password"/>
			<br>
			<input type="submit" name="submit" value="Log in" id="login-button">
			</fieldset>
			</form>
		</div>
		
		<footer>
			&copy; 2016
		</footer>
		
	</body>
</html>
