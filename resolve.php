<?
//Require Admin
include ("checkadmin.php");

$sql = "
UPDATE reports
SET resolved=1,resolvedby='" . $_SESSION['username'] . "'
WHERE id=" . $_POST['id'] . "
";

if ($conn->query($sql) === TRUE) {
    echo "Successfully resolved report";
} else {
    echo "FUCK: " . $conn->error;
}
?>