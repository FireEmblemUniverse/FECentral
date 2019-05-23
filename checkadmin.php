<?
$admin = true;
if (!isset($_SESSION['username']) || $_SESSION['permissions'] != 2)	{
	$admin = false;
}
if ($admin == false) {
	header('Location: http://markyjoe.com/?page=notallow2');
	exit();
}
?>