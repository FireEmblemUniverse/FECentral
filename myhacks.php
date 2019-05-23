<?
//Require login
include ("checklogin.php");
?>

<script>
function removeHack(hackID) {
	var answer = confirm("Are you sure you want to remove this game from the database? Once it is gone, it cannot be recovered.");
	if (answer) {
		$(document).ready(function() {
			$.ajax({
				 url: 'http://markyjoe.com/?page=removehack',
				 method:'POST',
				 data: {'id' : hackID},
				 success: function() {
					$("#" + hackID + "-name").remove();
					$("#" + hackID + "-id").remove();
					$("#" + hackID + "-file").remove();
					$("#" + hackID + "-screenshots").remove();
					$("#" + hackID + "-thumbnail").remove();
					$("#" + hackID + "-author").remove();
					$("#" + hackID + "-description").remove();
					$("#" + hackID + "-tags").remove();
					$("#" + hackID + "-thread").remove();
					$("#" + hackID + "-engine").remove();
					$("#" + hackID + "-version").remove();
					$("#" + hackID + "-remove").remove();
				 }
			})
		});
	}
}

function revealThing(field,area,hackID) {
	$(document).ready(function() {
		$('#fieldName').text(field + ' Editor (' + hackID + ')');
		$('#fieldEditor').val($('#' + area).text());
		$('#fieldSubmit').attr('onclick','changeThing(\'' + field + '\',\'' + area + '\',' + hackID + ')');
		//Hide file and version viewer
		$('#fileViewer').removeClass('show');
		$('#fileViewer').addClass('hidden');
		$('#versionViewer').removeClass('show');
		$('#versionViewer').addClass('hidden');
		$('#thumbnailViewer').removeClass('show');
		$('#thumbnailViewer').addClass('hidden');
		$('#nameViewer').removeClass('show');
		$('#nameViewer').addClass('hidden');
		$('#fieldViewer').removeClass('hidden');
		$('#fieldViewer').addClass('show');
	});
}

function changeThing(field,area,hackID) {
	myValue = $('#fieldEditor').val();
	$(document).ready(function() {
		$.ajax({
			 url: 'http://markyjoe.com/?page=changevalue',
			 method:'POST',
			 data: {
				'id' : hackID,
				'field' : field,
				'value' : myValue
				},
			 success: function() {
				alert(field + ' saved');
				$('#' + area).text(myValue);
				$('#fieldViewer').removeClass('show');
				$('#fieldViewer').addClass('hidden');
			 }
		});
	});
}

function showVers(hackID) {
	$(document).ready(function() {
		$('#versionName').text('Engine Editor (' + hackID + ')');
		//$('#versionEditor').val($('#' + area).text());
		$('#versionSubmit').attr('onclick','changeVers(' + hackID + ')');
		//Hide file and field viewer
		$('#fileViewer').removeClass('show');
		$('#fileViewer').addClass('hidden');
		$('#fieldViewer').removeClass('show');
		$('#fieldViewer').addClass('hidden');
		$('#thumbnailViewer').removeClass('show');
		$('#thumbnailViewer').addClass('hidden');
		$('#nameViewer').removeClass('show');
		$('#nameViewer').addClass('hidden');
		$('#versionViewer').removeClass('hidden');
		$('#versionViewer').addClass('show');
	});
}

function changeVers(hackID) {
	myEngine = document.getElementsByName("engine")[0].value;
	myRegion = document.getElementsByName("region")[0].value;
	$(document).ready(function() {
		$.ajax({
			 url: 'http://markyjoe.com/?page=changeversion',
			 method:'POST',
			 data: {
				'id' : hackID,
				'engine' : myEngine,
				'region' : myRegion
				},
			 success: function() {
				alert('Version saved');
				//$('#' + area).text(myValue);
				$('#myEngine-' + hackID).text(myEngine + myRegion)
				$('#versionViewer').removeClass('show');
				$('#versionViewer').addClass('hidden');
			 }
		});
	});
}

