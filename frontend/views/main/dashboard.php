<div class="row">
    <div class="col-12">
        <div class="panel panel-default">
            <div class="panel-header">
                <h2 class='text-center'>Рейтинг обсуждении</h2>
            </div>
            <div class="panel-body">
                <div class="col-lg-12">
                    <div class="ibox">
                        <?php
                        $total = 0;
                        foreach ($rating as $i) {
                            $total += $i;
                        }
                        foreach ($candidateInformation as $candidate) { ?>
                            <div class="ibox-content">
                                <div class="row">
                                    <a href="#" class="float-left">
                                        <img alt="image" style='width:50px;margin-right:10px;' class="rounded-circle" src="/img/a2.jpg">
                                    </a>
                                    <div class="media-body ">
                                        <h4 class="float-right text-navy"><?php echo round(($rating[$candidate['id']] / $total) * 100, 2) ?> %</h4>
                                        <h4><strong><?= $candidate['name'] ?></strong></h4>
                                        <div class="progress progress-mini">
                                            <div style="width: <?php echo round(($rating[$candidate['id']] / $total) * 100, 2) ?>%;" class="progress-bar"></div>
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


    <div class="col-lg-6 col-sm-12">
        <div class="panel panel-default">
            <div class="panel-header">
                <h2 class='text-center'>Тональность постов про кандидатов</h2>
            </div>
            <div class="panel-body">
                <?php
                $total = [];
                foreach ($postsSentimentLine as $key => $sentiment) {
                    $total[$key] = (isset($total[$key]) ? $total[$key] : 0) + $sentiment['positive'] + $sentiment['neutral'] + $sentiment['negative'];
                }
                foreach ($candidateInformation as $candidate) { ?>
                    <div class="ibox-content" style='position:relative !important;'>
                        <h4><strong><?= $candidate['name'] ?></strong></h4>
                        <div style='position:inherit; width:100%; margin-bottom:20px;'>
                            <h4 style='position:absolute; text-align:center; color:slategrey; margin-top:-5px; width:<?= round((($postsSentimentLine[$candidate['id']]['positive'] / $total[$candidate['id']]) * 100), 2) ?>%; height: fit-content;'><?= round((($postsSentimentLine[$candidate['id']]['positive'] / $total[$candidate['id']]) * 100), 2) ?>%</h4>
                            <h4 style='position:absolute; text-align:center; color:slategrey; margin-top:-5px; margin-left:<?= round((($postsSentimentLine[$candidate['id']]['positive'] / $total[$candidate['id']]) * 100), 2) ?>%;width:<?= round((($postsSentimentLine[$candidate['id']]['neutral'] / $total[$candidate['id']]) * 100), 2) ?>%; height: fit-content;'><?= round((($postsSentimentLine[$candidate['id']]['neutral'] / $total[$candidate['id']]) * 100), 2) ?>%</h4>
                            <h4 style='position:absolute; text-align:center; color:slategrey; margin-top:-5px; margin-left:<?= round(((($postsSentimentLine[$candidate['id']]['positive'] / $total[$candidate['id']]) * 100) + (($postsSentimentLine[$candidate['id']]['neutral'] / $total[$candidate['id']]) * 100)), 2) ?>%;width:<?= round((($postsSentimentLine[$candidate['id']]['negative'] / $total[$candidate['id']]) * 100), 2) ?>%; height: fit-content;'><?= round((($postsSentimentLine[$candidate['id']]['negative'] / $total[$candidate['id']]) * 100), 2) ?>%</h4>
                        </div>
                        <div class="progress" style='height:8px !important;'>
                            <div class="progress-bar progress-bar-primary" role="progressbar" style="width: <?= round((($postsSentimentLine[$candidate['id']]['positive'] / $total[$candidate['id']]) * 100), 2) ?>%;display:block;" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100">

                            </div>
                            <div class="progress-bar progress-bar-warning" role="progressbar" style="width: <?= round((($postsSentimentLine[$candidate['id']]['neutral'] / $total[$candidate['id']]) * 100), 2) ?>%" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">

                            </div>
                            <div class="progress-bar progress-bar-danger" role="progressbar" style="width: <?= round((($postsSentimentLine[$candidate['id']]['negative'] / $total[$candidate['id']]) * 100), 2) ?>%" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100">

                            </div>
                        </div>
                    </div>
                <?php
                }
                ?>
            </div>

        </div>
    </div>

    <div class="col-lg-6 col-sm-12">
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
                history.pushState("/main/index#dashboard" + '?start_date=' + sdate+ '&end_date=' + edate, "/main/index#dashboard" + '?start_date=' + sdate+ '&end_date=' + edate,"/main/index#dashboard" + '?start_date=' + sdate+ '&end_date=' + edate);
                $('.wrapper-content').html(data);
            }
        });

    }

    function openurl(type, start_date, end_date) {
        $.ajax({
            url: '/main/' + type + '?start_date=' + start_date.split(".")[2] + "-" + start_date.split(".")[1] + "-" + start_date.split(".")[0] + '&end_date=' + end_date.split(".")[2] + "-" + end_date.split(".")[1] + "-" + end_date.split(".")[0],
            type: 'GET',
            success: function(data) {
                // $('#page-wrapper').html("");
                history.pushState("/main/index#" + type + '?start_date=' + start_date.split(".")[2] + "-" + start_date.split(".")[1] + "-" + start_date.split(".")[0] + '&end_date=' + end_date.split(".")[2] + "-" + end_date.split(".")[1] + "-" + end_date.split(".")[0], "/main/index#" + type + '?start_date=' + start_date.split(".")[2] + "-" + start_date.split(".")[1] + "-" + start_date.split(".")[0] + '&end_date=' + end_date.split(".")[2] + "-" + end_date.split(".")[1] + "-" + end_date.split(".")[0], "/main/index#" + type + '?start_date=' + start_date.split(".")[2] + "-" + start_date.split(".")[1] + "-" + start_date.split(".")[0] + '&end_date=' + end_date.split(".")[2] + "-" + end_date.split(".")[1] + "-" + end_date.split(".")[0]);
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
            chart: {
                type: 'spline',
                scrollablePlotArea: {
                    minWidth: 600,
                    scrollPositionX: 1
                },
                plotBackgroundColor: 'rgba(225, 245, 254, 0.35)',
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
                minorGridLineWidth: 0,
                gridLineWidth: 0,
                alternateGridColor: null,
            },
            tooltip: {
                valueSuffix: ' постов'
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
                        foreach ($date_posts as $key => $value) {
                            if ($date == $key) {
                                echo $value . ",";
                            }else{
                                echo 0 . ",";
                            }
                        }
                    }
                    ?>

                ]

            }, ],
            navigation: {
                menuItemStyle: {
                    fontSize: '10px'
                }
            }
        });

        // Data retrieved from https://olympics.com/en/olympic-games/beijing-2022/medals
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
                    innerSize: 100,
                    depth: 45
                }
            },
            series: [{
                name: 'Постов',
                data: [
                    ['Facebook', <?= $totalResourcesDonut['fb'] ?>],
                    ['Instagram', <?= $totalResourcesDonut['ig'] ?>],
                    ['Telegram', <?= $totalResourcesDonut['tg'] ?>],
                    ['Web-Site', <?= $totalResourcesDonut['web'] ?>],
                ]
            }]
        });
    });
</script>