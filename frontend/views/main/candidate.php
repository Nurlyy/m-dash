<div class="row">
    <div class="col-12">
        <div class="tabs-container">
            <ul class="nav nav-tabs" role="tablist">
                <li><a class="nav-link active" data-toggle="tab" href="#tab-discussion"><i class="far fa-analyze"></i> Обсуждение</a></li>
                <li><a class="nav-link" data-toggle="tab" href="#tab-2">This is second tab</a></li>
            </ul>
            <div class="tab-content">
                <div role="tabpanel" id="tab-discussion" class="tab-pane active">
                    <div class="panel-body">

                        <div class="row">

                            <div class="col-lg-8 col-md-12">
                                <figure class="highcharts-figure">
                                    <div id="total_chart"></div>
                                </figure>
                            </div>

                            <div class="col-lg-4 col-md-12">
                                <figure class="highcharts-figure">
                                    <div id="total_donut"></div>
                                </figure>
                            </div>

                        </div>
                    </div>
                </div>
                <div role="tabpanel" id="tab-2" class="tab-pane">
                    <div class="panel-body">
                        <strong>Donec quam felis</strong>

                        <p>Thousand unknown plants are noticed by me: when I hear the buzz of the little world among the stalks, and grow familiar with the countless indescribable forms of the insects
                            and flies, then I feel the presence of the Almighty, who formed us in his own image, and the breath </p>

                        <p>I am alone, and feel the charm of existence in this spot, which was created for the bliss of souls like mine. I am so happy, my dear friend, so absorbed in the exquisite
                            sense of mere tranquil existence, that I neglect my talents. I should be incapable of drawing a single stroke at the present moment; and yet.</p>
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
            url: '/main/telegram?start_date=' + sdate + '&end_date=' + edate,
            type: 'GET',
            success: function(data) {
                $('.wrapper-content').html(data);
            }
        });

        window.history.pushState(stateObj,
            'Page 2', '/main/index#telegram?start_date=' + sdate + '&end_date=' + edate);

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
    });

    Highcharts.chart('container', {
        chart: {
            type: 'spline',
            scrollablePlotArea: {
                minWidth: 600,
                scrollPositionX: 1
            }
        },
        title: {
            text: 'Публикации источников',
            align: 'center'
        },
        xAxis: {
            accessibility: {
                rangeDescription: 'Показатель'
            },
            categories: ['<?= implode("', '", $dates) ?>']
        },
        yAxis: {
            title: {
                text: 'Кол-во публикации'
            },
            minorGridLineWidth: 0,
            gridLineWidth: 0,
            alternateGridColor: null,
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
            name: 'Facebook',
            data: [<?php
                    foreach ($dates as $d) {
                        foreach ($date_posts as $date => $value) {
                            if ($d == $date) echo $value['fb'] . ", ";
                        }
                    }

                    ?>]
        }, {
            name: 'Instagram',
            data: [<?php
                    foreach ($dates as $d) {
                        foreach ($date_posts as $date => $value) {
                            if ($d == $date) echo $value['ig'] . ", ";
                        }
                    }

                    ?>]
        }, {
            name: 'Telegram',
            data: [<?php
                    foreach ($dates as $d) {
                        foreach ($date_posts as $date => $value) {
                            if ($d == $date) echo $value['tg'] . ", ";
                        }
                    }

                    ?>]
        }, {
            name: 'Web-sites',
            data: [<?php
                    foreach ($dates as $d) {
                        foreach ($date_posts as $date => $value) {
                            if ($d == $date) echo $value['web'] . ", ";
                        }
                    }

                    ?>]
        }],
        navigation: {
            menuItemStyle: {
                fontSize: '10px'
            }
        }
    });


    Highcharts.chart('total_donut', {
        chart: {
            type: 'pie',
            options3d: {
                enabled: true,
                alpha: 45
            }
        },
        title: {
            text: 'Beijing 2022 gold medals by country'
        },
        subtitle: {
            text: '3D donut in Highcharts'
        },
        plotOptions: {
            pie: {
                innerSize: 100,
                depth: 45
            }
        },
        series: [{
            name: 'Medals',
            data: [
                ['Norway', 16],
                ['Germany', 12],
                ['USA', 8],
                ['Sweden', 8],
                ['Netherlands', 8],
                ['ROC', 6],
                ['Austria', 7],
                ['Canada', 4],
                ['Japan', 3]

            ]
        }]
    });
</script>