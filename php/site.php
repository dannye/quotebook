<?php
@session_start();

	function buildHeader($game, $logIn) {
		if (isset($_SESSION['username'])) {
			$username = $_SESSION['username'];
		}
		else {
			$username = "";
		}
		echo '<header>';
		echo '<a href="home.php"><img alt="img" id="home-button" src="../images/home.png"/></a>';
		if ($game) {
			echo '<a href="game.php"><img alt="img" id="game-button" src="../images/game.png"/></a>';
		}
		echo '<div class="ribbon">';
		echo '<img alt="img" id="facebook-logo" src="../images/facebook.png" />';
		if ($username != "") {
			echo '<a href="../index.php" id="log-out"><img alt="img" id="gear-img" src="../images/gear.png"/><span>Log Out</span></a>';
			echo "<div id='user'>$username</div>";
		}
		elseif ($logIn) {
			echo "<a id='login-link' href='login.php'>Log In</a>";
		}
		echo '</div></header>';
	}
?>
