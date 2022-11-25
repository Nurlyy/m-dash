<div class="row">

    <div class="col-12 m-b-md ">
        <div class="panel panel-default widget-head-color-box navy-bg p-lg text-left">
            <div class="panel-body">
                <div class="row justify-content-center">
                    <div class="row col-lg-2 col-sm-12 justify-content-center">
                        <img style="width:10.5em; height:10.5em;" src="<?= $candidateInformation['photo'] ?>" class="float-left rounded-circle circle-border m-b-md" alt="profile">
                    </div>
                    <div class="row col-lg-10 col-sm-12">
                        <div class="col-12 m-b-md m-l-md">
                            <h2 class="font-bold no-margins">
                                <?= $candidateInformation['name'] ?>
                            </h2>
                        </div>
                        <div class="row m-l-sm col-12">
                            <div class='col-lg-6 col-sm-12'>
                                <p>Представляет: "<?= $candidateInformation['partia'] ?>"</p>
                                <p>Дата рождения: <?= $candidateInformation['birthday'] ?></p>
                                <p>Стаж в госслужбе: <?= $candidateInformation['experience'] ?> лет</p>
                            </div>
                            <div class='col-lg-6 col-sm-12'>
                                <p>Facebook аккаунт: <?= $candidateInformation['fb_account'] ?></p>
                                <p>Instagram аккаунт: <?= $candidateInformation['ig_account'] ?></p>
                                <p>Web-Site: <?= $candidateInformation['web_site'] ?></p>
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
                <div class="row">
                    <div class="col-12">
                        <div class="tabs-container">
                            <ul class="nav nav-tabs" role="tablist">
                                <li><a class="nav-link active" data-toggle="tab" href="#tab-discussion"><i class='fa fa-area-chart'></i>Обсуждение</a></li>
                                <li><a class="nav-link" data-toggle="tab" href="#tab-subs"><i class='fa fa-user'></i>Подписчики</a></li>
                                <li><a class="nav-link" data-toggle="tab" href="#tab-likes"><i class='fa fa-heart'></i>Лайки</a></li>
                                <li><a class="nav-link" data-toggle="tab" href="#tab-comments"><i class='fa fa-comment'></i>Комментарии</a></li>
                                <li><a class="nav-link" data-toggle="tab" href="#tab-reposts"><i class='fa fa-reply'></i>Репосты</a></li>
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
                <h2 class='text-center m-md'><strong>Посты Кандидата</strong></h2>
                <div class="row">
                    <div class='col-12' style=' display:flex; flex-wrap:nowrap; overflow-x:auto; gap:10px; '>
                        <div class="col-lg-4 col-sm-10 col-md-8 col-12 row">
                            <div class="panel panel-default col-12">
                                <div class="panel-header">
                                    <h4 class='text-center m-t-sm'><i class='fa fa-facebook'></i>
                                        Facebook</h4>

                                </div>
                                <div class="panel-body" style='overflow-y: auto; height:600px;'>
                                    <?php foreach ($candidate_posts as $post) {
                                        if ($post['type'] == 1) { ?>
                                            <div class="ibox">
                                                <div class="ibox-content product-box">

                                                    <div class="product-imitation">
                                                        <img src="<?= ltrim($post['photo_url'], "@web") ?>">
                                                    </div>
                                                    <div class="product-desc">
                                                        <small class="text-muted"><?= $post['date'] ?></small>
                                                        <a href="#" class="product-name"><?= str_split($post['text'], 15)[0] ?></a>

                                                        <div class="small m-t-xs">
                                                            <?= str_split($post['text'], 80)[0] ?>
                                                        </div>
                                                        <div class="m-t text-righ">

                                                            <a href="#" class="btn btn-xs btn-outline btn-primary">Перейти
                                                                <i class="fa fa-long-arrow-right"></i> </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                    <?php }
                                    } ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-sm-10 col-md-8 col-12 row">
                            <div class="panel panel-default col-12">
                                <div class="panel-header">
                                    <h4 class='text-center m-t-sm'><i class='fa fa-instagram'></i>
                                        Instagram</h4>

                                </div>
                                <div class="panel-body" style='overflow-y: auto; height:600px;'>
                                    <?php foreach ($candidate_posts as $post) {
                                        if ($post['type'] == 2) { ?>
                                            <div class="ibox">
                                                <div class="ibox-content product-box">

                                                    <div class="product-imitation">
                                                        <img src="<?= ltrim($post['photo_url'], "@web") ?>">
                                                    </div>
                                                    <div class="product-desc">
                                                        <small class="text-muted"><?= $post['date'] ?></small>
                                                        <a href="#" class="product-name"><?= str_split($post['text'], 15)[0] ?></a>

                                                        <div class="small m-t-xs">
                                                            <?= str_split($post['text'], 80)[0] ?>
                                                        </div>
                                                        <div class="m-t text-righ">

                                                            <a href="#" class="btn btn-xs btn-outline btn-primary">Перейти
                                                                <i class="fa fa-long-arrow-right"></i> </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                    <?php }
                                    } ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-sm-10 col-md-8 col-12 row">
                            <div class="panel panel-default col-12">
                                <div class="panel-header">
                                    <h4 class='text-center m-t-sm'><i class='fa fa-telegram'></i>
                                        Telegram</h4>

                                </div>
                                <div class="panel-body" style='overflow-y: auto; height:600px;'>
                                    <?php foreach ($candidate_posts as $post) {
                                        if ($post['type'] == 3) { ?>
                                            <div class="ibox">
                                                <div class="ibox-content product-box">

                                                    <div class="product-imitation">
                                                        <img src="<?= ltrim($post['photo_url'], "@web") ?>">
                                                    </div>
                                                    <div class="product-desc">
                                                        <small class="text-muted"><?= $post['date'] ?></small>
                                                        <a href="#" class="product-name"><?= str_split($post['text'], 15)[0] ?></a>

                                                        <div class="small m-t-xs">
                                                            <?= str_split($post['text'], 80)[0] ?>
                                                        </div>
                                                        <div class="m-t text-righ">

                                                            <a href="#" class="btn btn-xs btn-outline btn-primary">Перейти
                                                                <i class="fa fa-long-arrow-right"></i> </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                    <?php }
                                    } ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-sm-10 col-md-8 col-12 row">
                            <div class="panel panel-default col-12">
                                <div class="panel-header">
                                    <h4 class='text-center m-t-sm'><i class='fa fa-globe'></i>
                                        Web-sites</h4>

                                </div>
                                <div class="panel-body" style='overflow-y: auto; height:600px;'>
                                    <?php foreach ($candidate_posts as $post) {
                                        if ($post['type'] == 4) { ?>
                                            <div class="ibox">
                                                <div class="ibox-content product-box">

                                                    <div class="product-imitation">
                                                        <img src="<?= ltrim($post['photo_url'], "@web") ?>">
                                                    </div>
                                                    <div class="product-desc">
                                                        <small class="text-muted"><?= $post['date'] ?></small>
                                                        <a href="#" class="product-name"><?= str_split($post['text'], 15)[0] ?></a>

                                                        <div class="small m-t-xs">
                                                            <?= str_split($post['text'], 80)[0] ?>
                                                        </div>
                                                        <div class="m-t text-righ">

                                                            <a href="#" class="btn btn-xs btn-outline btn-primary">Перейти
                                                                <i class="fa fa-long-arrow-right"></i> </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                    <?php }
                                    } ?>
                                </div>
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
            url: '/main/candidate?start_date=' + sdate + '&end_date=' + edate + '&candidate_id=<?= $candidateInformation['id'] ?>',
            type: 'GET',
            success: function(data) {
                $('.wrapper-content').html(data);
            }
        });

        window.history.pushState(stateObj,
            'Page 2', '/main/index#candidate?start_date=' + sdate + '&end_date=' + edate + '&candidate_id=<?= $candidateInformation['id'] ?>');

    }

    // function openurl(type, start_date, end_date, candidate_id = null) {
    //     $.ajax({
    //         url: '/main/' + type + '?start_date=' + start_date.split(".")[2] + "-" + start_date.split(".")[1] + "-" + start_date.split(".")[0] + '&end_date=' + end_date.split(".")[2] + "-" + end_date.split(".")[1] + "-" + end_date.split(".")[0] + ((candidate_id != null) ? "&candidate_id=" + candidate_id : ""),
    //         type: 'GET',
    //         success: function(data) {
    //             // $('#page-wrapper').html("");
    //             history.pushState("/main/index#" + type + '?start_date=' + start_date.split(".")[2] + "-" + start_date.split(".")[1] + "-" + start_date.split(".")[0] + '&end_date=' + end_date.split(".")[2] + "-" + end_date.split(".")[1] + "-" + end_date.split(".")[0] + ((candidate_id != null) ? "&candidate_id=" + candidate_id : ""), "/main/index#" + type + '?start_date=' + start_date.split(".")[2] + "-" + start_date.split(".")[1] + "-" + start_date.split(".")[0] + '&end_date=' + end_date.split(".")[2] + "-" + end_date.split(".")[1] + "-" + end_date.split(".")[0] + ((candidate_id != null) ? "&candidate_id=" + candidate_id : ""), "/main/index#" + type + '?start_date=' + start_date.split(".")[2] + "-" + start_date.split(".")[1] + "-" + start_date.split(".")[0] + '&end_date=' + end_date.split(".")[2] + "-" + end_date.split(".")[1] + "-" + end_date.split(".")[0] + ((candidate_id != null) ? "&candidate_id=" + candidate_id : ""));
    //             $('.wrapper-content').html(data);
    //             window.scrollTo(0,0);

    //             // console.log(data);
    //         }
    //     });
    // }

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
    });

    function createChart(container, name, subtitle, data) {
        // console.log({'fb':{'fdsa':456, 'gfsdgf':987}});
        // console.log(data);

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
            } else if (keys[i] == 'web') {
                datas_name = 'Web-Sites'
            } else if (keys[i] == 'positive') {
                datas_name = 'Позитив'
            } else if (keys[i] == 'neutral') {
                datas_name = 'Нейтрал'
            } else if (keys[i] == 'negative') {
                datas_name = 'Негатив'
            }
            datas[i] = {
                name: datas_name,
                data: temp
            }
        }

        // console.log(datas);



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
                valueSuffix: ' постов',
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
            } else if (keys[i] == 'web') {
                datas[i] = ["Web-Sites", data[keys[i]]];
            } else if (keys[i] == 'positive') {
                datas[i] = ["Позитив", data[keys[i]]];
            } else if (keys[i] == 'neutral') {
                datas[i] = ["Нейтрал", data[keys[i]]];
            } else if (keys[i] == 'negative') {
                datas[i] = ["Негатив", data[keys[i]]];
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

    createChart('total_chart', 'Публикации источников', 'Кол-во постов', {
        // Формирование объекта с ключ/значениями для js из массива php
        <?php foreach ($date_posts[$candidateInformation['id']] as $key => $value) {
            echo $key . ":{";
            foreach ($value as $k => $v) {
                echo "'" . $k . "':" . $v . ", ";
            }
            echo "}, ";
        } ?>
    });

    createChart('sentiment_chart', 'Тональность постов', 'Кол-во постов', {
        <?php foreach ($postsSentimentChart[$candidateInformation['id']] as $key => $value) {
            echo $key . ":{";
            foreach ($value as $k => $v) {
                echo "'" . $k . "':" . $v . ", ";
            }
            echo "}, ";
        } ?>
    });

    createChart('subs_chart', 'График подписчиков', 'Кол-во подписчиков', {
        <?php foreach ($totalSubsChart[$candidateInformation['id']] as $key => $value) {
            echo $key . ":{";
            foreach ($value as $k => $v) {
                echo "'" . $k . "':" . $v . ", ";
            }
            echo "}, ";
        } ?>
    });

    createChart('likes_chart', 'График лайков', 'Кол-во лайков', {
        <?php foreach ($totalLikesChart[$candidateInformation['id']] as $key => $value) {
            echo $key . ":{";
            foreach ($value as $k => $v) {
                echo "'" . $k . "':" . $v . ", ";
            }
            echo "}, ";
        } ?>
    });

    createChart('comments_chart', 'График комментариев', 'Кол-во комментариев', {
        <?php foreach ($totalCommentsChart[$candidateInformation['id']] as $key => $value) {
            echo $key . ":{";
            foreach ($value as $k => $v) {
                echo "'" . $k . "':" . $v . ", ";
            }
            echo "}, ";
        } ?>
    });

    createChart('reposts_chart', 'График репостов', 'Кол-во репостов', {
        <?php foreach ($totalRepostsChart[$candidateInformation['id']] as $key => $value) {
            echo $key . ":{";
            foreach ($value as $k => $v) {
                echo "'" . $k . "':" . $v . ", ";
            }
            echo "}, ";
        } ?>
    });

    createDonut('comments_donut', 'Всего комментариев', 'Комментариев', {
        <?php foreach ($totalCommentsDonut[$candidateInformation['id']] as $key => $value) {
            echo $key . ':' . $value . ', ';
        } ?>
    });

    createDonut('likes_donut', 'Всего лайков', 'Лайков', {
        <?php foreach ($totalLikesDonut[$candidateInformation['id']] as $key => $value) {
            echo $key . ':' . $value . ', ';
        } ?>
    });


    createDonut('subs_donut', 'Всего подписчиков', 'Подписчиков', {
        <?php foreach ($totalSubsDonut[$candidateInformation['id']] as $key => $value) {
            echo $key . ':' . $value . ', ';
        } ?>
    });


    createDonut('sentiment_donut', 'Всего тональности', 'Постов', {
        <?php foreach ($postsSentimentLine[$candidateInformation['id']] as $key => $value) {
            echo $key . ':' . $value . ', ';
        } ?>
    });


    createDonut('total_donut', 'Всего постов', 'Постов', {
        <?php foreach ($totalResourcesDonut[$candidateInformation['id']] as $key => $value) {
            echo $key . ':' . $value . ', ';
        } ?>
    });


    createDonut('reposts_donut', 'Всего репостов', 'Репостов', {
        <?php foreach ($totalRepostsDonut[$candidateInformation['id']] as $key => $value) {
            echo $key . ':' . $value . ', ';
        } ?>
    });
</script>