<?
function orderLink($name,$property,$deforder) {
	//If name matches and order is ascending
	if ($_GET['orderby'] == $property && $_GET['order'] == 'descending') {
		echo '<a href="http://markyjoe.com/?page=hackuploads&orderby=' . $property . '&order=ascending">' . $name . ' V</a>';
	}
	elseif ($_GET['orderby'] == $property && $_GET['order'] == 'ascending') {
		echo '<a href="http://markyjoe.com/?page=hackuploads&orderby=' . $property . '&order=descending">' . $name . ' ^</a>';
	}
	//Default
	else {
		echo '<a href="http://markyjoe.com/?page=hackuploads&orderby=' . $property . '&order=' . $deforder . '">' . $name . '</a>';
	}
}
?>
<script>
	function incDL2(hackID) {
		dlContent = parseInt(document.getElementById(hackID).innerHTML);
		++dlContent;
		document.getElementById(hackID).innerHTML = dlContent;
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
					 alert('You just subscribed! You will now get e-mails whenever a new hack is uploaded.');
				 }
			})
			$('#subButton').attr('onclick','unsubscribe(\'' + author + '\',\'' + hackid + '\')');
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
					 alert('You just unsubscribed! You will no longer receive e-mails when a new hack is uploaded.');
				 }
			})
			$('#subButton').attr('onclick','subscribe(\'' + author + '\',\'' + hackid + '\')');
			$('#subButton').attr('src','./images/subme.png');
		});
	}
</script>
<style>
#subButton {cursor:pointer;}
.hackWrapper {display:grid;grid-template-columns:180px auto auto auto auto auto auto auto
<?
	if (isset($_SESSION['username'])) {
		echo ' auto';
	}
?>
;}
.hackWrapper > div {border:solid black 1px;padding:2px;}
</style>
<?
$sql = "SELECT subname
FROM subscriptions
WHERE author='[ALL]' AND subname='" . $_SESSION['username'] . "'
";

$result = $conn->query($sql);

echo '<h1>User Uploaded FE Games';
//Subscribe
if (isset($_SESSION['username'])) {
	if ($result->num_rows > 0) {
		echo ' - <img src="./images/subbed.png" id="subButton" onclick="unsubscribe(\'' . '[ALL]' . '\',0)"></img>';
	}
	else {
		echo ' - <img src="./images/subme.png" id="subButton" onclick="subscribe(\'' . '[ALL]' . '\',0)"></img>';
	}
}
echo '</h1>';
?>
<p>Click the name of the game to see more info on it!</p>
<div class="hackWrapper">
	<div><? orderLink('Name','Name','ascending') ?></div>
	<div>Download</div>
	<div><? orderLink('Engine','engine','descending') ?></div>
	<div><? orderLink('Author','author','ascending') ?></div>
	<div><? orderLink('Av. Rating','ratingaverage','descending') ?></div>
	<div><? orderLink('Reviews','ratingno','descending') ?></div>
	<div><? orderLink('DL Cnt.','downloads','descending') ?></div>
	<div><? orderLink('View Cnt.','viewcount','descending') ?></div>
	<? if (isset($_SESSION['username'])) echo '<div>Options</div>'; ?>
<?
$sql = 'SELECT * FROM hacksubmission';

//SORT
if($_GET['orderby']) {
	if ($_GET['order'] == "ascending") {
		$asc = " ASC";
	}
	else {
		$asc = " DESC";
	}
	$sql .= " ORDER BY " . $_GET['orderby'] . $asc;
}
//END SORT

$result = $conn->query($sql);

if ($result->num_rows > 0) {
	while ($row = $result->fetch_assoc()) {
		if ($row['website'] == 'public_html') {
			$myWebsite = 'markyjoe.com';
		}
		else {
			$myWebsite = $row['website'];
		}
		echo '<div><a href="http://markyjoe.com/?page=hackinfo&hackid=' . $row['id'] . '">' . $row['name'] . '</a></div>';
		echo '<div><a download onclick="incDL2(\'' . $row['id'] . '\')" href="';
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
		echo '<div><a href="http://markyjoe.com/?page=hackauthor&hackauthor=' . $row['author'] . '">' . $row['author'] . '</a></div>';
		echo '<div>' . $row['ratingaverage'] . '</div>';
		echo '<div>' . $row['ratingno'] . '</div>';
		echo '<div id=\'' . $row['id'] . '\'>' . $row['downloads'] . '</div>';
		echo '<div>' . $row['viewcount'] . '</div>';
		if (isset($_SESSION['username'])) {
			echo '<div>';
			echo '<a href=\'http://markyjoe.com/?page=writereview&id=' . $row['id'] . '\'><img alt="Write Review" src="./images/review.png" /></a>';
			echo '<a href=\'http://markyjoe.com/?page=hackinfo&hackid=' . $row['id'] . '\'><img alt="Subscribe" src="./images/bell.png" /></a>';
			echo '<a href=\'http://markyjoe.com/?page=reporthack&hackid=' . $row['id'] . '\'><img alt="Report" src="./images/report.png" /></a>';
			if ($_SESSION['permissions'] == 2) {
					echo ' ';
					echo '<a href=\'http://markyjoe.com/?page=adminremovehack&id=' . $row['id'] . '\'><img alt="Remove Hack" src="./images/remove.png" /></a>';
			};
			echo '</div>';
		};
	}
}
else {
}
?>
</div>