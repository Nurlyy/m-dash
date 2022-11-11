<?php

use yii\bootstrap5\Html as Html; ?>

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
                                <th>Публикации</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php
                            $counter = 1;
                            foreach ($total_posts as $key => $value) {
                                if ($key == 'web' && $value > 0) {
                                    echo "<tr>
                                                <td>{$counter}</td>
                                                <td>" . Html::img('@web/img/icons/web.png', ['width' => '20px']) . " Web-sites</td>
                                                <td>" . (end($date_posts)['web'] > prev($date_posts)['web'] ? "<i class='fa fa-arrow-up' style='color:#1ab394' aria-hidden='true'></i>" : "<i class='fa fa-arrow-down' style='color:crimson' aria-hidden='true'></i>") . " {$value}</td>
                                            </tr>";
                                }
                                if ($key == 'fb' && $value > 0) {
                                    echo "<tr>
                                                <td>{$counter}</td>
                                                <td>" . Html::img('@web/img/icons/facebook.png', ['width' => '20px']) . " Facebook</td>
                                                <td>" . (end($date_posts)['fb'] > prev($date_posts)['fb'] ? "<i class='fa fa-arrow-up' style='color:#1ab394' aria-hidden='true'></i>" : "<i class='fa fa-arrow-down' style='color:crimson' aria-hidden='true'></i>") . " {$value}</td>
                                            </tr>";
                                }
                                if ($key == 'ig' && $value > 0) {
                                    echo "<tr>
                                                <td>{$counter}</td>
                                                <td>" . Html::img('@web/img/icons/instagram.png', ['width' => '20px']) . " Instagram</td>
                                                <td>" . (end($date_posts)['ig'] > prev($date_posts)['ig'] ? "<i class='fa fa-arrow-up' style='color:#1ab394' aria-hidden='true'></i>" : "<i class='fa fa-arrow-down' style='color:crimson' aria-hidden='true'></i>") . " {$value}</td>
                                            </tr>";
                                }
                                if ($key == 'tg' && $value > 0) {
                                    echo "<tr>
                                                <td>{$counter}</td>
                                                <td>" . Html::img('@web/img/icons/telegram.png', ['width' => '20px']) . " Telegram</td>
                                                <td>" . (end($date_posts)['tg'] > prev($date_posts)['tg'] ? "<i class='fa fa-arrow-up' style='color:#1ab394' aria-hidden='true'></i>" : "<i class='fa fa-arrow-down' style='color:crimson' aria-hidden='true'></i>") . " {$value}</td>
                                            </tr>";
                                }


                                $counter++;
                            }

                            ?>


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

    <div class="col-lg-6">
        <figure class="highcharts-figure">
            <div id="container"></div>
            <p class="highcharts-description">
                This demo shows how plot bands can be used on an axis to
                highlight regions of a chart. In this example, the plot
                bands are used to separate the wind speeds on the Y-axis
                into categories.
            </p>
        </figure>
    </div>
</div>

