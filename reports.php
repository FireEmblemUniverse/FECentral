<script>
function resolve(id) {
	$(document).ready(function() {
		$.ajax({
			 url: 'http://markyjoe.com/?page=resolve',
			 method:'POST',
			 data: {'id' : id},
			 success: function() {
				$("#" + id).remove();
				alert("Report number " + id + " resolved.");
			 }
		})
	});
}
</script>

<?
//Require Admin
include ("checkadmin.php");

$sql = "
SELECT *
FROM reports
WHERE resolved=0
";

$result = $conn->query($sql);

echo '<h1>Reports</h1>';
if ($result->num_rows > 0) {
	while ($row = $result->fetch_assoc()) {
		echo '<div id=' . $row['id'] . ' class="reportWrapper">';
		echo '<h3>[' . $row['id'] . '] Regarding <a href="http://markyjoe.com/?page=hackinfo&hackid=' . $row['hackid'] . '">' . $row['hackname'] . '</a> - from <a href="http://markyjoe.com/?page=hackauthor&hackauthor=' . $row['writer'] . '">' . $row['writer'] . '</a></h3>';
		echo '<div>' . $row['explanation'] . ' <button onclick="resolve(' . $row['id'] . ')">Resolve</button></div>';
		echo '</div>';
	}
}
else {
	echo '<p>There\'s no reports as of late! Guess things are going smoothly!</p>';
}
?>