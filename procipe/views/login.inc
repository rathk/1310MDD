<?php
$page_title = "Procipe Login";
?>

<div class="row">
	<p></p>
	<div class="small-6 large-centered columns">
		<div class="panel">
			<h3>Log In</h3>
			<p>Procipe is a FREE recipe search app that lets you find over 170,000 great recipes!  Powered by the Yummly API you can search &amp; view recipes, save your favorite recipes and create shopping lists from those recipes.  Free to sign up, give it a try today!</p>
			<form action="" method="post">
				<div class="row">
					<div class="large-9 columns">
						<p style="font-style: italic; color: #0000FF;"><?php echo $data[0]; ?></p>
						<label for="username">Username:</label><br/>
						<input type="text" name="username" id="username" maxlength="20" placeholder="Enter Username"/><br/>
					</div>
				</div>
				<div class="row">
					<div class="large-9 columns">
						<label for="password">Password:</label></br>
						<input type = "password" name="password" id="password" placeholder="Enter Password"/><br/>
					</div>
				</div>
				<input type="submit" name="submit" value="Log In" class="small button"/>
			<p>Don't have an account?&nbsp;<a href="?na=new" class="small button">Sign Up</a>&nbsp;for free!</p>
		</div>
	</div>
</div>
</form>
