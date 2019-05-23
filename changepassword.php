<h1>Make sure you remember it this time</h1>
<form method="post" action="?page=changepassword2">
	New password: <input name="newpass" type="password"></input><br />
	Confirm Password: <input name="confirmpass" type="password"></input><br />
	<input name="uid" type="hidden" value="<? echo $_GET['uid'] ?>"></input>
	<button>Submit</button>
</form>