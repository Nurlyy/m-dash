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
                    <h5><i class="fa fa-newspaper-o"></i> Публикаций</h5>
                </div>
                <div class="ibox-content">
                    <h1 class="no-margins"><?php $sum=0;
                    foreach($total_posts as $values){
                        $sum += (isset($values['fb'])?$values['fb']:0)+(isset($values['ig'])?$values['ig']:0)+(isset($values['tg'])?$values['tg']:0) + (isset($values['web'])?$values['web']:0);
                    } echo $sum; ?></h1>
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
                    <h1 class="no-margins"><?php $sum=0;
                    foreach($total_views as $values){
                        $sum += (isset($values['web'])?$values['web']:0);
                    } echo $sum; ?></h1>
                    <div class="stat-percent font-bold text-info">23% <i class="fa fa-level-up"></i></div>
                </div>
            </div>
        </div>
        <div class="col-lg-2">
            <div class="ibox ">
                <div class="ibox-title">
                    <h5><i class="fa fa-heart"></i> Лайков</h5>
                </div>
                <div class="ibox-content">
                    <h1 class="no-margins"><?php $sum=0;
                    foreach($total_likes as $values){
                        $sum += (isset($values['fb'])?$values['fb']:0)+(isset($values['ig'])?$values['ig']:0);
                    } echo $sum; ?></h1>
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
                    <h1 class="no-margins"><?php $sum=0;
                    foreach($total_reposts as $values){
                        $sum += (isset($values['fb'])?$values['fb']:0)+(isset($values['ig'])?$values['ig']:0)+(isset($values['tg'])?$values['tg']:0);
                    } echo $sum; ?></h1>
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
                    <h1 class="no-margins"><?php $sum=0;
                    foreach($total_comments as $values){
                        $sum += (isset($values['fb'])?$values['fb']:0)+(isset($values['ig'])?$values['ig']:0);
                    } echo $sum; ?></h1>
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
                    <h1 class="no-margins"><?php $sum=0;
                    foreach($total_subs as $values){
                        $sum += (isset($values['fb'])?$values['fb']:0)+(isset($values['ig'])?$values['ig']:0)+(isset($values['tg'])?$values['tg']:0);
                    } echo $sum; ?></h1>
                    <div class="stat-percent font-bold text-info">2% <i class="fa fa-level-up"></i></div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-8">
            <div class="ibox ">
                <div class="ibox-content">
                    <div id="container_dynamic"></div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="ibox ">
                <div class="ibox-content">
                    <div id="container_map"></div>
                </div>
            </div>
        </div>

        <div class="col-lg-12">
            <div class="ibox ">
                <div class="ibox-title">
                    <h5>Рейтинг организаций</h5>
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
                        <ul class="nav nav-tabs" role="tablist">
                            <li><a class="nav-link active" data-toggle="tab" href="#tab-1">Общее</a></li>
                            <li><a class="nav-link" data-toggle="tab" href="#tab-2">Facebook</a></li>
                            <li><a class="nav-link" data-toggle="tab" href="#tab-3">Instagram</a></li>
                            <li><a class="nav-link" data-toggle="tab" href="#tab-4">Telegram</a></li>
                            <li><a class="nav-link" data-toggle="tab" href="#tab-5">Сайты</a></li>
                        </ul>
                        <div class="tab-content">
                            <div role="tabpanel" id="tab-1" class="tab-pane active">
                                <div class="panel-body">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>№</th>
                                                <th>Организация </th>
                                                <th>Публикаций</th>
                                                <th>Подписчиков</th>
                                                <th>Просмотров</th>
                                                <th>Лайков </th>
                                                <th>Репостов</th>
                                                <th>Комментариев</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $counter = 1; foreach($organization_data as $org_data){
                                                $name = $org_data['name'];
                                                echo "<tr><td>{$counter}</td><td>{$name}</td><td>"
                                                        .$total_posts[$org_data['id']]['fb']+$total_posts[$org_data['id']]['ig']+$total_posts[$org_data['id']]['tg']+$total_posts[$org_data['id']]['web']
                                                        ."</td><td>"
                                                        .$total_subs[$org_data['id']]['fb']+$total_subs[$org_data['id']]['ig']+$total_subs[$org_data['id']]['tg']
                                                        ."</td><td>"
                                                        .$total_views[$org_data['id']]['web']
                                                        ."</td><td>"
                                                        .$total_likes[$org_data['id']]['fb']+$total_likes[$org_data['id']]['ig']
                                                        ."</td><td>"
                                                        .$total_reposts[$org_data['id']]['fb']+$total_reposts[$org_data['id']]['ig']+$total_reposts[$org_data['id']]['tg']
                                                        ."</td><td>"
                                                        .$total_comments[$org_data['id']]['fb']+$total_comments[$org_data['id']]['ig']
                                                        ."</td></tr>";
                                                $counter++;
                                            } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div role="tabpanel" id="tab-2" class="tab-pane">
                                <div class="panel-body">
                                    <table class="table table-striped">
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
                                            <?php $counter = 1; foreach($organization_data as $org_data){
                                                $name = $org_data['name'];
                                                echo "<tr><td>{$counter}</td><td>{$name}</td><td>"
                                                        .$total_posts[$org_data['id']]['fb']
                                                        ."</td><td>"
                                                        .$total_subs[$org_data['id']]['fb']
                                                        ."</td><td>"
                                                        .$total_likes[$org_data['id']]['fb']
                                                        ."</td><td>"
                                                        .$total_reposts[$org_data['id']]['fb']
                                                        ."</td><td>"
                                                        .$total_comments[$org_data['id']]['fb']
                                                        ."</td></tr>";
                                                $counter++;
                                            } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div role="tabpanel" id="tab-3" class="tab-pane">
                                <div class="panel-body">
                                    <table class="table table-striped">
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
                                        <?php $counter = 1; foreach($organization_data as $org_data){
                                                $name = $org_data['name'];
                                                echo "<tr><td>{$counter}</td><td>{$name}</td><td>"
                                                        .$total_posts[$org_data['id']]['ig']
                                                        ."</td><td>"
                                                        .$total_subs[$org_data['id']]['ig']
                                                        ."</td><td>"
                                                        .$total_likes[$org_data['id']]['ig']
                                                        ."</td><td>"
                                                        .$total_reposts[$org_data['id']]['ig']
                                                        ."</td><td>"
                                                        .$total_comments[$org_data['id']]['ig']
                                                        ."</td></tr>";
                                                $counter++;
                                            } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div role="tabpanel" id="tab-4" class="tab-pane">
                                <div class="panel-body">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>№</th>
                                                <th>Канал</th>
                                                <th>Публикаций</th>
                                                <th>Подписчиков</th>
                                                <th>Ответов</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $counter = 1; foreach($organization_data as $org_data){
                                                $name = $org_data['name'];
                                                echo "<tr><td>{$counter}</td><td>{$name}</td><td>"
                                                        .$total_posts[$org_data['id']]['tg']
                                                        ."</td><td>"
                                                        .$total_subs[$org_data['id']]['tg']
                                                        ."</td><td>"
                                                        .$total_reposts[$org_data['id']]['tg']
                                                        ."</td><td>";
                                                $counter++;
                                            } ?>
                                    </table>
                                </div>
                            </div>
                            <div role="tabpanel" id="tab-5" class="tab-pane">
                                <div class="panel-body">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>№</th>
                                                <th>Сайт</th>
                                                <th>Публикаций</th>
                                                <th>Просмотров</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $counter = 1; foreach($organization_data as $org_data){
                                                $name = $org_data['name'];
                                                echo "<tr><td>{$counter}</td><td>{$name}</td><td>"
                                                        .$total_posts[$org_data['id']]['web']
                                                        ."</td><td>"
                                                        .$total_views[$org_data['id']]['web']
                                                        ."</td><td>";
                                                $counter++;
                                            } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
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
    function addState(start_date, end_date) {
        let stateObj = {
            id: '456498'
        };

        $.ajax({
            url: '/main/dashboard?start_date=' + start_date + '&end_date=' + end_date,
            type: 'GET',
            success: function(data) {
                $('#page-wrapper').html(data);
            }
        });

        window.history.pushState(stateObj,
            'Page 2', '/main/index?start_date=' + start_date + '&end_date=' + end_date);

    }

    function do_daterangepicker_stuff(start, end, label) {

        $('#reportrange span').html(start.format('D.MM.YYYY') + ' - ' + end.format('D.MM.YYYY'));
        addState(start.format('YYYY-MM-D'), end.format('YYYY-MM-D'));

    }

    function create_daterangepicker(start, end) {
        // v:004-92M
        // if(start==null && end==null){
        let edate = new Date(end);
        let sdate = new Date(start);
        let start_date = sdate.getDate() + '.' + parseInt(sdate.getMonth() + 1) + '.' + sdate.getFullYear();
        let end_date = edate.getDate() + '.' + parseInt(edate.getMonth() + 1) + '.' + edate.getFullYear();
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
        $('#reportrange span').html(start + ' - ' + end);
        $('#reportrange').daterangepicker(daterangepicker_setting, do_daterangepicker_stuff);
        // Формирование календаря для малых экаранов
        // $('#reportrange-header span').html(string_date);
        $('#reportrange-header span').html(start + ' - ' + end);
        $('#reportrange-header').daterangepicker(daterangepicker_setting, do_daterangepicker_stuff);
    }

    $(document).ready(function() {
        create_daterangepicker('<?= $start_date ?>', '<?= $end_date ?>');
        // Instantiate the map
        // Prepare demo data
        // Data is joined to map using value of 'hc-key' property by default.
        // See API docs for 'joinBy' for more info on linking data and map.
        var map_data = [
            <?php
                foreach($organization_data as $organization){
                    $sum=0;
                    foreach($total_posts as $values){
                        $sum += (isset($values['fb'])?$values['fb']:0)+(isset($values['ig'])?$values['ig']:0)+(isset($values['tg'])?$values['tg']:0) + (isset($values['web'])?$values['web']:0);
                    }
                }
                ?>
            ['kz-qo', <?php echo (isset($regions_data[45]['posts']['fb'])?$regions_data[16]['posts']['fb']:0) + (isset($regions_data[45]['posts']['ig'])?$regions_data[16]['posts']['ig']:0) + (isset($regions_data[45]['posts']['tg'])?$regions_data[16]['posts']['tg']:0) + (isset($regions_data[45]['posts']['web'])?$regions_data[16]['posts']['web']:0)?>],
            ['kz-qs', <?php echo (isset($regions_data[45]['posts']['fb'])?$regions_data[16]['posts']['fb']:0) + (isset($regions_data[45]['posts']['ig'])?$regions_data[16]['posts']['ig']:0) + (isset($regions_data[45]['posts']['tg'])?$regions_data[16]['posts']['tg']:0) + (isset($regions_data[45]['posts']['web'])?$regions_data[16]['posts']['web']:0)?>],
            ['kz-nk', <?php echo (isset($regions_data[45]['posts']['fb'])?$regions_data[16]['posts']['fb']:0) + (isset($regions_data[45]['posts']['ig'])?$regions_data[16]['posts']['ig']:0) + (isset($regions_data[45]['posts']['tg'])?$regions_data[16]['posts']['tg']:0) + (isset($regions_data[45]['posts']['web'])?$regions_data[16]['posts']['web']:0)?>],
            ['kz-pa', <?php echo (isset($regions_data[14]['posts']['fb'])?$regions_data[14]['posts']['fb']:0) + (isset($regions_data[14]['posts']['ig'])?$regions_data[14]['posts']['ig']:0) + (isset($regions_data[14]['posts']['tg'])?$regions_data[14]['posts']['tg']:0) + (isset($regions_data[14]['posts']['web'])?$regions_data[14]['posts']['web']:0)?>],
            ['kz-am', <?php echo (isset($regions_data[45]['posts']['fb'])?$regions_data[16]['posts']['fb']:0) + (isset($regions_data[45]['posts']['ig'])?$regions_data[16]['posts']['ig']:0) + (isset($regions_data[45]['posts']['tg'])?$regions_data[16]['posts']['tg']:0) + (isset($regions_data[45]['posts']['web'])?$regions_data[16]['posts']['web']:0)?>],
            ['kz-zm', <?php echo (isset($regions_data[45]['posts']['fb'])?$regions_data[16]['posts']['fb']:0) + (isset($regions_data[45]['posts']['ig'])?$regions_data[16]['posts']['ig']:0) + (isset($regions_data[45]['posts']['tg'])?$regions_data[16]['posts']['tg']:0) + (isset($regions_data[45]['posts']['web'])?$regions_data[16]['posts']['web']:0)?>],
            ['kz-aa', <?php echo (isset($regions_data[45]['posts']['fb'])?$regions_data[16]['posts']['fb']:0) + (isset($regions_data[45]['posts']['ig'])?$regions_data[16]['posts']['ig']:0) + (isset($regions_data[45]['posts']['tg'])?$regions_data[16]['posts']['tg']:0) + (isset($regions_data[45]['posts']['web'])?$regions_data[16]['posts']['web']:0)?>],
            ['kz-ar', <?php echo (isset($regions_data[45]['posts']['fb'])?$regions_data[16]['posts']['fb']:0) + (isset($regions_data[45]['posts']['ig'])?$regions_data[16]['posts']['ig']:0) + (isset($regions_data[45]['posts']['tg'])?$regions_data[16]['posts']['tg']:0) + (isset($regions_data[45]['posts']['web'])?$regions_data[16]['posts']['web']:0)?>],
            ['kz-mg', <?php echo (isset($regions_data[45]['posts']['fb'])?$regions_data[16]['posts']['fb']:0) + (isset($regions_data[45]['posts']['ig'])?$regions_data[16]['posts']['ig']:0) + (isset($regions_data[45]['posts']['tg'])?$regions_data[16]['posts']['tg']:0) + (isset($regions_data[45]['posts']['web'])?$regions_data[16]['posts']['web']:0)?>],
            ['kz-ek', <?php echo (isset($regions_data[16]['posts']['fb'])?$regions_data[16]['posts']['fb']:0) + (isset($regions_data[16]['posts']['ig'])?$regions_data[16]['posts']['ig']:0) + (isset($regions_data[16]['posts']['tg'])?$regions_data[16]['posts']['tg']:0) + (isset($regions_data[16]['posts']['web'])?$regions_data[16]['posts']['web']:0)?>],
            ['kz-at', <?php echo (isset($regions_data[45]['posts']['fb'])?$regions_data[16]['posts']['fb']:0) + (isset($regions_data[45]['posts']['ig'])?$regions_data[16]['posts']['ig']:0) + (isset($regions_data[45]['posts']['tg'])?$regions_data[16]['posts']['tg']:0) + (isset($regions_data[45]['posts']['web'])?$regions_data[16]['posts']['web']:0)?>],
            ['kz-wk', <?php echo (isset($regions_data[45]['posts']['fb'])?$regions_data[16]['posts']['fb']:0) + (isset($regions_data[45]['posts']['ig'])?$regions_data[16]['posts']['ig']:0) + (isset($regions_data[45]['posts']['tg'])?$regions_data[16]['posts']['tg']:0) + (isset($regions_data[45]['posts']['web'])?$regions_data[16]['posts']['web']:0)?>],
            ['kz-sk', <?php echo (isset($regions_data[45]['posts']['fb'])?$regions_data[16]['posts']['fb']:0) + (isset($regions_data[45]['posts']['ig'])?$regions_data[16]['posts']['ig']:0) + (isset($regions_data[45]['posts']['tg'])?$regions_data[16]['posts']['tg']:0) + (isset($regions_data[45]['posts']['web'])?$regions_data[16]['posts']['web']:0)?>],
            ['kz-qg', <?php echo (isset($regions_data[45]['posts']['fb'])?$regions_data[16]['posts']['fb']:0) + (isset($regions_data[45]['posts']['ig'])?$regions_data[16]['posts']['ig']:0) + (isset($regions_data[45]['posts']['tg'])?$regions_data[16]['posts']['tg']:0) + (isset($regions_data[45]['posts']['web'])?$regions_data[16]['posts']['web']:0)?>]
        ];

        // Create the chart
        Highcharts.mapChart('container_map', {
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
                data: map_data,
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



        Highcharts.chart('container_dynamic', {

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
                name: 'Публикаций',
                yAxis: 1,
                data: [<?php
                    foreach($dates as $d){
                        foreach($date_posts as $date=>$value){
                            if($d == $date) echo $value . ", ";
                        }
                    }
                    
                ?>]
            }, {
                name: 'Лайки',
                data: [<?php foreach($dates as $d){
                        foreach($date_likes as $date=>$value){
                            if($d == $date) echo $value . ", ";
                        }
                    } ?>]
            }, {
                name: 'Комментарии',
                data: [<?php foreach($dates as $d){
                        foreach($date_comments as $date=>$value){
                            if($d == $date) echo $value . ", ";
                        }
                    } ?>]
            }, {
                name: 'Репосты',
                data: [<?php foreach($dates as $d){
                        foreach($date_reposts as $date=>$value){
                            if($d == $date) echo $value . ", ";
                        }
                    } ?>]
            }, {
                name: 'Подписчики',
                yAxis: 1,
                data: [<?php foreach($dates as $d){
                        foreach($date_subs as $date=>$value){
                            if($d == $date) echo $value . ", ";
                        }
                    } ?>]
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
</script>