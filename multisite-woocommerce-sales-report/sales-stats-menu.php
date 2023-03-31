<?php

// Добавляем пункт меню в основное меню управления сетью сайтов
add_action( 'network_admin_menu', 'woocommerce_sales_stats_menu' );

function woocommerce_sales_stats_menu() {
	add_menu_page( 'WooCommerce Sales Stats', 'WooCommerce Sales Stats', 'manage_network', 'woocommerce-sales-stats', 'woocommerce_sales_stats_page' );
}

// Добавляем субменю в меню "WooCommerce Sales Stats"
add_action( 'network_admin_menu', 'woocommerce_sales_stats_submenu' );

function woocommerce_sales_stats_submenu() {
	add_submenu_page( 'woocommerce-sales-stats', 'Settings', 'Settings', 'manage_network', 'woocommerce-sales-stats-settings', 'woocommerce_sales_stats_settings_page' );
}