<?
//Require login
include ("checklogin.php");

//Delete files
$sql = "SELECT name,website,file FROM hacksubmission WHERE id='" . $_POST['id'] . "'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
	echo 'YES';
	while ($row = $result->fetch_assoc()) {
		array_map('unlink', glob("../" . $row['website'] . "/uploads/screenshots/" . $row['name'] . "/*"));
		rmdir ("../" . $row['website'] . "/uploads/screenshots/" . $row['name']);
		unlink ("../" . $row['website'] . "/uploads/games/" . $row['file']);
	}
}
else {
	echo 'FUCK';
}

//Remove hack from database
$sql = "DELETE FROM hacksubmission WHERE id='" . $_POST['id'] ."'";
$result = $conn->query($sql);

if ($conn->query($sql) === TRUE) {
    echo "Successfully removed hack from database";
} else {
    echo "FUCK: " . $conn->error;
}

//Update review average and review count
$sql = "
UPDATE hacksubmission AS h JOIN
	(SELECT hackid, AVG(rating) AS avgscore
	FROM hackreview
	GROUP BY hackid) as r
ON h.id = r.hackid
	SET h.ratingaverage = r.avgscore
";

if ($conn->query($sql) === TRUE) {
    echo "Updated review averages";
} else {
    echo "Failed to update review averages: " . $conn->error;
}

$sql = "
UPDATE hacksubmission AS h JOIN
	(SELECT hackid, COUNT(rating) AS scorecnt
	FROM hackreview
	GROUP BY hackid) as r
ON h.id = r.hackid
	SET h.ratingno = r.scorecnt
";

if ($conn->query($sql) === TRUE) {
    echo "Updated review count";
} else {
    echo "Failed to update review count: " . $conn->error;
}
?>