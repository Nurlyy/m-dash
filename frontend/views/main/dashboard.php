<div class="row">
    <div class="col-12">
        <div class="panel panel-default">
            <div class="panel-header">
                <h2 class='text-center'><strong><?= Yii::t('frontend', 'Discussions rating') ?></strong></h2>
            </div>
            <div class="panel-body">
                <div class="col-lg-12">
                    <div class="ibox">
                        <?php
                        $total = 0;
                        $ids = array_keys($cityInformation);
                        foreach ($rating as $i) {
                            $total += $i;
                        }
                        foreach ($rating as $key => $rate) {
                            foreach ($ids as $id) {
                                if ($key == $id) { ?>
                                    <div class="ibox-content">
                                        <div class="row">
                                            <div class="media-body ">
                                                <h4 class="float-right text-navy"><?php echo (isset($rating[$id]) && $rating[$id] != 0 ? round(($rating[$id] / $total) * 100, 2) : 0) ?> %</h4>
                                                <a style="font-size:15px;" onclick='openurl("main","city", start_date, end_date, <?= $id ?>)'><strong><?= $cityInformation[$id]['name'] ?></strong></a>
                                                <div class="progress progress-mini">
                                                    <div style="width: <?php echo (isset($rating[$id]) && $rating[$id] != 0 ? round(($rating[$id] / $total) * 100, 2) : 0) ?>%;" class="progress-bar"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                        <?php }
                            }
                        } ?>
                    </div>
                </div>

            </div>
        </div>
    </div>


    <div class="col-lg-8 col-sm-12">
        <div class="panel panel-default">
            <div class="panel-header">
                <h2 class='text-center'><strong><?= Yii::t('frontend', 'Sentiment of posts') ?></strong></h2>
            </div>
            <div class="panel-body">
                <?php
                $total = [];
                foreach ($postsSentimentLine as $key => $sentiment) {
                    $total[$key] = (isset($total[$key]) ? $total[$key] : 0) + $sentiment['positive'] + $sentiment['neutral'] + $sentiment['negative'];
                }
                foreach ($postsSentimentLine as $key => $sentiment) {
                    foreach ($cityInformation as $city) {
                        if ($key == $city['id']) { ?>
                            <div class="ibox-content" style='position:relative !important;'>
                                <a style="font-size:15px;" onclick='openurl("main", "city", start_date, end_date, <?= $city["id"] ?>)'><strong><?= $city['name'] ?></strong></a>
                                <div style='position:inherit; width:100%; margin-bottom:20px;'>
                                    <h5 style='position:absolute; text-align:center; color:slategrey; margin-top:5px; width:<?= isset($postsSentimentLine[$city['id']]) && $postsSentimentLine[$city['id']]['positive'] != 0 ? round((($postsSentimentLine[$city['id']]['positive'] / $total[$city['id']]) * 100), 2) : 0 ?>%; height: fit-content;'><?= isset($postsSentimentLine[$city['id']]) && $postsSentimentLine[$city['id']]['positive'] != 0 ? round((($postsSentimentLine[$city['id']]['positive'] / $total[$city['id']]) * 100), 2) : 0 ?>%</h5>
                                    <h5 style='position:absolute; text-align:center; color:slategrey; margin-top:5px; margin-left:<?= isset($postsSentimentLine[$city['id']]) && $postsSentimentLine[$city['id']]['neutral'] != 0 ? round((($postsSentimentLine[$city['id']]['positive'] / $total[$city['id']]) * 100), 2) : 0 ?>%;width:<?= isset($postsSentimentLine[$city['id']]) && $postsSentimentLine[$city['id']]['neutral'] != 0 ? round((($postsSentimentLine[$city['id']]['neutral'] / $total[$city['id']]) * 100), 2) : 0 ?>%; height: fit-content;'><?= isset($postsSentimentLine[$city['id']]) && $postsSentimentLine[$city['id']]['neutral'] != 0 ? round((($postsSentimentLine[$city['id']]['neutral'] / $total[$city['id']]) * 100), 2) : 0 ?>%</h5>
                                    <h5 style='position:absolute; text-align:center; color:slategrey; margin-top:5px; margin-left:<?= isset($postsSentimentLine[$city['id']]) && $postsSentimentLine[$city['id']]['negative'] != 0 ? round(((($postsSentimentLine[$city['id']]['positive'] / $total[$city['id']]) * 100) + (($postsSentimentLine[$city['id']]['neutral'] / $total[$city['id']]) * 100)), 2) : 0 ?>%;width:<?= isset($postsSentimentLine[$city['id']]) && $postsSentimentLine[$city['id']]['negative'] != 0 ? round((($postsSentimentLine[$city['id']]['negative'] / $total[$city['id']]) * 100), 2) : 0 ?>%; height: fit-content;'><?= isset($postsSentimentLine[$city['id']]) && $postsSentimentLine[$city['id']]['negative'] != 0 ? round((($postsSentimentLine[$city['id']]['negative'] / $total[$city['id']]) * 100), 2) : 0 ?>%</h5>
                                </div>
                                <div class="progress" style='height:8px !important;'>
                                    <div class="progress-bar progress-bar-primary" role="progressbar" style="width: <?= isset($postsSentimentLine[$city['id']]) && $postsSentimentLine[$city['id']]['positive'] != 0 ? round((($postsSentimentLine[$city['id']]['positive'] / $total[$city['id']]) * 100), 2) : 0 ?>%;display:block;" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100">

                                    </div>
                                    <div class="progress-bar progress-bar-warning" role="progressbar" style="width: <?= isset($postsSentimentLine[$city['id']]) && $postsSentimentLine[$city['id']]['neutral'] != 0 ? round((($postsSentimentLine[$city['id']]['neutral'] / $total[$city['id']]) * 100), 2) : 0 ?>%" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">

                                    </div>
                                    <div class="progress-bar progress-bar-danger" role="progressbar" style="width: <?= isset($postsSentimentLine[$city['id']]) && $postsSentimentLine[$city['id']]['negative'] != 0 ? round((($postsSentimentLine[$city['id']]['negative'] / $total[$city['id']]) * 100), 2) : 0 ?>%" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100">

                                    </div>
                                </div>
                            </div>
                <?php
                        }
                    }
                }
                ?>
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


    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="row">

                    <div class="col-lg-12 col-md-12">
                        <figure class="highcharts-figure">
                            <div id="total_chart"></div>
                        </figure>
                    </div>
                </div>

            </div>
        </div>
    </div>



