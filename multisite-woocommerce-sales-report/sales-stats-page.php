<?php
// Вывод данных о продажах в виде таблицы
function display_sales_table($data) {
	// Получаем выбранную валюту по умолчанию
	$default_currency = get_option('woocommerce_sales_stats_currency', 'USD');

	echo '<div class="wrap">';
	echo '<h1>Статистика продаж WooCommerce</h1>';
	echo '<table class="widefat">';
	echo '<thead><tr><th>ID сайта</th><th>Название сайта</th><th>Количество продаж</th><th>Общая сумма продаж</th></tr></thead>';
	echo '<tbody>';
	foreach ( $data['sites'] as $site_data ) {
		echo '<tr>';
		echo '<td>' . esc_html( $site_data['site_id'] ) . '</td>';
		echo '<td>' . esc_html( $site_data['site_name'] ) . '</td>';
		echo '<td>' . esc_html( $site_data['sales_count'] ) . '</td>';
		//echo '<td>' . wc_price( $site_data['sales_total'], array('currency' => $default_currency) ) . '</td>';
        //echo '<td>' . wc_price( $site_data['sales_total'], array('currency' => $default_currency), '', '' ) . '</td>';
        //echo '<td>' . wc_price( $site_data['sales_total'], array('currency' => $default_currency) ) . ' (валюта: ' . $default_currency . ')</td>';
        echo '<td>' . number_format( $site_data['sales_total'], 2, '.', ' ' ) . ' ' . $default_currency . '</td>';

		echo '</tr>';
	}
	echo '<tr>';
	echo '<td colspan="2"><strong>Итого:</strong></td>';
	echo '<td><strong>' . esc_html( $data['total_sales_count'] ) . '</strong></td>';
	//echo '<td><strong>' . wc_price( $data['total_sales_amount'], array('currency' => $default_currency), '', '' ) . '</strong></td>';
	echo '<td><strong>' . number_format( $data['total_sales_amount'], 2, '.', ' ' ) . ' ' . $default_currency . '</strong></td>';
	echo '</tr>';
	echo '</tbody>';
	echo '</table>';
	echo '</div>';
}