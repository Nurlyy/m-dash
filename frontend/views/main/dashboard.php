    <div class="row">
        <div class="col-lg-2">
            <div class="ibox ">
                <div class="ibox-title">
                    <h5><i class="fa fa-newspaper-o"></i> Публикаций</h5>
                </div>
                <div class="ibox-content">
                    <h1 class="no-margins"><?php $sum=0;
                    if(isset($total_posts))
                    foreach($total_posts as $values){
                        $sum += (isset($values['fb'])?$values['fb']:0)+(isset($values['ig'])?$values['ig']:0)+(isset($values['tg'])?$values['tg']:0) + (isset($values['web'])?$values['web']:0);
                    } echo $sum; ?></h1>
                    <?= (end($date_posts) > prev($date_posts)?'<div class="stat-percent font-bold text-info">'.end($date_posts)-prev($date_posts).' <i class="fa fa-level-up"></i>':'<div class="stat-percent font-bold text-danger">'.end($date_posts)-prev($date_posts).'<i class="fa fa-level-down"></i>') ?></div>
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
                    if(isset($total_views))
                    foreach($total_views as $values){
                        $sum += (isset($values['web'])?$values['web']:0);
                    } echo $sum; ?></h1>
                    <?= (end($date_views) > prev($date_views)?'<div class="stat-percent font-bold text-info">'.end($date_views)-prev($date_views).' <i style="margin-left: 5px;" class="fa fa-level-up"></i>':'<div class="stat-percent font-bold text-danger">'.end($date_views)-prev($date_views).'<i style="margin-left: 5px;" class="fa fa-level-down"></i>') ?></div>
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
                    <?= (end($date_likes) > prev($date_likes)?'<div class="stat-percent font-bold text-info">'.end($date_likes)-prev($date_likes).' <i style="margin-left: 5px;" class="fa fa-level-up"></i>':'<div class="stat-percent font-bold text-danger">'.end($date_likes)-prev($date_likes).'<i style="margin-left: 5px;" class="fa fa-level-down"></i>') ?></div>
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
                    if(isset($total_reposts))
                    foreach($total_reposts as $values){
                        $sum += (isset($values['fb'])?$values['fb']:0)+(isset($values['ig'])?$values['ig']:0)+(isset($values['tg'])?$values['tg']:0);
                    } echo $sum; ?></h1>
                    <?= (end($date_reposts) > prev($date_reposts)?'<div class="stat-percent font-bold text-info">'.end($date_reposts)-prev($date_reposts).' <i style="margin-left: 5px;" class="fa fa-level-up"></i>':'<div class="stat-percent font-bold text-danger">'.end($date_reposts)-prev($date_reposts).'<i style="margin-left: 5px;" class="fa fa-level-down"></i>') ?></div>
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
                    if(isset($total_comments))
                    foreach($total_comments as $values){
                        $sum += (isset($values['fb'])?$values['fb']:0)+(isset($values['ig'])?$values['ig']:0);
                    } echo $sum; ?></h1>
                    <?= (end($date_comments) > prev($date_comments)?'<div class="stat-percent font-bold text-info">'.end($date_comments)-prev($date_comments).' <i style="margin-left: 5px;" class="fa fa-level-up"></i>':'<div class="stat-percent font-bold text-danger">'.end($date_comments)-prev($date_comments).'<i style="margin-left: 5px;" class="fa fa-level-down"></i>') ?></div>
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
                    if(isset($total_subs))
                    foreach($total_subs as $values){
                        $sum += (isset($values['fb'])?$values['fb']:0)+(isset($values['ig'])?$values['ig']:0)+(isset($values['tg'])?$values['tg']:0);
                    } echo $sum; ?></h1>
                    <?= (end($date_subs) > prev($date_subs)?'<div class="stat-percent font-bold text-info">'.end($date_subs)-prev($date_subs).' <i style="margin-left: 5px;" class="fa fa-level-up"></i>':'<div class="stat-percent font-bold text-danger">'.end($date_subs)-prev($date_subs).'<i style="margin-left: 5px;" class="fa fa-level-down"></i>') ?>
                    </div>
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


