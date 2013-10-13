<h1>Create Your Procipe Account</h1>
<p>Please fill out the form to create a Procipe account.</p>
<form action="" method="post">
	<p>Usernames must be at least 5 characters and include at least 1 upper case letter and 1 number.</p>
	<label for="new_username">Choose a Username:</label>
		<input type="text" name="new_username" id="new_username" maxlength="20" />
	<p>Passwords must be at least 6 characters and include at least 1 upper case letter, 1 number and a special character.</p>
	<label for="new_password">Choose a Password:</label>
		<input type="password" name="new_password" id="new_password" maxlength="15" /><br/>
	<p>Please provide some information about you below.</p>
	<label for="first_name">First name:</label>
		<input type="text" name="first_name" id="first_name" maxlength="20" /><br/>
	<label for="last_name">Last name:</label>
		<input type="text" name="last_name" id="last_name" maxlength="20" /><br/>
	<label for="email">Email address:</label>
		<input type="text" name="email" id="email" maxlength="50" /><br/>
	<input type="submit" name="submit_new" value="Create Account" />
</form>