<?php foreach($cities as $city){ ?>
	<div class="city-block">
		<span class="city-name"><?php echo $city->city->name ?></span>
		<img alt="<?php echo $city->weather->description ?>"
		     class="icon"
		     src="<?php echo FRONTEND_PATH ?>/assets/icons/<?php echo $city->weather->icon ?>.svg">
		<ul class="description">
			<li><?php echo $city->weather->description ?></li>
			<li class="temperature"><?php echo substr($city->temperature->now,0,-6)?>
				<img src="<?php echo FRONTEND_PATH ?>/assets/icons/celsius.svg">
			</li>
		</ul>
	</div>
<?php } ?>