<script>
    
    function addState(sdate, edate) {
        let stateObj = {
            id: '456498'
        };

        $.ajax({
            url: '/main/dashboard?start_date=' + sdate + '&end_date=' + edate,
            type: 'GET',
            success: function(data) {
                $('.wrapper-content').html(data);
            }
        });

        window.history.pushState(stateObj,
            'Page 2', '/main/index?start_date=' + sdate + '&end_date=' + edate);

    }

    function openurl(type, start_date, end_date){
        $.ajax({
            url: '/main/'+type+'?start_date='+start_date.split(".")[2]+"-"+start_date.split(".")[1]+"-"+start_date.split(".")[0]+'&end_date='+end_date.split(".")[2]+"-"+end_date.split(".")[1]+"-"+end_date.split(".")[0],
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
        var map_data = [
            
            ['kz-qo', <?php echo (isset($regions_data[11]['posts']['fb'])?$regions_data[11]['posts']['fb']:0) + (isset($regions_data[11]['posts']['ig'])?$regions_data[11]['posts']['ig']:0) + (isset($regions_data[11]['posts']['tg'])?$regions_data[11]['posts']['tg']:0) + (isset($regions_data[11]['posts']['web'])?$regions_data[11]['posts']['web']:0)?>],
            ['kz-qs', <?php echo (isset($regions_data[10]['posts']['fb'])?$regions_data[10]['posts']['fb']:0) + (isset($regions_data[10]['posts']['ig'])?$regions_data[10]['posts']['ig']:0) + (isset($regions_data[10]['posts']['tg'])?$regions_data[10]['posts']['tg']:0) + (isset($regions_data[10]['posts']['web'])?$regions_data[10]['posts']['web']:0)?>],
            ['kz-nk', <?php echo (isset($regions_data[15]['posts']['fb'])?$regions_data[15]['posts']['fb']:0) + (isset($regions_data[15]['posts']['ig'])?$regions_data[15]['posts']['ig']:0) + (isset($regions_data[15]['posts']['tg'])?$regions_data[15]['posts']['tg']:0) + (isset($regions_data[15]['posts']['web'])?$regions_data[15]['posts']['web']:0)?>],
            ['kz-pa', <?php echo (isset($regions_data[14]['posts']['fb'])?$regions_data[14]['posts']['fb']:0) + (isset($regions_data[14]['posts']['ig'])?$regions_data[14]['posts']['ig']:0) + (isset($regions_data[14]['posts']['tg'])?$regions_data[14]['posts']['tg']:0) + (isset($regions_data[14]['posts']['web'])?$regions_data[14]['posts']['web']:0)?>],
            ['kz-am', <?php echo (isset($regions_data[3]['posts']['fb'])?$regions_data[3]['posts']['fb']:0) + (isset($regions_data[3]['posts']['ig'])?$regions_data[3]['posts']['ig']:0) + (isset($regions_data[3]['posts']['tg'])?$regions_data[3]['posts']['tg']:0) + (isset($regions_data[3]['posts']['web'])?$regions_data[3]['posts']['web']:0)?>],
            ['kz-zm', <?php echo (isset($regions_data[8]['posts']['fb'])?$regions_data[8]['posts']['fb']:0) + (isset($regions_data[8]['posts']['ig'])?$regions_data[8]['posts']['ig']:0) + (isset($regions_data[8]['posts']['tg'])?$regions_data[8]['posts']['tg']:0) + (isset($regions_data[8]['posts']['web'])?$regions_data[8]['posts']['web']:0)?>],
            ['kz-aa', <?php echo (isset($regions_data[5]['posts']['fb'])?$regions_data[5]['posts']['fb']:0) + (isset($regions_data[5]['posts']['ig'])?$regions_data[5]['posts']['ig']:0) + (isset($regions_data[5]['posts']['tg'])?$regions_data[5]['posts']['tg']:0) + (isset($regions_data[5]['posts']['web'])?$regions_data[5]['posts']['web']:0)?>],
            ['kz-ar', <?php echo (isset($regions_data[6]['posts']['fb'])?$regions_data[6]['posts']['fb']:0) + (isset($regions_data[6]['posts']['ig'])?$regions_data[6]['posts']['ig']:0) + (isset($regions_data[6]['posts']['tg'])?$regions_data[6]['posts']['tg']:0) + (isset($regions_data[6]['posts']['web'])?$regions_data[6]['posts']['web']:0)?>],
            ['kz-mg', <?php echo (isset($regions_data[12]['posts']['fb'])?$regions_data[12]['posts']['fb']:0) + (isset($regions_data[12]['posts']['ig'])?$regions_data[12]['posts']['ig']:0) + (isset($regions_data[12]['posts']['tg'])?$regions_data[12]['posts']['tg']:0) + (isset($regions_data[12]['posts']['web'])?$regions_data[12]['posts']['web']:0)?>],
            ['kz-ek', <?php echo (isset($regions_data[16]['posts']['fb'])?$regions_data[16]['posts']['fb']:0) + (isset($regions_data[16]['posts']['ig'])?$regions_data[16]['posts']['ig']:0) + (isset($regions_data[16]['posts']['tg'])?$regions_data[16]['posts']['tg']:0) + (isset($regions_data[16]['posts']['web'])?$regions_data[16]['posts']['web']:0)?>],
            ['kz-at', <?php echo (isset($regions_data[4]['posts']['fb'])?$regions_data[4]['posts']['fb']:0) + (isset($regions_data[4]['posts']['ig'])?$regions_data[4]['posts']['ig']:0) + (isset($regions_data[4]['posts']['tg'])?$regions_data[4]['posts']['tg']:0) + (isset($regions_data[4]['posts']['web'])?$regions_data[4]['posts']['web']:0)?>],
            ['kz-wk', <?php echo (isset($regions_data[7]['posts']['fb'])?$regions_data[7]['posts']['fb']:0) + (isset($regions_data[7]['posts']['ig'])?$regions_data[7]['posts']['ig']:0) + (isset($regions_data[7]['posts']['tg'])?$regions_data[7]['posts']['tg']:0) + (isset($regions_data[7]['posts']['web'])?$regions_data[7]['posts']['web']:0)?>],
            ['kz-sk', <?php echo (isset($regions_data[13]['posts']['fb'])?$regions_data[13]['posts']['fb']:0) + (isset($regions_data[13]['posts']['ig'])?$regions_data[13]['posts']['ig']:0) + (isset($regions_data[13]['posts']['tg'])?$regions_data[13]['posts']['tg']:0) + (isset($regions_data[13]['posts']['web'])?$regions_data[13]['posts']['web']:0)?>],
            ['kz-qg', <?php echo (isset($regions_data[9]['posts']['fb'])?$regions_data[9]['posts']['fb']:0) + (isset($regions_data[9]['posts']['ig'])?$regions_data[9]['posts']['ig']:0) + (isset($regions_data[9]['posts']['tg'])?$regions_data[9]['posts']['tg']:0) + (isset($regions_data[9]['posts']['web'])?$regions_data[9]['posts']['web']:0)?>]
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