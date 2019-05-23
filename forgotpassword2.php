<?
$sql = "
SELECT uid
FROM hackuser
WHERE email='" . $_POST['email'] . "'
";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
	while ($row = $result->fetch_assoc()) {
		mail("'" . $_POST['email'] . "'","Change your password!","Looks like you fucked up. Luckily, your old pal MarkyJoe has you covered! Click the link below, and experience the wonders of password changing!\n\nhttp://markyjoe.com/?page=changepassword&uid=" . $row['uid'] . "");
		echo 'Sent you an e-mail. Check it so you can change your password!<br />';
	}
}
else {
	echo 'FUCK! Something went wrong. I don\'t know what, cause I\'m a computer!<br />';
}
?>
<meta http-equiv="refresh" content="3;url=http://www.markyjoe.com" />