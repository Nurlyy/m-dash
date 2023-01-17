<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var \frontend\models\SignupForm $model */

use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;

$this->title = 'Signup';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="middle-box text-center loginscreen   animated fadeInDown">
    <div>
        <div>

            <h4 class="logo-name">iMAS</h4>
            <p class='logo-subtitle'>Rating</p>
        </div>
        <?php $form = ActiveForm::begin(['id' => 'form-signup', 'options'=>['class' => 'm-t']]); ?>
        <div class="form-group">
            <?= $form->field($model, 'username')->textInput(['autofocus' => true, 'class'=>'form-control'])->input('username', ['placeholder' => 'Имя пользователя'])->label(false) ?>
        </div>
        <div class="form-group">
            <?= $form->field($model, 'email')->textInput()->input('email', ['placeholder' => 'Email адрес'])->label(false) ?>
        </div>
        <div class="form-group">
            <?= $form->field($model, 'password')->passwordInput()->input('password', ['placeholder' => 'Пароль'])->label(false) ?>
        </div>
        <div class="form-group">
            <?= Html::submitButton('Зарегистрироваться', ['class' => 'btn btn-primary block full-width m-b', 'name' => 'signup-button', 'style'=>'border-radius:15px;']) ?>
        </div>

        <?php ActiveForm::end(); ?>

        <a class="btn btn-sm btn-white btn-block" style='border-radius:15px;' href="/site/login">Войти</a>
    </div>
</div>
<!-- 
<div class="middle-box text-center loginscreen   animated fadeInDown">
    <div>
        <div>

            <h1 class="logo-name">iMAS</h1>

        </div>
        <h3>Register to iMAS</h3>
        <p>Create account to see it in action.</p>
        <form class="m-t" role="form" id='form-signup'>
            <div class="form-group">
                <input type="text" class="form-control" placeholder="Name" required="">
            </div>
            <div class="form-group">
                <input type="email" class="form-control" placeholder="Email" required="">
            </div>
            <div class="form-group">
                <input type="password" class="form-control" placeholder="Password" required="">
            </div>
            <div class="form-group">
                <div class="checkbox i-checks"><label> <input type="checkbox"><i></i> Agree the terms and policy </label></div>
            </div>
            <button type="submit" class="btn btn-primary block full-width m-b">Register</button>

            <p class="text-muted text-center"><small>Already have an account?</small></p>
            <a class="btn btn-sm btn-white btn-block" href="login.html">Login</a>
        </form>
        <p class="m-t"> <small>Inspinia we app framework base on Bootstrap 3 &copy; 2014</small> </p>
    </div>
</div> -->