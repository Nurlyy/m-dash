<?php

/** @var \yii\web\View $this */
/** @var string $content */

use yii\bootstrap5\Alert;
use frontend\assets\AppAsset;
use yii\bootstrap5\Breadcrumbs;
use yii\bootstrap5\Html;
use yii\bootstrap5\Nav;
use yii\bootstrap5\NavBar;
use yii\helpers\Url;

AppAsset::register($this);
?>

<?php $this->beginPage() ?>
<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php $this->registerCsrfMetaTags() ?>
    <title>Dashboard</title>
    <?php $this->head() ?>


</head>

<body style="padding-right:0px !important;">
    <main role="main" class="flex-shrink-0">
        <div class="container">
            <?php if (Yii::$app->session->getFlash('success') != null) { ?>
                <div class="alert alert-success alert-dismissable">
                    <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                    <?php echo Yii::$app->session->getFlash('success') ?>
                </div>
            <?php } ?>
        </div>
    </main>
    <?php $this->beginBody() ?>
    <div id="wrapper">

        <?= $content ?>

    </div>
    <?php $this->endBody() ?>
</body>

</html>
<?php $this->endPage();
