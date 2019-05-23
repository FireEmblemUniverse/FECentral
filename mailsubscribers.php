<?
//Require login
include ("checklogin.php");
?>

<style>
.msgWrapper {display:grid;grid-template-columns:200px auto}
</style>

<h1><? echo $_SESSION['username'] ?> Mail Subscribers</h1>
<form method="post" action="http://markyjoe.com/?page=submitsubscribermail">
	<div class="msgWrapper">
		<div>Subject:</div><div><input name="subject"></input></div>
		<div>Regarding which of your hacks?</div><div>
			<select name="hackid">
				<option value="0" selected>All Of Them</option>
				<?
					$sql = "SELECT name,id
					FROM hacksubmission
					WHERE author='" . $_SESSION['username'] . "'";
					$result = $conn->query($sql);
					if ($result->num_rows > 0) {
						while ($row = $result->fetch_assoc()) {
							echo '<option value="' . $row['id'] . '">' . $row['name'] . '</option>';
						}
					}
				?>
			<select>
		</div>
		<div>Message:</div><div><textarea name="message" style="width:100%;height:100px;"></textarea></div>
	</div>
	<button>Submit</button>
</form>