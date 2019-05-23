<?
//Require login
include ("checklogin.php");

//Delete review from database
$sql = "DELETE FROM hackreview WHERE rid='" . $_POST['rid'] . "'";
$result = $conn->query($sql);

if ($conn->query($sql) === TRUE) {
    echo "Successfully removed hack from database";
} else {
    echo "FUCK: " . $conn->error;
}
?>