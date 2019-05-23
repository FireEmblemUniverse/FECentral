<?php
// Create database
//CHARACTER SET utf8 COLLATE utf8_general_ci
$sql = "CREATE TABLE hackuser (
id int AUTO_INCREMENT COLLATE utf8_general_ci NOT NULL,
username varchar(120) COLLATE utf8_general_ci NOT NULL,
email varchar(220) COLLATE utf8_general_ci NOT NULL,
password varchar(255) COLLATE utf8_general_ci NOT NULL,
permissions int COLLATE utf8_general_ci NOT NULL,
uid varchar(10) COLLATE utf8_general_ci NOT NULL,
PRIMARY KEY(id)
)
COLLATE utf8_general_ci;";
if ($conn->query($sql) === TRUE) {
    //echo "Database created successfully";
} else {
    //echo "Error creating database: " . $conn->error;
}

?>

_GET
<?
//echo "SELECT username FROM hackuser WHERE username = '" . $_GET['username'] . "'";
//Check if password and confirm password match
if ($_POST['password'] != $_POST['confirmpassword']) {
	echo 'Password and confirmed password don\'t match';
	echo '<meta http-equiv="refresh" content="3;url=http://www.markyjoe.com/?page=register" />';
}
//Check if username matches one in the database
elseif (($conn->query("SELECT username FROM hackuser WHERE username = '" . $_POST['username'] . "'"))->num_rows) {
	echo 'Username already exists!';
	echo '<meta http-equiv="refresh" content="3;url=http://www.markyjoe.com/?page=register" />';
}
elseif (($conn->query("SELECT email FROM hackuser WHERE email = '" . $_POST['email'] . "'"))->num_rows) {
	echo 'email already exists!';
	echo '<meta http-equiv="refresh" content="3;url=http://www.markyjoe.com/?page=register" />';
}
else {
	echo 'AWESOME! You should be getting an e-mail so you can verify your account!<br /><br />... It might be in your spam folder, btw.';
	$myRand = mt_rand(1000000000,9999999999);
	echo '<meta http-equiv="refresh" content="3;url=http://www.markyjoe.com/" />';
	$sql = "INSERT INTO hackuser (username,email,password,uid) VALUES ('" . $_POST['username'] . "','" . $_POST['email'] ."','" . password_hash($_POST['password'],PASSWORD_DEFAULT) . "','" . $myRand . "')";
	//echo $sql;
	if($conn->query($sql) === TRUE) {
		//echo '<br />DID IT!<br /><br />';
		//echo password_hash($_GET['password'],PASSWORD_DEFAULT);
		mail($_POST['email'],"Verify your account, dude!","Click this link to prove you're a real person and shit! Then you can upload hacks to my website!\n\nhttp://markyjoe.com/?page=verify&uid=" . $myRand . "&username=" . $_POST['username']);
	}
	else {
		//echo '<br /><br />FUCK<br /><br />' . $conn->error;
		echo 'FUCK! There was an issue of some kind!';
	}
}
?>