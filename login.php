<style>
.logWrapper {display:grid;grid-template-columns:150px auto;}
</style>
<p>Enter your information so you can log into the website.</p>
<form action="index.php?page=submitlogin" method="post">
	<div class="logWrapper">
		<div>Username:</div><div><input type="text" name="username"></input></div>
		<div>Password:</div><div><input type="password" name="password"></input></div>
	</div>
	<button>Submit</button>
</form>
<p><a href="http://markyjoe.com/?page=forgotpassword">Forgot your password?</a></p>