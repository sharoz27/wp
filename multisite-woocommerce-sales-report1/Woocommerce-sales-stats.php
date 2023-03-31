<?php
/*
Plugin Name: WooCommerce Multisite Sales Stats
Plugin URI: https://rosta.me/
Description: Collects sales stats from all sites in a WordPress Multisite network
Version: 1.0
Author: Ростислав Шацкий
Author URI: https://rosta.me/
*/



require_once( plugin_dir_path( __FILE__ ) . 'sales-stats-menu.php' ); // Файл с данными о пунктах меню
require_once( plugin_dir_path( __FILE__ ) . 'sales_stats_settings_page.php' ); // Функция, отображающая страницу настроек плагина

require_once( plugin_dir_path( __FILE__ ) . 'collect_sales_data.php' ); // Собираем данные о продажах с каждого сайта

require_once( plugin_dir_path( __FILE__ ) . 'woocommerce_sales_stats_page.php' ); // Отображаем страницу статистики продаж
require_once( plugin_dir_path( __FILE__ ) . 'sales-stats-page.php' ); // Вывод данных о продажах в виде таблицы

require_once( plugin_dir_path( __FILE__ ) . 'my_enqueue_scripts.php' ); // Добавляет библиотеки в плагин
require_once( plugin_dir_path( __FILE__ ) . 'get_sales_data.php' ); // ajax для получения данных