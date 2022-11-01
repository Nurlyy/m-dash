    <div class="row border-bottom">
        <nav class="navbar navbar-static-top white-bg" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>
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
            <div class="col-lg-2">
                <div class="ibox ">
                    <div class="ibox-title">
                        <h2><i class="fa fa-newspaper-o"></i> Сайты</h2>
                    </div>
                    <div class="ibox-content">
                        <h4 class="no-margins">19 сайтов</h4>
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
                                                        $sum += (isset($values['web']) ? $values['web'] : 0);
                                                    }
                                                echo $sum; ?></h1>
                        <div class="stat-percent font-bold text-info">17% <i class="fa fa-level-up"></i></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-2">
                <div class="ibox ">
                    <div class="ibox-title">
                        <h5><i class="fa fa-eye"></i> Просмотров</h5>
                    </div>
                    <div class="ibox-content">
                        <h1 class="no-margins"><?php $sum = 0;
                                                foreach ($total_views as $values) {
                                                    $sum += (isset($values['web']) ? $values['web'] : 0);
                                                }
                                                echo $sum; ?></h1>
                        <div class="stat-percent font-bold text-info">23% <i class="fa fa-level-up"></i></div>
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
                                <li><a class="nav-link" data-toggle="tab" href="#tab-views">Просмотры</a></li>
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
                                <div role="tabpanel" id="tab-views" class="tab-pane">
                                    <div class="panel-body">
                                        <div class="row">
                                            <div class="col-lg-8">
                                                <div id="container_dynamic_views"></div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div id="container_map_views"></div>
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
                        <h5>Рейтинг сайтов</h5>
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
                                <thead>
                                    <tr>
                                        <th>№</th>
                                        <th>Сайт</th>
                                        <th>Публикаций</th>
                                        <th>Просмотров</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $counter = 1;
                                    if (isset($organization_data))
                                        foreach ($organization_data as $org_data) {
                                            if (isset($org_data)) {
                                                $name = $org_data['name'];
                                                echo "<tr><td>{$counter}</td><td>{$name}</td><td>"
                                                    . $total_posts[$org_data['id']]['web']
                                                    . "</td><td>"
                                                    . $total_views[$org_data['id']]['web']
                                                    . "</td><td>";
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
    </div>

    <div class="footer">
        <div>
            Смыслы и послания данного сайта созданы командой iMAS, не пытайтесь их повторить. "iMAS GROUP". 2014 - ∞
        </div>
    </div>

    </div>

    <script>
        function addState(sdate, edate) {
        let stateObj = {
            id: '456498'
        };

        $.ajax({
            url: '/main/sites?start_date=' + sdate + '&end_date=' + edate,
            type: 'GET',
            success: function(data) {
                $('#page-wrapper').html(data);
            }
        });

        window.history.pushState(stateObj,
            'Page 2', '/main/index#sites?start_date=' + sdate + '&end_date=' + edate);

    }

    function openurl(type, start_date, end_date){
        $.ajax({
            url: '/main/'+type+'?start_date='+start_date.split(".")[2]+"-"+start_date.split(".")[1]+"-"+start_date.split(".")[0]+'&end_date='+end_date.split(".")[2]+"-"+end_date.split(".")[1]+"-"+end_date.split(".")[0],
            type: 'GET',
            success: function(data) {
                // $('#page-wrapper').html("");
                history.pushState("/main/index#" + type, "/main/index#" + type, "/main/index#" + type);
                $('#page-wrapper').html(data);
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
                ['kz-qo', <?php echo isset($regions_data[11]['posts']['web']) ? $regions_data[11]['posts']['web'] : 0 ?>],
                ['kz-qs', <?php echo isset($regions_data[10]['posts']['web']) ? $regions_data[10]['posts']['web'] : 0 ?>],
                ['kz-nk', <?php echo isset($regions_data[15]['posts']['web']) ? $regions_data[15]['posts']['web'] : 0 ?>],
                ['kz-pa', <?php echo isset($regions_data[14]['posts']['web']) ? $regions_data[14]['posts']['web'] : 0 ?>],
                ['kz-am', <?php echo isset($regions_data[3]['posts']['web']) ? $regions_data[3]['posts']['web'] : 0 ?>],
                ['kz-zm', <?php echo isset($regions_data[8]['posts']['web']) ? $regions_data[8]['posts']['web'] : 0 ?>],
                ['kz-aa', <?php echo isset($regions_data[5]['posts']['web']) ? $regions_data[5]['posts']['web'] : 0 ?>],
                ['kz-ar', <?php echo isset($regions_data[6]['posts']['web']) ? $regions_data[6]['posts']['web'] : 0 ?>],
                ['kz-mg', <?php echo isset($regions_data[12]['posts']['web']) ? $regions_data[12]['posts']['web'] : 0 ?>],
                ['kz-ek', <?php echo isset($regions_data[16]['posts']['web']) ? $regions_data[16]['posts']['web'] : 0 ?>],
                ['kz-at', <?php echo isset($regions_data[4]['posts']['web']) ? $regions_data[4]['posts']['web'] : 0 ?>],
                ['kz-wk', <?php echo isset($regions_data[7]['posts']['web']) ? $regions_data[7]['posts']['web'] : 0 ?>],
                ['kz-sk', <?php echo isset($regions_data[13]['posts']['web']) ? $regions_data[13]['posts']['web'] : 0 ?>],
                ['kz-qg', <?php echo isset($regions_data[9]['posts']['web']) ? $regions_data[9]['posts']['web'] : 0 ?>]
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

            var map_data_views = [
                ['kz-qo', <?php echo isset($regions_data[11]['views']['web']) ? $regions_data[11]['views']['web'] : 0 ?>],
                ['kz-qs', <?php echo isset($regions_data[10]['views']['web']) ? $regions_data[10]['views']['web'] : 0 ?>],
                ['kz-nk', <?php echo isset($regions_data[15]['views']['web']) ? $regions_data[15]['views']['web'] : 0 ?>],
                ['kz-pa', <?php echo isset($regions_data[14]['views']['web']) ? $regions_data[14]['views']['web'] : 0 ?>],
                ['kz-am', <?php echo isset($regions_data[3]['views']['web']) ? $regions_data[3]['views']['web'] : 0 ?>],
                ['kz-zm', <?php echo isset($regions_data[8]['views']['web']) ? $regions_data[8]['views']['web'] : 0 ?>],
                ['kz-aa', <?php echo isset($regions_data[5]['views']['web']) ? $regions_data[5]['views']['web'] : 0 ?>],
                ['kz-ar', <?php echo isset($regions_data[6]['views']['web']) ? $regions_data[6]['views']['web'] : 0 ?>],
                ['kz-mg', <?php echo isset($regions_data[12]['views']['web']) ? $regions_data[12]['views']['web'] : 0 ?>],
                ['kz-ek', <?php echo isset($regions_data[16]['views']['web']) ? $regions_data[16]['views']['web'] : 0 ?>],
                ['kz-at', <?php echo isset($regions_data[4]['views']['web']) ? $regions_data[4]['views']['web'] : 0 ?>],
                ['kz-wk', <?php echo isset($regions_data[7]['views']['web']) ? $regions_data[7]['views']['web'] : 0 ?>],
                ['kz-sk', <?php echo isset($regions_data[13]['views']['web']) ? $regions_data[13]['views']['web'] : 0 ?>],
                ['kz-qg', <?php echo isset($regions_data[9]['views']['web']) ? $regions_data[9]['views']['web'] : 0 ?>]
            ];

            Highcharts.mapChart('container_map_views', {
                chart: {
                    map: 'countries/kz/kz-all'
                },

                title: {
                    text: 'Кол-во просмотров по областям'
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
                    data: map_data_views,
                    name: 'Кол-во просмотров',
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

            Highcharts.chart('container_dynamic_views', {

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
                            text: 'Кол-во просмотров'
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
                    name: 'Просмотров',
                    data: [<?php
                            foreach ($dates as $d) {
                                foreach ($date_views as $date => $value) {
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