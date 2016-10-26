<script>
	var j = jQuery.noConflict();
	var unit_mapper = {
		'metric' : {
			'wind' : {'low' : 5, 'medium' :  10},
			'temperature' : {'low' : 0, 'medium' : 25}
		}
	};
	var frontend_path = '<?php echo FRONTEND_PATH; ?>';
	var unit_system = '<?php echo self::UNIT_SYSTEM; ?>';
	var ajaxurl = '<?php echo admin_url('admin-ajax.php'); ?>';
	var call_length = 120000;
	j( document ).ready(function() {
		handle_server_response(<?php echo $data; ?>);
		setInterval(function () {
			request_server_data();
		},call_length);
		j('#reload').on('click',function () {
			request_server_data();
		})
	});
	function request_server_data() {
		j.ajax({
			url: ajaxurl,
			data: {'action': 'falcon_weather'},
			beforeSend: function () {
				j('#reload img').addClass('spinning-arrows');
				j('#reload span').text('reloading...');
				j('#weather').addClass('reloading');
			},
			complete: function () {
				j('#reload img').removeClass('spinning-arrows');
				j('#reload span').text('reload');
				j('#weather').removeClass('reloading');
			},
			success: function (data) {
				handle_server_response(data);
			}
		});
	}

	function handle_server_response(data) {
		if (data['error'] != undefined) {
			console.log(data['error']);
		} else {
			weather_boxes = "";
			jQuery.each(data['data']['cities'],function (index,city_data) {
				weather_boxes += create_box(city_data);
			});
			j('#weather').html(weather_boxes);
		}
	}
	function create_box(data) {
		return '<div class="city-block"> ' +
			'<span class="city-name">'+ data.city +'</span>' +
			'<img alt="'+data.weather.description+'" class="icon" ' +
				'src="'+frontend_path +'/assets/icons/'+data.weather.icon +'.svg">' +
			'<ul class="description"> ' +
				'<li>'+data.weather.description +'</li> ' +
				'<li>' +
					data.temperature.value +
					'<img class="temperature-unit" src="'+frontend_path +'/assets/icons/'+data.temperature.unit +'.svg">' +
					get_temperature_icon(data.temperature) +
				'</li> ' +
				'<li>'+data.wind.speed+get_wind_icon(data.wind) +'</li> ' +
			'</ul> ' +
			'</div>';
	}
	function get_wind_icon(wind) {
		icon = get_icon('wind',wind.speed);
		class_attr = '';
		if(wind.direction.indexOf('W') !== -1) {
			class_attr = 'class="flip"';
		}
		return '<img src="'+frontend_path+'/assets/icons/'+icon+'" alt="wind" '+class_attr+' title="'+wind.direction+'">';
	}
	function get_temperature_icon(temperature) {
		icon = get_icon('temperature',temperature);
		return '<img src="'+frontend_path+'/assets/icons/'+icon+'" alt="temperature">';
	}
	function get_icon(type, actualValue) {
		j(unit_mapper[unit_system][type]).each(function(key, measurement) {
			if(actualValue < measurement) {
				return type+'-'+key+'.svg';
			}
		});
		return type+'-high.svg';
	}
</script>
<div id="falcon-weather">
	<a id="reload" href="#">
		<img src="<?php echo FRONTEND_PATH;?>/assets/icons/reload.svg">
		<span>reload</span>
	</a>
	<div id="weather"></div>
</div>