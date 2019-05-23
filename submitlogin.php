<?php
$sql = "SELECT * FROM hackuser WHERE username='" . $_POST['username'] . "'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
	$row = $result->fetch_assoc();
	if (password_verify($_POST['password'],$row['password']) == TRUE) {
		$_SESSION['username'] = $row['username'];
		$_SESSION['email'] = $row['email'];
		$_SESSION['permissions'] = $row['permissions'];
		echo 'login successful! Now leave this page so that your account options open up!<br />';
		echo '<meta http-equiv="refresh" content="3;url=http://markyjoe.com" />';
		$_POST['username'] = $row['username'];
		if ($row['permissions'] == 2) {
			echo 'Hello, administrator!';
		}
	}
	else {
		echo 'Login failed<br />';
		echo '<meta http-equiv="refresh" content="3;url=http://markyjoe.com/?page=login" />';
	}
}
else {
	echo 'login failed<br />';
	echo '<meta http-equiv="refresh" content="3;url=http://markyjoe.com/?page=login" />';
}
$conn->close();
?>