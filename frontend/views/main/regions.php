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
                        <h5><strong>Топ Ресурсов</strong></h5>
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
                                        <th>Организация </th>
                                        <th>Публикации</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $counter = 1;
                                    foreach ($organization_data as $organization) {
                                        $name = $organization['name'];
                                        $posts = 0;
                                        if (isset($total_posts[$organization['id']])) {
                                            $posts = $total_posts[$organization['id']];
                                        }
                                        echo    "<tr>
                                                    <td>{$counter}</td>
                                                    <td>{$name}</td>
                                                    <td>" . (end($date_posts[$organization['id']]) < prev($date_posts[$organization['id']]) ? "<i class='fa fa-arrow-down' style='color:crimson' aria-hidden='true'></i>" : "<i class='fa fa-arrow-up' style='color:#1ab394' aria-hidden='true'></i>") . " {$posts}</td>
                                                </tr>";
                                    }
                                    $counter++;
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
                        <h5><strong>Тональность по ресурсам</strong></h5>
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

    
    <script>
        function addState(sdate, edate) {
            let stateObj = {
                id: '456498'
            };

            $.ajax({
                url: '/main/regions?start_date=' + sdate + '&end_date=' + edate,
                type: 'GET',
                success: function(data) {
                    $('.wrapper-content').html(data);
                }
            });

            window.history.pushState(stateObj,
                'Page 2', '/main/index#regions?start_date=' + sdate + '&end_date=' + edate);

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
                    text: 'Ресурсы'
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

                series: [
                    <?php
                    foreach ($organization_data as $data) {
                        echo '{name: ' . "'" . $data['name'] . "'" . ', data: [';
                        foreach ($dates as $d) {
                            foreach ($date_posts[$data['id']] as $date => $value) {
                                if ($d == $date) echo $value . ", ";
                            }
                        }
                        echo ']},';
                    }

                    ?>
                ],

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
                categories: [<?php foreach ($organization_data as $d) {
                                    echo "'" . $d['name'] . "', ";
                                } ?>]
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
                data: [<?php foreach ($organization_data as $data) {
                            echo $resources_sentiments[$data['id']]['negative'] . ",";
                        } ?>],
                color: 'crimson'
            }, {
                name: 'Нейтрал',
                data: [<?php foreach ($organization_data as $data) {
                            echo $resources_sentiments[$data['id']]['neutral'] . ",";
                        } ?>],
            }, {
                name: 'Позитив',
                data: [<?php foreach ($organization_data as $data) {
                            echo $resources_sentiments[$data['id']]['positive'] . ",";
                        } ?>],
                color: '#1ab394'
            }]
        });
    </script>