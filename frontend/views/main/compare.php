<div class="row">
    <div class="col-12">
        <div class="panel panel-default">
            <div class="panel-header">
                <h2 class='text-center'>Сравнить кандидатов</h2>
            </div>
            <div class="panel-body">
                <div class="col-lg-12 row no-margins" style='justify-content:center;'>
                    <div class="col-lg-4 col-md-12 col-sm-12" style='display:flex; flex-direction:column; gap: 10px; justify-content:center;'>
                        <div class="btn-group">
                            <select class="btn btn-white inline-block" style='width:100%' id="firstSelect">
                                <option value="select">Выбрать кандидата</option>
                                <?php foreach ($candidateInformation as $candidate) { ?>
                                    <option value="<?= $candidate['id'] ?>"><?= $candidate['name'] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="btn-group">
                            <select class="btn btn-white inline-block" style='width:100%' id="secondSelect">
                                <option value="select">Выбрать кандидата</option>
                                <?php foreach ($candidateInformation as $candidate) { ?>
                                    <option value="<?= $candidate['id'] ?>"><?= $candidate['name'] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12 col-sm-12" style='display:flex; flex-direction:row; flex-wrap:wrap;'>
                        <div class="col-lg-6 col-md-6">
                            <div style='display:flex; flex-direction: column; justify-content:center; height:100%;'>
                                <label class="toggle">
                                    <input class="toggle-checkbox" id='discussionChart' type="checkbox" checked>
                                    <div class="toggle-switch"></div>
                                    <span class="toggle-label">Обсуждения</span>
                                </label>
                                <label class="toggle">
                                    <input class="toggle-checkbox" id='sentimentChart' type="checkbox" checked>
                                    <div class="toggle-switch"></div>
                                    <span class="toggle-label">Тональность обсуждении</span>
                                </label>
                                <label class="toggle">
                                    <input class="toggle-checkbox" id='rating' type="checkbox" checked>
                                    <div class="toggle-switch"></div>
                                    <span class="toggle-label">Рейтинг</span>
                                </label>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div style='display:flex; flex-direction: column;'>
                                <label class="toggle">
                                    <input class="toggle-checkbox" id='subsChart' type="checkbox" checked>
                                    <div class="toggle-switch"></div>
                                    <span class="toggle-label">Подписчики</span>
                                </label>
                                <label class="toggle">
                                    <input class="toggle-checkbox" id='likesChart' type="checkbox" checked>
                                    <div class="toggle-switch"></div>
                                    <span class="toggle-label">Лайки</span>
                                </label>
                                <label class="toggle">
                                    <input class="toggle-checkbox" id='commentsChart' type="checkbox" checked>
                                    <div class="toggle-switch"></div>
                                    <span class="toggle-label">Комментарии</span>
                                </label>
                                <label class="toggle">
                                    <input class="toggle-checkbox" id='repostsChart' type="checkbox" checked>
                                    <div class="toggle-switch"></div>
                                    <span class="toggle-label">Репосты, ответы</span>
                                </label>
                                <!-- <label class="toggle">
                                    <input class="toggle-checkbox" type="checkbox" checked>
                                    <div class="toggle-switch"></div>
                                    <span class="toggle-label"></span>
                                </label> -->
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 text-center m-t-md">
                    <button class='btn btn-primary' onclick="compare(start_date, end_date)" style='width:200px;'>Сравнить</button>
                </div>
            </div>
        </div>
    </div>

    <div class="col-12">
        <div class="row"  id="comparecontent">

        </div>
    </div>

</div>

<script>
    function compare(sdate, edate) {
        sdate = sdate.split(".")[2] + "-" + sdate.split(".")[1] + "-" + sdate.split(".")[0];
        edate = edate.split(".")[2] + "-" + edate.split(".")[1] + "-" + edate.split(".")[0];
        var f = document.getElementById('firstSelect').value;
        var s = document.getElementById('secondSelect').value;
        console.log(f);
        discussionChart = $("#discussionChart").is(":checked");
        sentimentChart = $("#sentimentChart").is(":checked");
        subsChart = $("#subsChart").is(":checked");
        likesChart = $("#likesChart").is(":checked");
        commentsChart = $("#commentsChart").is(":checked");
        repostsChart = $("#repostsChart").is(":checked");
        rating = $("#rating").is(":checked");

        // console.log('/main/comparecontent?start_date=' + sdate + '&end_date=' + edate + '&first=' + f + '&second=' + s + "&discussionChart=" + discussionChart + "&sentimentChart=" + sentimentChart + "&subsChart=" + subsChart + "&likesChart=" + likesChart + "&commentsChart=" + commentsChart + "&repostsChart=" + repostsChart + "&birthday=" + birthday + "&experience=" + experience)
        if (f != s && f != "select" && s != "select") {
            if (discussionChart == true || sentimentChart == true || rating == true || subsChart == true || commentsChart == true || likesChart == true || repostsChart == true) {
                $.ajax({
                    url: '/main/comparecontent?start_date=' + sdate + '&end_date=' + edate + '&first=' + f + '&second=' + s + "&discussionChart=" + discussionChart + "&sentimentChart=" + sentimentChart + "&subsChart=" + subsChart + "&likesChart=" + likesChart + "&commentsChart=" + commentsChart + "&repostsChart=" + repostsChart + "&rating=" + rating,
                    type: "GET",
                    success: function(data){
                        $("#comparecontent").html(data);
                    }
                });
            }
        }



    }

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
            url: '/main/compare?start_date=' + sdate + '&end_date=' + edate,
            type: 'GET',
            success: function(data) {
                // console.log(sdate);
                history.pushState("/main/index#compare" + '?start_date=' + sdate + '&end_date=' + edate, "/main/index#compare" + '?start_date=' + sdate + '&end_date=' + edate, "/main/index#compare" + '?start_date=' + sdate + '&end_date=' + edate);
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
    });
</script>