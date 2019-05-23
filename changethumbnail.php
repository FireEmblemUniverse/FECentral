<?
//Require login
include ("checklogin.php");

$sql = "
UPDATE hacksubmission
SET thumbnail='" . $_POST['thumbnail'] . "'
WHERE id='" . $_POST['id'] . "';
";

if ($conn->query($sql) === TRUE) {
	echo "Updated database!<br />";
} else {
	echo "Updating database failed: " . $conn->error . "<br />";
}
?>