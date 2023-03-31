<?php

// Функция, отображающая страницу настроек плагина
function woocommerce_sales_stats_settings_page() {
	// Обработка формы настроек, если она отправлена
	if (isset($_POST['submit'])) {
		// Сохраняем выбранную валюту по умолчанию в опции
		update_option('woocommerce_sales_stats_currency', sanitize_text_field($_POST['currency']));
		echo '<div class="notice notice-success"><p>Настройки сохранены.</p></div>';
	}

	// Получаем текущую выбранную валюту по умолчанию
	$default_currency = get_option('woocommerce_sales_stats_currency', 'USD');

	// Выводим форму настроек
	?>
	<div class="wrap">
		<h1>Настройки статистики продаж</h1>
		<form method="post">
			<table class="form-table">
				<tbody>
					<tr>
						<th scope="row"><label for="currency">Валюта по умолчанию:</label></th>
						<td>
							<select name="currency" id="currency">
								<?php foreach (get_woocommerce_currencies() as $code => $name) { ?>
									<option value="<?php echo esc_attr($code); ?>" <?php selected($code, $default_currency); ?>><?php echo esc_html($code); ?> - <?php echo esc_html($name); ?></option>
								<?php } ?>
							</select>
						</td>
					</tr>
				</tbody>
			</table>
			<p class="submit"><input type="submit" name="submit" id="submit" class="button button-primary" value="Сохранить изменения"></p>
		</form>
	</div>
	<?php
}