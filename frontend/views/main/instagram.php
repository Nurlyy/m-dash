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
                    <h2><i class="fa fa-instagram"></i> Instagram</h2>
                </div>
                <div class="ibox-content">
                    <h4 class="no-margins">46 аккаунтов</h4>
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
                                                    $sum += (isset($values['ig']) ? $values['ig'] : 0);
                                                }
                                            echo $sum; ?></h1>
                    <div class="stat-percent font-bold text-info">17% <i class="fa fa-level-up"></i></div>
                </div>
            </div>
        </div>
        <div class="col-lg-2">
            <div class="ibox ">
                <div class="ibox-title">
                    <h5><i class="fa fa-heart"></i> Лайков</h5>
                </div>
                <div class="ibox-content">
                    <h1 class="no-margins"><?php $sum = 0;
                                            if (isset($total_likes))
                                                foreach ($total_likes as $values) {
                                                    $sum += (isset($values['ig']) ? $values['ig'] : 0);
                                                }
                                            echo $sum; ?></h1>
                    <div class="stat-percent font-bold text-danger">4% <i class="fa fa-level-down"></i></div>
                </div>
            </div>
        </div>
        <div class="col-lg-2">
            <div class="ibox ">
                <div class="ibox-title">
                    <h5><i class="fa fa-share"></i> Репостов</h5>
                </div>
                <div class="ibox-content">
                    <h1 class="no-margins"><?php $sum = 0;
                                            if (isset($total_reposts))
                                                foreach ($total_reposts as $values) {
                                                    $sum += (isset($values['ig']) ? $values['ig'] : 0);
                                                }
                                            echo $sum; ?></h1>
                    <div class="stat-percent font-bold text-info">7% <i class="fa fa-level-up"></i></div>
                </div>
            </div>
        </div>
        <div class="col-lg-2">
            <div class="ibox ">
                <div class="ibox-title">
                    <h5><i class="fa fa-comments"></i> Комментариев</h5>
                </div>
                <div class="ibox-content">
                    <h1 class="no-margins"><?php $sum = 0;
                                            if (isset($total_comments))
                                                foreach ($total_comments as $values) {
                                                    $sum += (isset($values['ig']) ? $values['ig'] : 0);
                                                }
                                            echo $sum; ?></h1>
                    <div class="stat-percent font-bold text-danger">5% <i class="fa fa-level-down"></i></div>
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
                                                    $sum += (isset($values['ig']) ? $values['ig'] : 0);
                                                }
                                            echo $sum; ?></h1>
                    <div class="stat-percent font-bold text-info">2% <i class="fa fa-level-up"></i></div>
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
                            <li><a class="nav-link" data-toggle="tab" href="#tab-likes">Лайки</a></li>
                            <li><a class="nav-link" data-toggle="tab" href="#tab-comments">Комментарии</a></li>
                            <li><a class="nav-link" data-toggle="tab" href="#tab-reposts">Репосты</a></li>
                            <li><a class="nav-link" data-toggle="tab" href="#tab-members">Подписчики</a></li>
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
                            <div role="tabpanel" id="tab-likes" class="tab-pane">
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-lg-8">
                                            <div id="container_dynamic_likes"></div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div id="container_map_likes"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div role="tabpanel" id="tab-comments" class="tab-pane">
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-lg-8">
                                            <div id="container_dynamic_comments"></div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div id="container_map_comments"></div>
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
                            <thead>
                                <tr>
                                    <th>№</th>
                                    <th>Аккаунт</th>
                                    <th>Публикаций</th>
                                    <th>Подписчиков</th>
                                    <th>Лайков </th>
                                    <th>Репостов</th>
                                    <th>Комментариев</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $counter = 1;
                                if (isset($organization_data))
                                    foreach ($organization_data as $org_data) {
                                        if (isset($org_data)) {
                                            $name = $org_data['name'];
                                            echo "<tr><td>{$counter}</td><td>{$name}</td><td>"
                                                . $total_posts[$org_data['id']]['ig']
                                                . "</td><td>"
                                                . $total_subs[$org_data['id']]['ig']
                                                . "</td><td>"
                                                . $total_likes[$org_data['id']]['ig']
                                                . "</td><td>"
                                                . $total_reposts[$org_data['id']]['ig']
                                                . "</td><td>"
                                                . $total_comments[$org_data['id']]['ig']
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
</div>

<div class="footer">
    <div>
        Смыслы и послания данного сайта созданы командой iMAS, не пытайтесь их повторить. "iMAS GROUP". 2014 - ∞
    </div>
</div>


<script>
    function addState(sdate, edate) {
        let stateObj = {
            id: '456498'
        };

        $.ajax({
            url: '/main/instagram?start_date=' + sdate + '&end_date=' + edate,
            type: 'GET',
            success: function(data) {
                $('#page-wrapper').html(data);
            }
        });

        window.history.pushState(stateObj,
            'Page 2', '/main/index#instagram?start_date=' + sdate + '&end_date=' + edate);

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
            ['kz-qo', <?php echo isset($regions_data[11]['posts']['ig'])?$regions_data[11]['posts']['ig']:0 ?>],
            ['kz-qs', <?php echo isset($regions_data[10]['posts']['ig'])?$regions_data[10]['posts']['ig']:0 ?>],
            ['kz-nk', <?php echo isset($regions_data[15]['posts']['ig'])?$regions_data[15]['posts']['ig']:0 ?>],
            ['kz-pa', <?php echo isset($regions_data[14]['posts']['ig'])?$regions_data[14]['posts']['ig']:0 ?>],
            ['kz-am', <?php echo isset($regions_data[3]['posts']['ig'])?$regions_data[3]['posts']['ig']:0 ?>],
            ['kz-zm', <?php echo isset($regions_data[8]['posts']['ig'])?$regions_data[8]['posts']['ig']:0 ?>],
            ['kz-aa', <?php echo isset($regions_data[5]['posts']['ig'])?$regions_data[5]['posts']['ig']:0 ?>],
            ['kz-ar', <?php echo isset($regions_data[6]['posts']['ig'])?$regions_data[6]['posts']['ig']:0 ?>],
            ['kz-mg', <?php echo isset($regions_data[12]['posts']['ig'])?$regions_data[12]['posts']['ig']:0 ?>],
            ['kz-ek', <?php echo isset($regions_data[16]['posts']['ig'])?$regions_data[16]['posts']['ig']:0 ?>],
            ['kz-at', <?php echo isset($regions_data[4]['posts']['ig'])?$regions_data[4]['posts']['ig']:0 ?>],
            ['kz-wk', <?php echo isset($regions_data[7]['posts']['ig'])?$regions_data[7]['posts']['ig']:0 ?>],
            ['kz-sk', <?php echo isset($regions_data[13]['posts']['ig'])?$regions_data[13]['posts']['ig']:0 ?>],
            ['kz-qg', <?php echo isset($regions_data[9]['posts']['ig'])?$regions_data[9]['posts']['ig']:0 ?>]
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

        var map_data_likes = [
            ['kz-qo', <?php echo (isset($regions_data[11]['likes']['ig'])?$regions_data[11]['likes']['ig']:0)?>],
            ['kz-qs', <?php echo (isset($regions_data[10]['likes']['ig'])?$regions_data[10]['likes']['ig']:0)?>],
            ['kz-nk', <?php echo (isset($regions_data[15]['likes']['ig'])?$regions_data[15]['likes']['ig']:0)?>],
            ['kz-pa', <?php echo (isset($regions_data[14]['likes']['ig'])?$regions_data[14]['likes']['ig']:0)?>],
            ['kz-am', <?php echo (isset($regions_data[3]['likes']['ig'])?$regions_data[3]['likes']['ig']:0)?>],
            ['kz-zm', <?php echo (isset($regions_data[8]['likes']['ig'])?$regions_data[8]['likes']['ig']:0)?>],
            ['kz-aa', <?php echo (isset($regions_data[5]['likes']['ig'])?$regions_data[5]['likes']['ig']:0)?>],
            ['kz-ar', <?php echo (isset($regions_data[6]['likes']['ig'])?$regions_data[6]['likes']['ig']:0)?>],
            ['kz-mg', <?php echo (isset($regions_data[12]['likes']['ig'])?$regions_data[12]['likes']['ig']:0)?>],
            ['kz-ek', <?php echo (isset($regions_data[16]['likes']['ig'])?$regions_data[16]['likes']['ig']:0)?>],
            ['kz-at', <?php echo (isset($regions_data[4]['likes']['ig'])?$regions_data[4]['likes']['ig']:0)?>],
            ['kz-wk', <?php echo (isset($regions_data[7]['likes']['ig'])?$regions_data[7]['likes']['ig']:0)?>],
            ['kz-sk', <?php echo (isset($regions_data[13]['likes']['ig'])?$regions_data[13]['likes']['ig']:0)?>],
            ['kz-qg', <?php echo (isset($regions_data[9]['likes']['ig'])?$regions_data[9]['likes']['ig']:0)?>]
        ];

        Highcharts.mapChart('container_map_likes', {
            chart: {
                map: 'countries/kz/kz-all'
            },

            title: {
                text: 'Кол-во лайков по областям'
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
                data: map_data_likes,
                name: 'Кол-во лайков',
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

        var map_data_comments = [
            ['kz-qs', <?php echo (isset($regions_data[10]['comments']['ig'])?$regions_data[10]['comments']['ig']:0)?>],
            ['kz-qo', <?php echo (isset($regions_data[11]['comments']['ig'])?$regions_data[11]['comments']['ig']:0)?>],
            ['kz-nk', <?php echo (isset($regions_data[15]['comments']['ig'])?$regions_data[15]['comments']['ig']:0)?>],
            ['kz-pa', <?php echo (isset($regions_data[14]['comments']['ig'])?$regions_data[14]['comments']['ig']:0)?>],
            ['kz-am', <?php echo (isset($regions_data[3]['comments']['ig'])?$regions_data[3]['comments']['ig']:0)?>],
            ['kz-zm', <?php echo (isset($regions_data[8]['comments']['ig'])?$regions_data[8]['comments']['ig']:0)?>],
            ['kz-aa', <?php echo (isset($regions_data[5]['comments']['ig'])?$regions_data[5]['comments']['ig']:0)?>],
            ['kz-ar', <?php echo (isset($regions_data[6]['comments']['ig'])?$regions_data[6]['comments']['ig']:0)?>],
            ['kz-mg', <?php echo (isset($regions_data[12]['comments']['ig'])?$regions_data[12]['comments']['ig']:0)?>],
            ['kz-ek', <?php echo (isset($regions_data[16]['comments']['ig'])?$regions_data[16]['comments']['ig']:0)?>],
            ['kz-at', <?php echo (isset($regions_data[4]['comments']['ig'])?$regions_data[4]['comments']['ig']:0)?>],
            ['kz-wk', <?php echo (isset($regions_data[7]['comments']['ig'])?$regions_data[7]['comments']['ig']:0)?>],
            ['kz-sk', <?php echo (isset($regions_data[13]['comments']['ig'])?$regions_data[13]['comments']['ig']:0)?>],
            ['kz-qg', <?php echo (isset($regions_data[9]['comments']['ig'])?$regions_data[9]['comments']['ig']:0)?>]
        ];

        Highcharts.mapChart('container_map_comments', {
            chart: {
                map: 'countries/kz/kz-all'
            },

            title: {
                text: 'Кол-во комментариев по областям'
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
                data: map_data_comments,
                name: 'Кол-во комментариев',
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
            ['kz-qo', <?php echo (isset($regions_data[11]['reposts']['ig'])?$regions_data[11]['reposts']['ig']:0)?>],
            ['kz-qs', <?php echo (isset($regions_data[10]['reposts']['ig'])?$regions_data[10]['reposts']['ig']:0)?>],
            ['kz-nk', <?php echo (isset($regions_data[15]['reposts']['ig'])?$regions_data[15]['reposts']['ig']:0)?>],
            ['kz-pa', <?php echo (isset($regions_data[14]['reposts']['ig'])?$regions_data[14]['reposts']['ig']:0)?>],
            ['kz-am', <?php echo (isset($regions_data[3]['reposts']['ig'])?$regions_data[3]['reposts']['ig']:0)?>],
            ['kz-zm', <?php echo (isset($regions_data[8]['reposts']['ig'])?$regions_data[8]['reposts']['ig']:0)?>],
            ['kz-aa', <?php echo (isset($regions_data[5]['reposts']['ig'])?$regions_data[5]['reposts']['ig']:0)?>],
            ['kz-ar', <?php echo (isset($regions_data[6]['reposts']['ig'])?$regions_data[6]['reposts']['ig']:0)?>],
            ['kz-mg', <?php echo (isset($regions_data[12]['reposts']['ig'])?$regions_data[12]['reposts']['ig']:0)?>],
            ['kz-ek', <?php echo (isset($regions_data[16]['reposts']['ig'])?$regions_data[16]['reposts']['ig']:0)?>],
            ['kz-at', <?php echo (isset($regions_data[4]['reposts']['ig'])?$regions_data[4]['reposts']['ig']:0)?>],
            ['kz-wk', <?php echo (isset($regions_data[7]['reposts']['ig'])?$regions_data[7]['reposts']['ig']:0)?>],
            ['kz-sk', <?php echo (isset($regions_data[13]['reposts']['ig'])?$regions_data[13]['reposts']['ig']:0)?>],
            ['kz-qg', <?php echo (isset($regions_data[9]['reposts']['ig'])?$regions_data[9]['reposts']['ig']:0)?>]
        ];

        Highcharts.mapChart('container_map_reposts', {
            chart: {
                map: 'countries/kz/kz-all'
            },

            title: {
                text: 'Кол-во репостов по областям'
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
                name: 'Кол-во репостов',
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
            ['kz-qo', <?php echo (isset($regions_data[11]['subs']['ig'])?$regions_data[11]['subs']['ig']:0)?>],
            ['kz-qs', <?php echo (isset($regions_data[10]['subs']['ig'])?$regions_data[10]['subs']['ig']:0)?>],
            ['kz-nk', <?php echo (isset($regions_data[15]['subs']['ig'])?$regions_data[15]['subs']['ig']:0)?>],
            ['kz-pa', <?php echo (isset($regions_data[14]['subs']['ig'])?$regions_data[14]['subs']['ig']:0)?>],
            ['kz-am', <?php echo (isset($regions_data[3]['subs']['ig'])?$regions_data[3]['subs']['ig']:0)?>],
            ['kz-zm', <?php echo (isset($regions_data[8]['subs']['ig'])?$regions_data[8]['subs']['ig']:0)?>],
            ['kz-aa', <?php echo (isset($regions_data[5]['subs']['ig'])?$regions_data[5]['subs']['ig']:0)?>],
            ['kz-ar', <?php echo (isset($regions_data[6]['subs']['ig'])?$regions_data[6]['subs']['ig']:0)?>],
            ['kz-mg', <?php echo (isset($regions_data[12]['subs']['ig'])?$regions_data[12]['subs']['ig']:0)?>],
            ['kz-ek', <?php echo (isset($regions_data[16]['subs']['ig'])?$regions_data[16]['subs']['ig']:0)?>],
            ['kz-at', <?php echo (isset($regions_data[4]['subs']['ig'])?$regions_data[4]['subs']['ig']:0)?>],
            ['kz-wk', <?php echo (isset($regions_data[7]['subs']['ig'])?$regions_data[7]['subs']['ig']:0)?>],
            ['kz-sk', <?php echo (isset($regions_data[13]['subs']['ig'])?$regions_data[13]['subs']['ig']:0)?>],
            ['kz-qg', <?php echo (isset($regions_data[9]['subs']['ig'])?$regions_data[9]['subs']['ig']:0)?>]
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
                categories: ['<?= isset($dates)?implode("', '", $dates):0 ?>']
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
                    foreach($dates as $d){
                        foreach($date_posts as $date=>$value){
                            if($d == $date) echo $value . ", ";
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

        Highcharts.chart('container_dynamic_comments', {

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
                categories: ['<?= isset($dates)?implode("', '", $dates):0 ?>']
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
                name: 'Комментарии',
                data: [<?php
                    foreach($dates as $d){
                        foreach($date_comments as $date=>$value){
                            if($d == $date) echo $value . ", ";
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

        Highcharts.chart('container_dynamic_likes', {

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
                categories: ['<?= isset($dates)?implode("', '", $dates):0 ?>']
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
                name: 'Лайки',
                data: [<?php
                    foreach($dates as $d){
                        foreach($date_likes as $date=>$value){
                            if($d == $date) echo $value . ", ";
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
                categories: ['<?= isset($dates)?implode("', '", $dates):0 ?>']
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
                    foreach($dates as $d){
                        foreach($date_subs as $date=>$value){
                            if($d == $date) echo $value . ", ";
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
                categories: ['<?= isset($dates)?implode("', '", $dates):0 ?>']
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
                name: 'Репосты',
                data: [<?php
                    foreach($dates as $d){
                        foreach($date_reposts as $date=>$value){
                            if($d == $date) echo $value . ", ";
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
            dom: '<\"html5buttons\B>lTfgitp',
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