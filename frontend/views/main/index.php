<?php

use yii\helpers\Url;
use yii\helpers\Html;

$this->registerCssFile("css/plugins/ladda/ladda-themeless.min.css");

?>
<nav class="navbar-default navbar-static-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav metismenu" id="side-menu">
            <li class="nav-header">
                <div class="dropdown profile-element">
                    <img alt="img" src="/img/logo_imas.png" height="40px">
                </div>
            </li>
            <li>
                <a href="#dashboard" onclick='openurl("main", "dashboard", start_date, end_date, null)'><i class="fa fa-th-large"></i> <span class="nav-label">Главная</span></a>
            </li>
            <li>
                <a href="#"><i class="fa fa-globe"></i> <span class="nav-label">Города</span><span class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse">
                    <?php foreach ($candidateInformation as $candidate) { ?>
                        <li><a onclick='openurl("main", "candidate", start_date, end_date, <?= $candidate["id"] ?>)' href='#candidate<?= $candidate['id'] ?>'><?= $candidate['name'] ?></a></li>
                    <?php } ?>
                </ul>
            </li>
            <li>
                <a href="#" onclick='openurl("main", "compare", start_date, end_date)'><i class="fa fa-clone"></i> <span class="nav-label">Сравнить</span></a>
            </li>

        </ul>

    </div>
</nav>

<div id="page-wrapper" style="background-color: #ededed">
    <div class="row border-bottom" style="position:fixed; width:inherit; z-index:99; box-shadow: 0px 0.5px 10px #878787;">
        <nav class="navbar navbar-static-top white-bg" role="navigation" style="margin-bottom: -1px">
            <div class="navbar-header">
                <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>
                <ul class="nav navbar-top-links navbar-left" style="margin-top: 12px; padding-left:15px;">
                    <li>
                        <div class="filter_datetime p-t-0 f-l">
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
                    <button onclick="createPdf()" class="ladda-button btn btn-primary" data-style="zoom-in" style="margin-left: 20px; margin-right: 10px;"><i class="fa fa-paste"></i> Экспорт PDF</button>
                </li>
                <li>
                    <a onclick="logout()" data-toggle="modal" data-target="#myModal2">
                        <i class="fa fa-sign-out"></i> Выход
                    </a>
                </li>

            </ul>
        </nav>
    </div>

    <div class="modal inmodal" id="myModal2" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content animated flipInY">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title">Вы уверены?</h4>
                </div>
                <div class="modal-footer">
                    <!-- <button type="button" onclick="logout()" class="btn btn-white" data-dismiss="modal">Да</button> -->
                    <form action="/site/logout" method="POST"><input type="hidden" name="<?= Yii::$app->request->csrfParam ?>" value="<?= Yii::$app->request->getCsrfToken() ?>" /><input type="submit" value="Да" class="btn btn-white" /></form>
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Нет</button>
                </div>
            </div>
        </div>
    </div>

    <div id="main_wrapper_container" class="wrapper wrapper-content">

    </div>

    <div class="footer" style="background-color: #ededed">
        <div class="text-center"><strong>
                "iMAS GROUP" 2014
                - ∞
            </strong></div>
    </div>
</div>



<script>
    function createPdf() {
        var element = document.getElementById("main_wrapper_container");
        if ($("#comparecontent")) {
            var element = document.getElementById("comparecontent");
        }
        var opt = {
            jsPDF: {
                format: 'a3',
                orientation: 'landscape'
            },
            html2canvas: {
                scale: 3,
                letterRendering: true,
                useCORS: true,
                logging: true
            },
            image: {
                type: 'jpeg',
                quality: 0.95
            },
            filename: 'rating_iMAS.pdf'
        };
        html2pdf().set(opt).from(element).save();

    }

    window.onload = function() {
        let urlString = window.location.href.toString();

        console.log(urlString)
        // console.log("fjdos")

        if (urlString.includes('#') && urlString.split('#')[1]) {
            var words = urlString.split('#');
            var action = words[1].split('?');
            if (['dashboard', 'candidate', 'compare', 'comparecontent'].includes(action[0])) {
                // console.log("fjdos")
                if (action[1]) {
                    // console.log("fjdos")
                    if (action[1].includes("first=")) {
                        var url = "/main/" + action[0] + "?" + action[1].split("&first=")[0];
                        // console.log("fjdos")
                    } else {
                        // console.log("fjdos")
                        var url = '/main/' + words[1];
                    }
                } else {
                    var url = '/main/' + action[0] + '?start_date=<?php echo $start_date ?>&end_date=<?php echo $end_date ?>';
                }
                // console.log("fjdos")
                $.ajax({
                    url: url,
                    type: 'GET',
                    success: function(data) {
                        history.pushState("/main/index#" + words[1], "/main/index#" + words[1], "/main/index#" + words[1])
                        $('.wrapper-content').html(data);
                        startCompare();
                        console.log("fjdos")
                    }
                });

            }
        } else {


            $.ajax({
                url: '/main/dashboard?start_date=<?php echo $start_date ?>&end_date=<?php echo $end_date ?>',
                type: 'GET',
                success: function(data) {
                    history.pushState("/main/index#dashboard?start_date=<?php echo $start_date ?>&end_date=<?php echo $end_date ?>", "/main/index#dashboard?start_date=<?php echo $start_date ?>&end_date=<?php echo $end_date ?>", "/main/index#dashboard?start_date=<?php echo $start_date ?>&end_date=<?php echo $end_date ?>")
                    $('.wrapper-content').html(data);
                    // console.log("fjdos")
                }
            });
            
        }
    }

    function logout() {
        $.ajax({
            url: "/site/logout",
            type: "POST",
            success: function(data) {

            }
        });
    }
</script>