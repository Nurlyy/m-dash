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
        "css/plugins/ladda/ladda-themeless.min.css",
        "css/plugins/footable/footable.core.css",
        "css/plugins/toastr/toastr.min.css",
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
        "js/plugins/ladda/spin.min.js",
        "js/plugins/ladda/ladda.min.js",
        "js/plugins/ladda/ladda.jquery.min.js",
        "js/inspinia.js",
        "js/plugins/pace/pace.min.js",
        "js/plugins/jquery-ui/jquery-ui.min.js",
        "js/plugins/sparkline/jquery.sparkline.min.js",
        "js/demo/sparkline-demo.js",
        "js/plugins/chartJs/Chart.min.js",
        "js/scripts.js",
        "https://code.highcharts.com/maps/highmaps.js",
        "https://code.highcharts.com/mapdata/countries/kz/kz-all.js",
        "https://code.highcharts.com/highcharts.js",
        "https://code.highcharts.com/highcharts-3d.js",
        "https://code.highcharts.com/modules/exporting.js",
        "https://code.highcharts.com/modules/export-data.js",
        "https://code.highcharts.com/modules/accessibility.js",
        "https://code.highcharts.com/highcharts-more.js",
        "https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.3.4/html2canvas.min.js",
        "https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js",
        "js/plugins/footable/footable.all.min.js",
        "js/plugins/toastr/toastr.min.js",
    ];

    public $depends = [
        'yii\web\YiiAsset',
        // 'yii\bootstrap5\BootstrapAsset',
    ];
}
