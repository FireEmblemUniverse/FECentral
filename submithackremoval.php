<?
//Require login
include ("checklogin.php");

$servername = "localhost";
$username = "markyjoe_edit";
$password = "gingko";
$database = "markyjoe_website";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$allHacks = '';
for ($i = 0; $i < count($_POST['hacks']); ++$i) {
	if ($i > 0) {
		$allHacks .= ',';
	}
	$allHacks .= $_POST['hacks'][$i];
}

echo $allHacks . '<br />';

//Delete files
for ($i = 0; $i < count($_POST['hacks']); ++$i) {
	$sql = "SELECT name,file FROM hacksubmission WHERE id=" . $_POST['hacks'][$i];
	echo 'NO';
	$result = $conn->query($sql);
	echo 'YES';
	if ($result->num_rows > 0) {
		echo 'YES';
		while ($row = $result->fetch_assoc()) {
			array_map('unlink', glob("./uploads/screenshots/" . $row['name'] . "/*"));
			rmdir ("./uploads/screenshots/" . $row['name']);
			unlink ("./uploads/games/" . $row['file']);
		}
	}
	else {
		echo 'FUCK';
	}
}

echo 'Test';
$sql = "DELETE FROM hacksubmission WHERE id IN(" . $allHacks . ")";
$result = $conn->query($sql);

if ($conn->query($sql) === TRUE) {
    echo "Successfully removed hacks from database";
} else {
    echo "FUCK: " . $conn->error;
}
?>