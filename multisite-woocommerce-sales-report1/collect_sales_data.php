<?php
// Собираем данные о продажах за выбранный период с каждого сайта
function collect_sales_data( $start_date, $end_date ) {
    $sites = get_sites();
    $data = array(
        'total_sales_count' => 0,
        'total_sales_amount' => 0,
        'sites' => array(),
    );
    foreach ( $sites as $site ) {
        switch_to_blog( $site->blog_id );

        // Получаем заказы со статусом "Завершенные" и "В ожидании" за выбранный период
        $orders = wc_get_orders( array(
            'status' => array( 'completed', 'processing' ),
            'limit' => -1,
            'date_created' => '>=' . $start_date . ' 00:00:00',
            'date_created' => '<=' . $end_date . ' 23:59:59',
        ) );

        // Собираем данные о продажах для этого сайта
        $site_data = array(
            'site_id' => $site->blog_id,
            'site_name' => get_bloginfo( 'name' ),
            'sales_count' => count( $orders ),
            'sales_total' => 0,
        );
        foreach ( $orders as $order ) {
            $site_data['sales_total'] += $order->get_total();
        }
        $data['total_sales_count'] += $site_data['sales_count'];
        $data['total_sales_amount'] += $site_data['sales_total'];
        $data['sites'][] = $site_data;

        restore_current_blog();
    }
    return $data;
}