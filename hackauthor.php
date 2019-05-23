<script>
	function incDL2(hackID) {
		dlContent = parseInt(document.getElementById(hackID).innerHTML);
		++dlContent;
		document.getElementById(hackID).innerHTML = dlContent;
		console.log("FUCK");
		
		$(document).ready(function() {
			$.ajax({
				 url: 'http://markyjoe.com/?page=increment_download',
				 method:'POST',
				 data: {'id' : hackID},
				 success: function() {
					 //alert('win');
				 }
			})
		});
	}
	function subscribe(author,hackid) {
		$(document).ready(function() {
			$.ajax({
				 url: 'http://markyjoe.com/?page=subscribe',
				 method:'POST',
				 data: {'author' : author,
						'hackid' : hackid},
				 success: function() {
					 alert('You just subscribed! You will now get e-mails whenever this author has an update.');
				 }
			})
			$('#subButton').attr('onclick','unsubscribe(\'' + author + '\',' + hackid + ')');
			$('#subButton').attr('src','./images/subbed.png');
		});
	}

	function unsubscribe(author,hackid) {
		$(document).ready(function() {
			$.ajax({
				 url: 'http://markyjoe.com/?page=unsubscribe',
				 method:'POST',
				 data: {'author' : author,
						'hackid' : hackid},
				 success: function() {
					 alert('You just unsubscribed! You will no longer receive e-mails whenever this author has an update.');
				 }
			})
			$('#subButton').attr('onclick','subscribe(\'' + author + '\',' + hackid + ')');
			$('#subButton').attr('src','./images/subme.png');
		});
	}
</script>
<style>
.hackWrapper {display:grid;grid-template-columns:auto auto auto auto auto;}
.hackWrapper > div {padding:2px;border:solid black 1px;}
.revWrapper {display:grid;grid-template-columns:auto auto auto;}
.revWrapper > div {padding:2px;border:solid black 1px;}
#subButton {cursor:pointer;}
</style>
<?

$sql = "SELECT subname
FROM subscriptions
WHERE author='" . $_GET['hackauthor'] . "' AND subname='" . $_SESSION['username'] . "' AND hackid='0'
";

$result = $conn->query($sql);

echo '<h1>' . $_GET['hackauthor'] . '\'s Profile Page';
//Subscribe
if (isset($_SESSION['username'])) {
	if ($result->num_rows > 0) {
		echo ' - <img src="./images/subbed.png" id="subButton" onclick="unsubscribe(\'' . $_GET['hackauthor'] . '\',0)"></img>';
	}
	else {
		echo ' - <img src="./images/subme.png" id="subButton" onclick="subscribe(\'' . $_GET['hackauthor'] . '\',0)"></img>';
	}
}
echo '</h1>';

$sql = "SELECT *
FROM hacksubmission
WHERE author='" . $_GET['hackauthor'] . "'
ORDER BY date ASC";

$result = $conn->query($sql);

//Author's HacKs
if ($result->num_rows > 0) {
	echo '<h2>Hacks</h2>';
	echo '<div class="hackWrapper">';
		echo '<div>Name</div>';
		echo '<div>Download</div>';
		echo '<div>Engine</div>';
		echo '<div>Av. Rating</div>';
		echo '<div>Dl Cnt.</div>';
	while ($row = $result->fetch_assoc()) {
		if ($row['website'] == 'public_html') {
			$myWebsite = 'markyjoe.com';
		}
		else {
			$myWebsite = $row['website'];
		}
		echo '<div><a href="http://markyjoe.com/?page=hackinfo&hackid=' . $row['id'] . '">' . $row['name'] . '</a></div>';
		echo '<div><a onclick="incDL2(\'' . $row['id'] . '\')" href="';
		if ($row['file'] != null) {
			echo 'http://' . $myWebsite . '/uploads/games/' . $row['file'];
		}
		else {
			echo $row['downloadlink'];
		}
		echo '">';
		if ($row['version'] != null) echo $row['version'];
		else echo 'Download';
		echo '</a></div>';
		echo '<div>' . $row['engine'] . $row['region'] . '</div>';
		echo '<div>' . $row['ratingaverage'] . '</div>';
		echo '<div id="' . $row['id'] . '">' . $row['downloads'] . '</div>';
	}
	echo '</div>';
}

$sql = "SELECT *
FROM hackreview
WHERE author='" . $_GET['hackauthor'] . "'";

$result = $conn->query($sql);

//Author's Reviews
if ($result->num_rows > 0) {
	echo '<h2>Reviews</h2>';
	echo '<div class="revWrapper">';
	echo '<div>Name</div>';
	echo '<div>Date Posted</div>';
	echo '<div>Rating</div>';
	while ($row = $result->fetch_assoc()) {
		echo '<div><a href="http://markyjoe.com/?page=hackinfo&hackid=' . $row['hackid'] . '#' . $_GET['hackauthor'] . '">' . $row['hackname'] . '</a></div>';
		echo '<div>' . date("m/d/Y g:i:s A",$row['date']) . '</div>';
		echo '<div>';
		for ($i = 1; $i <= 5; ++$i) {
			if ($i <= $row['rating']) {
				echo '<img src="./images/waffle.png" />';
			}
			else {
				echo '<img src="./images/waffle2.png" />';
			}
		}
		echo '</div>';
	}
	echo '</div>';
}

//Select
$sql = "
SELECT subname,hackid
FROM subscriptions
WHERE author='" . $_GET['hackauthor'] . "'";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
	echo '<h1>Subscribers (' . $result->num_rows . ')</h1>';
	while ($row = $result->fetch_assoc()) {
		if ($row['hackid'] == 0) {
			echo '<div><a href="http://markyjoe.com/?page=hackauthor&hackauthor=' . $row['subname'] . '">' . $row['subname'] . '</a></div>';
		}
		else {
			echo '<div><a href="http://markyjoe.com/?page=hackinfo&hackid=' . $row['hackid'] . '">' . $row['subname'] . ' (For Hack ID ' . $row['hackid'] . ')</a></div>';
		}
	}
}
else {
	echo '';
}

//Select
$sql = "
SELECT author,hackid
FROM subscriptions
WHERE subname='" . $_GET['hackauthor'] . "'";

$result = $conn->query($sql);
if ($result->num_rows > 0) {
	echo '<h1>Subscriptions (' . $result->num_rows . ')</h1>';
	while ($row = $result->fetch_assoc()) {
		if ($row['hackid'] == 0) {
			echo '<div><a href="http://markyjoe.com/?page=hackauthor&hackauthor=' . $row['author'] . '">' . $row['author'] . '</a></div>';
		}
		else {
			echo '<div><a href="http://markyjoe.com/?page=hackinfo&hackid=' . $row['hackid'] . '">' . $row['author'] . ' (For Hack ID ' . $row['hackid'] . ')</a></div>';
		}
	}
}
else {
	echo '';
}
?>