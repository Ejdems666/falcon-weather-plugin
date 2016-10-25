<?php foreach($cities as $city){ ?>
	<div class="city-block">
		<span class="city-name"><?php echo $city->city->name ?></span>
		<img alt="<?php echo $city->weather->description ?>"
		     class="icon"
		     src="<?php echo FRONTEND_PATH ?>/assets/icons/<?php echo $city->weather->icon ?>.svg">
		<ul class="description">
			<li><?php echo $city->weather->description ?></li>
			<li>
				<?php echo $city->temperature->now->getValue(); ?>
				<img class="temperature-unit" src="<?php echo FRONTEND_PATH ?>/assets/icons/<?php echo $city->temperature->getUnit(); ?>.svg">
				<?php echo $this->getTemperatureIcon($city->temperature); ?>
			</li>
			<li><?php echo $city->wind->speed.' '.$this->getWindIcon($city->wind); ?></li>
		</ul>
	</div>
<?php } ?>