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
                <a href="#mainpage" onclick='openurl("mainpage", start_date, end_date, null)'><i class="fa fa-th-large"></i> <span class="nav-label">Проекты</span></a>
            </li>
            <li>
                <a href="#createproject" onclick='openurl("createproject", start_date, end_date, null)'><i class="fa fa-plus"></i> <span class="nav-label">Создать проект</span></a>
            </li>
            <!-- <li>
                <a href="#" onclick='openurl("compare", start_date, end_date)'><i class="fa fa-clone"></i> <span class="nav-label">Сравнить</span></a>
            </li> -->

        </ul>

    </div>
</nav>

<div id="page-wrapper" style="background-color: #ededed">
    <div class="row border-bottom" style="position:fixed; width:inherit; z-index:99; box-shadow: 0px 0.5px 10px #878787;">
        <nav class="navbar navbar-static-top white-bg" role="navigation" style="margin-bottom: -1px">
            <div class="navbar-header">
                <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>
            </div>


            <ul class="nav navbar-top-links navbar-right">
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
    window.onload = function() {
        let urlString = window.location.href.toString();

        if (urlString.includes('#') && urlString.split('#')[1]) {
            var controller = urlString.split('#');
            var action = controller[1].split('?');
            if (['mainpage', 'project', 'createproject'].includes(action[0])) {
                if (action[1]) {
                    if (action[1].includes("first=")) {
                        var url = "/super/" + action[0];
                    } else {
                        var url = '/super/' + controller[1];
                    }
                } else {
                    var url = '/super/' + action[0];
                }
                $.ajax({
                    url: url,
                    type: 'GET',
                    success: function(data) {
                        history.pushState("", "", "/super/index#" + controller[1])
                        $('.wrapper-content').html(data);
                        // startCompare();
                    }
                });

            }
        } else {
            $.ajax({
                url: '/super/mainpage',
                type: 'GET',
                success: function(data) {
                    history.pushState("", "", "/super/index#mainpage")
                    $('.wrapper-content').html(data);
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