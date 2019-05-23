<?
//Require login
include ("checklogin.php");

$fixedReview = str_replace('\'','&#039;',$_POST['review']);
$fixedReview = str_replace("\n",'\r\n',$fixedReview);

$sql = "
UPDATE hackreview
SET review='" . $fixedReview . "'
WHERE rid='" . $_POST['rid']. "';
";

if ($conn->query($sql)) {
    echo "SQL ran successfully";
} else {
    echo "Error running SQL: " . $conn->error;
}
?>