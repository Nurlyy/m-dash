        <div class="row">
            <div class="col-lg-2">
                <div class="ibox ">
                    <div class="ibox-title">
                        <h2><i class="fa fa-telegram"></i> Telegram</h2>
                    </div>
                    <div class="ibox-content">
                        <h4 class="no-margins">132 канала</h4>
                    </div>
                </div>
            </div>
            <div class="col-lg-2">
                <div class="ibox ">
                    <div class="ibox-title">
                        <h5><i class="fa fa-newspaper-o"></i> Публикаций</h5>
                    </div>
                    <div class="ibox-content">
                        <h1 class="no-margins"><?php $sum = 0;
                                                if (isset($total_posts))
                                                    foreach ($total_posts as $values) {
                                                        $sum += (isset($values['tg']) ? $values['tg'] : 0);
                                                    }
                                                echo $sum; ?></h1>
                        <?= (end($date_posts) > prev($date_posts) ? '<div class="stat-percent font-bold text-info">' . end($date_posts) - prev($date_posts) . ' <i class="fa fa-level-up"></i>' : '<div class="stat-percent font-bold text-danger">' . end($date_posts) - prev($date_posts) . '<i class="fa fa-level-down"></i>') ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-2">
            <div class="ibox ">
                <div class="ibox-title">
                    <h5><i class="fa fa-share"></i> Ответов</h5>
                </div>
                <div class="ibox-content">
                    <h1 class="no-margins"><?php $sum = 0;
                                            if (isset($total_reposts))
                                                foreach ($total_reposts as $values) {
                                                    $sum += (isset($values['tg']) ? $values['tg'] : 0);
                                                }
                                            echo $sum; ?></h1>
                    <?= (end($date_reposts) > prev($date_reposts) ? '<div class="stat-percent font-bold text-info">' . end($date_reposts) - prev($date_reposts) . ' <i style="margin-left: 5px;" class="fa fa-level-up"></i>' : '<div class="stat-percent font-bold text-danger">' . end($date_reposts) - prev($date_reposts) . '<i style="margin-left: 5px;" class="fa fa-level-down"></i>') ?>
                </div>
            </div>
        </div>
        </div>
        <div class="col-lg-2">
            <div class="ibox ">
                <div class="ibox-title">
                    <h5><i class="fa fa-users"></i> Подписчиков</h5>
                </div>
                <div class="ibox-content">
                    <h1 class="no-margins"><?php $sum = 0;
                                            if (isset($total_subs))
                                                foreach ($total_subs as $values) {
                                                    $sum += (isset($values['tg']) ? $values['tg'] : 0);
                                                }
                                            echo $sum; ?></h1>
                    <?= (end($date_subs) > prev($date_subs) ? '<div class="stat-percent font-bold text-info">' . end($date_subs) - prev($date_subs) . '<i style="margin-left: 5px;" class="fa fa-level-up"></i>' : '<div class="stat-percent font-bold text-danger">' . end($date_subs) - prev($date_subs) . '<i style="margin-left: 5px;" class="fa fa-level-down"></i>') ?>
                </div>
            </div>
        </div>
        </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox ">
                    <div class="ibox-content">
                        <div class="tabs-container">
                            <ul class="nav nav-tabs" role="tablist">
                                <li><a class="nav-link active" data-toggle="tab" href="#tab-posts">Посты</a></li>
                                <li><a class="nav-link" data-toggle="tab" href="#tab-members">Подписчики</a></li>
                                <li><a class="nav-link" data-toggle="tab" href="#tab-reposts">Ответы</a></li>
                            </ul>
                            <div class="tab-content">
                                <div role="tabpanel" id="tab-posts" class="tab-pane active">
                                    <div class="panel-body">
                                        <div class="row">
                                            <div class="col-lg-8">
                                                <div id="container_dynamic_posts"></div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div id="container_map_posts"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div role="tabpanel" id="tab-reposts" class="tab-pane">
                                    <div class="panel-body">
                                        <div class="row">
                                            <div class="col-lg-8">
                                                <div id="container_dynamic_reposts"></div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div id="container_map_reposts"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div role="tabpanel" id="tab-members" class="tab-pane">
                                    <div class="panel-body">
                                        <div class="row">
                                            <div class="col-lg-8">
                                                <div id="container_dynamic_members"></div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div id="container_map_members"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="ibox ">
                    <div class="ibox-title">
                        <h5>Рейтинг Facebook</h5>
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
                            <table class="table table-striped table-bordered table-hover dataTables-example">
                                <tr>
                                    <th>№</th>
                                    <th>Канал</th>
                                    <th>Публикаций</th>
                                    <th>Подписчиков</th>
                                    <th>Ответов</th>
                                </tr>
                                </thead>
                                <tbody>
                                    <?php $counter = 1;
                                    if (isset($organization_data))
                                        foreach ($organization_data as $org_data) {
                                            if (isset($org_data)) {
                                                $name = $org_data['name'];
                                                echo "<tr><td>{$counter}</td><td>{$name}</td><td>"
                                                    . $total_posts[$org_data['id']]['tg']
                                                    . "</td><td>"
                                                    . $total_subs[$org_data['id']]['tg']
                                                    . "</td><td>"
                                                    . $total_reposts[$org_data['id']]['tg']
                                                    . "</td></tr>";
                                                $counter++;
                                            }
                                        } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script>
            function addState(sdate, edate) {
                let stateObj = {
                    id: '456498'
                };

                $.ajax({
                    url: '/main/telegram?start_date=' + sdate + '&end_date=' + edate,
                    type: 'GET',
                    success: function(data) {
                        $('.wrapper-content').html(data);
                    }
                });

                window.history.pushState(stateObj,
                    'Page 2', '/main/index#telegram?start_date=' + sdate + '&end_date=' + edate);

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
                var map_data_posts = [
                    ['kz-qo', <?php echo isset($regions_data[11]['posts']['tg']) ? $regions_data[11]['posts']['tg'] : 0 ?>],
                    ['kz-qs', <?php echo isset($regions_data[10]['posts']['tg']) ? $regions_data[10]['posts']['tg'] : 0 ?>],
                    ['kz-nk', <?php echo isset($regions_data[15]['posts']['tg']) ? $regions_data[15]['posts']['tg'] : 0 ?>],
                    ['kz-pa', <?php echo isset($regions_data[14]['posts']['tg']) ? $regions_data[14]['posts']['tg'] : 0 ?>],
                    ['kz-am', <?php echo isset($regions_data[3]['posts']['tg']) ? $regions_data[3]['posts']['tg'] : 0 ?>],
                    ['kz-zm', <?php echo isset($regions_data[8]['posts']['tg']) ? $regions_data[8]['posts']['tg'] : 0 ?>],
                    ['kz-aa', <?php echo isset($regions_data[5]['posts']['tg']) ? $regions_data[5]['posts']['tg'] : 0 ?>],
                    ['kz-ar', <?php echo isset($regions_data[6]['posts']['tg']) ? $regions_data[6]['posts']['tg'] : 0 ?>],
                    ['kz-mg', <?php echo isset($regions_data[12]['posts']['tg']) ? $regions_data[12]['posts']['tg'] : 0 ?>],
                    ['kz-ek', <?php echo isset($regions_data[16]['posts']['tg']) ? $regions_data[16]['posts']['tg'] : 0 ?>],
                    ['kz-at', <?php echo isset($regions_data[4]['posts']['tg']) ? $regions_data[4]['posts']['tg'] : 0 ?>],
                    ['kz-wk', <?php echo isset($regions_data[7]['posts']['tg']) ? $regions_data[7]['posts']['tg'] : 0 ?>],
                    ['kz-sk', <?php echo isset($regions_data[13]['posts']['tg']) ? $regions_data[13]['posts']['tg'] : 0 ?>],
                    ['kz-qg', <?php echo isset($regions_data[9]['posts']['tg']) ? $regions_data[9]['posts']['tg'] : 0 ?>]
                ];

                // Create the chart
                Highcharts.mapChart('container_map_posts', {
                    chart: {
                        map: 'countries/kz/kz-all'
                    },

                    title: {
                        text: 'Кол-во публикаций по областям'
                    },
                    mapNavigation: {
                        enabled: true,
                        buttonOptions: {
                            verticalAlign: 'bottom'
                        }
                    },

                    colorAxis: {
                        min: 0
                    },

                    series: [{
                        data: map_data_posts,
                        name: 'Кол-во публикаций',
                        states: {
                            hover: {
                                color: '#BADA55'
                            }
                        },
                        dataLabels: {
                            enabled: true,
                            format: '{point.name}'
                        }
                    }]
                });

                var map_data_reposts = [
                    ['kz-qo', <?php echo (isset($regions_data[11]['reposts']['tg']) ? $regions_data[11]['reposts']['tg'] : 0) ?>],
                    ['kz-qs', <?php echo (isset($regions_data[10]['reposts']['tg']) ? $regions_data[10]['reposts']['tg'] : 0) ?>],
                    ['kz-nk', <?php echo (isset($regions_data[15]['reposts']['tg']) ? $regions_data[15]['reposts']['tg'] : 0) ?>],
                    ['kz-pa', <?php echo (isset($regions_data[14]['reposts']['tg']) ? $regions_data[14]['reposts']['tg'] : 0) ?>],
                    ['kz-am', <?php echo (isset($regions_data[3]['reposts']['tg']) ? $regions_data[3]['reposts']['tg'] : 0) ?>],
                    ['kz-zm', <?php echo (isset($regions_data[8]['reposts']['tg']) ? $regions_data[8]['reposts']['tg'] : 0) ?>],
                    ['kz-aa', <?php echo (isset($regions_data[5]['reposts']['tg']) ? $regions_data[5]['reposts']['tg'] : 0) ?>],
                    ['kz-ar', <?php echo (isset($regions_data[6]['reposts']['tg']) ? $regions_data[6]['reposts']['tg'] : 0) ?>],
                    ['kz-mg', <?php echo (isset($regions_data[12]['reposts']['tg']) ? $regions_data[12]['reposts']['tg'] : 0) ?>],
                    ['kz-ek', <?php echo (isset($regions_data[16]['reposts']['tg']) ? $regions_data[16]['reposts']['tg'] : 0) ?>],
                    ['kz-at', <?php echo (isset($regions_data[4]['reposts']['tg']) ? $regions_data[4]['reposts']['tg'] : 0) ?>],
                    ['kz-wk', <?php echo (isset($regions_data[7]['reposts']['tg']) ? $regions_data[7]['reposts']['tg'] : 0) ?>],
                    ['kz-sk', <?php echo (isset($regions_data[13]['reposts']['tg']) ? $regions_data[13]['reposts']['tg'] : 0) ?>],
                    ['kz-qg', <?php echo (isset($regions_data[9]['reposts']['tg']) ? $regions_data[9]['reposts']['tg'] : 0) ?>]
                ];


                Highcharts.mapChart('container_map_reposts', {
                    chart: {
                        map: 'countries/kz/kz-all'
                    },

                    title: {
                        text: 'Кол-во ответов по областям'
                    },
                    mapNavigation: {
                        enabled: true,
                        buttonOptions: {
                            verticalAlign: 'bottom'
                        }
                    },

                    colorAxis: {
                        min: 0
                    },

                    series: [{
                        data: map_data_reposts,
                        name: 'Кол-во ответов',
                        states: {
                            hover: {
                                color: '#BADA55'
                            }
                        },
                        dataLabels: {
                            enabled: true,
                            format: '{point.name}'
                        }
                    }]
                });

                var map_data_subs = [
                    ['kz-qo', <?php echo (isset($regions_data[11]['subs']['tg']) ? $regions_data[11]['subs']['tg'] : 0) ?>],
                    ['kz-qs', <?php echo (isset($regions_data[10]['subs']['tg']) ? $regions_data[10]['subs']['tg'] : 0) ?>],
                    ['kz-nk', <?php echo (isset($regions_data[15]['subs']['tg']) ? $regions_data[15]['subs']['tg'] : 0) ?>],
                    ['kz-pa', <?php echo (isset($regions_data[14]['subs']['tg']) ? $regions_data[14]['subs']['tg'] : 0) ?>],
                    ['kz-am', <?php echo (isset($regions_data[3]['subs']['tg']) ? $regions_data[3]['subs']['tg'] : 0) ?>],
                    ['kz-zm', <?php echo (isset($regions_data[8]['subs']['tg']) ? $regions_data[8]['subs']['tg'] : 0) ?>],
                    ['kz-aa', <?php echo (isset($regions_data[5]['subs']['tg']) ? $regions_data[5]['subs']['tg'] : 0) ?>],
                    ['kz-ar', <?php echo (isset($regions_data[6]['subs']['tg']) ? $regions_data[6]['subs']['tg'] : 0) ?>],
                    ['kz-mg', <?php echo (isset($regions_data[12]['subs']['tg']) ? $regions_data[12]['subs']['tg'] : 0) ?>],
                    ['kz-ek', <?php echo (isset($regions_data[16]['subs']['tg']) ? $regions_data[16]['subs']['tg'] : 0) ?>],
                    ['kz-at', <?php echo (isset($regions_data[4]['subs']['tg']) ? $regions_data[4]['subs']['tg'] : 0) ?>],
                    ['kz-wk', <?php echo (isset($regions_data[7]['subs']['tg']) ? $regions_data[7]['subs']['tg'] : 0) ?>],
                    ['kz-sk', <?php echo (isset($regions_data[13]['subs']['tg']) ? $regions_data[13]['subs']['tg'] : 0) ?>],
                    ['kz-qg', <?php echo (isset($regions_data[9]['subs']['tg']) ? $regions_data[9]['subs']['tg'] : 0) ?>]
                ];

                Highcharts.mapChart('container_map_members', {
                    chart: {
                        map: 'countries/kz/kz-all'
                    },

                    title: {
                        text: 'Кол-во подписчиков по областям'
                    },
                    mapNavigation: {
                        enabled: true,
                        buttonOptions: {
                            verticalAlign: 'bottom'
                        }
                    },

                    colorAxis: {
                        min: 0
                    },

                    series: [{
                        data: map_data_subs,
                        name: 'Кол-во подписчиков',
                        states: {
                            hover: {
                                color: '#BADA55'
                            }
                        },
                        dataLabels: {
                            enabled: true,
                            format: '{point.name}'
                        }
                    }]
                });



                Highcharts.chart('container_dynamic_posts', {

                    title: {
                        text: ''
                    },

                    yAxis: [{
                            title: {
                                text: 'Кол-во'
                            }
                        },
                        {
                            title: {
                                text: 'Кол-во подписчиков'
                            },
                            opposite: true
                        }
                    ],

                    xAxis: {
                        accessibility: {
                            rangeDescription: 'Показатель'
                        },
                        categories: ['<?= isset($dates) ? implode("', '", $dates) : 0 ?>']
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
                        name: 'Посты',
                        data: [<?php
                                foreach ($dates as $d) {
                                    foreach ($date_posts as $date => $value) {
                                        if ($d == $date) echo $value . ", ";
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


                Highcharts.chart('container_dynamic_members', {

                    title: {
                        text: ''
                    },

                    yAxis: [{
                        title: {
                            text: 'Кол-во подписчиков'
                        }
                    }],

                    xAxis: {
                        accessibility: {
                            rangeDescription: 'Показатель'
                        },
                        categories: ['<?= isset($dates) ? implode("', '", $dates) : 0 ?>']
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
                        name: 'Подписчики',
                        data: [<?php
                                foreach ($dates as $d) {
                                    foreach ($date_subs as $date => $value) {
                                        if ($d == $date) echo $value . ", ";
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

                Highcharts.chart('container_dynamic_reposts', {

                    title: {
                        text: ''
                    },

                    yAxis: [{
                            title: {
                                text: 'Кол-во'
                            }
                        },
                        {
                            title: {
                                text: 'Кол-во подписчиков'
                            },
                            opposite: true
                        }
                    ],

                    xAxis: {
                        accessibility: {
                            rangeDescription: 'Показатель'
                        },
                        categories: ['<?= isset($dates) ? implode("', '", $dates) : 0 ?>']
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
                        name: 'Ответов',
                        data: [<?php
                                foreach ($dates as $d) {
                                    foreach ($date_reposts as $date => $value) {
                                        if ($d == $date) echo $value . ", ";
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

            $(document).ready(function() {
                $('.dataTables-example').DataTable({
                    pageLength: 15,
                    responsive: false,
                    searching: false,
                    lengthChange: false,
                    dom: '<\"html5buttons\"B>lTfgitp',
                    buttons: [{
                            extend: 'copy'
                        },
                        {
                            extend: 'csv'
                        },
                        {
                            extend: 'excel',
                            title: 'ExampleFile'
                        },
                        {
                            extend: 'pdf',
                            title: 'ExampleFile'
                        },

                        {
                            extend: 'print',
                            customize: function(win) {
                                $(win.document.body).addClass('white-bg');
                                $(win.document.body).css('font-size', '10px');

                                $(win.document.body).find('table')
                                    .addClass('compact')
                                    .css('font-size', 'inherit');
                            }
                        }
                    ]

                });

            });
        </script>