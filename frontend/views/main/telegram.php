<?php use yii\bootstrap5\Html as Html; ?>

<div id="page-wrapper" class="gray-bg">
    <div class="row border-bottom">
        <nav class="navbar navbar-static-top white-bg" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>
                <ul class="nav navbar-top-links navbar-left m-t-15">
                    <li>
                        <div class="filter_datetime p-t-0 f-l">
                            <!-- v:004-92M -->
                            <div id="reportrange" class="form-control b-none">
                                <i class="fa fa-calendar p-r-5"></i>
                                <span></span>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
            
            <ul class="nav navbar-top-links navbar-right">
                <li>
                    <a href="info.html">
                        <i class="fa fa-info-circle" style="color: #1ab394;"></i>
                    </a>
                </li>
                <li>
                    <a href="logout.html">
                        <i class="fa fa-sign-out"></i> Log out
                    </a>
                </li>
            </ul>
        </nav>
    </div>


    <div class="wrapper wrapper-content">
        <div class="row">
            <div class="col-lg-2">
                <div class="ibox ">
                    <div class="ibox-title">
                        <h2><i class="fa fa-telegram"></i> Telegram</h2>
                    </div>
                    <div class="ibox-content">
                        <h4 class="no-margins">132 канала</h4>
                    </div>
                </div>
            </div>
            <div class="col-lg-2">
                <div class="ibox ">
                    <div class="ibox-title">
                        <h5><i class="fa fa-newspaper-o"></i> Публикаций</h5>
                    </div>
                    <div class="ibox-content">
                        <h1 class="no-margins">1 169</h1>
                        <div class="stat-percent font-bold text-info">17% <i class="fa fa-level-up"></i></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-2">
                <div class="ibox ">
                    <div class="ibox-title">
                        <h5><i class="fa fa-share"></i> Ответов</h5>
                    </div>
                    <div class="ibox-content">
                        <h1 class="no-margins">146</h1>
                        <div class="stat-percent font-bold text-info">7% <i class="fa fa-level-up"></i></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-2">
                <div class="ibox ">
                    <div class="ibox-title">
                        <h5><i class="fa fa-users"></i> Подписчиков</h5>
                    </div>
                    <div class="ibox-content">
                        <h1 class="no-margins">1.2 млн</h1>
                        <div class="stat-percent font-bold text-info">2% <i class="fa fa-level-up"></i></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox ">
                    <div class="ibox-content">
                        <div class="tabs-container">
                            <ul class="nav nav-tabs" role="tablist">
                                <li><a class="nav-link active" data-toggle="tab" href="#tab-posts">Посты</a></li>
                                <li><a class="nav-link" data-toggle="tab" href="#tab-members">Подписчики</a></li>
                                <li><a class="nav-link" data-toggle="tab" href="#tab-reposts">Ответы</a></li>
                            </ul>
                            <div class="tab-content">
                                <div role="tabpanel" id="tab-posts" class="tab-pane active">
                                    <div class="panel-body">
                                        <div class="row">
                                            <div class="col-lg-8">
                                                <div id="container_dynamic_posts"></div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div id="container_map_posts"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div role="tabpanel" id="tab-reposts" class="tab-pane active">
                                    <div class="panel-body">
                                        <div class="row">
                                            <div class="col-lg-8">
                                                <div id="container_dynamic_reposts"></div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div id="container_map_reposts"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div role="tabpanel" id="tab-members" class="tab-pane active">
                                    <div class="panel-body">
                                        <div class="row">
                                            <div class="col-lg-8">
                                                <div id="container_dynamic_members"></div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div id="container_map_members"></div>
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

        <div class="row">
            <div class="col-lg-8">
                <div class="ibox ">
                    <div class="ibox-title">
                        <h5>Рейтинг Facebook</h5>
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
                            <table class="table table-striped table-bordered table-hover dataTables-example" >
                                <tr>
                                                <th>№</th>
                                                <th>Канал</th>
                                                <th>Публикаций</th>
                                                <th>Подписчиков</th>
                                                <th>Ответов</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                                <tr><td>1</td><td>Школа №180 Алматы</td><td>2134</td><td>24635</td><td>242</td></tr>
                                                <tr><td>2</td><td>Школа-лицей №64 Нур-Султан</td><td>985</td><td>23811</td><td>113</td></tr>
                                                <tr><td>3</td><td>Школа-лицей №59 Нур-Султан</td><td>621</td><td>14284</td><td>36</td></tr>
                                                <tr><td>4</td><td>Школа №170 Алматы</td><td>487</td><td>21754</td><td>29</td></tr>
                                                <tr><td>5</td><td>Гимназия №46 Алматы</td><td>170</td><td>22133</td><td>42</td></tr>
                                                <tr><td>6</td><td>Школа Гимназия №2 Нур-Султан</td><td>86</td><td>17779</td><td>28</td></tr>
                                                <tr><td>7</td><td>Школа №115 Алматы</td><td>199</td><td>23099</td><td>42</td></tr>
                                                <tr><td>8</td><td>Школа №127 Алматы</td><td>133</td><td>16747</td><td>28</td></tr>
                                                <tr><td>9</td><td>Школа №101 Алматы</td><td>57</td><td>16368</td><td>21</td></tr>
                                                <tr><td>10</td><td>Школа №135 Алматы</td><td>22</td><td>17038</td><td>20</td></tr>
                                                <tr><td>11</td><td>Школа №52 Алматы</td><td>26</td><td>4981</td><td>19</td></tr>
                                                <tr><td>12</td><td>Школа-Гимназия №1 им. Пушкина Шымкент</td><td>109</td><td>4408</td><td>10</td></tr>
                                                <tr><td>13</td><td>Школа Гимназия №1 Алматы</td><td>26</td><td>2550</td><td>29</td></tr>
                                                <tr><td>14</td><td>Школа Гимназия №6 Нур-Султан</td><td>40</td><td>3053</td><td>16</td></tr>
                                                <tr><td>15</td><td>Школа-лицей №37 Нур-Султан</td><td>66</td><td>2621</td><td>18</td></tr>
                                                <tr><td>16</td><td>Школа Гимназия №144 Алматы</td><td>27</td><td>2395</td><td>17</td></tr>
                                                <tr><td>17</td><td>Школа-интернат ДАРЫН Караганда</td><td>62</td><td>2137</td><td>42</td></tr>
                                                <tr><td>18</td><td>Лицей-интернат для одаренных юношей Нур-Султан</td><td>22</td><td>2214</td><td>155</td></tr>
                                                <tr><td>19</td><td>Лицей №134 Алматы</td><td>8</td><td>1762</td><td>68</td></tr>			
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="ibox ">
                    <div class="ibox-title">
                        <h5>Последние публикации</h5>
                        <div class="ibox-tools">
                       </div>
                    </div>
                    <div class="ibox-content">
                        <div>
                            <div class="feed-activity-list">
                                <div class="feed-element">
                                    <a class="float-left" href="profile.html">
                                        <!-- <img alt="image" class="rounded-circle" src="img/a3.jpg"> -->
                                        <?= Html::img('@web/img/a3.jpg', ['class'=>'rounded-circle']) ?>

                                    </a>
                                    <div class="media-body ">
                                        <strong>Гимназия №46 Алматы</strong> <br>
                                        <small class="text-muted">17:02, 29 Сентября 2022, Понедельник</small>
                                        <div class="well">
                                            В КГУ "Гимназия № 46" города Алматы прошли классные часы "Молодёжь против коррупции", а также мероприятие в актовом зале "Роль молодежи в реализации государственной политики по противодействию коррупции"
                                        </div>
                                    </div>
                                </div>
                                <div class="feed-element">
                                    <a class="float-left" href="profile.html">
                                        <!-- <img alt="image" class="rounded-circle" src="img/a3.jpg"> -->
                                        <?= Html::img('@web/img/a3.jpg', ['class'=>'rounded-circle']) ?>

                                    </a>
                                    <div class="media-body ">
                                        <strong>Школа Гимназия №2 Нур-Султан</strong> <br>
                                        <small class="text-muted">01:10, 04 Октября 2022, Вторник</small>
                                        <div class="well">
                                            Сегодня, 04.10, в нашей школе начался месяц методического объединения учителей английского языка. С утра, до уроков, ученики 8-9 классов делились своим хорошим настроением с ребя...
                                        </div>
                                    </div>
                                </div>
                                <div class="feed-element">
                                    <a class="float-left" href="profile.html">
                                        <!-- <img alt="image" class="rounded-circle" src="img/a5.jpg"> -->
                                        <?= Html::img('@web/img/a5.jpg', ['class'=>'rounded-circle']) ?>

                                    </a>
                                    <div class="media-body ">
                                        <strong>Школа-лицей №59 Нур-Султан</strong> <br>
                                        <small class="text-muted">15:02, 22 Сентября 2022, Четверг</small>
                                        <div class="well">
                                            30 марта 2022 года в столице Республики Казахстан – городе Нур-Султан ГУ «Институт истории государства» КН МОН РК совместно с ГКП на ПХВ «Школа-лицей №59» акимата гор...
                                        </div>
                                    </div>
                                </div>
                                <div class="feed-element">
                                    <a class="float-left" href="profile.html">
                                        <!-- <img alt="image" class="rounded-circle" src="img/a6.jpg"> -->
                                        <?= Html::img('@web/img/a6.jpg', ['class'=>'rounded-circle']) ?>

                                    </a>
                                    <div class="media-body ">
                                        <strong>Школа Гимназия №1 Алматы</strong> <br>
                                        <small class="text-muted">14:37, 16 Сентября 2022, Понедельник</small>
                                        <div class="well">
                                            Алматы облысының тілдерді дамыту жөніндегі басқармасының ұйымдастырылуымен «Қазақстан халқы тілдері күні» аясындағы  «Тіл шебері» байқауының қорытынд...
                                        </div>
                                    </div>
                                </div>
                                <div class="feed-element">
                                    <a class="float-left" href="profile.html">
                                        <!-- <img alt="image" class="rounded-circle" src="img/a6.jpg"> -->
                                        <?= Html::img('@web/img/a6.jpg', ['class'=>'rounded-circle']) ?>

                                    </a>
                                    <div class="media-body ">
                                        <strong>Школа-гимназия № 6 им. Абая Кунанбаева</strong> <br>
                                        <small class="text-muted">10:37, 02 Сентября 2022, Пятница</small>
                                        <div class="well">
                                            02 сентября 2022 года в КГУ "Школа-гимназия № 6 имени Абая Кунанбаева" состоялся кинопоказ документального фильма известного российского режиссёра Константина Харалампидиса "Батыры Великой Отечественной", посвяще..
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
    
    <div class="footer">
        <div>
            Смыслы и послания данного сайта созданы командой iMAS, не пытайтесь их повторить. "iMAS GROUP". 2014 - ∞
        </div>
    </div>