<script>
    function addState(sdate, edate) {
        let stateObj = {
            id: '456498'
        };

        $.ajax({
            url: '/main/resources?start_date=' + sdate + '&end_date=' + edate,
            type: 'GET',
            success: function(data) {
                $('.wrapper-content').html(data);
            }
        });

        window.history.pushState(stateObj,
            'Page 2', '/main/index#resources?start_date=' + sdate + '&end_date=' + edate);

    }

    function openurl(type, start_date, end_date) {
        $.ajax({
            url: '/main/' + type + '?start_date=' + start_date.split(".")[2] + "-" + start_date.split(".")[1] + "-" + start_date.split(".")[0] + '&end_date=' + end_date.split(".")[2] + "-" + end_date.split(".")[1] + "-" + end_date.split(".")[0],
            type: 'GET',
            success: function(data) {
                // $('#page-wrapper').html("");
                history.pushState("/main/index#" + type, "/main/index#" + type, "/main/index#" + type);
                $('.wrapper-content').html(data);
                // console.log(data);
            }
        });
    }

    function do_daterangepicker_stuff(start, end, label) {

        $('#reportrange span').html(start.format('DD.MM.YYYY') + ' - ' + end.format('DD.MM.YYYY'));
        addState(start.format('YYYY-MM-DD'), end.format('YYYY-MM-DD'));
    }



    function create_daterangepicker(start, end) {
        // v:004-92M
        // if(start==null && end==null){
        let edate = new Date(end);
        let sdate = new Date(start);
        start_date = sdate.getDate() + '.' + parseInt(sdate.getMonth() + 1) + '.' + sdate.getFullYear();
        end_date = edate.getDate() + '.' + parseInt(edate.getMonth() + 1) + '.' + edate.getFullYear();

        // }else {
        //     start_date = start;
        //     end_date = end;
        // }


        const string_date = start_date + ' - ' + end_date;
        console.log(string_date);
        const daterangepicker_setting = {
            format: 'DD.MM.YYYY',
            startDate: start_date,
            endDate: end_date,
            minDate: '01.01.2022',
            maxDate: '31.11.2022',
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
        $('#reportrange span').html(start_date + ' - ' + end_date);
        $('#reportrange').daterangepicker(daterangepicker_setting, do_daterangepicker_stuff);
        // Формирование календаря для малых экаранов
        // $('#reportrange-header span').html(string_date);
        $('#reportrange-header span').html(start_date + ' - ' + end_date);
        $('#reportrange-header').daterangepicker(daterangepicker_setting, do_daterangepicker_stuff);
    }

    $(document).ready(function() {
        create_daterangepicker('<?= $start_date ?>', '<?= $end_date ?>');
        // Instantiate the map
        // Prepare demo data
        // Data is joined to map using value of 'hc-key' property by default.
        // See API docs for 'joinBy' for more info on linking data and map.


        Highcharts.chart('container_dynamic', {

            title: {
                text: 'Источники'
            },

            yAxis: [{
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
                categories: ['<?= implode("', '", $dates) ?>']
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
                data: [<?php
                        foreach ($dates as $d) {
                            foreach ($date_posts as $date => $value) {
                                if ($d == $date) echo $value['fb'] . ", ";
                            }
                        }

                        ?>]
            }, {
                name: 'Instagram',
                data: [<?php
                        foreach ($dates as $d) {
                            foreach ($date_posts as $date => $value) {
                                if ($d == $date) echo $value['ig'] . ", ";
                            }
                        }

                        ?>]
            }, {
                name: 'Telegram',
                data: [<?php
                        foreach ($dates as $d) {
                            foreach ($date_posts as $date => $value) {
                                if ($d == $date) echo $value['tg'] . ", ";
                            }
                        }

                        ?>]
            }, {
                name: 'Web-sites',
                data: [<?php
                        foreach ($dates as $d) {
                            foreach ($date_posts as $date => $value) {
                                if ($d == $date) echo $value['web'] . ", ";
                            }
                        }

                        ?>]
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
            data: [<?php echo (isset($resources_sentiments['fb_negative']) ? $resources_sentiments['fb_negative'] : 0) . ", " . (isset($resources_sentiments['ig_negative']) ? $resources_sentiments['ig_negative'] : 0) . ", " . (isset($resources_sentiments['tg_negative']) ? $resources_sentiments['tg_negative'] : 0) . ", " . (isset($resources_sentiments['web_negative']) ? $resources_sentiments['web_negative'] : 0) ?>],
            color: 'crimson'
        }, {
            name: 'Нейтрал',
            data: [<?php echo (isset($resources_sentiments['fb_neutral']) ? $resources_sentiments['fb_neutral'] : 0) . ", " . (isset($resources_sentiments['ig_neutral']) ? $resources_sentiments['ig_neutral'] : 0) . ", " . (isset($resources_sentiments['tg_neutral']) ? $resources_sentiments['tg_neutral'] : 0) . ", " . (isset($resources_sentiments['web_neutral']) ? $resources_sentiments['web_neutral'] : 0) ?>],
        }, {
            name: 'Позитив',
            data: [<?php echo (isset($resources_sentiments['fb_positive']) ? $resources_sentiments['fb_positive'] : 0) . ", " . (isset($resources_sentiments['ig_positive']) ? $resources_sentiments['ig_positive'] : 0) . ", " . (isset($resources_sentiments['tg_positive']) ? $resources_sentiments['tg_positive'] : 0) . ", " . (isset($resources_sentiments['web_positive']) ? $resources_sentiments['web_positive'] : 0) ?>],
            color: '#1ab394'
        }]
    });

    // Data retrieved from https://www.vikjavev.no/ver/#2022-06-13,2022-06-14

    Highcharts.chart('container', {
        chart: {
            type: 'spline',
            scrollablePlotArea: {
                minWidth: 600,
                scrollPositionX: 1
            }
        },
        title: {
            text: 'Публикации источников',
            align: 'center'
        },
        xAxis: {
            accessibility: {
                rangeDescription: 'Показатель'
            },
            categories: ['<?= implode("', '", $dates) ?>']
        },
        yAxis: {
            title: {
                text: 'Кол-во публикации'
            },
            minorGridLineWidth: 0,
            gridLineWidth: 0,
            alternateGridColor: null,
        },
        plotOptions: {
        spline: {
            lineWidth: 4,
            states: {
                hover: {
                    lineWidth: 5
                }
            },
            marker: {
                enabled: false
            },
        }
    },
        series: [{
            name: 'Facebook',
            data: [<?php
                    foreach ($dates as $d) {
                        foreach ($date_posts as $date => $value) {
                            if ($d == $date) echo $value['fb'] . ", ";
                        }
                    }

                    ?>]
        }, {
            name: 'Instagram',
            data: [<?php
                    foreach ($dates as $d) {
                        foreach ($date_posts as $date => $value) {
                            if ($d == $date) echo $value['ig'] . ", ";
                        }
                    }

                    ?>]
        }, {
            name: 'Telegram',
            data: [<?php
                    foreach ($dates as $d) {
                        foreach ($date_posts as $date => $value) {
                            if ($d == $date) echo $value['tg'] . ", ";
                        }
                    }

                    ?>]
        }, {
            name: 'Web-sites',
            data: [<?php
                    foreach ($dates as $d) {
                        foreach ($date_posts as $date => $value) {
                            if ($d == $date) echo $value['web'] . ", ";
                        }
                    }

                    ?>]
        }],
        navigation: {
            menuItemStyle: {
                fontSize: '10px'
            }
        }
    });
</script>