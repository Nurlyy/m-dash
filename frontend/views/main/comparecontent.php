<?php
// var_dump($totalSubsChart);exit;
if ($ratingToggle == 'true') { ?>
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
                                            <!-- <a onclick='openurl("city", start_date, end_date, <?php #echo $id 
                                                                                                        ?>)' class="float-left">
                                            <img alt="image" style='width:50px;margin-right:10px;' class="rounded-circle" src="<?php #echo $cityInformation[$id]['photo'] 
                                                                                                                                ?>">
                                        </a> -->
                                            <div class="media-body ">
                                                <h4 class="float-right text-navy"><?php echo (isset($rating[$id]) && $rating[$id] != 0 ? round(($rating[$id] / $total) * 100, 2) : 0) ?> %</h4>
                                                <a style="font-size:15px;" onclick='openurl("city", start_date, end_date, <?= $id ?>)'><strong><?= $cityInformation[$id]['name'] ?></strong></a>
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
<?php } ?>


<?php if ($sentimentChart == 'true') { ?>
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
                foreach ($cityInformation as $city) { ?>
                    <div class="ibox-content" style='position:relative !important;'>
                        <a style="font-size:15px;" onclick='openurl("city", start_date, end_date, <?= $city["id"] ?>)'><strong><?= $city['name'] ?></strong></a>
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
    function createChart(container, name, subtitle, subsubtitle, data) {
        dates = [<?= "'" . implode("', '", $dates) . "'" ?>];
        names = [];
        datas = [];
        keys = [];
        temp = [];
        datas_name = '';
        for (let value of Object.keys(data)) {
            names.push(value);
        };

        for (let i = 0; i < names.length; i++) {
            temp = [];
            for (let j = 0; j < dates.length; j++) {
                temp.push((data[names[i]][dates[j]]) ? data[names[i]][dates[j]] : 0);
            }
            datas[i] = {
                name: names[i],
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
    posts = {};

    function createobj(name, key, value) {
        // posts= {};
        if (posts[name]) {
            if (posts[name][key]) {
                posts[name][key] = posts[name][key] + value;
            } else {
                posts[name][key] = value;
            }
        } else {
            posts[name] = {};

            if (posts[name][key]) {
                posts[name][key] = posts[name][key] + value;
            } else {
                posts[name][key] = value;
            }
        }

    }


    function createRadar(container, name, subtitle, data, keys) {
        for (let i = 0; i < keys.length; i++) {
            if (keys[i] == 'fb') {
                keys[i] = 'Facebook'
            } else if (keys[i] == 'ig') {
                keys[i] = 'Instagram'
            } else if (keys[i] == 'tg') {
                keys[i] = 'Telegram'
            } else if (keys[i] == 'tt') {
                keys[i] = 'TikTok'
            } else if (keys[i] == 'mm') {
                keys[i] = '<?= Yii::t('frontend', 'Moi Mir'); ?>'
            } else if (keys[i] == 'yt') {
                keys[i] = 'YouTube'
            } else if (keys[i] == 'ok') {
                keys[i] = '<?= Yii::t('frontend', 'Odnoklassniki'); ?>'
            } else if (keys[i] == 'tw') {
                keys[i] = 'Twitter'
            } else if (keys[i] == 'gg') {
                keys[i] = 'Google+'
            } else if (keys[i] == 'vk') {
                keys[i] = '<?= Yii::t('frontend', 'Vkontakte'); ?>'
            } else if (keys[i] == 'positive') {
                keys[i] = '<?= Yii::t('frontend', 'Positive'); ?>'
            } else if (keys[i] == 'neutral') {
                keys[i] = '<?= Yii::t('frontend', 'Neutral'); ?>'
            } else if (keys[i] == 'negative') {
                keys[i] = '<?= Yii::t('frontend', 'Negative'); ?>'
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
                    rangeDescription: '<?= Yii::t('frontend', 'Index') ?>'
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


    <?php if ($discussionChart == 'true') { ?>
        createRadar('total_radar', '<?= Yii::t('frontend', 'Publications') ?>', '<?= Yii::t('frontend', 'Count of posts') ?>', [
            // Формирование объекта с ключ/значениями для js из массива php
            <?php
            $keys = [];
            foreach ($cityInformation as $city) {
                echo "{type: 'area', name: '" . $city['name'] . "', data:[";

                foreach ($date_posts[$city['id']] as $key => $value) {
                    $sum = 0;
                    foreach ($value as $v) {
                        $sum += $v;
                    }
                    if ($sum > 0) {
                        echo $sum . ", ";
                        array_push($keys, $key);
                    }
                }
                echo "]}, ";
            } ?>
        ], ['<?= implode("', '", array_unique($keys)) ?>']);
    <?php } ?>

    <?php if ($sentimentChart == 'true') { ?>
        createRadar('total_donut', '<?= Yii::t('frontend', 'Publications') ?>', '<?= Yii::t('frontend', 'Count of posts') ?>', [
            // Формирование объекта с ключ/значениями для js из массива php
            <?php
            $keys = [];
            foreach ($cityInformation as $city) {
                echo "{type: 'area', name: '" . $city['name'] . "', data:[";

                foreach ($postsSentimentChart[$city['id']] as $key => $value) {
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

    <?php
    function call_createobj($city_inf, $array)
    {
        foreach ($city_inf as $city) {
            if (isset($array[$city['id']])) {
                foreach ($array[$city['id']] as $value) {
                    foreach ($value as $k => $v) {
    ?>
                        createobj('<?= $city['name'] ?>', '<?= $k ?>', <?= $v ?>);
    <?php
                    }
                }
            }
        }
    } ?>

    <?php
    if ($discussionChart == 'true') {
        call_createobj($cityInformation, $date_posts);
    ?>
        createChart('total_chart', '<?= Yii::t('frontend', 'Publications of sources') ?>', '<?= Yii::t('frontend', 'Count of posts') ?>', '<?= Yii::t('frontend', 'posts') ?>', posts);
        posts = {};
    <?php
    }
    ?>

    <?php
    if ($subsChart == 'true') {
        call_createobj($cityInformation, $totalSubsChart);
    ?>
        createChart('subs_chart', '<?= Yii::t('frontend', 'Subscribers Chart') ?>', '<?= Yii::t('frontend', 'Number of followers') ?>', '<?= Yii::t('frontend', 'subscribers') ?>', posts);
        posts = {};
    <?php
    }
    ?>

    <?php
    if ($likesChart == 'true') {
        call_createobj($cityInformation, $totalLikesChart);
    ?>
        createChart('likes_chart', '<?= Yii::t('frontend', 'Likes Chart') ?>', '<?= Yii::t('frontend', 'Number of likes') ?>', '<?= Yii::t('frontend', 'likes') ?>', posts);
        posts = {};
    <?php
    }
    ?>

    <?php
    if ($commentsChart == 'true') {
        call_createobj($cityInformation, $totalCommentsChart);
    ?>
        createChart('comments_chart', '<?= Yii::t('frontend', 'Comments Chart') ?>', '<?= Yii::t('frontend', 'Number of comments') ?>', '<?= Yii::t('frontend', 'comments') ?>', posts)
        posts = {};
    <?php
    }
    ?>

    <?php
    if ($repostsChart == 'true') {
        call_createobj($cityInformation, $totalRepostsChart);
    ?>
        createChart('reposts_chart', '<?= Yii::t('frontend', 'Reposts Chart') ?>', '<?= Yii::t('frontend', 'Number of reposts') ?>', '<?= Yii::t('frontend', 'reposts') ?>', posts);
        posts = {};
    <?php
    }
    ?>


    //     <?php
            //      if ($sentimentChart == 'true') { 
            ?>
    //         createRadar('sentiment_donut', "Тональность публикации", "Кол-во постов", [
    //             <?php

                    //             $keys = [];
                    //             foreach ($cityInformation as $city) {
                    //                 echo "{type: 'area', name: '" . $city['name'] . "', data:[";

                    //                 foreach ($postsSentimentChart[$city['id']] as $key => $value) {
                    //                     $sum = 0;
                    //                     array_push($keys, $key);
                    //                     foreach ($value as $v) {
                    //                         $sum += $v;
                    //                     }
                    //                     echo $sum . ", ";
                    //                 }
                    //                 echo "]}, ";
                    //             } 
                    ?>
    //         ], ['<?php #echo implode("', '", array_unique($keys)) 
                    ?>']);
    //     <?php
            //  } 
            ?>
</script>