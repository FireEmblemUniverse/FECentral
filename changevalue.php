<?
//Require login
include ("checklogin.php");

$sql = "
UPDATE hacksubmission
SET " . $_POST['field'] . "='" . $_POST['value'] . "'
WHERE id='" . $_POST['id'] . "';
";
echo $sql . '<br />';
if ($conn->query($sql)) {
    echo "SQL ran successfully";
} else {
    echo "Error running SQL: " . $conn->error;
}
?>