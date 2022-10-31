<?php use yii\bootstrap5\Html as Html; ?>

<div id="page-wrapper" class="gray-bg">
    <div class="row border-bottom">
        <nav class="navbar navbar-static-top white-bg" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i
                        class="fa fa-bars"></i> </a>
                <ul class="nav navbar-top-links navbar-left m-t-15">
                    <li>
                        <div class="filter_datetime p-t-0 f-l">
                            <!-- v:004-92M -->
                            <div id="reportrange" class="form-control b-none">
                                <i class="fa fa-calendar p-r-5"></i>
                                <span></span>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>

            <ul class="nav navbar-top-links navbar-right">
                <li>
                    <a href="info.html">
                        <i class="fa fa-info-circle" style="color: #1ab394;"></i>
                    </a>
                </li>
                <li>
                    <a href="logout.html">
                        <i class="fa fa-sign-out"></i> Log out
                    </a>
                </li>
            </ul>
        </nav>
    </div>


    <div class="wrapper wrapper-content">
        
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox ">
                    <div class="ibox-content">
                        <div id="container_dynamic"></div>
                    </div>
                </div>
            </div>
            

        </div>

        <div class="row">

            <div class="col-lg-6">
                <div class="ibox ">
                    <div class="ibox-title">
                        <h5><strong>Топ источников</strong></h5>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                <i class="fa fa-wrench"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-user">
                                <li><a href="#" class="dropdown-item">Config option 1</a>
                                </li>
                                <li><a href="#" class="dropdown-item">Config option 2</a>
                                </li>
                            </ul>
                            <a class="close-link">
                                <i class="fa fa-times"></i>
                            </a>
                        </div>
                    </div>
                    <div class="ibox-content">
                        <div class="tabs-container">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>№</th>
                                        <th>Ресурс </th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td><?= Html::img('@web/img/icons/facebook.png', ['width'=>'20px']) ?> Facebook</td>
                                        <td><i class="fa fa-arrow-up" style='color:#1ab394'
                                                aria-hidden="true"></i> 8536</td>
                                    <tr>
                                        <td>2</td>
                                        <td><?= Html::img('@web/img/icons/instagram.png', ['width'=>'20px']) ?> Instagram</td>
                                        <td><i class="fa fa-arrow-up" style='color:#1ab394'
                                                aria-hidden="true"></i> 3939</td>
                                    <tr>
                                        <td>3</td>
                                        <td><?= Html::img('@web/img/icons/telegram.png', ['width'=>'20px']) ?> Telegram</td>
                                        <td><i class="fa fa-arrow-down" style='color:crimson'
                                                aria-hidden="true"></i> 2485</td>
                                    <tr>
                                        <td>4</td>
                                        <td><?= Html::img('@web/img/icons/web.png', ['width'=>'20px']) ?> Web-sites</td>
                                        <td><i class="fa fa-arrow-up" style='color:#1ab394'
                                                aria-hidden="true"></i> 1948</td>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="ibox ">
                    <div class="ibox-title">
                        <h5><strong>Тональность по источникам</strong></h5>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                <i class="fa fa-wrench"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-user">
                                <li><a href="#" class="dropdown-item">Config option 1</a>
                                </li>
                                <li><a href="#" class="dropdown-item">Config option 2</a>
                                </li>
                            </ul>
                            <a class="close-link">
                                <i class="fa fa-times"></i>
                            </a>
                        </div>
                    </div>
                    <div class="ibox-content">
                        <div id="container_sentiment"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="footer">
        <div>
            Смыслы и послания данного сайта созданы командой iMAS, не пытайтесь их повторить. "iMAS GROUP". 2014
            - ∞
        </div>
    </div>

</div>

<?php 

