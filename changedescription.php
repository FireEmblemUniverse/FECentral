<?
//Require login
include ("checklogin.php");

$sql = "UPDATE hacksubmission
SET description='" . $_POST['desc'] . "'
WHERE id='" . $_POST['id'] . "';";
echo $sql . '<br />';
if ($conn->query($sql)) {
    echo "SQL ran successfully";
} else {
    echo "Error running SQL: " . $conn->error;
}
?>