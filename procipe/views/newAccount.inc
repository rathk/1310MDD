<div class="row">
	<div class="small-7 large-centered columns">
		<div class="panel">
			<h3 class="text-center">Create Your Account</h3>
			<h6 class="subhead text-center">Please fill out the form to create a Procipe account.</h6><p style="font-style: italic; color: #0000FF;"><?php echo $data[3] ;?></p>
			<form action="" method="post">
				<div class="row text-center">
					<div class="large-9 large-centered columns">
						<p>Usernames must be at least 5 characters and include at least 1 upper case letter and 1 number.</p>
						<p style="font-style: italic; color: #0000FF;"><?php echo $data[0]; ?></p>
						<label for="new_username" class="text-left">Username:</label>
						<input type="text" name="new_username" id="new_username" maxlength="20" placeholder="Choose a username" /><br/>
					</div>
				</div>
				<div class="row text-center">
					<div class="large-9 large-centered columns">
						<p>Passwords must be at least 6 characters and include at least 1 upper case letter, 1 number and a special character.</p>
						<p style="font-style: italic; color: #0000FF;"><?php echo $data[1]; ?></p>
						<label for="new_password" class="text-left">Password:</label>
						<input type="password" name="new_password" id="new_password" maxlength="15" placeholder="Choose a password" /><br/>
					</div>
				</div>
				<div class="row text-center">
					<div class="large-9 large-centered columns">
						<p>Please provide some information about you below.</p>
						<label for="first_name" class="text-left">First:</label>
						<input type="text" name="first_name" id="first_name" maxlength="20" placeholder="Please enter your first name"/><br/>
						<label for="last_name" class="text-left">Last:</label>
						<input type="text" name="last_name" id="last_name" maxlength="20" placeholder="Please enter your last name"/><br/>
						<p style="font-style: italic; color: #0000FF;"><?php echo $data[2]; ?></p>
						<label for="email" class="text-left">Email:</label>
						<input type="text" name="email" id="email" maxlength="50" placeholder="Please enter your email address"/><br/>
						<input type="submit" name="submit_new" value="Create Account" class="button small"/>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>