function showFile(hackID) {
	$('#fileName').text('Replace Game File (' + hackID + ')');
	$('#fileId').attr('value',hackID);
	$('#thumbnailViewer').removeClass('show');
	$('#thumbnailViewer').addClass('hidden');
	$('#fieldViewer').removeClass('show');
	$('#fieldViewer').addClass('hidden');
	$('#versionViewer').removeClass('show');
	$('#versionViewer').addClass('hidden');
	$('#nameViewer').removeClass('show');
	$('#nameViewer').addClass('hidden');
	$('#fileViewer').removeClass('hidden');
	$('#fileViewer').addClass('show');
}

function changeThumb(myThumb,hackID) {
	$(document).ready(function() {
		$.ajax({
			 url: 'http://markyjoe.com/?page=changethumbnail',
			 method:'POST',
			 data: {
				'id' : hackID,
				'thumbnail' : myThumb
				},
			 success: function() {
				alert('Thumbnail saved');
				//$('#' + area).text(myValue);
				$('#thumbnailViewer').removeClass('show');
				$('#thumbnailViewer').addClass('hidden');
			 }
		});
	});
}

function selectThumb(clicked,selectedScreenshot,hackID) {
	$(document).ready(function() {
		$('.screenshot').attr('id','unselected');
		$(clicked).attr('id','selected');
		$('#screenSelection').val(selectedScreenshot);
		$('#thumbSubmit').attr('onclick','changeThumb(\'' + selectedScreenshot + '\',' + hackID + ')');
	});
}

function showThumb(hackName,hackID) {
	newScreens = "";
	myScreens = $('#hiddenThumb-' + hackID).text();
	myScreens = myScreens.split(",");
	for (i =0; i < myScreens.length; ++i) {
		newScreens = newScreens + "<img onclick='selectThumb(this,\"" + myScreens[i] + "\"," + hackID + ")' class=\"screenshot\" id='unselected' src='/uploads/screenshots/" + hackName + "/" + myScreens[i] + "' />";
	}
	$('#myScreens').html(newScreens);
	//$('#thumbSubmit').attr('onclick','changeThumb(' + hackID + ')');
	$('#versionViewer').removeClass('show');
	$('#versionViewer').addClass('hidden');
	$('#fieldViewer').removeClass('show');
	$('#fieldViewer').addClass('hidden');
	$('#fileViewer').removeClass('show');
	$('#fileViewer').addClass('hidden');
	$('#nameViewer').removeClass('show');
	$('#nameViewer').addClass('hidden');
	$('#thumbnailViewer').removeClass('hidden');
	$('#thumbnailViewer').addClass('show');
}

function showName(hackID) {
	$('#nameName').text('Change Game Name (' + hackID + ')');
	$('#nameViewer').removeClass('hidden');
	$('#nameViewer').addClass('show');
	$('#nameSubmit').attr('onclick','changeName(' + hackID + ')')
	$('#versionViewer').removeClass('show');
	$('#versionViewer').addClass('hidden');
	$('#fieldViewer').removeClass('show');
	$('#fieldViewer').addClass('hidden');
	$('#fileViewer').removeClass('show');
	$('#fileViewer').addClass('hidden');
	$('#thumbnailViewer').removeClass('show');
	$('#thumbnailViewer').addClass('hidden');
}

function changeName(hackID) {
	myName = $('#nameEditor').val();
	$(document).ready(function() {
		$.ajax({
			 url: 'http://markyjoe.com/?page=changename',
			 method:'POST',
			 data: {
				'id' : hackID,
				'name' : myName
				},
			 success: function() {
				alert('Name changed! It may take a bit for the screenshots to update on your game info page.');
				$('#' + hackID + "-name").text(myName);
				$('#nameViewer').removeClass('show');
				$('#nameViewer').addClass('hidden');
			 }
		});
	});
}