</div>

<script>
    function getDatesBetween(startDate, endDate, separator = '.') {
        const currentDate = new Date(startDate.getTime());
        const dates = [];
        while (currentDate <= endDate) {
            dates.push(currentDate.getFullYear() + separator + parseInt(currentDate.getMonth() + 1) + separator + currentDate.getDate());
            currentDate.setDate(currentDate.getDate() + 1);
        }
        return dates;
    }

    function addState(sdate, edate) {
        $.ajax({
            url: '/main/dashboard?start_date=' + sdate + '&end_date=' + edate,
            type: 'GET',
            success: function(data) {
                history.pushState("/main/index#dashboard" + '?start_date=' + sdate + '&end_date=' + edate, "/main/index#dashboard" + '?start_date=' + sdate + '&end_date=' + edate, "/main/index#dashboard" + '?start_date=' + sdate + '&end_date=' + edate);
                $('.wrapper-content').html(data);
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

        Highcharts.chart('total_chart', {
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
                text: '<?= Yii::t('frontend', 'Discussions in media') ?>',
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
                    text: "<?= Yii::t('frontend', 'Posts') ?>",
                    style: {
                        color: "#A0A0A3"
                    }
                },
                minorGridLineWidth: 0,
                alternateGridColor: null,
            },
            tooltip: {
                valueSuffix: ' <?= Yii::t('frontend', 'posts') ?>',
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

            series: [{
                name: '<?= Yii::t('frontend', 'All discussions') ?>',

                data: [
                    <?php
                    foreach ($dates as $date) {
                        if (isset($date_posts[$date])) {
                            echo $date_posts[$date] . ",";
                        } else {
                            echo 0 . ",";
                        }
                    }
                    ?>

                ]

            }, ],
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


        Highcharts.chart('total_donut', {
            chart: {
                type: 'pie',
                options3d: {
                    enabled: true,
                    alpha: 25
                }
            },
            title: {
                text: '<?= Yii::t('frontend', 'Discussions in resources') ?>'
            },
            plotOptions: {
                pie: {
                    innerSize: 30,
                    depth: 45
                }
            },
            series: [{
                name: '<?= Yii::t('frontend', 'Posts') ?>',
                data: [
                    <?php
                    $socials = ['fb' => 'Facebook', 'ig' => 'Instagram', 'gg' => 'Google', 'tt' => 'TikTok', 'tw' => 'Twitter', 'mm' => Yii::t('frontend', 'Moi Mir'), 'ok' => Yii::t('frontend', 'Odnoklassniki'), 'vk' => Yii::t('frontend', 'Vkontakte'), 'tg' => 'Telegram', 'yt' => 'YouTube'];
                    foreach ($totalResourcesDonut as $k => $v) {
                        if ($v > 0) {
                            echo "['" . $socials[$k] . "', " . $v . "],";
                        }
                    } ?>
                ]
            }]
        });
    });
</script>