$this->registerJs("


function do_daterangepicker_stuff(start, end, label) {
    $('#reportrange span').html(start.format('D.MM.YYYY') + ' - ' + end.format('D.MM.YYYY'));
}
function create_daterangepicker() {
    // v:004-92M
    const string_date = '15.10.2021 - 15.11.2021';
    const daterangepicker_setting = {
        format: 'DD.MM.YYYY',
        startDate: '15.10.2021',
        endDate: '15.11.2021',
        minDate: '01.10.2021',
        maxDate: '31.12.2021',
        showDropdowns: true,
        // showWeekNumbers: true,
        timePicker: false,
        timePickerIncrement: 1,
        timePicker12Hour: true,

        opens: 'right',
        drops: 'down',
        buttonClasses: ['btn', 'btn-sm'],
        applyClass: 'btn-primary daterangepicker-apply-button',
        cancelClass: 'btn-default daterangepicker-cancel-button',
        separator: ' to ',
        locale: {
            applyLabel: 'Ок',
            cancelLabel: 'Отмена',
            fromLabel: 'от',
            toLabel: 'по',
            customRangeLabel: 'Период',
            daysOfWeek: [
                'Вс', 
                'Пн', 
                'Вт', 
                'Ср', 
                'Чт', 
                'Пт', 
                'Сб'
            ],
            monthNames: [
                'Январь', 
                'Февраль', 
                'Март', 
                'Апрель', 
                'Май', 
                'Июнь', 
                'Июль', 
                'Август', 
                'Сентябрь', 
                'Октябрь', 
                'Ноябрь', 
                'Декабрь'
            ],
            firstDay: 1
        }
    };
    // Формирование календаря для больших экаранов
    $('#reportrange span').html(string_date);
    $('#reportrange').daterangepicker(daterangepicker_setting, do_daterangepicker_stuff);
    // Формирование календаря для малых экаранов
    $('#reportrange-header span').html(string_date);
    $('#reportrange-header').daterangepicker(daterangepicker_setting, do_daterangepicker_stuff);
}
");

$this->registerJs("
$(document).ready(function () {
    create_daterangepicker();
    // Instantiate the map
    // Prepare demo data
    // Data is joined to map using value of 'hc-key' property by default.
    // See API docs for 'joinBy' for more info on linking data and map.
    

    Highcharts.chart('container_dynamic', {

        title: {
            text: 'Источники'
        },

        yAxis: [
            {
                title: {
                    text: 'Кол-во'
                }
            },
            {
                title: {
                    text: 'Кол-во публикации'
                },
                opposite: true
            }
        ],

        xAxis: {
            accessibility: {
                rangeDescription: 'Показатель'
            },
            categories: [
                '21.9.2022',
                '22.9.2022',
                '23.9.2022',
                '24.9.2022',
                '25.9.2022',
                '26.9.2022',
                '27.9.2022',
                '28.9.2022',
                '29.9.2022',
                '30.9.2022',
                '31.9.2022',
                '01.10.2022',
                '02.10.2022',
                '03.10.2022',
                '04.10.2022',
                '05.10.2022',
                '06.10.2022',
                '07.10.2022',
                '08.10.2022',
                '09.10.2022',
                '10.10.2022',
                '11.10.2022',
                '12.10.2022',
                '13.10.2022',
                '14.10.2022',
                '15.10.2022',
                '16.10.2022',
                '17.10.2022',
                '18.10.2022',
                '19.10.2022',
            ]
        },

        legend: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'middle'
        },

        plotOptions: {
            series: {
                label: {
                    connectorAllowed: false
                },
            }
        },

        series: [{
            name: 'Facebook',
            data: [137, 153, 153, 138, 141, 149, 144, 141, 160, 147, 155, 133, 155, 149, 152, 131, 132, 133, 153, 144, 142, 147, 137, 141, 136, 131, 146, 147, 140, 131, 152]
        }, {
            name: 'Instagram',
            data: [118, 130, 139, 110, 137, 123, 136, 116, 139, 140, 134, 120, 122, 139, 116, 139, 113, 120, 115, 136, 137, 135, 128, 129, 123, 122, 131, 137, 134, 114, 135]
        }, {
            name: 'Telegram',
            data: [125, 130, 90, 106, 123, 125, 122, 105, 94, 115, 119, 125, 108, 111, 98, 104, 100, 127, 114, 115, 123, 114, 94, 124, 123, 106, 91, 92, 95, 97, 96]
        }, {
            name: 'Web-sites',
            data: [81, 71, 90, 97, 77, 82, 82, 96, 78, 88, 89, 99, 72, 100, 98, 89, 97, 99, 99, 87, 92, 84, 94, 95, 90, 93, 97, 100, 82, 90, 92]
        }],

        responsive: {
            rules: [{
                condition: {
                    maxWidth: 500
                },
                chartOptions: {
                    legend: {
                        layout: 'horizontal',
                        align: 'center',
                        verticalAlign: 'bottom'
                    }
                }
            }]
        }

    });
});
");

$this->registerJs("
Highcharts.chart('container_sentiment', {
    chart: {
        type: 'column'
    },
    title: {
        text: ''
    },
    xAxis: {
        categories: ['Facebook', 'Instagram', 'Telegram', 'Web-sites']
    },
    yAxis: {
        min: 0,
        title: {
            text: ''
        }
    },
    tooltip: {
        pointFormat: '<span style=\"color:{series.color}\">{series.name}</span>: <b>{point.y}</b> ({point.percentage:.0f}%)<br/>',
        shared: true
    },
    plotOptions: {
        column: {
            stacking: 'percent'
        }
    },
    series: [{
        name: 'Негатив',
        data: [9, 7, 11, 4],
        color: 'crimson'
    }, {
        name: 'Нейтрал',
        data: [37, 34, 39, 37],
    }, {
        name: 'Позитив',
        data: [13, 20, 17, 12],
        color: '#1ab394'
    }]
});
");