</div>



<?php

$this->registerJs("
  

function do_daterangepicker_stuff(start, end, label) {
    $('#reportrange span').html(start.format('D.MM.YYYY') + ' - ' + end.format('D.MM.YYYY'));
}
function create_daterangepicker(){
    // v:004-92M
    const string_date = '15.10.2021 - 15.11.2021';
    const daterangepicker_setting = {
        format: 'DD.MM.YYYY',
        startDate: '15.10.2021',
        endDate: '15.11.2021',
        minDate: '01.10.2021',
        maxDate: '31.12.2021',
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
    $('#reportrange span').html(string_date);
    $('#reportrange').daterangepicker(daterangepicker_setting, do_daterangepicker_stuff);
    // Формирование календаря для малых экаранов
    $('#reportrange-header span').html(string_date);
    $('#reportrange-header').daterangepicker(daterangepicker_setting, do_daterangepicker_stuff);
}
");

$this->registerJs("
$(document).ready(function() {
    create_daterangepicker();
    // Instantiate the map
    // Prepare demo data
    // Data is joined to map using value of 'hc-key' property by default.
    // See API docs for 'joinBy' for more info on linking data and map.
    var map_data = [
        ['kz-qo', 3278],
        ['kz-qs', 2145],
        ['kz-nk', 2413],
        ['kz-pa', 3245],
        ['kz-am', 4825],
        ['kz-zm', 2265],
        ['kz-aa', 5876],
        ['kz-ar', 2168],
        ['kz-mg', 3102],
        ['kz-ek', 3961],
        ['kz-at', 3556],
        ['kz-wk', 1984],
        ['kz-sk', 2978],
        ['kz-qg', 3642]
    ];

    // Create the chart
    Highcharts.mapChart('container_map_posts', {
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
    
    
    Highcharts.mapChart('container_map_reposts', {
        chart: {
            map: 'countries/kz/kz-all'
        },

        title: {
            text: 'Кол-во ответов по областям'
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
            name: 'Кол-во ответов',
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
    
    Highcharts.mapChart('container_map_members', {
        chart: {
            map: 'countries/kz/kz-all'
        },

        title: {
            text: 'Кол-во подписчиков по областям'
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
            name: 'Кол-во подписчиков',
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
    
    
    
    Highcharts.chart('container_dynamic_posts', {

      title: {
        text: ''
      },

      yAxis: [
        {
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
        categories: [
                '21.9.2022',
                '22.9.2022',
                '23.9.2022',
                '24.9.2022',
                '25.9.2022',
                '26.9.2022',
                '27.9.2022',
                '28.9.2022',
                '29.9.2022',
                '30.9.2022',
                '31.9.2022',
                '01.10.2022',
                '02.10.2022',
                '03.10.2022',
                '04.10.2022',
                '05.10.2022',
                '06.10.2022',
                '07.10.2022',
                '08.10.2022',
                '09.10.2022',
                '10.10.2022',
                '11.10.2022',
                '12.10.2022',
                '13.10.2022',
                '14.10.2022',
                '15.10.2022',
                '16.10.2022',
                '17.10.2022',
                '18.10.2022',
                '19.10.2022',
            ]
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
        name: 'Посты',
        data: [124, 96, 125, 112, 62, 113, 67, 56, 111, 118, 86, 127, 126, 76, 120, 94, 56, 128, 87, 105, 54, 101, 110, 100, 112, 76, 116, 102, 88, 106]
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
    
    
    Highcharts.chart('container_dynamic_members', {

      title: {
        text: ''
      },

      yAxis: [
        {
            title: {
              text: 'Кол-во подписчиков'
            }
        }
      ],

      xAxis: {
        accessibility: {
          rangeDescription: 'Показатель'
        },
        categories: [
                '21.9.2022',
                '22.9.2022',
                '23.9.2022',
                '24.9.2022',
                '25.9.2022',
                '26.9.2022',
                '27.9.2022',
                '28.9.2022',
                '29.9.2022',
                '30.9.2022',
                '31.9.2022',
                '01.10.2022',
                '02.10.2022',
                '03.10.2022',
                '04.10.2022',
                '05.10.2022',
                '06.10.2022',
                '07.10.2022',
                '08.10.2022',
                '09.10.2022',
                '10.10.2022',
                '11.10.2022',
                '12.10.2022',
                '13.10.2022',
                '14.10.2022',
                '15.10.2022',
                '16.10.2022',
                '17.10.2022',
                '18.10.2022',
                '19.10.2022',
            ]
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
        name: 'Подписчики',
        data: [960271, 995715, 1026703, 1108701, 1138843, 1145809, 1185331, 1283446, 1297439, 1396714, 1406531, 1488713, 1582278, 1648898, 1694744, 1727927, 1799319, 1816785, 1912428, 1981498, 2058356, 2072991, 2091460, 2118252, 2189074, 2273387, 2363048, 2420255, 2455378]
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
    
    Highcharts.chart('container_dynamic_reposts', {

      title: {
        text: ''
      },

      yAxis: [
        {
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
        categories: [
                '21.9.2022',
                '22.9.2022',
                '23.9.2022',
                '24.9.2022',
                '25.9.2022',
                '26.9.2022',
                '27.9.2022',
                '28.9.2022',
                '29.9.2022',
                '30.9.2022',
                '31.9.2022',
                '01.10.2022',
                '02.10.2022',
                '03.10.2022',
                '04.10.2022',
                '05.10.2022',
                '06.10.2022',
                '07.10.2022',
                '08.10.2022',
                '09.10.2022',
                '10.10.2022',
                '11.10.2022',
                '12.10.2022',
                '13.10.2022',
                '14.10.2022',
                '15.10.2022',
                '16.10.2022',
                '17.10.2022',
                '18.10.2022',
                '19.10.2022',
            ]
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
        name: 'Ответов',
        data: [3, 10, 15, 14, 5, 6, 7, 1, 13, 4, 10, 11, 9, 5, 9, 8, 7, 6, 9, 9, 7, 13, 9, 9, 0, 4, 8, 3, 13, 6]
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
");

$this->registerJs("
$(document).ready(function(){
    $('.dataTables-example').DataTable({
        pageLength: 15,
        responsive: false,
        searching: false,
        lengthChange: false,
        dom: '<\"html5buttons\"B>lTfgitp',
        buttons: [
            { extend: 'copy'},
            {extend: 'csv'},
            {extend: 'excel', title: 'ExampleFile'},
            {extend: 'pdf', title: 'ExampleFile'},

            {extend: 'print',
             customize: function (win){
                    $(win.document.body).addClass('white-bg');
                    $(win.document.body).css('font-size', '10px');

                    $(win.document.body).find('table')
                            .addClass('compact')
                            .css('font-size', 'inherit');
            }
            }
        ]

    });

});

");