function showScreens(name,hackID) {
	//hiddenScreens-hackID
	newScreens = "";
	myScreens = $('#hiddenThumb-' + hackID).text();
	myScreens = myScreens.split(",");
	for (i =0; i < myScreens.length; ++i) {
		newScreens = newScreens + "<img src='/uploads/screenshots/" + name + "/" + myScreens[i] + "' /><button>Remove</button><br />";
	}
	$('#screenName').text('Remove Screenshots (' + hackID + ')');
	$('#screenEditor').html(newScreens);
	$('#screenViewer').removeClass('hidden');
	$('#screenViewer').addClass('show');
	//$('#screenSubmit').attr('onclick','changeScreens(' + hackID + ')')
	$('#versionViewer').removeClass('show');
	$('#versionViewer').addClass('hidden');
	$('#fieldViewer').removeClass('show');
	$('#fieldViewer').addClass('hidden');
	$('#fileViewer').removeClass('show');
	$('#fileViewer').addClass('hidden');
	$('#thumbnailViewer').removeClass('show');
	$('#thumbnailViewer').addClass('hidden');
}

</script>
<style>
.myHacks {
	display:grid;
	grid-template-columns:auto auto auto auto auto auto auto auto auto auto auto auto;
	font-size:12px;
	}
.myHacks > div > button {
	font-size:12px;border:solid #555577 1px;
	border-radius:3px;
	cursor:pointer;
	width:100%;
	background-image:linear-gradient(#FFFFFF, #AAAAFF);
	min-height:40px;
	}
.myHacks > div > button:hover {background-image:linear-gradient(#EEEEEE, #9999EE);}
.myHacks > div > button:active {background-image:linear-gradient(#CCCCCC, #5555CC);}
.myHacks > div > button:focus {outline:0;}
.hidden {display:none;}
.borderright {
	border-left:solid black 1px;
	border-bottom:solid black 1px;
	border-top:solid black 1px;
	background-image:linear-gradient(#FFFFFF,#FFAAAA);
	padding:2px;
	font-weight:bold;
	}
.borderbottom {border:solid black 1px;background-image:linear-gradient(#FFFFFF,#CC77FF);padding:2px;font-weight:bold;}
.show {display:visible;}
#unselected {border:none;padding:5px;cursor:pointer;}
#selected {border:solid green 5px;padding:0px;}
</style>

<h2>My FE Games</h2>
<p></p>
<?
$sql = "SELECT *
FROM hacksubmission
WHERE author='" . $_SESSION['username'] . "'";
$result = $conn->query($sql);


if ($result->num_rows > 0) {
	echo '<div class="myHacks">';
	echo '<div class="borderright">Name</div>';
	echo '<div class="borderright">ID</div>';
	echo '<div class="borderright">File</div>';
	echo '<div class="borderright">Screenshots</div>';
	echo '<div class="borderright">Thumbnail</div>';
	echo '<div class="borderright">Author</div>';
	echo '<div class="borderright">Description</div>';
	echo '<div class="borderright">Tags</div>';
	echo '<div class="borderright">Thread</div>';
	echo '<div class="borderright">Engine</div>';
	echo '<div class="borderright">Version</div>';
	echo '<div class="borderbottom">Remove</div>';
	while ($row = $result->fetch_assoc()) {
		echo '<div><button id="' . $row['id'] . '-name" onclick="showName(' . $row['id'] . ')">' . $row['name'] . '</button></div>';
		echo '<div id="' . $row['id'] . '-id">' . $row['id'] . '</div>';
		echo '<div id="' . $row['id'] . '-file"><button onclick="showFile(' . $row['id'] . ')">' . $row['file'] . '</button></div>';
		echo '<div id="' . $row['id'] . '-screenshots"><button onclick="showScreens(\'' . $row['name'] . '\',' . $row['id'] . ')">N/A</button><span id="hiddenScreens-' . $row['id'] .'" class="hidden">' . $row['screenshots'] . '</span></div>';
		echo '<div id="' . $row['id'] . '-thumbnail"><button onclick="showThumb(\'' . $row['name'] . '\',' . $row['id'] . ')">Edit</button><span id="hiddenThumb-' . $row['id'] . '" class="hidden">' . $row['screenshots'] . '</span></div>';
		echo '<div id="' . $row['id'] . '-author"><button id="myAuthor-' . $row['id'] . '" onclick="revealThing(\'author\',\'myAuthor-' . $row['id'] . '\',' . $row['id'] . ')">' . $row['author'] . '</button></div>';
		echo '<div id="' . $row['id'] . '-description">' . '<button onclick="revealThing(\'description\',\'hiddenDesc-' . $row['id'] . '\',' . $row['id'] . ')">Edit</button><span id="hiddenDesc-' . $row['id'] . '" class="hidden">' . $row['description'] . '</span></div>';
		echo '<div id="' . $row['id'] . '-tags">' . '<button onclick="revealThing(\'tags\',\'hiddenTags-' . $row['id'] . '\',' . $row['id'] . ')">Edit</button><span id="hiddenTags-' . $row['id'] . '" class="hidden">' . $row['tags'] . '</span></div>';
		echo '<div id="' . $row['id'] . '-thread"><button id="myThread-' . $row['id'] . '" onclick="revealThing(\'thread\',\'myThread-' . $row['id'] . '\',' . $row['id'] . ')">' . $row['thread'] . '</button></div>';
		echo '<div id="' . $row['id'] . '-engine"><button id="myEngine-' . $row['id'] . '" onclick="showVers(' . $row['id'] . ')">' . $row['engine'] . $row['region'] . '</button></div>';
		echo '<div id="' . $row['id'] . '-version"><button id="myVersion-' . $row['id'] . '" onclick="revealThing(\'version\',\'myVersion-' . $row['id'] . '\',' . $row['id'] . ')">' . $row['version'] . '</button></div>';
		//Remove hack should just ask "are you sure?". On yes, remove hack with AJAX and javascript
		echo '<div id="' . $row['id'] . '-remove"><button onclick="removeHack(' . $row['id'] . ')">Remove</button></div>';
	}
	echo '</div>';
}
else {
	echo 'FUCK';
}
?>

<div id="versionViewer" class="hidden"><p id="versionName">Version Editor</p>
	<select name="engine">
		<option value="FE6">Fire Emblem: The Binding Blade</option>
		<option value="FE7">Fire Emblem: The Blazing Sword</option>
		<option selected="selected" value="FE8">Fire Emblem: The Sacred Stones</option>
		<option value="FEXP">Fire Emblem XP</option>
		<option value="FEXNA">Fire Emblem XNA</option>
		<option value="SRPG">SRPG Studio</option>
		<option value="Lex Talionis">Lex Talionis</option>
		<option value="Sim RPG Maker 95">Sim RPG Maker 95</option>
	</select>
	<input type="radio" name="region" value="U" checked="checked">USA</input>
	<input type="radio" name="region" value="J" >Japan</input>
	<input type="radio" name="region" value="E" >Europe</input>
<button id="versionSubmit">Save</button>
</div>

<div id="fieldViewer" class="hidden"><p id="fieldName"></p>
<textarea id="fieldEditor" style="width:100%;max-width:100%;height:500px;"></textarea>
<button id="fieldSubmit">Save</button>
</div>


<div id="fileViewer" class="hidden"><p id="fileName"></p>
	<form method="post" action="index.php?page=replacefile" enctype="multipart/form-data">
	<input id="fileId" name="hackid" class="hidden" value=""></input>
	<input id="fileEditor" name="myFile" type="file"></input><br />
	<button id="fileSubmit">Save</button>
	</form>
</div>

<div id="thumbnailViewer" class="hidden"><p>Thumbnail Selector</p>
	<div id="myScreens">
	</div>
	<input id="screenSelection" value=""></input>
	<button id="thumbSubmit">Submit</button>
</div>

<div id="nameViewer" class="hidden"><p id="nameName"></p>
<input id="nameEditor"></input>
<button id="nameSubmit">Save</button>
</div>

<div id="screenViewer" class="hidden"><p id="screenName"></p>
<p id="screenEditor"></p>
<button id="screenSubmit">Save</button>
</div>