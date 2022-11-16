<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var \common\models\LoginForm $model */

use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="middle-box text-center loginscreen animated fadeInDown">
    <div>
        <div>

            <h4 class="logo-name">iMAS</h4>
            <p class='logo-subtitle'>Rating</p>

        </div>
        <?php $form = ActiveForm::begin(['id' => 'login-form', 'options' => ['class' => 'm-t']]); ?>
        <div class="form-group">
            <?= $form->field($model, 'username')->textInput(['autofocus' => true])->label(false)->input('username', ['placeholder'=>'Имя пользователя']) ?>
        </div>
        <div class="form-group">
        <?= $form->field($model, 'password')->passwordInput()->label(false)->input('password', ['placeholder'=>'Пароль']) ?>
        </div>
        <div class="form-group">
            <?= $form->field($model, 'rememberMe')->checkbox() ?>
        </div>
        <div class="my-1 mx-0" style="color:#999;">
            Забыли пароль? <?= Html::a('Восстановить', ['site/request-password-reset']) ?>.
            <br>
            Новая ссылка верификации? <?= Html::a('Отправить', ['site/resend-verification-email']) ?>
        </div>

        <div class="form-group">
            <?= Html::submitButton('Войти', ['class' => 'btn btn-primary block full-width m-b', 'name' => 'login-button', 'style'=>'border-radius:15px;']) ?>
        </div>

        <?php ActiveForm::end(); ?>
        <div class="my-1 mx-0" style="color:#999;">
            Не зарегистрированы? <?= Html::a('Зарегистрироваться', ['site/signup']) ?>.
        </div>
    </div>
</div>
