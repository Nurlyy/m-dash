<?php if ($ratingToggle == 'true') { ?>
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

                        foreach ($rating as $key => $value) { ?>
                            <div class="ibox-content">
                                <div class="row">
                                    <a href="#" class="float-left">
                                        <img alt="image" style='width:50px;margin-right:10px;' class="rounded-circle" src="<?= $candidateInformation[$key]['photo'] ?>">
                                    </a>
                                    <div class="media-body ">
                                        <h4 class="float-right text-navy"><?php echo round(($value / $total) * 100, 2) ?> %</h4>
                                        <h4><strong><?= $candidateInformation[$key]['name'] ?></strong></h4>
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
<?php } ?>


<?php if ($sentimentChart == 'true') { ?>
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
                            <h5 style='position:absolute; text-align:center; color:slategrey; margin-top:-3px; width:<?= round((($postsSentimentLine[$candidate['id']]['positive'] / $total[$candidate['id']]) * 100), 2) ?>%; height: fit-content;'><?= round((($postsSentimentLine[$candidate['id']]['positive'] / $total[$candidate['id']]) * 100), 2) ?>%</h5>
                            <h5 style='position:absolute; text-align:center; color:slategrey; margin-top:-3px; margin-left:<?= round((($postsSentimentLine[$candidate['id']]['positive'] / $total[$candidate['id']]) * 100), 2) ?>%;width:<?= round((($postsSentimentLine[$candidate['id']]['neutral'] / $total[$candidate['id']]) * 100), 2) ?>%; height: fit-content;'><?= round((($postsSentimentLine[$candidate['id']]['neutral'] / $total[$candidate['id']]) * 100), 2) ?>%</h5>
                            <h5 style='position:absolute; text-align:center; color:slategrey; margin-top:-3px; margin-left:<?= round(((($postsSentimentLine[$candidate['id']]['positive'] / $total[$candidate['id']]) * 100) + (($postsSentimentLine[$candidate['id']]['neutral'] / $total[$candidate['id']]) * 100)), 2) ?>%;width:<?= round((($postsSentimentLine[$candidate['id']]['negative'] / $total[$candidate['id']]) * 100), 2) ?>%; height: fit-content;'><?= round((($postsSentimentLine[$candidate['id']]['negative'] / $total[$candidate['id']]) * 100), 2) ?>%</h5>
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

                    <div class="col-12">
                        <figure class="highcharts-figure">
                            <div id="sentiment_donut"></div>
                        </figure>
                    </div>

                </div>

            </div>
        </div>
    </div>
<?php } ?>



<?php if ($discussionChart == 'true') { ?>
    <div class="col-lg-8 col-md-12">
        <div class="panel panel-default">
            <div class="panel-body">
                <figure class="highcharts-figure">
                    <div id="total_chart"></div>
                </figure>
            </div>
        </div>
    </div>
    <div class="col-lg-4 col-md-12">
        <div class="panel panel-default">
            <div class="panel-body">
                <figure class="highcharts-figure">
                    <div id="total_radar"></div>
                </figure>
            </div>
        </div>
    </div>
<?php } ?>




<?php if ($subsChart == 'true') { ?>
    <div class="col-lg-12 col-md-12">
        <div class="panel panel-default">
            <div class="panel-body">
                <figure class="highcharts-figure">
                    <div id="subs_chart"></div>
                </figure>
            </div>
        </div>
    </div>

    <!-- <div class="col-lg-4 col-sm-12">
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
    </div> -->
<?php } ?>





<?php if ($likesChart == 'true') { ?>
    <div class="col-lg-12 col-md-12">
        <div class="panel panel-default">
            <div class="panel-body">
                <figure class="highcharts-figure">
                    <div id="likes_chart"></div>
                </figure>
            </div>
        </div>
    </div>

    <!-- <div class="col-lg-4 col-sm-12">
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
    </div> -->
<?php } ?>



<?php if ($commentsChart == 'true') { ?>
    <div class="col-lg-12 col-md-12">
        <div class="panel panel-default">
            <div class="panel-body">
                <figure class="highcharts-figure">
                    <div id="comments_chart"></div>
                </figure>
            </div>
        </div>
    </div>

    <!-- <div class="col-lg-4 col-sm-12">
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
    </div> -->
<?php } ?>



<?php if ($repostsChart == 'true') { ?>
    <div class="col-lg-12 col-md-12">
        <div class="panel panel-default">
            <div class="panel-body">
                <figure class="highcharts-figure">
                    <div id="reposts_chart"></div>
                </figure>
            </div>
        </div>
    </div>

    <!-- <div class="col-lg-4 col-sm-12">
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
    </div> -->
<?php } ?>


<script>
    function createChart(container, name, subtitle, data) {
        Highcharts.chart(container, {
            chart: {
                type: 'spline',
                scrollablePlotArea: {
                    minWidth: 600,
                    scrollPositionX: 1
                }
            },
            title: {
                text: name,
                align: 'center'
            },
            xAxis: {
                accessibility: {
                    rangeDescription: 'Показатель'
                },
                categories: [<?= "'" . implode("', '", $dates) . "'" ?>]
            },
            yAxis: {
                title: {
                    text: subtitle
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
            series: data,
            navigation: {
                menuItemStyle: {
                    fontSize: '10px'
                }
            }
        });

    }


    function createRadar(container, name, subtitle, data, keys) {
        for (let i = 0; i < keys.length; i++) {
            if (keys[i] == 'fb') {
                keys[i] = 'Facebook'
            } else if (keys[i] == 'ig') {
                keys[i] = 'Instagram'
            } else if (keys[i] == 'tg') {
                keys[i] = 'Telegram'
            } else if (keys[i] == 'web') {
                keys[i] = 'Web-Sites'
            } else if (keys[i] == 'positive') {
                keys[i] = 'Позитив'
            } else if (keys[i] == 'neutral') {
                keys[i] = 'Нейтрал'
            } else if (keys[i] == 'negative') {
                keys[i] = 'Негатив'
            }
        }
        Highcharts.chart(container, {

            chart: {
                polar: true
            },

            title: {
                text: name
            },

            xAxis: {
                accessibility: {
                    rangeDescription: 'Показатель'
                },
                categories: keys
            },

            yAxis: {
                title: {
                    text: subtitle
                },
                minorGridLineWidth: 0,
                gridLineWidth: 0,
                alternateGridColor: null,
            },

            plotOptions: {
                column: {
                    pointPadding: 0,
                    groupPadding: 0
                }
            },

            series: data
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

    <?php if ($discussionChart == 'true') { ?>
        createRadar('total_radar', 'Публикации', 'Кол-во постов', [
            // Формирование объекта с ключ/значениями для js из массива php
            <?php
            $keys = [];
            foreach ($candidateInformation as $candidate) {
                echo "{type: 'area', name: '" . $candidate['name'] . "', data:[";

                foreach ($date_posts[$candidate['id']] as $key => $value) {
                    $sum = 0;
                    array_push($keys, $key);
                    foreach ($value as $v) {
                        $sum += $v;
                    }
                    echo $sum . ", ";
                }
                echo "]}, ";
            } ?>
        ], ['<?= implode("', '", array_unique($keys)) ?>']);
    <?php } ?>


    <?php if ($discussionChart == 'true') { ?>
        createChart('total_chart', 'График публикации', 'Кол-во постов', [
            // Формирование объекта с ключ/значениями для js из массива php
            <?php
            foreach ($candidateInformation as $candidate) {
                $temp = [];
                echo "{name: '" . $candidate['name'] . "', data:[";
                foreach ($date_posts[$candidate['id']] as $key => $value) {
                    foreach ($value as $k => $v) {
                        $temp[$k] = (isset($temp[$k]) ? $temp[$k] : 0) + $v;
                    }
                }
                foreach ($dates as $date) {
                    if(isset($temp[$date])){
                        echo $temp[$date]. ", ";
                    }else{
                        echo "0, ";
                    }
                }
                echo "]}, ";
            } ?>
        ]);
    <?php } ?>


    <?php if ($sentimentChart == 'true') { ?>
        createRadar('sentiment_donut', "Тональность публикации", "Кол-во постов", [
            <?php
            $keys = [];
            foreach ($candidateInformation as $candidate) {
                echo "{type: 'area', name: '" . $candidate['name'] . "', data:[";

                foreach ($postsSentimentChart[$candidate['id']] as $key => $value) {
                    $sum = 0;
                    array_push($keys, $key);
                    foreach ($value as $v) {
                        $sum += $v;
                    }
                    echo $sum . ", ";
                }
                echo "]}, ";
            } ?>
        ], ['<?= implode("', '", array_unique($keys)) ?>']);
    <?php } ?>


    <?php if($subsChart == 'true'){ ?>
        createChart('subs_chart', 'График подписчиков', 'Кол-во подписчиков', [
            // Формирование объекта с ключ/значениями для js из массива php
            <?php
            foreach ($candidateInformation as $candidate) {
                $temp = [];
                echo "{name: '" . $candidate['name'] . "', data:[";
                foreach ($totalSubsChart[$candidate['id']] as $key => $value) {
                    foreach ($value as $k => $v) {
                        $temp[$k] = (isset($temp[$k]) ? $temp[$k] : 0) + $v;
                    }
                }
                foreach ($dates as $date) {
                    if(isset($temp[$date])){
                        echo $temp[$date]. ", ";
                    }else{
                        echo "0, ";
                    }
                }
                echo "]}, ";
            } ?>
        ]);
    <?php } ?>

    <?php if($likesChart == 'true'){ ?>
        createChart('likes_chart', 'График лайков', 'Кол-во лайков', [
            // Формирование объекта с ключ/значениями для js из массива php
            <?php
            foreach ($candidateInformation as $candidate) {
                $temp = [];
                echo "{name: '" . $candidate['name'] . "', data:[";
                foreach ($totalLikesChart[$candidate['id']] as $key => $value) {
                    foreach ($value as $k => $v) {
                        $temp[$k] = (isset($temp[$k]) ? $temp[$k] : 0) + $v;
                    }
                }
                foreach ($dates as $date) {
                    if(isset($temp[$date])){
                        echo $temp[$date]. ", ";
                    }else{
                        echo "0, ";
                    }
                }
                echo "]}, ";
            } ?>
        ]);
    <?php } ?>

    <?php if($commentsChart == 'true'){ ?>
        createChart('comments_chart', 'График комментариев', 'Кол-во комментариев', [
            // Формирование объекта с ключ/значениями для js из массива php
            <?php
            foreach ($candidateInformation as $candidate) {
                $temp = [];
                echo "{name: '" . $candidate['name'] . "', data:[";
                foreach ($totalCommentsChart[$candidate['id']] as $key => $value) {
                    foreach ($value as $k => $v) {
                        $temp[$k] = (isset($temp[$k]) ? $temp[$k] : 0) + $v;
                    }
                }
                foreach ($dates as $date) {
                    if(isset($temp[$date])){
                        echo $temp[$date]. ", ";
                    }else{
                        echo "0, ";
                    }
                }
                echo "]}, ";
            } ?>
        ]);
    <?php } ?>

    <?php if($repostsChart == 'true'){ ?>
        createChart('reposts_chart', 'График репостов', 'Кол-во репостов', [
            // Формирование объекта с ключ/значениями для js из массива php
            <?php
            foreach ($candidateInformation as $candidate) {
                $temp = [];
                echo "{name: '" . $candidate['name'] . "', data:[";
                foreach ($totalRepostsChart[$candidate['id']] as $key => $value) {
                    foreach ($value as $k => $v) {
                        $temp[$k] = (isset($temp[$k]) ? $temp[$k] : 0) + $v;
                    }
                }
                foreach ($dates as $date) {
                    if(isset($temp[$date])){
                        echo $temp[$date]. ", ";
                    }else{
                        echo "0, ";
                    }
                }
                echo "]}, ";
            } ?>
        ]);
    <?php } ?>
</script>