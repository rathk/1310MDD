
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
	$output = json_decode($response, true);
	foreach ($output as $key => $value) {
		echo "$key<br>\n";
		foreach ($value as $key2 => $value2) {
			echo "--->lvl1--> $key2 => $value2<br>\n";
			foreach($value2 as $key3 => $value3){
				echo "------>lvl2---> $key3 => $value3<br>\n";
				foreach($value3 as $key4 => $value4){
					echo "--------->lvl3----> $key4 => $value4<br>\n";
					foreach($value4 as $key5 => $value5){
						echo "------------>lvl4-----> $key5 => $value5<br>\n";
						foreach($value5 as $key6 => $value6){
							echo "--------------->lvl5-------> $key6 => $value6<br>\n";
						}
					}
				}
			}
		}
	}
}
?>

</body>

</html>