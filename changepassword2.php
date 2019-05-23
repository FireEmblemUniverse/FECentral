<?
$mypass = password_hash($_POST['newpass'],PASSWORD_DEFAULT);

$sql = "
UPDATE hackuser
SET password='" . $mypass . "'
WHERE uid=" . $_POST['uid'] . "
";

//echo $sql . '<br />';

if ($_POST['newpass'] == $_POST['confirmpass']) {
	if ($conn->query($sql) === TRUE) {
		echo "Password changed successfully!";
	} else {
		echo "FUCK! Something went wrong: " . $conn->error;
	}
}
else {
	echo 'The password fields didn\'t match! Start over, assmunch!';
}

?>
<meta http-equiv="refresh" content="3;url=http://www.markyjoe.com" />