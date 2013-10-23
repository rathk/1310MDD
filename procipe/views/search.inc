<?php session_start();
echo $_SESSION['id']; 
$greeting_name = $_SESSION['user'];
$searched = $_POST['recipe_search'];
?>
<?php echo $greeting_name; ?>

<div class="row">
	<div class="large-8 columns">
		<div class="panel">
			<p>Search powered by <img src="http://static.yummly.com/api-logo.png" /></p>
			<form action="?auth=affirm" method="post">
				<div class="row collapse">
					<div class="small-10 columns">
						<input type="text" name="recipe_search" id="recipe_search">
					</div>
					<div class="small-2 columns">
						<input type="submit" name="submit_recipe_search" value="Search" class="small button" />
					</div>
				</div>
			</form>
			<?php
			if(!empty($data)){
				echo "<p>Total Results Searching for <strong> '".$searched."</strong>': ".$data->totalMatchCount."</p>";
				echo "<table border='1'>";
					for($counter=0; $counter<count($data->matches); $counter++){
						echo "<tr>";
						echo "<td><img src=".$data->matches[$counter]->smallImageUrls[0]." /></td>";
						echo "<td><strong>".$data->matches[$counter]->recipeName."</strong></td>";
						echo "</tr>";
					}
				#echo "<tr><img src=".$data->matches[2]->smallImageUrls[0]." /></tr>";
				echo "</table>";
				echo "<table>";
				echo "<tr>";
					for($pages=1; $pages<6; $pages++){
						echo "<td>";
						echo "<a href=''>".$pages."</a>";
						echo "</td>";
					}
				echo "</tr>";
				echo "</table>";
				}
			?>
		</div>
	</div>
	<div class="large-4 columns">
		<div class="panel">
			<div class="row">
				<div class="small-7 columns">
					<?php echo "Hello, ".$greeting_name."!"; ?>
				</div>
				<div class="small-5 columns">
					<p><a href="?rq=lo" class="small button">Log Out</a></p>
				</div>
			</div>
		</div>
	</div>
</div>
<p>Successful Login!</p>