<div class="navigator">
	<div align="center"><b><? if (isset($_SESSION['username'])) echo $_SESSION['username'] . '\'s ' ?>Account</b></div>
		<?
		if (!isset($_SESSION['username'])) {
			echo '<div class="navcontent"><a href="http://markyjoe.com/?page=login">Log In</a></div>';
			echo '<div class="navcontent"><a href="http://markyjoe.com/?page=register">Register</a></div>';
		}
		else {
			echo '<div class="navcontent"><a href="http://markyjoe.com/?page=hackauthor&hackauthor=' . $_SESSION['username'] . '">My Profile</a></div>';
			echo '<div class="navcontent"><a href="http://markyjoe.com/?page=submithack">Submit FE Game</a></div>';
			echo '<div class="navcontent"><a href="http://markyjoe.com/?page=mailsubscribers">Message Subscribers</a></div>';
			echo '<div class="navcontent"><a href="http://markyjoe.com/?page=myhacks">My FE Games</a></div>';
			echo '<div class="navcontent"><a href="http://markyjoe.com/?page=myreviews">My Reviews</a></div>';
			echo '<div class="navcontent"><a href="http://markyjoe.com/?page=logout">Log Out</a></div>';
			if ($_SESSION['permissions'] == 2) {
				echo '<div align="center"><b>Administration</b></div>';
				echo '<div class="navcontent"><a href="http://markyjoe.com/?page=reports">Reports</a></div>';
			}
		}
		?>
	<div align="center"><b>Navigation</b></div>
		<div class="navcontent"><img src="./images/homelogo.png" /> <a href="http://markyjoe.com">Home</a></div>
	<div class="navlist">Fire Emblem Games</div>
		<div class="navcontent"><img src="./images/gbalogo.png" /><a href="http://markyjoe.com/?page=hackuploads"> FE Game Uploads</a></div>
		<div class="navcontent"><img src="./images/booklogo.png" /><a href="http://markyjoe.com/?page=learnfehacking"> Learn FE Hacking</a></div>
</div>