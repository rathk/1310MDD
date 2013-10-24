<?php session_start();
?>
<div class="row">
	<div class="large-8 columns">
		<div class="panel">
			<table>
				<tr>
					<td class="large-8 columns">
						<?php
						echo "<img src='".$data->images[0]->hostedLargeUrl."' />"; 
						echo "<h4>".$data->name."</h4>";
						#echo "<h5>Preparation Instructions:<br />";
						echo "<a href='".$data->source->sourceSiteUrl."'class='medium button'>Visit ".$data->source->sourceDisplayName." for preparation instructions</a>"; 
						?>
					</td>
					<td class="large-4 columns">
						<?php
						echo "<h5>Ingredients</h5>";
						foreach($data->ingredientLines AS $i){
							echo $i."<br>";
						}
						if(!empty($data->totalTime)){
							echo "<h5>Total Time: ".$data->totalTime."</h5>";
						}
						echo "<h5>Serves: ".$data->numberOfServings."</h5>";
						?>
					</td>
				</tr>
				<tr class="large-12 columns">

				</tr>
			</table>
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