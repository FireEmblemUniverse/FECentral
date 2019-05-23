<?
//Require login
include ("checklogin.php");
?>
<script>
function removeReview(reviewID) {
	var answer = confirm("Are you sure?");
	if (answer) {
		$(document).ready(function() {
			$.ajax({
				 url: 'http://markyjoe.com/?page=removereview',
				 method:'POST',
				 data: {'rid' : reviewID},
				 success: function() {
					alert("Review removed.");
					$("#" + reviewID).next().next().next().next().remove();
					$("#" + reviewID).next().next().next().remove();
					$("#" + reviewID).next().next().remove();
					$("#" + reviewID).next().remove();
					$("#" + reviewID).remove();
				 }
			})
		});
	}
}

function showReview(reviewID) {
	$(document).ready(function() {
		myReview = $('#hiddenRev-' + reviewID).text();
		$('#thingViewer').attr('class','show');
		$('#thingSubmit button').attr('onclick',"changeReview(" + reviewID + ")");
		$('#thingEditor').val(myReview);
	});
}
function changeReview(reviewID) {
	myReview = $('#thingEditor').val();
	$(document).ready(function() {
		console.log(myReview);
		$.ajax({
			 url: 'http://markyjoe.com/?page=changereview',
			 method: 'POST',
			 data: {
				 'rid' : reviewID,
				 'review' : myReview
				 },
			 success: function() {
				alert("Review changed.");
				$('#hiddenRev-' + reviewID).text(myReview);
				$('#thingViewer').attr('class','hidden');
			 }
		})
	});
}

function showRating(reviewID) {
	$(document).ready(function() {
		myRating = $('#rating-' + reviewID).text();
		$('#ratingViewer').attr('class','show');
		$('#ratingSubmit button').attr('onclick',"changeRating(" + reviewID + ")");
		$('#ratingEditor').val(myRating);
	});
}

function changeRating(reviewID) {
	myRating = $('#ratingEditor').val();
	$(document).ready(function() {
		console.log(myRating);
		$.ajax({
			 url: 'http://markyjoe.com/?page=changerating',
			 method: 'POST',
			 data: {
				 'rid' : reviewID,
				 'rating' : myRating
				 },
			 success: function() {
				alert("Rating changed.");
				$('#rating-' + reviewID).text(myRating);
				$('#ratingViewer').attr('class','hidden');
			 }
		})
	});
}
</script>
<style>
	.reviewWrapper {display:grid;grid-template-columns:auto auto auto auto auto;}
	.reviewWrapper > div {border:solid black 1px;padding:2px}
	.hidden {display:none;}
	.show {display:visible;}
	#thingEditor {width:100%;max-width:100%;height:500px;}
</style>
<?
$sql = "SELECT *
FROM hackreview
WHERE author='" . $_SESSION['username'] . "'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
	echo '<h2>My Reviews</h2>';
	echo '<div class="reviewWrapper">';
		echo '<div>Name</div>';
		echo '<div>Review ID</div>';
		echo '<div>Review</div>';
		echo '<div>Rating</div>';
		echo '<div>Remove Review</div>';
	while ($row = $result->fetch_assoc()) {
		$fixedReview = str_replace("\n",'<br />',$row['review']);
		echo '<div id="' . $row['rid'] . '">' . $row['hackname'] . '</div>';
		echo '<div>' . $row['rid'] . '</div>';
		echo '<div><button onclick="showReview(' . $row['rid'] . ')">Edit/View</button><span class="hidden" id="hiddenRev-' . $row['rid'] . '">' . $fixedReview . '</span></div>';
		echo '<div><button id="rating-' . $row['rid'] . '" onclick="showRating(' . $row['rid'] . ')">' . $row['rating'] . '</button></div>';
		echo '<div><button onclick="removeReview(' . $row['rid'] . ')">Remove</button></div>';
	}
	echo '</div>';
}
?>

<div id="thingViewer" class="hidden"><p>Thing Editor</p>
<textarea id="thingEditor"></textarea>
<div id="thingSubmit"><button>Save</button></div>
</div>

<div id="ratingViewer" class="hidden"><p>Rating Editor</p>
<select id="ratingEditor">
	<option value="1">1</option>
	<option value="2">2</option>
	<option value="3">3</option>
	<option value="4">4</option>
	<option value="5">5</option>
</select>
<div id="ratingSubmit"><button>Save</button></div>
</div>