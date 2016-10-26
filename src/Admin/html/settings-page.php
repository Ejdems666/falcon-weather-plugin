<div class="wrap">
	<h2>Falcon Weather Plugin Options</h2>
	<form method="post" action="options.php">
		<?php settings_fields($option_name); ?>
		<?php do_settings_sections($option_name); ?>
		<table class="form-table">
			<tr valign="top"><th scope="row">OpenWeather Api key:</th>
				<td><input type="text" name="<?php echo $option_name?>[url_todo]" value="<?php echo $api_key; ?>" /></td>
			</tr>
		</table>
		<?php submit_button(); ?>
	</form>
</div>