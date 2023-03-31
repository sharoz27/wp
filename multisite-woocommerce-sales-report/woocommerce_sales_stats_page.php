<?php

// Отображаем страницу статистики продаж
function woocommerce_sales_stats_page() {
    // Проверяем, была ли отправлена форма выбора периода
    if ( isset( $_POST['start_date'] ) && isset( $_POST['end_date'] ) ) {
        $start_date = sanitize_text_field( $_POST['start_date'] );
        $end_date = sanitize_text_field( $_POST['end_date'] );
    } else {
        // Если форма не была отправлена, выбираем период по умолчанию (например, за последний месяц)
        $start_date = date( 'Y-m-d', strtotime( '-1 month' ) );
        $end_date = date( 'Y-m-d' );
    }

    $data = collect_sales_data( $start_date, $end_date );
    display_sales_table( $data, $start_date, $end_date );
    display_date_form( $start_date, $end_date );
    
}

// Отображаем форму выбора периода
function display_date_form($start_date, $end_date) {
    ?>
    <form method="post">
        <label for="start_date">Начальная дата:</label>
        <input type="date" name="start_date" value="<?php echo esc_attr( $start_date ); ?>" required>

        <label for="end_date">Конечная дата:</label>
        <input type="date" name="end_date" value="<?php echo esc_attr( $end_date ); ?>" required>

        <button type="submit">Отобразить статистику</button>
    </form>
    <?php
}
