<?php

namespace frontend\assets;

use yii\web\AssetBundle;
use yii\web\View;

/**
 * Main frontend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        "css/bootstrap.min.css",
        "font-awesome/css/font-awesome.css",
        "css/plugins/morris/morris-0.4.3.min.css",
        "css/plugins/daterangepicker/daterangepicker-bs3.css",
        "css/animate.css",
        "css/style.css",
    ];
    public $js = [
        "js/jquery-3.1.1.min.js",
        "js/popper.min.js",
        "js/bootstrap.js",
        "js/plugins/metisMenu/jquery.metisMenu.js",
        "js/plugins/slimscroll/jquery.slimscroll.min.js",
        "js/plugins/flot/jquery.flot.js",
        "js/plugins/flot/jquery.flot.tooltip.min.js",
        "js/plugins/flot/jquery.flot.spline.js",
        "js/plugins/flot/jquery.flot.resize.js",
        "js/plugins/flot/jquery.flot.pie.js",
        "js/plugins/flot/jquery.flot.symbol.js",
        "js/plugins/flot/curvedLines.js",
        "js/plugins/fullcalendar/moment.min.js",
        "js/plugins/daterangepicker/daterangepicker.js",
        "js/plugins/peity/jquery.peity.min.js",
        "js/demo/peity-demo.js",
        "js/inspinia.js",
        "js/plugins/pace/pace.min.js",
        "js/plugins/jquery-ui/jquery-ui.min.js",
        "js/plugins/sparkline/jquery.sparkline.min.js",
        "js/demo/sparkline-demo.js",
        "js/plugins/chartJs/Chart.min.js",
        "https://code.highcharts.com/maps/highmaps.js",
        "https://code.highcharts.com/mapdata/countries/kz/kz-all.js",
    ];
    
    public $depends = [
        'yii\web\YiiAsset',
        // 'yii\bootstrap5\BootstrapAsset',
    ];
}
