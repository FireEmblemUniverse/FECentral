<script>
	function incDL(hackID) {
		dlContent = parseInt(document.getElementById('DLCNT').innerHTML);
		++dlContent;
		document.getElementById('DLCNT').innerHTML = dlContent;
		console.log("FUCK");
		
		$(document).ready(
			$.ajax({
				 url: 'http://markyjoe.com/?page=increment_download',
				 method:'POST',
				 data: {'id' : hackID},
				 success: function() {
					 //alert('win');
				 }
			})
		);
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
<?
$sql = "
UPDATE hacksubmission
SET viewcount=viewcount+1
WHERE id=" . $_GET['hackid'] . "
";

//Increment viewcount by 1
if ($conn->query($sql) === TRUE) {
    //echo "Successfully incremented view count";
} else {
    echo "FUCK: " . $conn->error;
}

//Check if user is subbed to this hack
$sql = "SELECT * FROM subscriptions WHERE hackid='" . $_GET['hackid'] . "' AND subname='" . $_SESSION['username'] . "'";
$result = $conn->query($sql);
$subbed = false;
if ($result->num_rows > 0) {
	while ($row = $result->fetch_assoc()) {
		$subbed = true;
	}
}

$sql = "SELECT * FROM hacksubmission WHERE id=" . $_GET['hackid'];
$result = $conn->query($sql);

if ($result->num_rows > 0) {
	while ($row = $result->fetch_assoc()) {
		echo '<meta property="og:title" content="' . $row['name'] . '" />';
		echo '<meta property="og:description" content="' . $row['description'] . '" />';
		echo '<meta property="og:image" content=\'http://markyjoe.com/uploads/screenshots/' . $row['name'] . '/' . $row['thumbnail'] . '\' />';
		$fixedDescription = str_replace("\n",'<br />',$row['description']);
		//Screenshots Array
		/*
		$path = './uploads/screenshots/Old Fire Mumblem/';
		$files = scandir($path);
		array_shift($files);
		array_shift($files);
		*/
		$fixedTitle = str_replace("&#039;","'",$row['name']);
		$screenPath = '../' . $row['website'] . "/uploads/screenshots/" . $fixedTitle . "/";
		$screenArray = scandir($screenPath);
		array_shift($screenArray);
		array_shift($screenArray);
		if ($row['website'] == 'public_html') {
			$myWebsite = 'markyjoe.com';
		}
		else {
			$myWebsite = $row['website'];
		}
		echo '<h1 align="center">' . $row['name'] . ' (' . $row['engine'] . $row['region'] . ')';
		if (isset($_SESSION['username'])) {
			echo ' - ';
			//Check if subbed to hack or not
			if ($subbed == true) {
				echo '<img src="./images/subbed.png" id="subButton" onclick="unsubscribe(\'' . $row['author'] . '\',' . $_GET['hackid'] . ')"></img>';
			}
			else {
				echo '<img src="./images/subme.png" id="subButton" onclick="subscribe(\'' . $row['author'] . '\',' . $_GET['hackid'] . ')"></img>';
			}
		}
		echo '</h1>';
		echo '<p align="center">By <a href="http://markyjoe.com/?page=hackauthor&hackauthor=' . $row['author'] . '">' . $row['author'] . '</a>';
		if ($row['author'] != $row['poster']) echo ' (Posted by ' . $row['poster'] . ')';
		echo '</p>';
		for ($i = 0; $i < count($screenArray); ++$i) {
			echo "<a href='http://" . $myWebsite . "/uploads/screenshots/"  . $row['name'] . "/" . $screenArray[$i] . "'><img style='max-width:320px;' src='http://" . $myWebsite . "/uploads/screenshots/" . $row['name'] . "/" . $screenArray[$i] . "'/></a>";
		}
		echo '<p>Posted On: ' . date("m/d/Y g:i:s A",$row['date']) . '</p>';
		echo '<p>';
		if ($row['thread'] != null) echo '<p>Thread: <a href="' . $row['thread'] . '">' . $row['thread'] . '</a></p>';
		echo '</p>';
		echo '<p>Average User Score: ' . $row['ratingaverage'] . ' (' . $row['ratingno'] . ' reviews total)</p>';
		echo '<p>View Count: ' . $row['viewcount'] . '</p>';
		echo '<p>Download Count: <span id="DLCNT">' . $row['downloads'] . '</span></p>';
		echo '<p>' . $fixedDescription . '</p>';
		echo '<h3>Downloads</h3><a onclick="incDL(\'' . $row['id'] . '\')" href="';
		if ($row['file'] != null) {
			echo 'http://' . $myWebsite . '/uploads/games/' . $row['file'];
		}
		else {
			echo $row['downloadlink'];
		}
		echo '">' . $row['version'] . '</a>';
	}
}
else {
	echo 'Dude. This hack doesn\'t exist. It was in your mind all along. That\'s the plot twist.';
}
?>


<?
$sql = "SELECT * FROM hackreview WHERE hackid=" . $_GET['hackid'];
$result = $conn->query($sql);

if ($result->num_rows > 0) {
	echo '<h1>Reviews</h1>';
	while ($row = $result->fetch_assoc()) {
		$fixedReview = str_replace("\n",'<br />',$row['review']);
		echo '<hr />';
		echo '<span id="' . $row['author'] . '">Posted on: ' . date("M-d-Y g:i:s A",$row['date']) . ' by <b><a href="http://markyjoe.com/?page=hackauthor&hackauthor=' . $row['author'] . '">' . $row['author'] . '</a></b></span>';
		echo '<hr /><p>' . $fixedReview . '<br /></p>';
		echo 'Score: ';
		for ($i = 1; $i <= 5; ++$i) {
			if ($i <= $row['rating']) {
				echo '<img src="./images/waffle.png" />';
			}
			else {
				echo '<img src="./images/waffle2.png" />';
			}
		}
	}
}
else {
	echo '<br /><br /><i>No reviews exist of this hack. <a href="http://markyjoe.com/?page=writereview&id=' . $_GET['hackid'] . '">Be the first to do it!</a></i>';
}
?>