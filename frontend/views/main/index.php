<?php

use yii\helpers\Url;
use yii\helpers\Html;

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
                <a href="#dashboard" onclick='openurl("dashboard", start_date, end_date)'><i class="fa fa-th-large"></i> <span class="nav-label">Главная</span></a>
            </li>
            <li>
                <a href="#"><i class="fa fa-user"></i> <span class="nav-label">Кандидаты</span><span class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse">
                    <li><a href="#">Кандидат</a></li>
                    <li><a onclick='openurl("candidate", start_date, end_date)' href='#candidate'>Кандидат</a></li>
                    <li><a onclick='openurl("candidate", start_date, end_date)' href='#candidate'>Кандидат</a></li>
                    <li><a onclick='openurl("candidate", start_date, end_date)' href='#candidate'>Кандидат</a></li>
                    <li><a onclick='openurl("candidate", start_date, end_date)' href='#candidate'>Кандидат</a></li>
                    <li><a onclick='openurl("candidate", start_date, end_date)' href='#candidate'>Кандидат</a></li>
                    <li><a onclick='openurl("candidate", start_date, end_date)' href='#candidate'>Кандидат</a></li>
                    <li><a onclick='openurl("candidate", start_date, end_date)' href='#candidate'>Кандидат</a></li>
                </ul>
            </li>
            <li>
                <a href="#" onclick='openurl("compare", start_date, end_date)'><i class="fa fa-clone"></i> <span class="nav-label">Сравнить</span></a>
            </li>

        </ul>

    </div>
</nav>

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
                    <a href="logout.html" data-toggle="modal" data-target="#myModal2">
                        <i class="fa fa-sign-out"></i> Log out
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
                    <button type="button" class="btn btn-primary">Нет</button>
                </div>
            </div>
        </div>
    </div>

    <div class="wrapper wrapper-content">

    </div>

    <div class="footer">
        <div>
            Смыслы и послания данного сайта созданы командой iMAS, не пытайтесь их повторить. "iMAS GROUP". 2014
            - ∞
        </div>
    </div>
</div>



<script>
    window.onload = function() {
        let urlString = window.location.href.toString();
        if (urlString.includes('#')) {
            var words = urlString.split('#');
            var action = words[1].split('?');
            if (['dashboard', 'facebook', 'instagram', 'telegram', 'regions', 'resources', 'sites', 'candidate', 'compare'].includes(action[0])) {
                if (action[1]) {
                    var url = '/main/' + words[1];
                } else {
                    var url = '/main/' + action[0] + '?start_date=<?php echo $start_date ?>&end_date=<?php echo $end_date ?>';
                }
                // console.log(action[1]);
                $.ajax({
                    url: url,
                    type: 'GET',
                    success: function(data) {
                        history.pushState("/main/index#" + words[1], "/main/index#" + words[1], "/main/index#" + words[1])
                        $('.wrapper-content').html(data);
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
                }
            });
        }

    }
</script>