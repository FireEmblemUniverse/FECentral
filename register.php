<style>
.regWrapper {display:grid;grid-template-columns:150px auto;}
</style>
<p>Enter your information. Registering allows you to submit hacks to the website</p>
<form action="index.php?page=submitregistration" method="post">
	<div class="regWrapper">
	<div>Username:</div><div><input type="text" name="username"></input></div>
	<div>E-mail:</div><div><input type="text" name="email"></input></div>
	<div>Enter Password:</div><div><input type="password" name="password"></input></div>
	<div>Confirm Password:</div><div><input type="password" name="confirmpassword"></input></div>
	</div>
	<button>Submit</button>
</form>