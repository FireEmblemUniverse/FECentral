<?
//Require login
include ("checklogin.php");

$sql = "
UPDATE hacksubmission
SET engine='" . $_POST['engine'] . "',region='" . $_POST['region'] . "'
WHERE id='" . $_POST['id'] . "';
";

if ($conn->query($sql)) {
    echo "SQL ran successfully";
} else {
    echo "Error running SQL: " . $conn->error;
}
?>