<style>
.topWrapper {display:grid;grid-template-columns:auto auto auto;}
.topWrapper > div {border:solid black 1px;padding:2px;}
</style>

<b align="center">Upload, Download, Review Fan-Made FE Games! Oh, and MarkyJoe's content is here too, I guess</b>
<p>Lair of the Fooker aims to be the best place to go when you want to play, release, and rate fan-made Fire Emblem games made by the community! It's also the place where you can view MarkyJoe-related content!</p>
<p>The sidebar to your right has everything you need in order to get started. Have fun!</p>
<b align="center">Getting Started</b>
<p>Coming soon.</p>

<?
//Top Rated Hacks
echo '<h2>Top Rated FE Games</h2>';
$sql = "SELECT * FROM hacksubmission
ORDER BY ratingaverage DESC
LIMIT 5";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
	echo '<div class="topWrapper">';
	echo '<div>Name</div>';
	echo '<div>Author</div>';
	echo '<div>Av. Rating</div>';
	while ($row = $result->fetch_assoc()) {
		echo '<div><a href="http://markyjoe.com/?page=hackinfo&hackid=' . $row['id'] . '">' . $row['name'] . '</a></div>';
		echo '<div><a href="http://markyjoe.com/?page=hackauthor&hackauthor=' . $row['author'] . '">' . $row['author'] . '</a></div>';
		echo '<div>' . $row['ratingaverage'] . '</div>';
	}
	echo '</div>';
}
else {
	echo 'FUCK';
}
?>
<?
//Most Downloaded Hacks
echo '<h2>Most Viewed FE Games</h2>';
$sql = "SELECT * FROM hacksubmission
ORDER BY viewcount DESC
LIMIT 5";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
	echo '<div class="topWrapper">';
	echo '<div>Name</div>';
	echo '<div>Author</div>';
	echo '<div>View Count</div>';
	while ($row = $result->fetch_assoc()) {
		echo '<div><a href="http://markyjoe.com/?page=hackinfo&hackid=' . $row['id'] . '">' . $row['name'] . '</a></div>';
		echo '<div><a href="http://markyjoe.com/?page=hackauthor&hackauthor=' . $row['author'] . '">' . $row['author'] . '</a></div>';
		echo '<div>' . $row['viewcount'] . '</div>';
	}
	echo '</div>';
}
else {
	echo 'FUCK';
}
?>
<?
//Latest Hacks
echo '<h2>Latest FE Games</h2>';
$sql = "SELECT * FROM hacksubmission
ORDER BY date DESC
LIMIT 5";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
	echo '<div class="topWrapper">';
	echo '<div>Name</div>';
	echo '<div>Author</div>';
	echo '<div>Date Posted</div>';
	while ($row = $result->fetch_assoc()) {
		echo '<div><a href="http://markyjoe.com/?page=hackinfo&hackid=' . $row['id'] . '">' . $row['name'] . '</a></div>';
		echo '<div><a href="http://markyjoe.com/?page=hackauthor&hackauthor=' . $row['author'] . '">' . $row['author'] . '</a></div>';
		echo '<div>' . date("m/d/Y g:i:s A",$row['date']) . '</div>';
	}
	echo '</div>';
}
else {
	echo 'FUCK';
}
?>