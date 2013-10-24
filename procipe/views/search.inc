<?php session_start();
if(!empty($_SESSION['user'])){
	$greeting_name = $_SESSION['user'];
} 
if($_POST['recipe_search'] != NULL){
	$searched = $_POST['recipe_search'];
}else{
	$searched = $_GET['searched'];
}
?>
<?php echo $greeting_name; ?>

<div class="row">
	<div class="large-8 columns">
		<div class="panel">
			<p>Search powered by <img src="assets/api-logo.png" /></p>
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
				echo "<table border='1' class='small-12 columns'>";
					for($counter=0; $counter<count($data->matches); $counter++){
						echo "<tr>";
						if(!empty($data->matches[$counter]->smallImageUrls[0])){
							echo "<td><img src=".$data->matches[$counter]->smallImageUrls[0]." /></td>";
						}else{
							echo"<td><img src='assets/no-img.png' />";
						}
						echo "<td><strong><a href='?details=true&recipeID=".$data->matches[$counter]->id."'>".$data->matches[$counter]->recipeName."</a></strong></td>";
						echo "</tr>";
					}
				echo "</table>";
				echo "<table>";
				echo "<tr>";
					for($pages=1; $pages<6; $pages++){
						echo "<td>";
						$next = $pages*10;
						if($next == $_GET['nextlist']){
							echo $pages;
						}else{
							echo "<a href='?nextlist=".$next."&searched=".$searched."'>".$pages."</a>";
						}
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
					<a href="#" class="small button" onclick="history.go(-1); return false;">Go Back</a>
				</div>
				<div class="small-5 columns">
					<p><a href="?rq=lo" class="small button">Log Out</a></p>
				</div>
			</div>
		</div>
	</div>
</div>