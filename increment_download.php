<?
$sql = "
UPDATE hacksubmission
SET downloads = downloads + 1
WHERE id=" . $_POST['id'] . "
";

echo $sql . '<br />';
if ($conn->query($sql)) {
	echo 'YES!';
}
else {
	echo 'FUCK! ' . $conn->error;
}
?>