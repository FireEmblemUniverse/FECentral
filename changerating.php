<?
//Require login
include ("checklogin.php");

$sql = "
UPDATE hackreview
SET rating='" . $_POST['rating'] . "'
WHERE rid='" . $_POST['rid']. "';
";

if ($conn->query($sql)) {
    echo "SQL ran successfully";
} else {
    echo "Error running SQL: " . $conn->error;
}
?>