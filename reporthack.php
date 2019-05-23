<?
//Require login
include ("checklogin.php");

$sql = "
SELECT *
FROM hacksubmission
WHERE id=" . $_GET['hackid'] . "
";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
	while ($row = $result->fetch_assoc()) {
		echo '<h1>Please... tell us where this game touched you</h1>';
		echo '<h2>Reporting: ' . $row['name'] . '</h2>';
		echo '<form method="post" action="?page=submitreport">';
		echo 'Explanation:<br />';
		echo '<textarea style="width:100%;height:300px;" name="explanation"></textarea><br />';
		echo '<input type="hidden" name="hackname" value="' . $row['name'] . '"></input>';
		echo '<input type="hidden" name="hackid" value="' . $_GET['hackid'] . '"></input>';
		echo '<button>Submit</button>';
		echo '</form>';
	}
}

?>