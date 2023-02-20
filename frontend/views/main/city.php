<?php

// var_dump($totalResourcesDonut);exit;

$_monthsList = array(
    "01" => Yii::t('frontend','of january'), "02" => Yii::t('frontend','of february'),
    "03" => Yii::t('frontend','of march'), "04" => Yii::t('frontend','of april'), "05" => Yii::t('frontend','of may'), 
    "06" => Yii::t('frontend','of june'), "07" => Yii::t('frontend','of july'), "08" => Yii::t('frontend','of august'), 
    "09" => Yii::t('frontend','of september'), "10" => Yii::t('frontend','of october'), "11" => Yii::t('frontend','of november'), 
    "12" => Yii::t('frontend','of december')
);

?>

<div class="row">

    <div class="col-12 m-b-sm ">
        <div class="panel panel-default widget-head-color-box navy-bg text-center">
            <div class="panel-body">
                <div>
                    <h1 style="margin-top:0px;padding-top:0px; margin-bottom:0px; padding-bottom:0px;"><strong><?php echo $cityInformation['name'] ?></strong></h1>
                    <p style="margin-bottom:0px; margin-top:5px; padding-bottom:0px; padding-top:0px;"><?= Yii::t('frontend', 'Sources in social networks') ?>: <?= isset($r_count[$cityInformation['id']]) ? $r_count[$cityInformation['id']] : 0 ?></p>
                    <!-- <div class="row col-lg-2 col-sm-12 justify-content-center">
                        <img style="width:10.5em; height:10.5em;" src="<?php #echo $cityInformation['photo'] 
                                                                        ?>" class="float-left rounded-circle circle-border m-b-md" alt="profile">
                    </div>
                    <div class="row col-lg-10 col-sm-12"> -->
                    <!-- <div class="col-12 m-b-md m-l-md">
                            <h2 class="font-bold no-margins">
                                <?php #echo $cityInformation['name'] 
                                ?>
                            </h2>
                        </div>
                        <div class="row m-l-sm col-12">
                            <div class='col-lg-6 col-sm-12'>
                                <p>Ресурсов: "<php #echo=#$cityInformation['partia'] ?>"</p>
                                <p>Дата рождения: <?php #echo $cityInformation['birthday'] 
                                                    ?></p>
                                <p>Стаж в госслужбе: <?php #echo $cityInformation['experience'] 
                                                        ?> лет</p>
                            </div>
                            <div class='col-lg-6 col-sm-12'>
                                <p>Facebook аккаунт: <?php #echo $cityInformation['fb_account'] 
                                                        ?></p>
                                <p>Instagram аккаунт: <?php #echo $cityInformation['ig_account'] 
                                                        ?></p>
                                <p>Web-Site: <?php #echo $cityInformation['web_site'] 
                                                ?></p>
                            </div>
                        </div> -->

                </div>

            </div>
        </div>
    </div>


    <div class="col-12">
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="row">
                    <div class="col-12">
                        <div class="tabs-container">
                            <ul class="nav nav-tabs" role="tablist">
                                <li><a class="nav-link active" data-toggle="tab" href="#tab-discussion"><i class='fa fa-area-chart'></i><?= Yii::t('frontend', 'Discussion') ?></a></li>
                                <li><a class="nav-link" data-toggle="tab" href="#tab-subs"><i class='fa fa-user'></i><?= Yii::t('frontend', 'Subscribers') ?></a></li>
                                <li><a class="nav-link" data-toggle="tab" href="#tab-likes"><i class='fa fa-heart'></i><?= Yii::t('frontend', 'Likes') ?></a></li>
                                <li><a class="nav-link" data-toggle="tab" href="#tab-comments"><i class='fa fa-comment'></i><?= Yii::t('frontend', 'Comments') ?></a></li>
                                <li><a class="nav-link" data-toggle="tab" href="#tab-reposts"><i class='fa fa-reply'></i><?= Yii::t('frontend', 'Reposts') ?></a></li>
                            </ul>
                            <div class="tab-content">
                                <div role="tabpanel" id="tab-discussion" class="tab-pane active">
                                    <div class="panel-body">

                                        <div class="row">

                                            <div class="col-lg-8 col-md-12">
                                                <div class="panel panel-default">
                                                    <div class="panel-body">
                                                        <figure class="highcharts-figure">
                                                            <div id="total_chart"></div>
                                                        </figure>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-lg-4 col-sm-12">
                                                <div class="panel panel-default">
                                                    <div class="panel-body">
                                                        <div class="row">

                                                            <div class="col-lg-12 col-md-12">
                                                                <figure class="highcharts-figure">
                                                                    <div id="total_donut"></div>
                                                                </figure>
                                                            </div>

                                                        </div>

                                                    </div>
                                                </div>
                                            </div>

                                        </div>

                                        <div class="row">

                                            <div class="col-lg-8 col-md-12">
                                                <div class="panel panel-default">
                                                    <div class="panel-body">
                                                        <figure class="highcharts-figure">
                                                            <div id="sentiment_chart"></div>
                                                        </figure>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-lg-4 col-sm-12">
                                                <div class="panel panel-default">
                                                    <div class="panel-body">
                                                        <div class="row">

                                                            <div class="col-lg-12 col-md-12">
                                                                <figure class="highcharts-figure">
                                                                    <div id="sentiment_donut"></div>
                                                                </figure>
                                                            </div>

                                                        </div>

                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <div role="tabpanel" id="tab-subs" class="tab-pane">
                                    <div class="panel-body">
                                        <div class="row">

                                            <div class="col-lg-8 col-md-12">
                                                <div class="panel panel-default">
                                                    <div class="panel-body">
                                                        <figure class="highcharts-figure">
                                                            <div id="subs_chart"></div>
                                                        </figure>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-lg-4 col-sm-12">
                                                <div class="panel panel-default">
                                                    <div class="panel-body">
                                                        <div class="row">

                                                            <div class="col-lg-12 col-md-12">
                                                                <figure class="highcharts-figure">
                                                                    <div id="subs_donut"></div>
                                                                </figure>
                                                            </div>

                                                        </div>

                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <div role="tabpanel" id="tab-likes" class="tab-pane">
                                    <div class="panel-body">
                                        <div class="row">

                                            <div class="col-lg-8 col-md-12">
                                                <div class="panel panel-default">
                                                    <div class="panel-body">
                                                        <figure class="highcharts-figure">
                                                            <div id="likes_chart"></div>
                                                        </figure>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-lg-4 col-sm-12">
                                                <div class="panel panel-default">
                                                    <div class="panel-body">
                                                        <div class="row">

                                                            <div class="col-lg-12 col-md-12">
                                                                <figure class="highcharts-figure">
                                                                    <div id="likes_donut"></div>
                                                                </figure>
                                                            </div>

                                                        </div>

                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <div role="tabpanel" id="tab-comments" class="tab-pane">
                                    <div class="panel-body">
                                        <div class="row">
                                            <div class="col-lg-8 col-md-12">
                                                <div class="panel panel-default">
                                                    <div class="panel-body">
                                                        <figure class="highcharts-figure">
                                                            <div id="comments_chart"></div>
                                                        </figure>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-lg-4 col-sm-12">
                                                <div class="panel panel-default">
                                                    <div class="panel-body">
                                                        <div class="row">

                                                            <div class="col-lg-12 col-md-12">
                                                                <figure class="highcharts-figure">
                                                                    <div id="comments_donut"></div>
                                                                </figure>
                                                            </div>

                                                        </div>

                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <div role="tabpanel" id="tab-reposts" class="tab-pane">
                                    <div class="panel-body">
                                        <div class="row">

                                            <div class="col-lg-8 col-md-12">
                                                <div class="panel panel-default">
                                                    <div class="panel-body">
                                                        <figure class="highcharts-figure">
                                                            <div id="reposts_chart"></div>
                                                        </figure>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-lg-4 col-sm-12">
                                                <div class="panel panel-default">
                                                    <div class="panel-body">
                                                        <div class="row">

                                                            <div class="col-lg-12 col-md-12">
                                                                <figure class="highcharts-figure">
                                                                    <div id="reposts_donut"></div>
                                                                </figure>
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
                    </div>

                </div>
            </div>

        </div>
    </div>

    <div class="col-12">
        <div class="panel panel-default">
            <div class="panel-body">
                <h2 class='text-center m-md'><strong><?= Yii::t('frontend', 'Posts feed') ?></strong></h2>
                <div class="row">
                    <div class='col-12' style=' display:flex; flex-wrap:nowrap; overflow-x:auto; gap:10px; '>
                        <?php
                        $types = [];
                        $posts = [];
                        if (isset($city_posts[$cityInformation['id']]))
                            foreach ($city_posts[$cityInformation['id']] as $resources) {
                                foreach ($resources as $post) {
                                    array_push($posts, $post);
                                    array_push($types, $post['type']);
                                }
                            }
                        $types = array_unique($types);
                        foreach ($types as $type) { ?>
                            <div class="col-lg-4 col-sm-10 col-md-8 col-12 row">
                                <div class="panel panel-default col-12">
                                    <div class="panel-header">
                                        <h4 class='text-center m-t-sm'><i class='fa fa-<?php switch ($type) {
                                                                                            case 0:
                                                                                                echo "globe'></i> СМИ";
                                                                                                break;
                                                                                            case 1:
                                                                                                echo "vk'></i>".Yii::t('frontend', 'Vkontakte');
                                                                                                break;
                                                                                            case 2:
                                                                                                echo "facebook'></i> Facebook";
                                                                                                break;
                                                                                            case 3:
                                                                                                echo "twitter'></i> Twitter";
                                                                                                break;
                                                                                            case 4:
                                                                                                echo "instagram'></i> Instagram";
                                                                                                break;
                                                                                            case 5:
                                                                                                echo "google-plus'></i> Google+";
                                                                                                break;
                                                                                            case 6:
                                                                                                echo "youtube'></i> Youtube";
                                                                                                break;
                                                                                            case 7:
                                                                                                echo "odnoklassniki'></i>".Yii::t('frontend', 'Odnoklassniki');
                                                                                                break;
                                                                                            case 8:
                                                                                                echo "envelope'></i>".Yii::t('frontend', 'Moi Mir');
                                                                                                break;
                                                                                            case 9:
                                                                                                echo "telegram'></i> Telegram";
                                                                                                break;
                                                                                            case 10:
                                                                                                echo "tiktok'></i> TikTok";
                                                                                                break;
                                                                                        }
                                                                                        ?></h4>
                                    </div>
                                    <div class="panel-body" style=' overflow-y: auto; overflow-x: hidden; height:600px; background-color: rgb(232, 232, 232);'>
                                                <?php

                                                usort($posts, function ($element1, $element2) {
                                                    $datetime1 = strtotime($element1['date']);
                                                    $datetime2 = strtotime($element2['date']);
                                                    return $datetime1 - $datetime2;
                                                });
                                                foreach ($posts as $post) {
                                                    if ($post['type'] == $type) { ?>

                                                        <div class="post-container">
                                                            <div class="post-header">
                                                                <div style="display:flex; flex-direction:row;">
                                                                    <div class="col-2 post-img-div">
                                                                        <img class="post-img" src="<?= $post['photo'] ?>" width="40px" height="40px" />
                                                                    </div>
                                                                    <h4 class="col-10"><?php echo $post['name'] ?></h4>
                                                                </div>
                                                                <p style="color:grey;"><?= date("d", strtotime($post['date'])) . " " . $_monthsList[date("m", strtotime($post['date']))] . " " . date("Y", strtotime($post['date'])) ?> | <a href="<?= $post['url'] ?>">
                                                                        <?php
                                                                        switch ($post['type']) {
                                                                            case 0:
                                                                                echo "СМИ";
                                                                                break;
                                                                            case 1:
                                                                                echo Yii::t('frontend', 'Vkontakte');
                                                                                break;
                                                                            case 2:
                                                                                echo "Facebook";
                                                                                break;
                                                                            case 3:
                                                                                echo "Twitter";
                                                                                break;
                                                                            case 4:
                                                                                echo "Instagram";
                                                                                break;
                                                                            case 5:
                                                                                echo "Google+";
                                                                                break;
                                                                            case 6:
                                                                                echo "Youtube";
                                                                                break;
                                                                            case 7:
                                                                                echo Yii::t('frontend', 'Odnoklassniki');
                                                                                break;
                                                                            case 8:
                                                                                echo Yii::t('frontend', 'Moi Mir');
                                                                                break;
                                                                            case 9:
                                                                                echo "Telegram";
                                                                                break;
                                                                            case 10:
                                                                                echo "TikTok";
                                                                                break;
                                                                        }
                                                                        ?></a></p>
                                                                <?php

                                                                ?>
                                                            </div>
                                                            <div class="post-body">
                                                                <p><?= str_split($post['text'], 100)[0] ?>...</p>
                                                                <div class="post-sentiment<?php echo $post['sentiment']
                                                                                            ?>">
                                                                    <?php echo (($post['sentiment'] == 1) ? Yii::t('frontend', 'Positive') : (($post['sentiment'] == 0) ? Yii::t('frontend', 'Neutral') : (($post['sentiment'] == -1) ? Yii::t('frontend', 'Negative') : null))) ?>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <!-- <div class="ibox">
                                                        <div class="ibox-content product-box">

                                                            <div class="product-imitation">
                                                                <img src="<?php #echo ltrim($post['photo_url'], "@web") 
                                                                            ?>">
                                                            </div>
                                                            <div class="product-desc">
                                                                <small class="text-muted"><?php #echo $post['date'] 
                                                                                            ?></small>
                                                                <a href="#" class="product-name"><?php #echo strtok($post['text'], " ") 
                                                                                                    ?></a>

                                                                <div class="small m-t-xs">
                                                                    <?php #echo str_split($post['text'], 80)[0] 
                                                                    ?>
                                                                </div>
                                                                <div class="m-t text-righ">

                                                                    <a href="#" class="btn btn-xs btn-outline btn-primary">Перейти
                                                                        <i class="fa fa-long-arrow-right"></i> </a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div> -->
                                                <?php }
                                                }
                                                ?>

                                    </div>
                                </div>
                            </div>
                        <?php }
                        ?>




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
            url: '/main/candidate?start_date=' + sdate + '&end_date=' + edate + '&city_id=<?= $cityInformation['id'] ?>',
            type: 'GET',
            success: function(data) {
                $('.wrapper-content').html(data);
            }
        });

        window.history.pushState(stateObj,
            'Page 2', '/main/index#candidate?start_date=' + sdate + '&end_date=' + edate + '&city_id=<?= $cityInformation['id'] ?>');

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
        const daterangepicker_setting = {
            format: 'DD.MM.YYYY',
            startDate: start_date,
            endDate: end_date,
            minDate: '01.01.2022',
            maxDate: '<?= date("d.m.Y", strtotime('today')) ?>',
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
                applyLabel: '<?= Yii::t('frontend', 'Ok') ?>',
                cancelLabel: '<?= Yii::t('frontend', 'Cancel') ?>',
                fromLabel: '<?= Yii::t('frontend', 'from') ?>',
                toLabel: '<?= Yii::t('frontend', 'to') ?>',
                customRangeLabel: '<?= Yii::t('frontend', 'Period') ?>',
                daysOfWeek: [
                    '<?= Yii::t('frontend', 'Su') ?>',
                    '<?= Yii::t('frontend', 'Mo') ?>',
                    '<?= Yii::t('frontend', 'Tu') ?>',
                    '<?= Yii::t('frontend', 'We') ?>',
                    '<?= Yii::t('frontend', 'Th') ?>',
                    '<?= Yii::t('frontend', 'Fr') ?>',
                    '<?= Yii::t('frontend', 'Sa') ?>'
                ],
                monthNames: [
                    '<?= Yii::t('frontend', 'January') ?>',
                    '<?= Yii::t('frontend', 'February') ?>',
                    '<?= Yii::t('frontend', 'March') ?>',
                    '<?= Yii::t('frontend', 'April') ?>',
                    '<?= Yii::t('frontend', 'May') ?>',
                    '<?= Yii::t('frontend', 'June') ?>',
                    '<?= Yii::t('frontend', 'July') ?>',
                    '<?= Yii::t('frontend', 'August') ?>',
                    '<?= Yii::t('frontend', 'September') ?>',
                    '<?= Yii::t('frontend', 'October') ?>',
                    '<?= Yii::t('frontend', 'November') ?>',
                    '<?= Yii::t('frontend', 'December') ?>'
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
    });

    function createChart(container, name, subtitle, subsubtitle, data) {

        dates = [<?= "'" . implode("', '", $dates) . "'" ?>];
        datas = [];
        keys = [];
        temp = [];
        datas_name = '';
        for (let value of Object.keys(data)) {
            keys.push(value);
        };

        for (let i = 0; i < keys.length; i++) {
            temp = [];
            for (let j = 0; j < dates.length; j++) {
                temp.push((data[keys[i]][dates[j]]) ? data[keys[i]][dates[j]] : 0);
            }
            if (keys[i] == 'fb') {
                datas_name = 'Facebook'
            } else if (keys[i] == 'ig') {
                datas_name = 'Instagram'
            } else if (keys[i] == 'tg') {
                datas_name = 'Telegram'
            } else if (keys[i] == 'tt') {
                datas_name = 'TikTok'
            } else if (keys[i] == 'vk') {
                datas_name = '<?= Yii::t('frontend', 'Vkontakte'); ?>'
            } else if (keys[i] == 'ok') {
                datas_name = '<?= Yii::t('frontend', 'Odnoklassniki'); ?>'
            } else if (keys[i] == 'yt') {
                datas_name = 'YouTube'
            } else if (keys[i] == 'mm') {
                datas_name = '<?= Yii::t('frontend', 'Moi Mir'); ?>'
            } else if (keys[i] == 'tw') {
                datas_name = 'Twitter'
            } else if (keys[i] == 'gg') {
                datas_name = 'Google+'
            } else if (keys[i] == 'positive') {
                datas_name = '<?= Yii::t('frontend', 'Positive}'); ?>'
            } else if (keys[i] == 'neutral') {
                datas_name = '<?= Yii::t('frontend', 'Neutral'); ?>'
            } else if (keys[i] == 'negative') {
                datas_name = '<?= Yii::t('frontend', 'Negative'); ?>'
            }
            datas[i] = {
                name: datas_name,
                data: temp
            }
        }

        Highcharts.chart(container, {
            colors: ["#9c98ce", "#51223a", "#7c2a1b", "#8cdd75", "#87510e", "#7bd3f6", "#7c260b", "#ee8f71", "#76c0c1", "#a18376"],
            chart: {
                type: 'spline',
                scrollablePlotArea: {
                    minWidth: 600,
                    scrollPositionX: 1
                },
                plotBackgroundColor: '#d5e4eb',
                fontFamily: "Droid Sans",
            },
            title: {
                text: name,
                align: 'center'
            },
            xAxis: {
                labels: {
                    overflow: 'justify'
                },
                categories: [
                    <?= "'" . implode("', '", $dates) . "'" ?>
                ],
            },
            yAxis: {
                gridLineColor: "#FFFFFF",
                lineColor: "#FFFFFF",
                minorGridLineColor: "#FFFFFF",
                tickColor: "#D7D7D8",
                tickWidth: 1,
                title: {
                    text: subtitle,
                    style: {
                        color: "#A0A0A3"
                    }
                },
                minorGridLineWidth: 0,
                alternateGridColor: null,
            },
            tooltip: {
                valueSuffix: ' ' + subsubtitle,
                backgroundColor: "#FFFFFF",
                borderColor: "#76c0c1",
                style: {
                    color: "#000000"
                }
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

            series: datas,
            "legend": {
                "itemStyle": {
                    "color": "#3C3C3C"
                },
                "itemHiddenStyle": {
                    "color": "#606063"
                }
            },
            credits: {
                style: {
                    color: "#666"
                }
            },
            labels: {
                style: {
                    color: "#D7D7D8"
                }
            },
            drilldown: {
                activeAxisLabelStyle: {
                    color: "#F0F0F3"
                },
                activeDataLabelStyle: {
                    color: "#F0F0F3"
                }
            },
            navigation: {
                buttonOptions: {
                    symbolStroke: "#505053",
                }
            },
            legendBackgroundColor: "rgba(0, 0, 0, 0.5)",
            background2: "#505053",
            dataLabelsColor: "#B0B0B3",
            textColor: "#C0C0C0",
            contrastTextColor: "#F0F0F3",
            maskColor: "rgba(255,255,255,0.3)"
        });

    }


    function createDonut(container, name, subtitle, data) {
        keys = [];
        for (let value of Object.keys(data)) {
            keys.push(value);
        };

        datas = [];
        for (let i = 0; i < keys.length; i++) {
            if (keys[i] == 'fb') {
                datas[i] = ["Facebook", data[keys[i]]];
            } else if (keys[i] == 'ig') {
                datas[i] = ["Instagram", data[keys[i]]];
            } else if (keys[i] == 'tg') {
                datas[i] = ["Telegram", data[keys[i]]];
            } else if (keys[i] == 'positive') {
                datas[i] = ['<?= Yii::t('frontend', 'Positive}'); ?>', data[keys[i]]];
            } else if (keys[i] == 'neutral') {
                datas[i] = ['<?= Yii::t('frontend', 'Neutral'); ?>', data[keys[i]]];
            } else if (keys[i] == 'negative') {
                datas[i] = ['<?= Yii::t('frontend', 'Negative'); ?>', data[keys[i]]];
            } else if (keys[i] == 'tt') {
                datas[i] = ['TikTok', data[keys[i]]];
            } else if (keys[i] == 'vk') {
                datas[i] = ['<?= Yii::t('frontend', 'Vkontakte'); ?>', data[keys[i]]];
            } else if (keys[i] == 'ok') {
                datas[i] = ['<?= Yii::t('frontend', 'Odnoklassniki'); ?>', data[keys[i]]];
            } else if (keys[i] == 'yt') {
                datas[i] = ['YouTube', data[keys[i]]];
            } else if (keys[i] == 'mm') {
                datas[i] = ['<?= Yii::t('frontend', 'Moi Mir'); ?>', data[keys[i]]];
            } else if (keys[i] == 'tw') {
                datas[i] = ['Twitter', data[keys[i]]];
            } else if (keys[i] == 'gg') {
                datas[i] = ['Google+', data[keys[i]]];
            }
        }

        Highcharts.chart(container, {
            chart: {
                type: 'pie',
                options3d: {
                    enabled: true,
                    alpha: 25
                }
            },
            title: {
                text: name
            },
            plotOptions: {
                pie: {
                    innerSize: 30,
                    depth: 45
                }
            },
            series: [{
                name: subtitle,
                data: datas,
            }]
        });
    };

    createChart('total_chart', '<?= Yii::t('frontend', 'Publications of sources') ?>', '<?= Yii::t('frontend', 'Count of posts') ?>', '<?= Yii::t('frontend', 'posts') ?>', {
        // Формирование объекта с ключ/значениями для js из массива php
        <?php if (isset($date_posts[$cityInformation['id']])) {
            foreach ($date_posts[$cityInformation['id']] as $key => $value) {
                echo $key . ":{";
                foreach ($value as $k => $v) {
                    echo "'" . $k . "':" . $v . ", ";
                }
                echo "}, ";
            }
        } else {
            echo "";
        } ?>
    });

    createChart('sentiment_chart', '<?= Yii::t('frontend', 'Sentiment of posts') ?>', '<?= Yii::t('frontend', 'Count of posts') ?>', '<?= Yii::t('frontend', 'posts') ?>', {
        <?php if (isset($postsSentimentChart[$cityInformation['id']])) foreach ($postsSentimentChart[$cityInformation['id']] as $key => $value) {
            echo $key . ":{";
            foreach ($value as $k => $v) {
                echo "'" . $k . "':" . $v . ", ";
            }
            echo "}, ";
        } ?>
    });

    createChart('subs_chart', '<?= Yii::t('frontend', 'Subscribers Chart') ?>', '<?= Yii::t('frontend', 'Number of followers') ?>', '<?= Yii::t('frontend', 'subscribers') ?>', {
        <?php if (isset($totalSubsChart[$cityInformation['id']])) foreach ($totalSubsChart[$cityInformation['id']] as $key => $value) {
            echo $key . ":{";
            foreach ($value as $k => $v) {
                echo "'" . $k . "':" . $v . ", ";
            }
            echo "}, ";
        } ?>
    });

    createChart('likes_chart', '<?= Yii::t('frontend', 'Likes Chart') ?>', '<?= Yii::t('frontend', 'Number of likes') ?>', '<?= Yii::t('frontend', 'likes') ?>', {
        <?php if (isset($totalLikesChart[$cityInformation['id']])) foreach ($totalLikesChart[$cityInformation['id']] as $key => $value) {
            echo $key . ":{";
            foreach ($value as $k => $v) {
                echo "'" . $k . "':" . $v . ", ";
            }
            echo "}, ";
        } ?>
    });

    createChart('comments_chart', '<?= Yii::t('frontend', 'Comments Chart') ?>', '<?= Yii::t('frontend', 'Number of comments') ?>', '<?= Yii::t('frontend', 'comments') ?>', {
        <?php if (isset($totalCommentsChart[$cityInformation['id']])) foreach ($totalCommentsChart[$cityInformation['id']] as $key => $value) {
            echo $key . ":{";
            foreach ($value as $k => $v) {
                echo "'" . $k . "':" . $v . ", ";
            }
            echo "}, ";
        } ?>
    });

    createChart('reposts_chart', '<?= Yii::t('frontend', 'Reposts Chart') ?>', '<?= Yii::t('frontend', 'Number of reposts') ?>', '<?= Yii::t('frontend', 'reposts') ?>', {
        <?php if (isset($totalRepostsChart[$cityInformation['id']])) foreach ($totalRepostsChart[$cityInformation['id']] as $key => $value) {
            echo $key . ":{";
            foreach ($value as $k => $v) {
                echo "'" . $k . "':" . $v . ", ";
            }
            echo "}, ";
        } ?>
    });

    createDonut('comments_donut', '<?= Yii::t('frontend', 'Total Comments') ?>', '<?= Yii::t('frontend', 'Comments') ?>', {
        <?php if (isset($totalCommentsDonut[$cityInformation['id']])) foreach ($totalCommentsDonut[$cityInformation['id']] as $key => $value) {
            if ($value > 0) echo $key . ':' . $value . ', ';
        } ?>
    });

    createDonut('likes_donut', '<?= Yii::t('frontend', 'Total likes') ?>', '<?= Yii::t('frontend', 'Likes') ?>', {
        <?php if (isset($totalLikesDonut[$cityInformation['id']])) foreach ($totalLikesDonut[$cityInformation['id']] as $key => $value) {
            if ($value > 0) echo $key . ':' . $value . ', ';
        } ?>
    });


    createDonut('subs_donut', '<?= Yii::t('frontend', 'Total Subscribers') ?>', '<?= Yii::t('frontend', 'Subscribers') ?>', {
        <?php if (isset($totalSubsDonut[$cityInformation['id']])) foreach ($totalSubsDonut[$cityInformation['id']] as $key => $value) {
            if ($value > 0) echo $key . ':' . $value . ', ';
        } ?>
    });


    createDonut('sentiment_donut', '<?= Yii::t('frontend', 'Total sentiment') ?>', '<?= Yii::t('frontend', 'Posts') ?>', {
        <?php if (isset($postsSentimentLine[$cityInformation['id']])) foreach ($postsSentimentLine[$cityInformation['id']] as $key => $value) {
            if ($value > 0) echo $key . ':' . $value . ', ';
        } ?>
    });


    createDonut('total_donut', '<?= Yii::t('frontend', 'Total posts') ?>', '<?= Yii::t('frontend', 'Posts') ?>', {
        <?php if (isset($totalResourcesDonut[$cityInformation['id']])) foreach ($totalResourcesDonut[$cityInformation['id']] as $key => $value) {
            if ($value > 0) echo $key . ':' . $value . ', ';
        } ?>
    });


    createDonut('reposts_donut', '<?= Yii::t('frontend', 'Total reposts') ?>', '<?= Yii::t('frontend', 'Reposts') ?>', {
        <?php if (isset($totalRepostsDonut[$cityInformation['id']])) foreach ($totalRepostsDonut[$cityInformation['id']] as $key => $value) {
            if ($value > 0) echo $key . ':' . $value . ', ';
        } ?>
    });
</script>