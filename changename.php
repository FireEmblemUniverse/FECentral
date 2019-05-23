<?
//Require login
include ("checklogin.php");

$target_dir = "./uploads/screenshots/";

//Check if directory name already exists...
if (file_exists($target_dir . $_POST['name']) == true) {
	echo 'That name already exists! Cancelling this shit.<br />';
}
//If not...
else {
	$fixedName = str_replace('\'','&#039;',$_POST['name']);
	//Get original name of hack!
	$sql = "
	SELECT name
	FROM hacksubmission
	WHERE id='" . $_POST['id'] . "'
	;";
	$result = $conn->query($sql);
	if ($result->num_rows > 0) {
		//Change name of screenshot file directory
		while ($row = $result->fetch_assoc()) {
			//You need original hack name so you can change it here
			rename($target_dir . $row['name'],$target_dir . $fixedName);
		}
	}
	//Then update database to have new name

	$sql = "
	UPDATE hacksubmission
	SET name='" . $fixedName . "'
	WHERE id='" . $_POST['id'] . "'
	;";
	echo $sql . '<br />';
	if ($conn->query($sql)) {
		echo "SQL ran successfully";
	} else {
		echo "Error running SQL: " . $conn->error;
	}
}
?>