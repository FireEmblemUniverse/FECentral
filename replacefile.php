<?
//Require login
include ("checklogin.php");

$uploadOk = true;

//SELECT original file name. Include uploads/games/ to directory
$sql = "
SELECT file,website
FROM hacksubmission
WHERE id='" . $_POST['hackid'] . "'
";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
	while ($row = $result->fetch_assoc()) {
		//Zip File
		$target_dir = "../" . $row['website'] . "/uploads/games/";
		$target_file = $target_dir . basename($_FILES["myFile"]["name"]);
		//If file already exists and ISN'T the original file.
		if(file_exists($target_file) && $target_file != 'uploads/games/' . $row['file']) {
			$uploadOk = false;
			echo 'You\'re trying to replace a file other than your own. Dick.<br />';
		}
		else {
			$fileToReplace = "../" . $row['website'] . '/uploads/games/' . $row['file'];
		}
	}
}

//Upload the damn file
if ($uploadOk == true) {
	if ( move_uploaded_file($_FILES["myFile"]["tmp_name"], $target_file) ) {
		unlink($fileToReplace);
		echo 'Uploaded file.<br />';
		//Update database
		$sql = "
		UPDATE hacksubmission
		SET file='" . $_FILES["myFile"]["name"] . "'
		WHERE id='" . $_POST['hackid'] . "'
		";

		if ($conn->query($sql) === TRUE) {
			echo "Updated database!<br />";
		} else {
			echo "Updating database failed: " . $conn->error . "<br />";
		}
	}
	else {
		echo 'Upload failed...<br />';
	}	
}
else {
	echo 'Upload failed...<br />';
}
echo '<meta http-equiv="refresh" content="3;URL=\'http://markyjoe.com/?page=myhacks\'" />';
?>