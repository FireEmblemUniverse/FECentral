<?
//Require login
include ("checklogin.php");
?>

<style>
.hackWrapper {display:grid;grid-template-columns:20% 80%;}
.hackWrapper > div {padding:5px;border-bottom:solid black 1px;}
textarea {width:100%; height:100% ;max-width:100%;max-height:2000px;}
</style>
<script>
function changeRadio() {
	newValue = document.getElementById("radInput").value;
	document.getElementById("change").value = newValue;
}
</script>
<form action="http://markyjoe.com/?page=upload" method="post" enctype="multipart/form-data">
	<p>IMPORTANT: New website features are <i>incomplete</i>, so weird shit might happen!</p>
	<p>WARNING: DO NOT UPLOAD ROMS. IT'S ILLEGAL.</p>
	<div class="hackWrapper">
		<div>Hack Name</div><div><input name="hackname" required></input></div>
		<div>Zip File</div><div><input name="fileToUpload" type="file" required></input></div>
		<div>Screenshots</div><div><input name="screenshots[]" type="file" accept="image/*" multiple></input></div>
		<div>Game Engine</div>
		<div>
			<select name="game" required>
				<option value="FE6">Fire Emblem: The Binding Blade</option>
				<option value="FE7">Fire Emblem: The Blazing Sword</option>
				<option selected="selected" value="FE8">Fire Emblem: The Sacred Stones</option>
				<option value="FEXP">Fire Emblem XP</option>
				<option value="FEXNA">Fire Emblem XNA</option>
				<option value="SRPG">SRPG Studio</option>
				<option value="Lex Talionis">Lex Talionis</option>
				<option value="Sim RPG Maker 95">Sim RPG Maker 95</option>
			</select>
		</div>
		<div>Region</div>
		<div>
			<input type="radio" name="region" value="U" checked="checked">USA</input>
			<input type="radio" name="region" value="J" >Japan</input>
			<input type="radio" name="region" value="E" >Europe</input>
		</div>
		<div>Hack Author</div><div>
			<input type="radio" name="creator" checked="checked" value="<? echo $_SESSION['username']; ?>">Me</input>
			<input type="radio" id="change" name="creator">Someone Else </input><input id="radInput" oninput="changeRadio()"></input>
		</div>
		<div>Tags (separate with commas)</div><div><input name="tags"></input></div>
		<div>Version Number</div><div><input name="version" required></input></div>
		<div>Forum thread</div><div><input name="thread"></input></div>
		<div>Hack Description</div><div><textarea name="description"></textarea></div>
		</div>
		<p>To set the thumbnail for your game, go to "My Hacks" after submitting.</p>
		<button>Submit</button>
</form>