<div class="row">
    <div class="col-12">
        <div class="panel panel-default">
            <div class="panel-header">
                <h2 class='text-center'><strong>Рейтинг обсуждении</strong></h2>
            </div>
            <div class="panel-body">
                <div class="col-lg-12">
                    <div class="ibox">
                        <?php
                        $total = 0;
                        foreach ($rating as $i) {
                            $total += $i;
                        }

                        foreach ($rating as $key => $value) { ?>
                            <div class="ibox-content">
                                <div class="row">
                                    <a onclick='openurl("candidate", start_date, end_date, <?= $key ?>)' class="float-left">
                                        <img alt="image" style='width:50px;margin-right:10px;' class="rounded-circle" src="<?= $candidateInformation[$key]['photo'] ?>">
                                    </a>
                                    <div class="media-body ">
                                        <h4 class="float-right text-navy"><?php echo round(($value / $total) * 100, 2) ?> %</h4>
                                        <a style="font-size:15px;" onclick='openurl("candidate", start_date, end_date, <?= $key ?>)'><strong><?= $candidateInformation[$key]['name'] ?></strong></a>
                                        <div class="progress progress-mini">
                                            <div style="width: <?php echo round(($value / $total) * 100, 2) ?>%;" class="progress-bar"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>

                    </div>
                </div>

            </div>
        </div>
    </div>


    <div class="col-lg-8 col-sm-12">
        <div class="panel panel-default">
            <div class="panel-header">
                <h2 class='text-center'><strong>Тональность постов про кандидатов</strong></h2>
            </div>
            <div class="panel-body">
                <?php
                $total = [];
                foreach ($postsSentimentLine as $key => $sentiment) {
                    $total[$key] = (isset($total[$key]) ? $total[$key] : 0) + $sentiment['positive'] + $sentiment['neutral'] + $sentiment['negative'];
                }
                foreach ($candidateInformation as $candidate) { ?>
                    <div class="ibox-content" style='position:relative !important;'>
                        <a style="font-size:15px;" onclick='openurl("candidate", start_date, end_date, <?= $candidate["id"] ?>)'><strong><?= $candidate['name'] ?></strong></a>
                        <div style='position:inherit; width:100%; margin-bottom:20px;'>
                            <h5 style='position:absolute; text-align:center; color:slategrey; margin-top:5px; width:<?= isset($postsSentimentLine[$candidate['id']])?round((($postsSentimentLine[$candidate['id']]['positive'] / $total[$candidate['id']]) * 100), 2):0 ?>%; height: fit-content;'><?= isset($postsSentimentLine[$candidate['id']])?round((($postsSentimentLine[$candidate['id']]['positive'] / $total[$candidate['id']]) * 100), 2):0 ?>%</h5>
                            <h5 style='position:absolute; text-align:center; color:slategrey; margin-top:5px; margin-left:<?= isset($postsSentimentLine[$candidate['id']])?round((($postsSentimentLine[$candidate['id']]['positive'] / $total[$candidate['id']]) * 100), 2):0 ?>%;width:<?= isset($postsSentimentLine[$candidate['id']])?round((($postsSentimentLine[$candidate['id']]['neutral'] / $total[$candidate['id']]) * 100), 2):0 ?>%; height: fit-content;'><?= isset($postsSentimentLine[$candidate['id']])?round((($postsSentimentLine[$candidate['id']]['neutral'] / $total[$candidate['id']]) * 100), 2):0 ?>%</h5>
                            <h5 style='position:absolute; text-align:center; color:slategrey; margin-top:5px; margin-left:<?= isset($postsSentimentLine[$candidate['id']])?round(((($postsSentimentLine[$candidate['id']]['positive'] / $total[$candidate['id']]) * 100) + (($postsSentimentLine[$candidate['id']]['neutral'] / $total[$candidate['id']]) * 100)), 2):0 ?>%;width:<?= isset($postsSentimentLine[$candidate['id']])?round((($postsSentimentLine[$candidate['id']]['negative'] / $total[$candidate['id']]) * 100), 2):0 ?>%; height: fit-content;'><?= isset($postsSentimentLine[$candidate['id']])?round((($postsSentimentLine[$candidate['id']]['negative'] / $total[$candidate['id']]) * 100), 2):0 ?>%</h5>
                        </div>
                        <div class="progress" style='height:8px !important;'>
                            <div class="progress-bar progress-bar-primary" role="progressbar" style="width: <?= isset($postsSentimentLine[$candidate['id']])?round((($postsSentimentLine[$candidate['id']]['positive'] / $total[$candidate['id']]) * 100), 2):0 ?>%;display:block;" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100">

                            </div>
                            <div class="progress-bar progress-bar-warning" role="progressbar" style="width: <?= isset($postsSentimentLine[$candidate['id']])?round((($postsSentimentLine[$candidate['id']]['neutral'] / $total[$candidate['id']]) * 100), 2):0 ?>%" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">

                            </div>
                            <div class="progress-bar progress-bar-danger" role="progressbar" style="width: <?= isset($postsSentimentLine[$candidate['id']])?round((($postsSentimentLine[$candidate['id']]['negative'] / $total[$candidate['id']]) * 100), 2):0 ?>%" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100">

                            </div>
                        </div>
                    </div>
                <?php
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
                // console.log(sdate);
                history.pushState("/main/index#dashboard" + '?start_date=' + sdate + '&end_date=' + edate, "/main/index#dashboard" + '?start_date=' + sdate + '&end_date=' + edate, "/main/index#dashboard" + '?start_date=' + sdate + '&end_date=' + edate);
                $('.wrapper-content').html(data);
            }
        });

    }

    function openurl(type, start_date, end_date, candidate_id = null) {
        $.ajax({
            url: '/main/' + type + '?start_date=' + start_date.split(".")[2] + "-" + start_date.split(".")[1] + "-" + start_date.split(".")[0] + '&end_date=' + end_date.split(".")[2] + "-" + end_date.split(".")[1] + "-" + end_date.split(".")[0] + ((candidate_id != null) ? "&candidate_id=" + candidate_id : ""),
            type: 'GET',
            success: function(data) {
                // $('#page-wrapper').html("");
                history.pushState("/main/index#" + type + '?start_date=' + start_date.split(".")[2] + "-" + start_date.split(".")[1] + "-" + start_date.split(".")[0] + '&end_date=' + end_date.split(".")[2] + "-" + end_date.split(".")[1] + "-" + end_date.split(".")[0] + ((candidate_id != null) ? "&candidate_id=" + candidate_id : ""), "/main/index#" + type + '?start_date=' + start_date.split(".")[2] + "-" + start_date.split(".")[1] + "-" + start_date.split(".")[0] + '&end_date=' + end_date.split(".")[2] + "-" + end_date.split(".")[1] + "-" + end_date.split(".")[0] + ((candidate_id != null) ? "&candidate_id=" + candidate_id : ""), "/main/index#" + type + '?start_date=' + start_date.split(".")[2] + "-" + start_date.split(".")[1] + "-" + start_date.split(".")[0] + '&end_date=' + end_date.split(".")[2] + "-" + end_date.split(".")[1] + "-" + end_date.split(".")[0] + ((candidate_id != null) ? "&candidate_id=" + candidate_id : ""));
                $('.wrapper-content').html(data);
                window.scrollTo(0,0);

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

        // console.log(candidateInformation);


        // console.log(getDatesBetween(new Date('<?= $start_date ?>'), new Date('<?= $end_date ?>')).map(item=>{
        //                 return item+", ";
        //             }));

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
                text: 'Обсуждение кандидатов в медиа',
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
                    text: "Постов",
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

            series: [{
                name: 'Все обсуждения',

                data: [
                    // console.log([
                    <?php
                    foreach ($dates as $date) {
                        // foreach ($date_posts as $key => $value) {
                        //     if ($date == $key) {
                        //         echo $value . ",";
                        //         continue;
                        //     }
                        //     echo 0 . ",";
                        // }
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
                text: 'Обсуждение кандидатов в ресурсах'
            },
            plotOptions: {
                pie: {
                    innerSize: 30,
                    depth: 45
                }
            },
            series: [{
                name: 'Постов',
                data: [
                    ['Facebook', <?= isset($totalResourcesDonut['fb'])?$totalResourcesDonut['fb']:0 ?>],
                    ['Instagram',<?= isset($totalResourcesDonut['ig'])?$totalResourcesDonut['ig']:0 ?>],
                    ['Telegram', <?= isset($totalResourcesDonut['tg'])?$totalResourcesDonut['tg']:0 ?>],
                    ['Web-Site', <?= isset($totalResourcesDonut['web'])?$totalResourcesDonut['web']:0 ?>],
                ]
            }]
        });
    });
</script>