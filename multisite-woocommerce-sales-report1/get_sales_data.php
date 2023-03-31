<?php
add_action( 'wp_ajax_nopriv_get_sales_data', 'get_sales_data' );
add_action( 'wp_ajax_get_sales_data', 'get_sales_data' );

function get_sales_data() {
    $orders = wc_get_orders( array(
        'numberposts' => -1,
        'post_status' => array_keys( wc_get_order_statuses() )
    ) );

    $sales_data = array();

    foreach ( $orders as $order ) {
        $order_date = $order->get_date_created()->format( 'Y-m-d' );
        $order_total = $order->get_total();

        if ( isset( $sales_data[ $order_date ] ) ) {
            $sales_data[ $order_date ] += $order_total;
        } else {
            $sales_data[ $order_date ] = $order_total;
        }
    }

    wp_send_json( $sales_data );
}
