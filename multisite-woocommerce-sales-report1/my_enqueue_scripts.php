<?php

function my_enqueue_scripts() {
    wp_enqueue_script( 'chart-js', 'https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/chart.min.js', array( 'jquery' ), '2.9.4', true );
    wp_enqueue_script( 'sales-chart', plugin_dir_url( __FILE__ ) . 'js/script.js', array( 'jquery' ), '1.0', true );

}
add_action( 'wp_enqueue_scripts', 'my_enqueue_scripts' );
