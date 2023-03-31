jQuery(document).ready(function($) {
    var data = {
        labels: <?php echo json_encode( $dates ); ?>,
        datasets: [{
            label: 'Sales',
            data: <?php echo json_encode( $sales ); ?>,
            backgroundColor: 'rgba(54, 162, 235, 0.2)',
            borderColor: 'rgba(54, 162, 235, 1)',
            borderWidth: 1
        }]
    };

    var options = {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true
                }
            }]
        }
    };

    var ctx = document.getElementById('myChart').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'line',
        data: data,
        options: options
    });

    // Получаем метки и значения продаж из таблицы данных
    var labels = [];
    var data = [];

    $('table tr:not(:first-child)').each(function() {
        var label = $(this).find('td:first-child').text();
        var value = $(this).find('td:last-child').text();

        labels.push(label);
        data.push(value);
    });

    // Создаем график с использованием меток и значений продаж
    createChart(labels, data);
});


function createChart(labels, data) {
    var ctx = document.getElementById('myChart').getContext('2d');
    var chart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: labels,
            datasets: [{
                label: 'Sales',
                data: data,
                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }
    });

     // Делаем Ajax-запрос для получения данных продаж
    jQuery.ajax({
        url: ajaxurl,
        method: 'POST',
        dataType: 'json',
        data: {
            action: 'get_sales_data'
        },
        success: function(data) {
            // Обновляем данные на графике
            chart.data.labels = Object.keys(data);
            chart.data.datasets[0].data = Object.values(data);
            chart.update();
        },
        error: function(xhr, status, error) {
            console.log(xhr.responseText);
        }
    });

}
