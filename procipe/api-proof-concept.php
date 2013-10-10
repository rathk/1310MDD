
<!DOCTYPE html>
<html>
<head><title>Proof of API Concept</title></head>
<body>
	<h1>Procipe API Proof of Concept</h1>
	<h4>MDD1310 - Rath Kaikala</h4>
	<form action="" method="post">
		<label for="search">Enter Recipe Search Terms</label>
			<input type="text" name="search" id="search"/><br/>
		<input type="submit" name="submit"/>
	</form>

<?php
if (isset($_POST['search'])) {
	$searchterm = $_POST['search'];
	$takeout = array(" ", "and", "&");
	$searchterm = str_replace($takeout, "%20", $searchterm);
	$url = 'http://api.yummly.com/v1/api/recipes?_app_id=aca40fa4&_app_key=8f690f6e964ea735eff7544215ab9585&q=' .$searchterm;
	$response = file_get_contents($url);
	$output = json_decode($response);
	echo 'Total Recipes Found= '.$output->totalMatchCount;
}
?>

</body>

</html>