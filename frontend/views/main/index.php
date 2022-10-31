<?php

use yii\helpers\Url;
use yii\helpers\Html;

?>
<nav class="navbar-default navbar-static-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav metismenu" id="side-menu">
            <li class="nav-header">
                <div class="dropdown profile-element">
                    <!-- <img alt="img" src="@web/img/logo_imas.png" height="40px"> -->
                    <?php echo HTML::img('@web/img/logo_imas.png', ['height' => '40px']); ?>
                </div>
            </li>
            <li>
                <a href="<?= Url::to('/main/index') ?>"><i class="fa fa-th-large"></i> <span class="nav-label">Dashboard</span> </a>
            </li>
            <li>
                <a onclick="openurl('facebook')"><i class="fa fa-facebook-square"></i> <span class="nav-label">Facebook</span> </a>
            </li>
            <li>
                <a href="<?= Url::to('/main/instagram') ?>"><i class="fa fa-instagram"></i> <span class="nav-label">Instagram</span> </a>
            </li>
            <li>
                <a href="<?= Url::to('/main/telegram') ?>"><i class="fa fa-telegram"></i> <span class="nav-label">Telegram</span> </a>
            </li>
            <li>
                <a href="<?= Url::to('/main/sites') ?>"><i class="fa fa-newspaper-o"></i> <span class="nav-label">WEB-sites</span> </a>
            </li>
            <li>
                <a href="<?= Url::to('/main/resources') ?>"><i class="fa fa-compass"></i> <span class="nav-label">Источники</span> </a>
            </li>
            <li>
                <a href="<?= Url::to('/main/regions') ?>"><i class="fa fa-globe"></i> <span class="nav-label">Регионы</span> </a>
            </li>
            <li>
                <a href="<?= Url::to('/main/index') ?>"><i class="fa fa-sign-out"></i> <span class="nav-label">Logout</span> </a>
            </li>

        </ul>

    </div>
</nav>

<div id="page-wrapper" class="gray-bg">

</div>



<script>
    window.onload = function() {
        $.ajax({
            url: '/main/dashboard?start_date=<?php echo $start_date ?>&end_date=<?php echo $end_date ?>',
            type: 'GET',
            success: function(data) {
                $('#page-wrapper').html(data);
            }
        });
    }

    function openurl(type){
        $.ajax({
            url: '/main/'+type+'?start_date=<?php echo $start_date ?>&end_date=<?php echo $end_date ?>',
            type: 'GET',
            success: function(data) {
                // $('#page-wrapper').html("");
                history.pushState("/main/index#facebook", "/main/index#facebook", "/main/index#facebook");
                $('#page-wrapper').html(data);
                // console.log(data);
            }
        });
    }
</script>