<?
$logged = true;
if (!isset($_SESSION['username']) || $_SESSION['permissions'] == 0)	{
	$logged = false;
}

if ($logged == false) {
	header('Location: http://markyjoe.com/?page=notallow');
	exit();
}
?>